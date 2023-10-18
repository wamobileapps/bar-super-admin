<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

//use Stripe;
//require_once('../vendor/stripe/stripe-php/lib/Stripe.php');
require_once('../vendor/stripe/stripe-php/init.php');

class PaymentController extends Controller
{
    public function index(Request $request)
    {
    	$post = $request->all();

    	$rules = array(
            'card_no' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required',
        );
      
        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {

		        \Stripe\Stripe::setApiKey('sk_test_51HXuykItWqDMUx2bghadvw0rk9RekGmleEYqQTmcXnyHaJ7IULXPy5pMcxahi4vcNKLYyo5gkLg8txC7hUiRlczf00aSfMw1G5');
		        try {
				            $response = \Stripe\Token::create(array(
				                "card" => array(
				                    "number"    => $post['card_no'],
				                    "exp_month" => $post['expiry_month'],
				                    "exp_year"  => $post['expiry_year'],
				                    "cvc"       => $post['cvv']
				                )));

				            if (!isset($response['id'])) {
				            	 $responcearray = array('status' => 400, "success" => false, "message" =>"something went to wrong.", "result" => $response);
		                		return response()->json($responcearray, 400);
				                // return redirect()->route('addmoney.paymentstripe');
				            }
		        	
		            $charge = \Stripe\Charge::create([
		                'card' => $response['id'],
		                'currency' => 'USD',
		                'amount' =>  100 * 100,
		                'description' => 'wallet',
		            ]);

		            if($charge['status'] == 'succeeded') {
		                
		                $responcearray = array('status' => 200, "success" => true, "message" =>"Payment Success!", "result" =>$charge);
                		return response()->json($responcearray, 200);

		            } else {
		                
		                $responcearray = array('status' => 400, "success" => false, "message" =>"something went to wrong.", "result" => new \stdClass());
                		return response()->json($responcearray, 400);
		            }

		        }
		        catch (Exception $e) {
		        
		            $responcearray = array('status' => 400, "success" => false, "message" =>$e->getMessage(), "result" => new \stdClass());
                	return response()->json($responcearray, 200);
		        }
		}
	}
}
