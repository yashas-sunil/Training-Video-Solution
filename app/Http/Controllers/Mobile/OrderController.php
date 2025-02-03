<?php

namespace App\Http\Controllers\Mobile;

use App\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /** @var ApiService */
    private $apiService;

    /**
     * CartController constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index() {
        $uuID = $this->getCartUUID();

        $response = $this->apiService->getCart(['uuid' => $uuID]);

        $cart= $response['data'];
        if (request()->ajax()) {
            return response()->json(['data' => $cart]);
        }

        $packages = $this->apiService->getFullPackages();
        $packages = $packages['data'] ?? [];
        $miniPackages = $this->apiService->getMiniPackages();
        $miniPackages = $miniPackages['data'] ?? [];

        return view('mobile.pages.order.index', compact('cart', 'packages', 'miniPackages'));
    }

    public function store(Request $request)
    {
        $response = $this->apiService->postOrder($request->input());
        if ($error = $this->handleApiError($response)) {
            return $error;
        }

        if ($request->has('associate_payment_type')) {
            if ($request->input('associate_payment_type') == 'link') {
                return view('associate.pages.orders.success');
            }
        }

        return view('mobile.pages.order.success');
    }

    public function checkout(Request $request)
    {

        if ($request->has('package')) {
            $response = $this->apiService->getPackage($request->input('package'));

            if ($error = $this->handleApiError($response)) {
                return $error;
            }

            $package = $response['data'];
            $subtotal = $package['price'];
            $total = $package['selling_price'];
            $discountPercentage = round((1 - $total / $subtotal) * 100 * 100) / 100;
            $discountPrice = $subtotal - $total;

            $cart =  [
                'subtotal' => $subtotal,
                'total' => $total,
                'discount' => $discountPrice,
                'discount_percentage' => $discountPercentage,
                'items' => [$package]
            ];
        } else {
            $uuid = $this->getCartUUID();

            $response = $this->apiService->getCart(['uuid' => $uuid]);

            $cart = $response['data'];
        }

        $response = $this->apiService->getAddresses();

        if ($error = $this->handleApiError($response)) {
            return $error;
        }

        $addresses = $response['data'];

        $pendrivePrice = $this->apiService->getSettings(['key' => 'pendrive_price']);

        $pendrivePrice = $pendrivePrice['data'] ?? null;

        $user = $this->apiService->getProfile() ?? null;
        $user = $user['data'] ?? null;

        $associateStudents = $this->apiService->getAssociateStudents();

        $associateStudents = $associateStudents['data'] ?? [];

        return view('mobile.pages.order.checkout', compact('cart', 'addresses', 'pendrivePrice', 'user', 'associateStudents'));
    }


    public function applyCoupon(Request $request) {
        $response = $this->apiService->getCoupons(['amount'=> $request->input('amount'),'coupon' => $request->input('coupon')]);
        return response()->json($response['data']);
    }

    function getCartUUID() {
        $uuid = Cookie::get('cart_uuid');

        if (! $uuid) {
            $uuid = Str::uuid();
            Cookie::queue(Cookie::forever('cart_uuid', $uuid));
        }

        return $uuid;
    }
}
