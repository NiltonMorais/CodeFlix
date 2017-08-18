<?php

namespace CodeFlix\Http\Requests;

use CodeFlix\Models\Plan;
use CodeFlix\PayPal\PaymentClient;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * @var PaymentClient
     */
    private $paymentClient;

    /**
     * OrderRequest constructor.
     */
    public function __construct(PaymentClient $paymentClient)
    {
        $this->paymentClient = $paymentClient;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $paymentId = $this->get('payment_id');
        if(!$paymentId){
            return false;
        }
        $payment = $this->paymentClient->get($paymentId);
        $planSku = $payment->getTransactions()[0]->getItemList()->getItems()[0]->getSku();
        $planId = Plan::getIdFromSku($planSku);
        return $planId == $this->route('plan')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'player_id' => 'required'
        ];
    }
}
