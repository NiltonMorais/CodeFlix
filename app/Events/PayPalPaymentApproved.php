<?php

namespace CodeFlix\Events;

use CodeFlix\Models\Order;
use CodeFlix\Models\Plan;

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
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Plan $plan)
    {
        //
        $this->plan = $plan;
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
