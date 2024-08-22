<?php

// if (isset($_POST['submit'])) {
//   print_r($_POST);
// }

// die;
require 'vendor/autoload.php';
include 'utils/location-info.php';

use Square\Environment;
use Ramsey\Uuid\Uuid;
// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Pulled from the .env file and upper cased e.g. SANDBOX, PRODUCTION.
if (isset($_POST['submit'])) {
  extract($_POST);
  $upper_case_environment = strtoupper(getenv('ENVIRONMENT'));
  $web_payment_sdk_url = $_ENV["ENVIRONMENT"] === Environment::PRODUCTION ? "https://web.squarecdn.com/v1/square.js" : "https://sandbox.web.squarecdn.com/v1/square.js";

  ?>

  <html>

  <head>
    <title>My Payment Flow</title>
    <!-- link to the Square web payment SDK library -->
    <script type="text/javascript" src="<?php echo $web_payment_sdk_url ?>"></script>
    <script type="text/javascript">
      window.applicationId =
        "<?php
        echo getenv('SQUARE_APPLICATION_ID');
        ?>";
      window.locationId =
        "<?php
        echo getenv('SQUARE_LOCATION_ID');
        ?>";
      window.currency =
        "<?php
        echo $location_info->getCurrency();
        ?>";
      window.country =
        "<?php
        echo $location_info->getCountry();
        ?>";
      window.idempotencyKey =
        "<?php
        echo Uuid::uuid4();
        ?>";
    </script>
    <link rel="stylesheet" type="text/css" href="public/stylesheets/style.css">
    <link rel="stylesheet" type="text/css" href="public/stylesheets/sq-payment.css">
  </head>

  <body>
    <form class="payment-form" id="fast-checkout">
      <div class="wrapper">
        <!-- <div id="apple-pay-button" alt="apple-pay" type="button"></div>
        <div id="google-pay-button" alt="google-pay" type="button"></div>
        <div class="border">
          <span>OR</span>
        </div> -->
        <!-- <div id="ach-wrapper">
          <label for="ach-account-holder-name">Full Name</label>
          <input id="ach-account-holder-name" type="text" placeholder="Full Name on Card" name="ach-account-holder-name"
            autocomplete="name" /><span id="ach-message"></span><button id="ach-button" type="button">Pay with Bank
            Account</button>

          <div class="border">
            <span>OR</span>
          </div>
        </div> -->
        <?php
          $amount = str_replace('$', '', $amount);
        ?>
        <input type="hidden" name="amount" value="<?php echo $amount ?>">
        <!-- <input type="hidden" name="token" value="<?php echo uniqid() ?>">
        <input type="hidden" name="name" value="<?php echo $name ?>">
        <input type="hidden" name="package_title" value="<?php echo $package_title ?>">
        <input type="hidden" name="url" value="<?php echo $url ?>">
        <input type="hidden" name="domain" value="<?php echo $domain ?>">
        <input type="hidden" name="email" value="<?php echo $email ?>">
        <input type="hidden" name="phone" value="<?php echo $phone ?>">
        <input type="hidden" name="token" value=""> -->
        
        <?php
        if (isset($business_name)) {
          ?><input type="hidden" name="name_of_business" value="<?php echo $name_of_business ?>"><?php
        }
        ?>
        <?php
        if (isset($logo_image)) {
          ?><input type="hidden" name="logo_image" value="<?php echo $logo_image ?>"><?php
        }
        ?>
        <?php
        if (isset($logo_slogan)) {
          ?><input type="hidden" name="logo_slogan" value="<?php echo $logo_slogan ?>"><?php
        }
        ?>
        <div id="card-container"></div><button id="card-button" type="button">Pay (<?php echo $amount?>) with Card </button>
        <span id="payment-flow-message"></span>
      </div>
    </form>

    <script type="text/javascript" src="public/js/sq-ach.js"></script>
    <script type="text/javascript" src="public/js/sq-apple-pay.js"></script>
    <script type="text/javascript" src="public/js/sq-card-pay.js"></script>
    <script type="text/javascript" src="public/js/sq-google-pay.js"></script>
    <script type="text/javascript" src="public/js/sq-payment-flow.js"></script>
  </body>

  </html>

  <?php
} else {
  echo "Form not submitted";
}

?>