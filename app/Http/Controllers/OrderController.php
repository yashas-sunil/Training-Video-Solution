<?php

namespace App\Http\Controllers;;

use App\User;
use Carbon\Carbon;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\ApiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Softon\Indipay\Facades\Indipay;
use App\Common\PaymentStatus;
use App\Easebuzz\EaseBuzz;
use App\Easebuzz\EaseBuzzPayment;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    /** @var ApiService */
    private $apiService;

    /**
     * OrderController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //        return $request->input();
        //        $validate = request()->validate([
        //            'address_id' => 'required',
        //        ],
        //        [
        //            'address_id.required' => 'Please select the address',
        //        ]);
        if (!$request->address_id) {
            return redirect()->back()->with('alert', 'Address required!');
        } else {

            $response = $this->apiService->postOrder($request->input());

            if ($error = $this->handleApiError($response)) {
                return $error;
            }
            $order = $response['data']['store_order'];

            $user = $response['data']['user'];

            if (isset($order['reward_id']) && isset($order['reward_amount']) && $order['net_amount'] == 0) {
                // if ($order['holiday_cashback_point']>0) {
                //     $this->apiService->addJmoney($request->input());
                // }
                return redirect('payments/success');
            }

            if ($order['net_amount'] == 0) {
                // if($order['holiday_cashback_point']>0) {
                //     $this->apiService->addJmoney($request->input());
                // }

                $jcoin = 0;
                if ($order['holiday_cashback_point'] > 0) {
                    $hoID = $order['holiday_offer_id'];
                    $response =  $this->apiService->getJmoneyOffer();
                    $jcoin = $response['data']['points'];
                    $holiday_offer_det = $this->apiService->getHolidayOfferDet(['id' => $hoID]);
                    $holiday_offer_name = $holiday_offer_det['data']['name'] ?? "PROMOTIONAL";
                    $jkoin[0] = $jcoin;
                    $jkoin[1] = $holiday_offer_name;
                    return redirect('payments/success')->with('jkoin', $jkoin);
                } else {
                    return redirect('payments/success');
                }
            }

            if ($request->has('associate_payment_type')) {
                if ($request->input('associate_payment_type') == 'link') {
                    return redirect('associate/payment-link');
                }
            }

            //        $netAmount = null;
            //
            //        if ($order['commission']) {
            //            $netAmount = (intval($order['net_amount']) - intval($order['commission']));
            //        } else {
            //            $netAmount = $order['net_amount'];
            //        }


            //         gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo

            // $order = Indipay::gateway('CCAvenue')->prepare($parameters);

            if ($request->input('spin_wheel_reward_type') == '5' || $request->input('spin_wheel_reward_type') == '6' || ($request->input('spin_wheel_reward_type') == '1' && $request->input('total_amount') == '0')) {
                // if($request->input('rakshajcoin')>0){
                //     $this->apiService->addJmoney($request->input());
                // }
                return redirect('payments/success');
            }
            Session::put('wasPosted', 2);
            $paymentData = [
                'order_id' => $order['id'],
                'gateway_type' => $response['data']['payment_gateway_type'],
                'nth_transaction_counter' => $response['data']['payment_counter']
            ];
            $this->apiService->paymentTransactionHistory($paymentData);

            if ($response['data']['payment_gateway_type'] == 'EASEBUZZ') {
                $city = str_replace($order['city'], ',', ' ');
                $address = preg_replace('/[#$\/%^&*._()+=-]/', '', $order['address']);
                $address = stripslashes($address);
                //dd($address);
                $postData = array(
                    "key" => Config::get('indipay.easebuzz.merchantkey'),
                    // "txnid" =>  substr(hash('sha256', mt_rand() . microtime()), 0, 20),
                    "txnid" => $order['transaction_id'],
                    "amount" => is_int($order['net_amount']) == '1' ? number_format((float)$order['net_amount'], 2, '.', '') : round($order['net_amount'], 2),
                    "firstname" => $user['name'], // "jitendra",
                    "email" => $user['email'], // "test@gmail.com",
                    "phone" => $order['phone'], // "1231231235",
                    "productinfo" => "JK Shah Online Courses",
                    "surl" => url('/easebuzz-payment-status'),
                    "furl" =>  url('/easebuzz-payment-failure'),
                    "udf1" => $order['id'],
                    "udf2" => "",
                    "udf3" => "",
                    "udf4" => "",
                    "udf5" => "",
                    "udf6" => "",
                    "udf7" => "",
                    "address1" => $address, // "aaaa",
                    "address2" => $address, // "aaaa",
                    "city" => $city,
                    "state" => $order['state'],
                    "country" => 'India',
                    "zipcode" => $order['pin'],
                    // "sub_merchant_id" => "S1992SBANV"
                );

                $MERCHANT_KEY = Config::get('indipay.easebuzz.merchantkey');
                $SALT = Config::get('indipay.easebuzz.salt');
                //$ENV = "test";    // setup test enviroment (testpay.easebuzz.in).
                $ENV =  Config::get('indipay.easebuzz.env');   // setup production enviroment (pay.easebuzz.in).



                # create Easebuzz object and pass the merchant key, salt and enviroment
                $easebuzzObj = new EaseBuzz($MERCHANT_KEY, $SALT, $ENV);

                # call to initiate Payment API method for initiate transaction
                $easebuzzObj->initiatePaymentAPI($postData);
            } else {
                $parameters = [
                    'merchant_id' => '245745',

                    'order_id' => $order['id'],

                    'currency' => "INR",

                    'language' => 'EN',

                    'amount' => $order['net_amount'],

                    'redirect_url' => url('/payment-status'), // this is the success url

                    'cancel_url' => url('/payment-failure'), //this is the failure url,

                    'billing_name' =>  $user['name'],

                    'billing_email' =>  $user['email'],

                    'billing_address' =>  $order['address'],

                    'billing_zip' => $order['pin'],

                    'delivery_name' =>  $user['name'],

                    'delivery_tel' =>  $order['phone'],

                    'delivery_address' =>  $order['address'],

                    'delivery_state' =>  $order['state'],

                    'delivery_city' =>  $order['city'],

                    'delivery_country' =>  'India',

                    'delivery_zip' => $order['pin'],



                ];

                $order = Indipay::gateway('CCAvenue')->prepare($parameters);
                return Indipay::process($order);
            }
        }
    }


    public function success(Request $request)
    {
        Session::put('wasPosted', 1);
        $response = Indipay::gateway('CCAvenue')->response($request);

        $transaction_response = json_encode($response);

        $response_parameters = [
            'id' => $response['order_id'],
            'transaction_id' => $response['tracking_id'],
            'transaction_response' => $transaction_response,
            'order_status' => $response['order_status'],
            'amount' => $response['amount'],
        ];

        $response = $this->apiService->updateOrder($response_parameters);

        if ($this->handleApiError($response)) {
            // if ($response['data']['order']['holiday_cashback_point']>0) {
            // $this->apiService->deleteJmoneyOffer();
            // }
            return view('pages.order.failure')->with('json', $transaction_response);
        }

        if ($response['data']['order_status'] == "Success") {
            $amount = $response['data']['order']['net_amount'] ?? null;
            $transactionId = $response['data']['order']['transaction_id'] ?? null;
            $jcoin = 0;
            if ($response['data']['order']['holiday_cashback_point'] > 0) {
                $hoID = $response['data']['order']['holiday_offer_id'];
                $response =  $this->apiService->getJmoneyOffer();
                $jcoin = $response['data']['points'];
                $holiday_offer_det = $this->apiService->getHolidayOfferDet(['id' => $hoID]);
                $holiday_offer_name = $holiday_offer_det['data']['name'] ?? "PROMOTIONAL";
                return view('pages.order.success', compact('amount', 'transactionId', 'jcoin', 'holiday_offer_name'));
            } else {
                return view('pages.order.success', compact('amount', 'transactionId'));
            }
        } else {
            // if ($response['data']['order']['holiday_cashback_point']>0){
            //     $this->apiService->deleteJmoneyOffer();
            // }
            return view('pages.order.failure')->with('json', $transaction_response);
        }
    }

    public function easebuzzsuccess(Request $request)
    {
        # set salt 
        $SALT = Config::get('indipay.easebuzz.salt');

        # create Object of Easebuzz class
        $easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);

        # $result variable store final transaction response
        $result = $easebuzzObj->easebuzzResponse($request->all());

        Session::put('wasPosted', 1);
        $response = json_decode($result, true);

        $response_parameters = [
            'id' => $response['data']['udf1'],
            'transaction_id' => $response['data']['txnid'],
            'transaction_response' => $response['data'],
            'order_status' => $response['data']['status'],
            'amount' => $response['data']['amount'],
        ];
        sleep(180);
        $response = $this->apiService->easeBuzzUpdateOrder($response_parameters);

        if ($this->handleApiError($response)) {

            return view('pages.order.failure')->with('json', $result);
        }

        if ($response['data']['order_status'] == "success") {
            $amount = $response['data']['order']['net_amount'] ?? null;
            $transactionId = $response['data']['order']['transaction_id'] ?? null;
            $jcoin = 0;
            if ($response['data']['order']['holiday_cashback_point'] > 0) {
                $hoID = $response['data']['order']['holiday_offer_id'];
                $response =  $this->apiService->getJmoneyOffer();
                $jcoin = $response['data']['points'];
                $holiday_offer_det = $this->apiService->getHolidayOfferDet(['id' => $hoID]);
                $holiday_offer_name = $holiday_offer_det['data']['name'] ?? "PROMOTIONAL";
                return view('pages.order.success', compact('amount', 'transactionId', 'jcoin', 'holiday_offer_name'));
            } else {
                return view('pages.order.success', compact('amount', 'transactionId'));
            }
        } else {
            // if ($response['data']['order']['holiday_cashback_point']>0){
            //     $this->apiService->deleteJmoneyOffer();
            // }
            return view('pages.order.failure')->with('json', $result);
        }
    }

    public function easebuzzWebhookNotify(Request $request)
    {
        # set salt 
        //  dd($request->all());
        try {

            $SALT = Config::get('indipay.easebuzz.salt');

            # create Object of Easebuzz class
            $easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);

            # $result variable store final transaction response
            $result = $easebuzzObj->easebuzzResponse($request->all());
            $response = json_decode($result, true);
            Log::info('webhook response' . $response['data']['status'] . ' order id=' . $response['data']['udf1'] . ' txtid=' . $response['data']['txnid']);
            if ($response['status'] == 1) {
                Session::put('wasPosted', 1);
                $response_parameters = [
                    'id' => $response['data']['udf1'],
                    'transaction_id' => $response['data']['txnid'],
                    'transaction_response' => $response['data'],
                    'order_status' => $response['data']['status'],
                    'amount' => $response['data']['amount'],
                ];
                $response = $this->apiService->easeBuzzUpdateOrder($response_parameters);
                if ($response['data']['order_status'] == "failures") {
                    // return response()->json(['message' => 'error'], 500);
                    Log::info('web response of failures');
                    return response()->json(['message' => 'success'], 200);
                } else {
                    return response()->json(['message' => 'success'], 200);
                }
            } else {
                // return response()->json(['message' => 'invalid'], 500);
                Log::info('web response of failures:error');
                return response()->json(['message' => 'success'], 200);
            }
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            // return response()->json(['message' => 'error exception', 'data' => $th->getMessage()], 500);
            return response()->json(['message' => 'success'], 200);
        }
    }

    public function easebuzzfailed(Request $request)
    {
        Session::put('wasPosted', 1);
        # set salt 
        $SALT = Config::get('indipay.easebuzz.salt');

        # create Object of Easebuzz class
        $easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);

        # $result variable store final transaction response
        $result = $easebuzzObj->easebuzzResponse($request->all());
        $response = json_decode($result, true);

        $response_parameters = [
            'id' => $response['data']['udf1'],
            'transaction_id' => $response['data']['txnid'],
            'transaction_response' => $response['data'],
            'order_status' => $response['data']['status'],
            'amount' => $response['data']['amount'],
        ];
        sleep(180);
        $this->apiService->easeBuzzUpdateOrder($response_parameters);

        return view('pages.order.cancel')->with('json', $result);
    }
    public function failed(Request $request)
    {
        Session::put('wasPosted', 1);
        $response = Indipay::gateway('CCAvenue')->response($request);

        $transaction_response = json_encode($response);

        $response_parameters = [
            'id' => $response['order_id'],
            'transaction_id' => $response['tracking_id'],
            'transaction_response' => $transaction_response,
            'order_status' => $response['order_status'],
        ];

        $this->apiService->updateOrder($response_parameters);
        // if ($response['data']['order']['holiday_cashback_point']>0){
        //     $this->apiService->deleteJmoneyOffer();
        // }
        return view('pages.order.cancel')->with('json', $transaction_response);
    }


    public function studentPurchase($id)
    {

        $response = $this->apiService->getOrder(["order_id" => $id]);

        $order = $response['data']['order_details'];
        $user = $response['data']['user'];

        $payment_link_expiry = Carbon::parse($order['created_at'])->addDays(env('PAYMENT_LINK_EXPIRY'));

        if (!($order['payment_status'] == PaymentStatus::PENDING && Carbon::now() < $payment_link_expiry)) {
            $error = "";
            $link_error = "";
            if ($order['payment_status'] == PaymentStatus::SUCCESS) {
                $error = "Already Purchased";
            } elseif ($order['payment_status'] == PaymentStatus::FAILURE) {
                $error = "Previous Payment Failed";
            } elseif ($order['payment_status'] == PaymentStatus::ABORTED) {
                $error = "Previous Payment Aborted";
            } elseif ($order['payment_status'] == PaymentStatus::RETURNED) {
                $error = "Previous Order Returned";
            }
            if (Carbon::now() > $payment_link_expiry) {
                $link_error = "Payment Link has expired";
            }
            return view('pages.error')->with(compact('error', 'link_error'));
        } else {
            $parameters = [
                'merchant_id' => '245745',

                'order_id' => $order['id'],

                'currency' => "INR",

                'language' => 'EN',

                'amount' => $order['net_amount'],

                'redirect_url' => url('/payment-status'), // this is the success url

                'cancel_url' => url('/payment-failure'), //this is the failure url,

                'billing_name' =>  $user['name'],

                'billing_email' =>  $user['email'],

                'billing_address' =>  $order['address'],

                'billing_zip' => $order['pin'],

                'delivery_name' =>  $user['name'],

                'delivery_tel' =>  $order['phone'],

                'delivery_address' =>  $order['address'],

                'delivery_state' =>  $order['state'],

                'delivery_city' =>  $order['city'],

                'delivery_country' =>  'India',

                'delivery_zip' => $order['pin'],

            ];

            //         gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo

            $order = Indipay::gateway('CCAvenue')->prepare($parameters);

            return Indipay::process($order);
        }
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function email()
    {
        $attributes = User::find(57);
        $packages = $this->apiService->getPackage(2);
        return view('email')->with(compact('attributes', 'packages'));
    }

    public function markAsCompleted($id)
    {
        $response = $this->apiService->orderItemsMarkAsCompleted($id);
        $response = $response['data'] ?? null;

        return response()->json($response);
    }

    public function checkoutStudyMaterial($id)
    {
        $package = $this->apiService->getPackage($id);

        if ($package->clientError()) {
            abort(404);
        }

        $package = $package['data'];

        $addresses = $this->apiService->getAddresses();

        if ($addresses->clientError()) {
            abort(404);
        }

        $addresses = $addresses['data'];

        $tax = $this->apiService->getTax();

        $cgst = $tax['data']['cgst']['value'];
        $igst = $tax['data']['igst']['value'];
        $sgst = $tax['data']['sgst']['value'];

        $user = $this->apiService->getProfile() ?? null;
        $user = $user['data'] ?? null;

        return view('pages.study-materials.checkout.index', compact('package', 'addresses', 'cgst', 'sgst', 'igst', 'user'));
    }

    public function statusCancelOrderApi()
    {

        $ordersarray = DB::select("select O.id as order_no from orders O where
           TIMESTAMPDIFF(MINUTE,O.created_at,NOW()) <= 30 and O.payment_status=5 and O.payment_mode=1 and O.updated_method!=4 and Date(O.created_at) = CURDATE() ");


        foreach ($ordersarray as $value) {
            $order_no = $value->order_no;

            $this->orderStatus($order_no);
        }


        // $ordercancelsarray = DB::select("select O.id as order_no from orders O where
        // TIMESTAMPDIFF(MINUTE,O.created_at,NOW()) > 30 and O.payment_status=5 and O.payment_mode=1 and Date(O.created_at) = CURDATE()");

        // foreach ($ordercancelsarray as $value) {
        //      $order_no= $value->order_no;

        //      $responseorder =  $this->checkStatus($order_no);

        //     if ($responseorder['order_status'] == 'Shipped') {

        //          $this->orderStatus($order_no);
        //     } else {

        //          $this->orderCancel($responseorder);

        //     }
        // }
        return 8;
    }

    public function orderStatus($order_no)
    {

        $parameters = [
            'order_no' => $order_no
        ];

        $order = Indipay::gateway('CCAvenue')->apiPrepare($parameters);
        $request = Indipay::apiProcess($order);


        $information = explode('&', $request);
        $dataSize = sizeof($information);
        $status1 = explode('=', $information[0]);
        $status2 = explode('=', $information[1]);

        if ($status1[1] == '1') {
            $response = $status2[1];
        } else {
            $actualresponse = rtrim($status2[1]);
            $responseval = Indipay::gateway('CCAvenue')->apiResponse($actualresponse);


            $response = json_decode($responseval, true);


            $response_parameters = [
                'id' => $response['order_no'],
                'transaction_id' => $response['reference_no'],
                'transaction_response' => $responseval,
                'order_status' => $response['order_status'],
                'amount' => $response['order_amt'],
            ];


            $apiresponse = $this->apiService->apiUpdateOrder($response_parameters);


            return  $apiresponse['data']['order_status'];
        }
    }

    public function checkStatus($order_no)
    {

        $parameters = [
            'order_no' => $order_no
        ];

        $order = Indipay::gateway('CCAvenue')->apiPrepare($parameters);
        $request = Indipay::apiProcess($order);


        $information = explode('&', $request);
        $dataSize = sizeof($information);
        $status1 = explode('=', $information[0]);
        $status2 = explode('=', $information[1]);

        if ($status1[1] == '1') {
            $response = $status2[1];
            return 2;
        } else {
            $actualresponse = rtrim($status2[1]);
            $responseval = Indipay::gateway('CCAvenue')->apiResponse($actualresponse);


            $response = json_decode($responseval, true);


            $response_parameters = [
                'id' => $response['order_no'],
                'transaction_id' => $response['reference_no'],
                'transaction_response' => $responseval,
                'order_status' => $response['order_status'],
                'amount' => $response['order_amt'],
            ];
            return  $response_parameters;
        }
    }

    public function orderCancel($responseorder)
    {
        $parameters = array();

        $parameters = array(
            'reference_no' => $responseorder['transaction_id'],
            'amount' => $responseorder['amount']
        );

        $order = Indipay::gateway('CCAvenue')->apiCancelPrepare($parameters);


        $request = Indipay::apiCancelProcess($order);

        $information = explode('&', $request);
        $dataSize = sizeof($information);
        $status1 = explode('=', $information[0]);
        $status2 = explode('=', $information[1]);

        if ($status1[1] == '1') {
            $response = $status2[1];
            return 2;
        } else {
            $actualresponse = rtrim($status2[1]);
            $responseval = Indipay::gateway('CCAvenue')->apiResponse($actualresponse);


            $response = json_decode($responseval, true);

            if ($response['success_count'] > 0) {
                $response_parameters = [
                    'id' => $responseorder['id'],
                    //'transaction_id' =>  $response['failed_List'][0]['reference_no'],
                    'transaction_id' =>  $responseorder['transaction_id'],
                    'transaction_response' => $responseval,
                    'order_status' => 'Cancelled'
                ];
                $apiresponse = $this->apiService->apiCancelOrder($response_parameters);
                return  $apiresponse['data']['order_status'];
            }
            return 1;
        }
    }
}
