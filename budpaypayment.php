<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class BudPayPayment extends PaymentModule
{
    public function __construct()
    {
        $this->name = 'budpaypayment';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->controllers = ['validation', 'callback'];
        $this->is_eu_compatible = 1;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('BudPay Payment Gateway');
        $this->description = $this->l('Redirect users to BudPay for secure payments.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('paymentOptions') &&
            $this->registerHook('paymentReturn');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return;
        }

        $paymentOption = new PrestaShop\PrestaShop\Core\Payment\PaymentOption();
        $paymentOption->setCallToActionText($this->l('Pay with BudPay'))
            ->setAction($this->context->link->getModuleLink($this->name, 'validation', [], true))
            ->setLogo(Media::getMediaPath(_PS_MODULE_DIR_ . $this->name . '/views/img/budpay_logo.png'));

        return [$paymentOption];
    }
}
