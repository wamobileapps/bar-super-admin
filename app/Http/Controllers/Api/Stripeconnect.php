<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class Stripeconnect extends Controller
{

  public function connectlink()
  {

    // Set your secret key. Remember to switch to your live secret key in production.
    // See your keys here: https://dashboard.stripe.com/apikeys
    // $stripe = new \Stripe\StripeClient('sk_test_ssX8RkrsQJWlHzUI7gxSeVnd');
try{
       $stripe = new \Stripe\StripeClient(
          'sk_test_51HXuykItWqDMUx2bghadvw0rk9RekGmleEYqQTmcXnyHaJ7IULXPy5pMcxahi4vcNKLYyo5gkLg8txC7hUiRlczf00aSfMw1G5'
        );

     $account= $stripe->accounts->create([
         'type' => 'custom',
         'country' => 'US',
         'email' => 'jenny.rosen@example.com',
         'capabilities' => [
         'card_payments' => ['requested' => true],
          'transfers' => ['requested' => true],
  ],
]);
      
       $link=$stripe->accountLinks->create([
          'account' => $account->id,
          'refresh_url' => 'http://baradmin.nvinfobase.com/refresh/'.$account->id,
          'return_url' => 'http://baradmin.nvinfobase.com/login',
          'type' => 'account_onboarding',
        ]);

        return $responcearray = array("message" =>'Stripe Connect link', "result" =>$link);
}

catch(\Stripe\Exception\CardException $e) {
                // Since it's a decline, \Stripe\Exception\CardException will be caught
                           $e = $e->getMessage();
                           return response()->json([
                           'status'=>false,
                            "message" => $e
                              ]);
                           } 
                catch (\Stripe\Exception\RateLimitException $e) {
                        $e = $e->getMessage();
                        
                           return response()->json([
                           'status'=>false,
                            "message" => $e
                              ]);
                        // Too many requests made to the API too quickly
                      } catch (\Stripe\Exception\InvalidRequestException $e) {
                        // Invalid parameters were supplied to Stripe's API
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                             "message" => $e
                               ]);
                      } catch (\Stripe\Exception\AuthenticationException $e) {
                        // Authentication with Stripe's API failed
                        // (maybe you changed API keys recently)
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                             "message" => $e
                               ]);
                      } catch (\Stripe\Exception\ApiConnectionException $e) {
                        // Network communication with Stripe failed
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                             "message" => $e
                               ]);
                      } catch (\Stripe\Exception\ApiErrorException $e) {
                        // Display a very generic error to the user, and maybe send
                        // yourself an email
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                            "message" => $e
                        ]);
                      } 




  }


  public function refreshID($account_id)
  {

    try{
    $stripe = new \Stripe\StripeClient(
          'sk_test_51HXuykItWqDMUx2bghadvw0rk9RekGmleEYqQTmcXnyHaJ7IULXPy5pMcxahi4vcNKLYyo5gkLg8txC7hUiRlczf00aSfMw1G5'
        );

    $link=  $stripe->accountLinks->create([
          'account' => $account_id,
          'refresh_url' => 'http://baradmin.nvinfobase.com/api/refresh',
          'return_url' => 'http://baradmin.nvinfobase.com/login',
          'type' => 'account_onboarding',
        ]);

    return $link;
        // return redirect($link->url) ;

       }

       catch(\Stripe\Exception\CardException $e) {
                // Since it's a decline, \Stripe\Exception\CardException will be caught
                           $e = $e->getMessage();
                           return response()->json([
                           'status'=>false,
                            "message" => $e
                              ]);
                           } 
                catch (\Stripe\Exception\RateLimitException $e) {
                        $e = $e->getMessage();
                        
                           return response()->json([
                           'status'=>false,
                            "message" => $e
                              ]);
                        // Too many requests made to the API too quickly
                      } catch (\Stripe\Exception\InvalidRequestException $e) {
                        // Invalid parameters were supplied to Stripe's API
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                             "message" => $e
                               ]);
                      } catch (\Stripe\Exception\AuthenticationException $e) {
                        // Authentication with Stripe's API failed
                        // (maybe you changed API keys recently)
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                             "message" => $e
                               ]);
                      } catch (\Stripe\Exception\ApiConnectionException $e) {
                        // Network communication with Stripe failed
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                             "message" => $e
                               ]);
                      } catch (\Stripe\Exception\ApiErrorException $e) {
                        // Display a very generic error to the user, and maybe send
                        // yourself an email
                        $e = $e->getMessage();
                        return response()->json([
                            'status'=>false,
                            "message" => $e
                        ]);
                      } 


  }
   public function refresh()
  {

                           return response()->json([
                           'status'=>false,
                            "message" => 'Error'
                              ]);
                           } 
            


  }

} 