<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Http\Requests\OrderRequest;
use CodeFlix\Models\Plan;
use CodeFlix\PayPal\PaymentClient;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    /**
     * @var PaymentClient
     */
    private $paymentClient;

    public function __construct(PaymentClient $paymentClient)
    {
        $this->paymentClient = $paymentClient;
    }

    public function store(OrderRequest $request, Plan $plan)
    {
        $order = $this->paymentClient->doPayment($plan);
        return $order;
    }
}
