<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Square\SquareClient;
use Square\Models\Invoice;
use Square\Models\InvoiceRecipient;
use Square\Models\InvoicePaymentRequest;
use Square\Models\Money;
use Square\Models\CreateInvoiceRequest;
use Square\Exceptions\ApiException;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$square_client = new SquareClient([
    'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
    'environment' => getenv('ENVIRONMENT')
]);

$invoices_api = $square_client->getInvoicesApi();

try {
    $recipient = new InvoiceRecipient([
        'customer_id' => 'JDKYHBWT1D4F8MFH63DBMEN8Y4'
    ]);

    $money = new Money();
    $money->setAmount(10000); // Amount in cents
    $money->setCurrency('USD'); // Currency

    $payment_request = new InvoicePaymentRequest();
    $payment_request->setRequestType('BALANCE');
    $payment_request->setDueDate('2030-01-24');
    $payment_request->setTippingEnabled(true);
    $payment_request->setAutomaticPaymentSource('NONE');
    $payment_request->setAmountDue($money);

    $invoice = new Invoice();
    $invoice->setLocationId('ES0RJRZYEC39A');
    $invoice->setPrimaryRecipient($recipient);
    $invoice->setPaymentRequests([$payment_request]);
    $invoice->setDeliveryMethod('EMAIL');
    $invoice->setTitle('Event Planning Services');
    $invoice->setDescription('We appreciate your business!');
    $invoice->setInvoiceNumber('inv-100');
    $invoice->setSaleOrServiceDate('2030-01-24');

    $body = new CreateInvoiceRequest($invoice);
    $body->setIdempotencyKey(uniqid());

    $response = $invoices_api->createInvoice($body);

    if ($response->isSuccess()) {
        $invoice = $response->getResult()->getInvoice();
        echo "Invoice created successfully. Invoice ID: " . $invoice->getId();
    } else {
        $errors = $response->getErrors();
        foreach ($errors as $error) {
            echo "Error: " . $error->getDetail() . "\n";
        }
    }
} catch (ApiException $e) {
    echo "ApiException: " . $e->getMessage();
}

?>