<?php

namespace App\Services;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;

class PaymentService
{
    /**
     * @param array $parameters
     * @return mixed
     */
    public function createOrder($parameters = [])
    {
        $parameters = [
            'merchant_id' => config('indipay.ccavenue.merchantId'),
            'currency' => config('indipay.ccavenue.currency'),
            'redirect_url' => $parameters['redirect_url'],
            'cancel_url' => $parameters['cancel_url'],
            'language' => config('indipay.ccavenue.language'),
            'order_id' => $parameters['order_id'],
            'amount' => $parameters['amount'],
            'delivery_name' => $parameters['delivery_name'],
            'delivery_address' => $parameters['delivery_address'],
            'delivery_zip' => $parameters['delivery_zip'],
            'delivery_city' => $parameters['delivery_city'],
            'delivery_state' => $parameters['delivery_state'],
            'delivery_country' => $parameters['delivery_country'],
            'delivery_tel' => $parameters['delivery_tel'],
            'merchant_param2' => $parameters['merchant_param2']
        ];

        $order = Indipay::prepare($parameters);

        return Indipay::process($order);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getResponse(Request $request)
    {
        return Indipay::gateway('CCAvenue')->response($request);
    }
}
