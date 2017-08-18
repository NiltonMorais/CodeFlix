<?php

namespace CodeFlix\Events;

use CodeFlix\Models\Order;
use CodeFlix\Models\Plan;
use PayPal\Api\Payment;

class PayPalPaymentApproved
{
    /**
     * @var Plan
     */
    private $plan;

    /**
     * @var Order
     */
    private $order;
    /**
     * @var Payment
     */
    private $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Plan $plan, Payment $payment)
    {
        $this->plan = $plan;
        $this->payment = $payment;
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment
    {
        return $this->payment;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @return mixed
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }


}
