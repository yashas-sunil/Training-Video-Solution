<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiService;
use App\Services\PaymentService;

class BalanceOrderController extends Controller
{
    /** @var ApiService $apiService */
    var $apiService;

    /** @var PaymentService $paymentService */
    var $paymentService;

    /**
     * BalanceOrderController constructor.
     * @param ApiService $apiService
     * @param PaymentService $paymentService
     */
    public function __construct(ApiService $apiService, PaymentService $paymentService)
    {
        $this->apiService = $apiService;
        $this->paymentService = $paymentService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $orderItem = $this->apiService->showOrderItem($request->input('order_id'), ['relations' => ['order.student.country', 'order.student.state']]);
        $orderItem = $orderItem['data'] ?? null;

        $this->apiService->updatePaymentInitiatedAt($orderItem['order_id']);

        $parameters = [
            'redirect_url' => url('balance-orders/success'),
            'cancel_url' => url('balance-orders/failure'),
            'order_id' => $orderItem['order_id'] . '-F' ?? '',
            'amount' => $orderItem['balance_amount'] ?? '',
            'delivery_name' => $orderItem['order']['student']['name'] ?? '',
            'delivery_address' => $orderItem['order']['student']['address'] ?? '',
            'delivery_zip' => $orderItem['order']['student']['pin'] ?? '',
            'delivery_city' => $orderItem['order']['student']['city'] ?? '',
            'delivery_state' => $orderItem['order']['student']['state']['name'] ?? '',
            'delivery_country' => $orderItem['order']['student']['country']['name'] ?? '',
            'delivery_tel' => $orderItem['order']['phone'] ?? '',
            'merchant_param2' => $orderItem['id'] ?? ''
        ];

        return $this->paymentService->createOrder($parameters);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function handleSuccess(Request $request)
    {
        $paymentResponse = $this->paymentService->getResponse($request);
        $response = $this->apiService->postBalanceOrders($paymentResponse);
        $response = $response['data'];

        if ($response['payment_status'] == 1) {
            $orderItem = $this->apiService->showOrderItem($paymentResponse['merchant_param2']);
            $orderItem = $orderItem['data'];

            return redirect('contents?package=' . $orderItem['package_id'])->with('success', true);
        } else {
            return redirect('payments/failure');
        }
    }

    /**
     * @return mixed
     */
    public function handleFailure()
    {
        return redirect('payments/failure');
    }
}
