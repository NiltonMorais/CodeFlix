<?php
/**
 * Created by PhpStorm.
 * User: Sony Vaio
 * Date: 15/08/2017
 * Time: 18:00
 */

namespace CodeFlix\PayPal;


use CodeFlix\Models\PaypalWebProfile;
use PayPal\Api\FlowConfig;
use PayPal\Api\InputFields;
use PayPal\Api\Presentation;
use PayPal\Api\WebProfile;
use PayPal\Rest\ApiContext;

class WebProfileClient
{
    /**
     * @var ApiContext
     */
    private $apiContext;

    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
    }

    public function create(PaypalWebProfile $webProfileModel){
        $flowConfig = new FlowConfig();
        $flowConfig->setLandingPageType('Billing');

        $presentation = new Presentation();
        $presentation
            ->setLogoImage($webProfileModel->logo_url)
            ->setBrandName($webProfileModel->name)
            ->setLocaleCode('BR')
            ->setReturnUrlLabel('Voltar à loja')
            ->setNoteToSellerLabel('Obrigado pela compra!');

        $inputFields = new InputFields();
        $inputFields
            ->setAllowNote(false)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $paypalWebProfile = new WebProfile();
        $paypalWebProfile
            ->setName("$webProfileModel->name-".uniqid())
            ->setFlowConfig($flowConfig)
            ->setPresentation($presentation)
            ->setInputFields($inputFields)
            ->setTemporary(false);

        return $paypalWebProfile->create($this->apiContext);
    }

    public function update(PaypalWebProfile $webProfileModel)
    {
        $webProfile = WebProfile::get($webProfileModel->code, $this->apiContext);
        $webProfile->setName("$webProfileModel->name-".uniqid());
        $webProfile->getPresentation()
            ->setLogoImage($webProfileModel->logo_url)
            ->setBrandName($webProfileModel->name);

        return $webProfile->update($this->apiContext);
    }

    public function delete($webProfileId)
    {
        $webProfile = WebProfile::get($webProfileId, $this->apiContext);
        return $webProfile->delete($this->apiContext);
    }
}