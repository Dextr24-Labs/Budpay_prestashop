<?php

class BudPayPaymentValidationModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        $cart = $this->context->cart;
        if (!$cart->id) {
            Tools::redirect('index.php?controller=order');
        }

        $email = $this->context->customer->email;
        $amount = $cart->getOrderTotal(true, Cart::BOTH) * 100; // Convert to kobo
        $callback = $this->context->link->getModuleLink('budpaypayment', 'callback', [], true);

        $data = [
            'email' => $email,
            'amount' => $amount,
            'callback' => $callback,
        ];

        $response = $this->initializePayment($data);

        if ($response['status'] === true) {
            Tools::redirect($response['data']['authorization_url']);
        } else {
            Tools::redirect('index.php?controller=order&step=3&error=payment');
        }
    }

    private function initializePayment($data)
    {
        $apiKey = 'YOUR_SECRET_KEY';
        $ch = curl_init('https://api.budpay.com/api/v2/transaction/initialize');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
