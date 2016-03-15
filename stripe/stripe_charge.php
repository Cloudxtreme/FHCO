<?php
/* 

*/	
	# Charge the credit card using the Stripe API
	function stripeChargeCardCust($secretKey,$token,$amount,$cust,$description=null) {
		
		Stripe::setApiKey($secretKey);
		try {
			$charge = Stripe_Charge::create(array(
		  			"amount"			=> $amount,
		  			"currency" 			=> "usd",
		  			"card" 				=> $token,
		  			"description" 		=> $description)
			);
			
			$result = true;
			
		} catch(Stripe_CardError $e) {
			# Card was declined
			$message = "Card Error: ".$e->getMessage();
	  		return array("success"=>false, "result"=>$e,"type"=>"Stripe_CardError","errorMessage"=>$message);
		} catch(Stripe_InvalidRequestError $e) {
			# You screwed up in your programming. Shouldn't happen!
			$message = "Invalid Request";
	  		return array("success"=>false, "result"=>$e,"type"=>"Stripe_InvalidRequestError","errorMessage"=>$message);
	  	} catch(Stripe_AuthenticationError $e) {
	  		# Bad Key? Don't desplay the message publicly
			$message = "API Authentication Error";
	  		return array("success"=>false, "result"=>$e,"type"=>"Stripe_AuthenticationError","errorMessage"=>$message);
	  	} catch(Stripe_ApiConnectionError $e) {
	  		# Network problem, perhaps try again.
			$message = "Stripe API Connection Error: ".$e->getMessage();
	  		return array("success"=>false, "result"=>$e,"type"=>"Stripe_ApiConnectionError","errorMessage"=>$message);
	  	} catch(Stripe_Error $e) {
	  		# Stripe's servers are down!
			$message = "Stripe Error: ".$e->getMessage();
	  		return array("success"=>false, "result"=>$e,"type"=>"Stripe_Error","errorMessage"=>$message);
	  	} catch(Exception $e) {
	  		# Something else that's not the customer's fault.
			$message = "Error Exception: ".$e->getMessage();
	  		return array("success"=>false, "result"=>$e,"type"=>"Exception","errorMessage"=>$message);
	  	}
		
		return array("success"=>$result,"result"=>$charge);
	}
?>