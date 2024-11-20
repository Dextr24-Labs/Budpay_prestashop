# BudPay Payment Gateway Module for PrestaShop

This module integrates BudPay as a payment gateway in your PrestaShop store. It allows users to securely pay for their orders by redirecting them to BudPay's payment platform.

---

## Features

- Redirects users to BudPay for secure payments.
- Seamless integration with PrestaShop's checkout system.
- Displays a "Pay with BudPay" button during checkout.
- Handles payment validation and callback for order confirmation.

---

## Installation

### 1. Download the Module

- Clone this repository or download it as a ZIP file.

### 2. Upload to PrestaShop

1. Log in to your PrestaShop Admin Dashboard.
2. Navigate to **Modules** > **Module Manager**.
3. Click on **Upload a Module**.
4. Upload the `budpaypayment.zip` file.

### 3. Configure the Module

1. After successful installation, locate the **BudPay Payment Gateway** module in the Module Manager.
2. Click on **Configure**.
3. Add your BudPay **API Secret Key** to the configuration settings.

---

## Usage

1. During checkout, users will see a "Pay with BudPay" option.
2. When selected, they will be redirected to the BudPay payment page to complete their transaction.
3. After successful payment, users will be redirected back to your PrestaShop store to complete the order.

---

## File Structure

```plaintext
budpaypayment/
├── budpaypayment.php            # Main module file
├── config.xml                   # Module configuration
├── translations/                # Language translations (empty for now)
├── views/
│   ├── templates/
│   │   ├── front/
│   │   │   ├── payment.tpl      # Frontend payment button template
│   │   │   ├── confirmation.tpl # Payment confirmation template
│   └── img/
│       └── budpay_logo.png      # BudPay logo for display
├── controllers/
│   ├── front/
│       ├── validation.php       # Handles redirection to BudPay
│       ├── callback.php         # Handles callback after payment
```

## API Integration

The module uses BudPay's Standard Checkout API to initialize payments and redirect users.

### API Request

The payment initialization is done via the following endpoint:

```bash
POST https://api.budpay.com/api/v2/transaction/initialize
```
### Payload Example

```json
{
  "email": "customer@email.com",
  "amount": "20000",
  "callback": "https://yourwebsite.com/module/budpaypayment/callback"
}
```
