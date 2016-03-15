 <?php
/*
defined('_JEXEC') or die('Restricted access');

4242 4242 4242 4242
*/
require_once('stripe-php-1.18.0/lib/Stripe.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Need a payment token:
	if (isset($_POST['stripeToken'])) {

		$token = $_POST['stripeToken'];
		$amount = $_POST['amount'];
	} else {
		echo 'The order cannot be processed. Please make sure you have JavaScript enabled and try again.';
	}
	
	try {
	    Stripe::setApiKey('sk_test_9J6nXGmgFN2zVuQBfLaFy3zL');
	    $charge = Stripe_Charge::create(array(
        'amount' => $amount, // Amount in cents!
        'currency' => 'usd',
        'card' => $token,
        'description' => 'Donation from website'
 	   ));
	} catch (Stripe_CardError $e) {
	}
}
?>
<h2>Support Equal Housing Opportunity!</h2>
<p>In 2014 we:</p>
<ul>
<li>Fielded more than 2500 live hotline calls;</li>
<li>Had successful acceptance of 62% of our assist letters on behalf of clients;</li>
<li>Providing fair housing resources and trainings in 20 counties;</li>
</ul>
<p>In 2015 we will be increasing awareness about the new Section 8 legislation, as well as working with jurisdictions to ensure that they understand their legal obligations to affirmatively further fair housing. <strong><em>We need your help to continue this work across all of Oregon. Please Donate Now.</em></strong></p>
<div class="donate-row clearfix">
	<div class="donate-row-left">- Individual Supporter $35</div>
	<div class="donate-row-right">
		<form action="" method="POST">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
data-amount="3500"
data-name="FHCO"
data-description="Donation"
data-zipCode=true
data-label="Donate"
data-image="/images/fhco_logo_stripe.jpg">
</script>
			<input type="hidden" name="amount" value="3500">
		</form>
	</div>
</div>

<div class="donate-row clearfix">
<div class="donate-row-left">- Family Supporter $50</div>
<div class="donate-row-right"><form action="" method="POST">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
data-amount="5000"
data-name="FHCO"
data-description="Donation"
data-zipCode=true
data-label="Donate"
data-image="/images/fhco_logo_stripe.jpg">
</script>
<input type="hidden" name="amount" value="5000">
</form>
</div>
</div>

<div class="donate-row clearfix">
<div class="donate-row-left">- Friend of Fair Housing $75</div>
<div class="donate-row-right"><form action="" method="POST">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
data-amount="7500"
data-name="FHCO"
data-description="Donation"
data-zipCode=true
data-label="Donate"
data-image="/images/fhco_logo_stripe.jpg">
</script>
<input type="hidden" name="amount" value="7500">
</form>
</div>
</div>

<div class="donate-row clearfix">
<div class="donate-row-left">- Advocate for Fair Housing $150</div>
<div class="donate-row-right"><form action="" method="POST">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
data-amount="15000"
data-name="FHCO"
data-description="Donation"
data-zipCode=true
data-label="Donate"
data-image="/images/fhco_logo_stripe.jpg">
</script>
<input type="hidden" name="amount" value="15000">
</form>
</div>
</div>

<div class="donate-row clearfix">
<div class="donate-row-left">- Sustainer $250</div>
<div class="donate-row-right"><form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
    data-amount="25000"
    data-name="FHCO"
    data-description="Donation"
	data-zipCode=true
    data-label="Donate"
    data-image="/images/fhco_logo_stripe.jpg">
  </script>
  <input type="hidden" name="amount" value="25000">
</form>
</div>
</div>

<div class="donate-row clearfix">
<div class="donate-row-left">- Leadership Supporter $500</div>
<div class="donate-row-right"><form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
    data-amount="50000"
    data-name="FHCO"
    data-description="Donation"
	data-zipCode=true
    data-label="Donate"
    data-image="/images/fhco_logo_stripe.jpg">
  </script>
  <input type="hidden" name="amount" value="50000">
</form>
</div>
</div>

<div class="donate-row clearfix">
<div class="donate-row-left">- Director&#39s Circle $1000</div>
<div class="donate-row-right"><form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_4DrL1bw4JwArxkaP2bnQIaP1"
    data-amount="100000"
    data-name="FHCO"
    data-description="Donation"
	data-zipCode=true
    data-label="Donate"
    data-image="/images/fhco_logo_stripe.jpg">
  </script>
  <input type="hidden" name="amount" value="100000">
</form>
</div>
</div>
<p><strong><em>Online donations take 2 to 3 business days to process</em></strong>, we will contact you within that timeframe to acknowledge your generous gift. Thank you for your patience.</p>
<p>The FHCO is a 501(c)(3); contributions may be tax deductible. For questions contact Diane Hess at (503) 223-8197 x. 108 or dhess@fhco.org</p>
<p>To donate over the phone call Rebecca Wetherby at (503) 223-8197 x. 111</p>
<h2>Get Involved:</h2>
<p><a href="index.php?option=com_content&amp;view=article&amp;id=13:get-involved&amp;catid=2:uncategorised&amp;Itemid=119" target="_self">Click here</a> to explore other ways to get involved!</p>