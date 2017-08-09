<?php
namespace CodeFlix\PayPal;

use CodeFlix\Events\PayPalPaymentApproved;
use CodeFlix\Models\Order;
use CodeFlix\Models\Plan;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;

class PaymentClient
{
    public function doPayment(Plan $plan): Order{
        // fazer o pagamento com o paypal
        $event = new PayPalPaymentApproved($plan);
        event($event);
        return $event->getOrder();
        // fazer o cadastro da order
    }

    public function makePayment(Plan $plan){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $duration = $plan->duration == Plan::DURATION_MONTHLY ? 'Mensal' : 'Anual';
        $item->setName("Plano $plan->name - $duration")
            ->setSku($plan->sku)
            ->setCurrency('BRL')
            ->setQuantity(1)
            ->setPrice($plan->value);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($plan->value);

        $amount = new Amount();
        $amount->setCurrency('BRL')
            ->setTotal($plan->value)
            ->setDetails($details);

    }
}