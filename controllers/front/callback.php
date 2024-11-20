<?php

class BudPayPaymentCallbackModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        $reference = Tools::getValue('reference');
        $status = Tools::getValue('status');

        if ($status === 'success') {
            $order = new Order((int)$reference);
            $order->setCurrentState(Configuration::get('PS_OS_PAYMENT'));
        } else {
            $order = new Order((int)$reference);
            $order->setCurrentState(Configuration::get('PS_OS_ERROR'));
        }

        Tools::redirect('index.php?controller=order-confirmation&id_cart=' . $this->context->cart->id . '&id_module=' . $this->module->id . '&key=' . $this->context->customer->secure_key);
    }
}
