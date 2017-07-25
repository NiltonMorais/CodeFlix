<?php
namespace CodeFlix\PayPal;

use CodeFlix\Events\PayPalPaymentApproved;
use CodeFlix\Models\Order;
use CodeFlix\Models\Plan;

class PaymentClient
{
    public function doPayment(Plan $plan): Order{
        // fazer o pagamento com o paypal
        $event = new PayPalPaymentApproved($plan);
        event($event);
        return $event->getOrder();
        // fazer o cadastro da order
    }
}