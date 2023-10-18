<?php



namespace App\Http\Controllers\Api;



use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use App\Models\AuthenticationModel;
use App\Models\BarmenuModel;
use App\Models\BarorderModel;
use App\Models\PaymentModel;
use App\Models\BarModel;
use App\User;
use App\Models\MenucategoryModel;
use App\Models\UserRequestModel;
use App\Models\BarpandingOrder;

use App\Models\NotificationModel;
use Illuminate\Support\Facades\Log;

const ORDER_PLACED ="Order has been successfully placed";
const ORDER_GOT ="Order get successfully.";
const TRANSACTION_GOT ="Transaction List get successfully.";
const USER_ID_ERROR="User id is required.";
const BAR_ID_ERROR="Bar id is required.";
const INVAILID_ID="Invalid User Id";
const INVAILID_BAR_ID="Invalid Bar Id";
const NO_DATA_FOUND="No Data Found";
const WENT_WRONG="Something went wrong.";
const ORDER_STATUS_UPDATE="Order status has been successfully updated.";
const REDEEM_SUCCESS="Order redeemed successfully.";
const REDEEM_CANCEL="Order redeemed cancel successfully.";
const REGIFT_SUCCESS="Order gifted successfully.";
const GIFTREQUEST_ACCEPTED="Drink request Accepted successfully";
const GIFTREQUEST_REJECTED="Drink request rejected successfully";


//use Stripe;
use Stripe\Stripe;

//require_once('../vendor/stripe/stripe-php/lib/Stripe.php');

require_once('../vendor/stripe/stripe-php/init.php');



class BarorderController extends Controller

{


	public function __construct()
    {
        
        
    }

    public function index(Request $request)
    {

        
    	$post = $request->all();

    	$rules = array(

            'user_id' => 'required',
            'bar_id' => 'required',
            'menu_items' => 'required',
            'stripeToken' => 'required',
            'totalPrice' => 'required',
            'currency' => 'required',
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

			$user = AuthenticationModel::where('user_id', $post['user_id'])->first();

			if($user->drunk_level == "Overlimit"){
				$responcearray = array('status' => 400, "success" => false, "message" =>"Your drunk level is over limit you cannot buy any drinks.", "result" => new \stdClass());
                return response()->json($responcearray, 400);
			}
			
			if($user->drunk_level == "Over" || $user->drunk_level == "Done" || $user->drunk_level == "Wasted" ){
				$notifyData = array(
                    "title"=> "Your drinking limit is over",
                    "body"=> "its not safe to purchase and drink alcoholic after over limit",
                    "device_token"=>$user->device_token,
                    'data'=>[]
                );
				
                if ($user->device_type == "android") 
                {
                    $getNotify = $this->android($notifyData);   
					
                }
                elseif ($user->device_type == "ios") 
                {
                    // $getNotify = $this->ios($notifyData);  
                    $getNotify = Controller::notificationApn($notifyData); 
                    
                }
			}
			    
		        $statusMsg = ''; 
				// Check whether stripe token is not empty 
				if(!empty($post)){ 
				     
				    // Retrieve stripe token, card and user info from the submitted form data 
				    $token  = $post['stripeToken']['tokenId'];  
			        // Convert price to cents 
			        $itemPriceCents = ($post['totalPrice']*100); 

			        $currency = $post['currency'];
			        
			        $description = "test example";
	
				    if($token){  
				         
				       
				    try {  

				  		// Set API key 
				   		 \Stripe\Stripe::setApiKey('sk_test_51HXuykItWqDMUx2bghadvw0rk9RekGmleEYqQTmcXnyHaJ7IULXPy5pMcxahi4vcNKLYyo5gkLg8txC7hUiRlczf00aSfMw1G5');
				           
				        $charge = \Stripe\Charge::create(array( 
				                'card' => $token, 
				                'amount'   => $itemPriceCents, 
				                'currency' => $currency, 
				                'description' => $description
				        ));

				        }catch(\Stripe\Exception\CardException $e) {
						  // Since it's a decline, \Stripe\Exception\CardException will be caught
						  $api_error['Status is'] = $e->getHttpStatus();
						  $api_error['Type is'] = $e->getError()->type;
						  $api_error['Code is'] = $e->getError()->code;
						  // param is '' in this case
						  $api_error['Param is'] = $e->getError()->param;
						  $api_error['Message is'] = $e->getError()->message;
						} catch (\Stripe\Exception\RateLimitException $e) {
						  // Too many requests made to the API too quickly
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\InvalidRequestException $e) {
						  // Invalid parameters were supplied to Stripe's API
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\AuthenticationException $e) {
						  // Authentication with Stripe's API failed
						  // (maybe you changed API keys recently)
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\ApiConnectionException $e) {
						  // Network communication with Stripe failed
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\ApiErrorException $e) {
						  // Display a very generic error to the user, and maybe send
						  // yourself an email
						  $api_error = $e->getMessage();
						} catch (Exception $e) {
						  // Something else happened, completely unrelated to Stripe
						  $api_error = $e->getMessage();
						}
				         
				        if(empty($api_error) && $charge){ 
				         
				            // Retrieve charge details 
				            $chargeJson = $charge->jsonSerialize(); 
				         
				            // Check whether the charge is successful 
				            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 
				                // Transaction details  
				                $transactionID = $chargeJson['balance_transaction']; 
				                $paidAmount = $chargeJson['amount']; 
				                $paidAmount = ($paidAmount/100); 
				                $paidCurrency = $chargeJson['currency']; 
				                $payment_status = $chargeJson['status']; 
				                 
				                // Include database  
				                $payementData = array(
				                	"user_id"=>$post['user_id'],
				                	"bar_id"=>$post['bar_id'],
									"transaction_id"=>$transactionID,
									"amount"=>$paidAmount,
									"payments_id"=>$transactionID,
				                );


				                $PayementSave = PaymentModel::create($payementData);
				                $payment_id =  $PayementSave->id;
                                $payments_id=  $PayementSave->transaction_id;
				                $order_pin= $this->generateNumericOTP(4);
								$order=[];
				                // If the order is successful 
				                if($payment_status == 'succeeded'){

					                foreach ($post['menu_items'] as $key => $value) {
					                	
					                	for($i=1;$i<=$value['quantity'];$i++)
					                	{
							        	$OrderData = BarmenuModel::select('t_bar_menu.menu_id','t_bar_menu.bar_id','t_bar_menu.category_id','t_bar_menu.name as drink_name','t_bar.name as bar_name','t_bar_menu_category.name as category_name','t_bar_menu_category.menu_type as menu_type')
							        	->from('t_bar_menu')
										->join('t_bar', 't_bar.bar_id', '=', 't_bar_menu.bar_id')
										->join('t_bar_menu_category', 't_bar_menu_category.id', '=', 't_bar_menu.category_id')
										->where('t_bar_menu.menu_id', $value['menu_id'])
										->where('t_bar_menu.bar_id', $post['bar_id'])
										->get()->toArray();
                                          
                                           $item_id=rand(10000,99999);
										   
										   $storeData = array(
											"bar_id"=>$OrderData[0]['bar_id'],
											"user_id"=>$post['user_id'],
											"menu_id"=>$OrderData[0]['menu_id'],
											"drink_name"=>$OrderData[0]['drink_name'],
											"item_id"=>$item_id,
											"category_name"=>$OrderData[0]['category_name'],
											"menu_type"=>$OrderData[0]['menu_type'],
											"price"=>$value['price'],
											// "quantity"=>$value['quantity'],
											"bar_name"=>$OrderData[0]['bar_name'],
											"payment_id"=>$payment_id,
											"payments_id"=>$payments_id,
											"order_status"=>'0',
											"order_pin"=>$order_pin,
											"purchase_date"=>Date("Y-m-d H:i:s"),
											"is_redeemed"=>0,
											"is_regifted"=>0,
										);
                                        
										$OrderSave = BarorderModel::create($storeData);

                                        $data=DB::table('t_order')
                                        ->where('bar_id',$OrderData[0]['bar_id'])
                                        ->where('user_id',$post['user_id'])
                                        ->where('menu_id',$OrderData[0]['menu_id'])
                                        ->first();

										$order[]=array(
											'order_id'=>$data->order_id,
											"menu_id"=>$OrderData[0]['menu_id'],
											"drink_name"=>$OrderData[0]['drink_name'],
											"category_name"=>$OrderData[0]['category_name'],
											"price"=>$value['price'],
											"quantity"=>$value['quantity'],
											"bar_name"=>$OrderData[0]['bar_name'],
											"payment_id"=>$payment_id,
											"item_id"=>$item_id,
											"order_status"=>'0',
											"order_pin"=>$order_pin,
											"is_redeemed"=>0,
											"is_regifted"=>0

										);
						        	}
						        }
						        	if ($OrderSave) {
							        	$responcearray = array('status' => 200, "success" => true, "message" =>ORDER_PLACED, "result" =>new \stdClass(), "bar_id"=>$OrderData[0]['bar_id'],
											"user_id"=>$post['user_id'], "order" => $order );
							            return response()->json($responcearray, 200);
						        	}else{
						        		$responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" =>$chargeJson);
						        	}

				                }else{ 
				                    $statusMsg = "Your Payment has Failed!"; 
				                    $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$chargeJson);
				                } 
				            }else{ 
				                $statusMsg = "Transaction has been failed!"; 
				                $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$chargeJson);
				            } 
				        }else{ 
				            $statusMsg = "Charge creation failed";  
				            $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$api_error);
				        } 
				    }else{  
				        $statusMsg = "Invalid card details."; 
				        $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$api_error); 
				    } 
				}else{ 
				    $statusMsg = "Error on form submission."; 
				    $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$api_error);
				} 
		    return response()->json($responcearray, 400);
		}
	}

	public function getUserOrder($id = "")
	{
		if(empty($id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
                $getBar = BarorderModel::select('t_bar.name as bar_name','t_bar.bar_id','t_bar.address as bar_address', 't_bar.latitude as barLattitude','t_bar.longitude as barLongitude', 't_bar.cover_image')
                                ->where('user_id', '=', $id)
                                ->join('t_bar','t_bar.bar_id', '=', 't_order.bar_id')			
                                ->groupBy('t_order.bar_id')				
                                ->get();
	                            


				$result = array();

				foreach ($getBar as $key => $value) {

					$barFevourite = BarModel::select('*')
					            ->from('t_bar')
					            ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
					            ->where('user_id', '=', $id)
					            ->where('bar_id', '=', $value['bar_id'])
					            ->get();

					$value['isFavourite'] = ($barFevourite->count()>0?true:false);     

					// $sql = 'SELECT false';
					$getOrder = BarorderModel::select('t_order.order_id','t_order.menu_id','t_order.drink_name','t_order.category_name','t_order.quantity','t_order.item_id' ,'t_order.quantity as max_quantity', 't_order.price','t_order.payment_id','t_order.order_status','t_order.is_redeemed','t_order.is_regifted','t_order.order_pin','t_bar_menu.image as menu_image','t_bar_menu.image as menu_image','t_order.senders_id','t_bar_menu_category.menu_type')
								// ->selectSub($sql, 'isFavourite')
                                ->where('t_order.bar_id', '=', $value['bar_id'])
                                ->where('t_order.user_id', '=', $id)
                                ->where('t_order.is_redeemed', '=', 0)
                                ->where('t_order.is_regifted', '=', 0)
                                ->join('t_bar_menu','t_bar_menu.menu_id', '=', 't_order.menu_id')
                                ->join('t_bar_menu_category','t_bar_menu_category.id', '=', 't_bar_menu.category_id')
                                ->get();

                    $allOrder  = array();
                    $drinkOrder  = array();
                    $foodOrder  = array();

                    foreach ($getOrder as $key => $order) {
                   	 $order['is_favorite']= Controller::getUserFavDrink($id,$value['bar_id'],$order['menu_id']);   

		               	if ($order['senders_id'] !==null) {
		                 	$order['senders_name']= Controller::getUserDetails($order['senders_id'])->full_name;
		               	 }
                     $allOrder[] = $order;

					 if($order['menu_type'] == 'food'){
						$foodOrder[] = $order;
					 }
					 if($order['menu_type'] == 'drink'){
						$drinkOrder[] = $order;
					 }
					    
                    }    

					$value['order']  = $allOrder;
					$value['food']  = $foodOrder;
					$value['drink']  = $drinkOrder;

					if ($value['order']) {
						$result[]=$value;
					}
				
				}
                            
                $count = $getBar->count();
                if($count > 0)
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>ORDER_GOT, "result" =>$result);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>INVAILID_ID, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
        }
	}

	public function getAwaitedOrder($id = "")
	{


		if(empty($id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>BAR_ID_ERROR, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $getOrder = BarorderModel::select('t_order.user_id','username','full_name','profileImage','email','bar_name','order_pin','order_status','bar_id','drink_name','order_id','category_name','t_order.created_at')
                             ->join('t_user','t_user.user_id', '=', 't_order.user_id')
                            ->where('bar_id', '=', $id)
                            ->where('order_status', '=', '0')
                            ->groupBy('user_id')
                            ->get(); 



			// DB::enableQueryLog();
			// $query = DB::getQueryLog();
			// print_r($query);
                         
            $count = $getOrder->count();
            if($count > 0)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>ORDER_GOT, "result" =>$getOrder);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>NO_DATA_FOUND, "result" => new \stdClass());
                return response()->json($responcearray, 400);
            }
        }
	}

	public function updateOrderStatus(Request $request)
    {
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "user_id" => "required", 
            "bar_id" => "required", 
            "order_status" => "required", 
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {
  
            $users = BarorderModel::where('user_id', $post['user_id'])
            ->where('bar_id', $post['bar_id'])
            ->update($post);

            if($users)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>ORDER_STATUS_UPDATE, "result" =>$users);
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }

    public function getTransaction($id = "",$option='')
	{
		if(empty($id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {	

        	$getTransactionData = array();
           
            $query = PaymentModel::select('t_payment.payment_id','t_payment.user_id','t_payment.transaction_id','t_payment.amount','t_payment.created_at','t_user.full_name as name','t_user.email','t_user.profileImage')
                            ->join('t_user','t_user.user_id', '=', 't_payment.user_id')
                            ->where('bar_id', '=', $id);
                                       
        	switch ($option) {

        		case '0':
        			$query->groupBy('t_payment.user_id');
        			$getTransactionData = $query->get(); 
        			break;

        		case '1':
        			    $query->whereRaw('Date(t_payment.created_at) = CURDATE()');
        			    $getTransactionData = $query->get(); 
        			break;

        		case '2':
        				$query->where('t_payment.created_at','>=',Date("Y-m-d 00:00:00", strtotime('monday this week')));
        			    $query->where('t_payment.created_at','<=',Date("Y-m-d 23:59:59"));
        			    $getTransactionData = $query->get(); 
        		break;	

        		case '3':
        			    $query->where('t_payment.created_at','>=',Date("Y-m-01 00:00:00"));
        			    $query->where('t_payment.created_at','<=',Date("Y-m-d 23:59:59"));
						 $getTransactionData = $query->get(); 
        		break;
        	}
                             
                $count = $query->count();
           
                if($count > 0)
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>TRANSACTION_GOT, "result" =>$getTransactionData);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>NO_DATA_FOUND, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
        }
	}

	public function redeem(Request $request)
    {
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "bar_id" => "required", 
            "user_id" => "required",
            "tip" => "required", 
            "order" => "required"
        );
         

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {
        	$code = $this->generateNumericOTP(4);

        	foreach ($post['order'] as $key => $value) {

        		$orderReddem = BarorderModel::where(['item_id'=>$value,'user_id'=>$post['user_id'],'bar_id'=>$post['bar_id']])->first();
        		// $redeemQuantity = $orderReddem->redeemQuantity + $value['quantity'];
        		// $quantity = $orderReddem->quantity - $value['quantity'];

        		$is_redeemed = array(
					// "redeemQuantity"=> $redeemQuantity,
					// "quantity"=> $quantity,
					'details'=> $post['details'] ?? null,
					'tip'=> $post['tip'],
	        		'updated_at'=> Date("Y-m-d H:i:s"),
	        		'is_redeemed'=>1,
	        		 'redeem_date'=>Date("Y-m-d H:i:s"),
	        	);
	        	
	            $users = BarorderModel::where('user_id', $post['user_id'])
			            ->where('bar_id', $post['bar_id'])	            
			            ->where('item_id', $value)	            
			            ->update($is_redeemed);

				
			    $redeemData = array(
                        "user_id"=> $post['user_id'],
						"item_id"=> $value,
						"order_id"=>$orderReddem->order_id,
						'bar_id'=> $post['bar_id'],
						'menu_id'=> $orderReddem->menu_id,
						'drink_name'=> $orderReddem->drink_name,
						'category_name'=> $orderReddem->category_name,
						'code'=> $code,
			    );
			    $save = BarpandingOrder::create($redeemData);
        	} 


            if($users)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>REDEEM_SUCCESS, "result" => new \stdClass());
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }

    public function cancelRedeem(Request $request)
    {

    	Log::info('test-request',$request->all());
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "code" => "required", 
            "bar_id" => "required", 
            "user_id" => "required", 
            "panding_order_id" => "required|array",
            "panding_order_id.*" => "required|distinct",
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {

        	foreach ($post['panding_order_id'] as $key => $value) {

        	    $orderReddem = BarpandingOrder::where(['id'=> $value,'code'=>$post['code']])->first();
        		$orderReddem->status = "2";
        		$orderReddem->save();

        		$order = BarorderModel::where('order_id', $orderReddem->order_id)->first();
                 
                // $quantity =  $order->quantity + $orderReddem->quantity;
                // $redeemQuantity = $order->redeemQuantity - $orderReddem->quantity;

        		$is_redeemed = array(
					// "redeemQuantity"=> $redeemQuantity,
					// "quantity"=> $quantity,
					"is_redeemed"=> 0,
					'redeem_date'=>NULL,
	        	);

	            $users = BarorderModel::where('order_id', $orderReddem->order_id)	            
			            ->update($is_redeemed);
        	} 


            if($users)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>REDEEM_CANCEL, "result" => new \stdClass());
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }


    public function pandingRedeem($id = "")
	{
		if(empty($id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
                $getBar = BarpandingOrder::select('t_bar.name as bar_name','t_bar.bar_id','t_bar.address as bar_address', 't_bar.latitude as barLattitude','t_bar.longitude as barLongitude', 't_bar.cover_image', 't_panding_order.code')
                                ->where('user_id', '=', $id)
                                ->where('t_panding_order.status', '=', "0")
                                ->join('t_bar','t_bar.bar_id', '=', 't_panding_order.bar_id')			
                                ->groupBy('t_panding_order.code')				
                                ->get();
	                            

				$result = array();

				foreach ($getBar as $key => $value) {

					$barFevourite = BarModel::select('*')
					            ->from('t_bar')
					            ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
					            ->where('user_id', '=', $id)
					            ->where('bar_id', '=', $value['bar_id'])
					            ->get();

					$value['isFavourite'] = ($barFevourite->count()>0?true:false);     

					$getOrder = BarpandingOrder::select('t_panding_order.order_id','t_panding_order.id as panding_order_id','t_panding_order.menu_id','t_panding_order.drink_name','t_panding_order.category_name','t_panding_order.quantity','t_panding_order.status', 't_panding_order.code','t_bar_menu.image as menu_image','t_bar_menu.image as menu_image', 't_bar_menu_category.menu_type','t_bar_menu.price')
                                ->where('t_panding_order.bar_id', '=', $value['bar_id'])
                                ->where('t_panding_order.user_id', '=', $id)
                                ->where('t_panding_order.code', '=', $value['code'])
                                ->join('t_bar_menu','t_bar_menu.menu_id', '=', 't_panding_order.menu_id')
                                ->join('t_bar_menu_category','t_bar_menu_category.id', '=', 't_bar_menu.category_id')
                                ->get();

                    $allOrder  = array();
                    $drinkOrder  = array();
                    $foodOrder  = array();

                    foreach ($getOrder as $key => $order) {
                   	 $order['is_favorite']= Controller::getUserFavDrink($id,$value['bar_id'],$order['menu_id']);   

                     $allOrder[] = $order;

					 if($order['menu_type'] == 'food'){
						$foodOrder[] = $order;
					 }
					 if($order['menu_type'] == 'drink'){
						$drinkOrder[] = $order;
					 }
					    
                    }    

					$value['order']  = $allOrder;
					$value['food']  = $foodOrder;
					$value['drink']  = $drinkOrder;

					if ($value['order']) {
						$result[]=$value;
					}
				
				}
                            
                $count = $getBar->count();
                if($count > 0)
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>ORDER_GOT, "result" =>$result);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>"Data not found", "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
        }
	}

    public function regift(Request $request)
    {
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "bar_id" => "required", 
            "user_id" => "required", 
            "to_user_id" => "required", 
            "is_friend" => "required", 
            "item_id" => "required"
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {

        	if ($post['user_id'] == $post['to_user_id']) {
        		
        		$responcearray = array('status' => 400, "success" => false, "message" =>"You Can't gift to yourself", "result" => new \stdClass());
                return response()->json($responcearray, 400); 
        	}

           
        	 $post['item_id']= explode(',', $post['item_id']);

             $sender_user=User::where('user_id',$post['user_id'])->first();
             $reciever_user=User::where('user_id',$post['to_user_id'])->first();
        	if ($post['is_friend']==1 || $post['is_friend']==true) 
        	{

        			
	        	$updateorderDetails = array();

                foreach ($post['item_id'] as $key => $value) {
                    
	            $updateorderDetails = BarorderModel::where(['user_id'=> $post['user_id'],'bar_id'=>$post['bar_id'],'item_id'=> $value])->first();


                    if($updateorderDetails)
	            {
	            if($updateorderDetails->regift_to!=null || $updateorderDetails->regift_to!='' )
	            {
	            	$regift_to=$updateorderDetails->regift_to.' @'.$reciever_user->full_name;
	            }
	            else
	            {
	            	$regift_to='@'.$sender_user->full_name.' @'.$reciever_user->full_name;
	            }
	            }
            $updateorderDetails = BarorderModel::where(['user_id'=> $updateorderDetails->senders_id,'bar_id'=>$post['bar_id'],'item_id'=> $value])->update(['regift_to'=>$regift_to]);
	         $is_regifted = array(
	        		'is_regifted'=>1,
	        		'regift_send_date'=>Date("Y-m-d H:i:s"),
	        		'regift_to'=>$regift_to,
	        		'updated_at'=> Date("Y-m-d H:i:s")
	        	);

		            $updateorderDetails = tap(BarorderModel::where(['user_id'=> $post['user_id'],'bar_id'=>$post['bar_id'],'item_id'=> $value]))
		               ->update($is_regifted)
		               ->first()->toArray();

		            $updateorderDetails["user_id"]     = $post['to_user_id'];
					$updateorderDetails["senders_id"]  = $post['user_id'];
					$updateorderDetails["is_redeemed"] = 0;
					$updateorderDetails["is_regifted"] = 0;
					$updateorderDetails["price"] = 0;
					$updateorderDetails["created_at"]  = Date("Y-m-d H:i:s");
					$updateorderDetails["updated_at"]  = Date("Y-m-d H:i:s");
					$updateorderDetails["regift_recieved_date"] = Date("Y-m-d H:i:s");
					
                    unset($updateorderDetails['regift_send_date']);
                    // unset($updateorderDetails['regift_to']);
					// unset($updateorderDetails['order_id']);
	        		$bar_order=BarorderModel::create($updateorderDetails);
	        		

	        	  $orderDetails = BarorderModel::select('t_user.full_name as senders_name','t_user.profileImage as senders_image' ,'t_user.user_id as senders_id','t_user.device_token','t_order.drink_name','t_order.bar_name','t_order.order_id','t_order.bar_id')
        							
	                                ->where('t_order.user_id', '=', $post['user_id'])
	                                ->where('t_order.item_id', '=', $value)
	                                ->join('t_user', 't_user.user_id', '=', 't_order.user_id')
	                                ->get()->first();

					$NotificationData['save_request']        	        =  1;                                   
	        		$NotificationData['title']           				= "Gift ";          

	                $NotificationData['body']            				= "".$orderDetails['senders_name']." has sent you a ".$orderDetails['drink_name']." at ".$orderDetails['bar_name']."";   
                    $NotificationData['request_user_id']  				=  $post['to_user_id']; 
	                $NotificationData['description']  					=  $NotificationData['body'];
	                $NotificationData['device_token']    				=  Controller::getUserDetails($post['to_user_id'])->device_token;   
	                $NotificationData['user_id']         				=  $orderDetails['senders_id'];  	               
	                $NotificationData['notfication_sendto_user_id']     =  $post['to_user_id'];   	
	                $NotificationData['request_type']    				=  1;         
	                $NotificationData['request_status']  				=  0;            
	                $NotificationData['bar_id']  						=  $post['bar_id'];   
	                $NotificationData['item_id']  						=  $value;   
	                $NotificationData['event_id']  						=  '';   
	                $NotificationData['notification_type']  			=  'gift_request';   
	                unset($orderDetails['device_token']);            
	                $NotificationData['data'] 			 				=  $orderDetails;        
                    $NotificationData['order_id'] 			 			=  $bar_order->id;
	                
	                $this->sendUserRequest($NotificationData);

	        	}	        	
        	}
        	else
        	{
        		$orderDetails = array();

        		foreach ($post['item_id'] as $key => $value) {

	        		$orderDetails = BarorderModel::select('t_user.full_name as senders_name','t_user.profileImage as senders_image' ,'t_user.user_id as senders_id','t_user.device_token','t_order.drink_name','t_order.bar_name','t_order.order_id','t_order.bar_id')
        							
	                                ->where('t_order.user_id', '=', $post['user_id'])
	                                ->where('t_order.item_id', '=', $value)
	                                ->join('t_user', 't_user.user_id', '=', 't_order.user_id')
	                                ->get()->first();
                    

	                $orderDetails['request_status'] 					= 0;   

	                $NotificationData['save_request']        	        =  1;   

	                $NotificationData['title']           				= "Gift ";          

	                $NotificationData['body']            				= "".$orderDetails['senders_name']." wants to send you a ".$orderDetails['drink_name']." at ".$orderDetails['bar_name']."";   

	                $NotificationData['description']  					=  $NotificationData['body'];   

	                $NotificationData['device_token']    				=  Controller::getUserDetails($post['to_user_id'])->device_token;   
	                $NotificationData['user_id']         				=  $orderDetails['senders_id'];   
	                $NotificationData['request_type']    				=  1;   
	                $NotificationData['request_user_id']  				=  $post['to_user_id'];   
	                $NotificationData['notfication_sendto_user_id']     =  $post['to_user_id'];   
	                $NotificationData['request_status']  				=  0;   
	                $NotificationData['bar_id']  						=  $post['bar_id'];   
	                $NotificationData['item_id']  						=  $value;  
	                $NotificationData['event_id']  						=  '';   
	                $NotificationData['notification_type']  			=  'gift_request';   
	                unset($orderDetails['device_token']);            
	                
	                $NotificationData['data'] 			 				=  $orderDetails;
	                // $NotificationData['order_id'] 			 			=  $bar_order->id;               
                   
                   
	                $this->sendUserRequest($NotificationData);
        		}


        	}

            if(!empty($orderDetails))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>REGIFT_SUCCESS);
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }
public function sendUserRequest($parms)
{
$userDeviceCheck =  AuthenticationModel::where('user_id', $parms['notfication_sendto_user_id'])->first();

        $parms['device_type'] = $userDeviceCheck->device_type;
        if (!empty($parms)) 
        {
            if($parms['device_type'] == "ios"){
                // $getNotify = $this->ios($parms);
                $getNotify = $this->notificationApn($parms);   
            }else{
                $msg = array
                (
                    'title'     => $parms['title'],
                    'body'      => $parms['body'],
                    'vibrate'   => 1,
                    'sound'     => 1,
                    'largeIcon' => 'large_icon',
                    'smallIcon' => 'small_icon'
                );


                $fields = array
                (
                    'to' => $parms['device_token'],
                    // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
                    'notification'  => $msg,
                    'data' => $parms['data']
                );

                // print_r($fields);exit;

                $headers = array
                (
                    'Authorization: key=' . SERVER_KEY,
                    'Content-Type: application/json'
                ); 

                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                if ($result === FALSE) 
                {
                    die('FCM Send Error: ' . curl_error($ch));
                }
                curl_close( $ch );
                
                $getNotify = json_decode($result);

            }

            


            // if (!empty($getNotify) && ( $getNotify->status == 1)) 
            // {

                if (isset($parms['save_request']) && $parms['save_request'] == 1) {
                    
                    $data = array(
                        "user_id"=>$parms['user_id'],
                        "request_type"=>$parms['request_type'],
                        "request_user_id"=>$parms['request_user_id'],
                        "request_status"=>$parms['request_status'],
                        "bar_id"=>(isset($parms['bar_id']))?$parms['bar_id']:null,
                        "order_id"=>(isset($parms['order_id']))?$parms['order_id']:null,

                    );


                    $UserRequest = UserRequestModel::create($data);
                    $UserRequestId = $UserRequest->id;
                }
                
                if ($parms['notification_type'] == 'gift_request') {
                    
                    $parms['gift_sender_id'] = $parms['user_id'];
                }

                $accepte_by = null;
                if (isset($parms['notification_type']) && $parms['notification_type'] == 'accepte_request') {

                    $accepte_by = $parms['user_id'];
                }


                $notifyData = array(
                                "title" => $parms['title'],
                                "bar_id" => ($parms['bar_id'])?$parms['bar_id']:null,
                                "event_id" => ($parms['event_id'])?$parms['event_id']:null,
                                "user_id"=> $parms['notfication_sendto_user_id'],
                                "description" => $parms['description'],
                                "notification_type"=>$parms['notification_type'],
                                "frined_request_id"=>$UserRequestId ?? null,
                                "gift_sender_id"=> $parms['gift_sender_id'] ?? null,
                                "accepte_by"=>$accepte_by ?? null
                            );


                $InsertNotify = NotificationModel::create($notifyData);

                if (!empty($UserRequest)  && !empty($InsertNotify)) 
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            // }
            // else
            // {
            //     return FALSE;
            // }
            
        }
        else
        {
            return FALSE;
        }
    }

	public function acceptOrRejectGift(Request $request)
    {
        $updateStatus =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
	            "user_id" => "required", 
	            "bar_id" => "required", 
	            "order_id" => "required", 
	            "senders_id" => "required", 
	            "is_accepted" => "required", 
	        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$updateStatus);
            return response()->json($responcearray, 400);
        }
        else
        {

        	// $post['order_id']= explode(',', $post['order_id']);
        	$updateData = array(
        		'request_status'=>$post['is_accepted'],
        		'updated_at'=> Date("Y-m-d H:i:s")
        	);

            $updateStatus = tap(UserRequestModel::where('user_id', $post['senders_id'])
                        ->where('request_user_id', $post['user_id'])	            
                        ->where('bar_id', $post['bar_id'])	            
                        ->where('order_id', $post['order_id'])
                        ->where('request_type','=', 1))
            ->update($updateData)
            ->first();
        

            if($updateStatus)
            {

            	if ($updateStatus->request_status == 1) {

     //        		$is_regifted = array(
		   //      		'is_regifted'=>1,	        		
		   //      		'updated_at'=> Date("Y-m-d H:i:s")
	    //     		);

		   //      	$updateorderDetails = array();		        	

		   //          $updateorderDetails = tap(BarorderModel::where('user_id', $post['senders_id'])
		   //          		            ->where('bar_id', $post['bar_id'])	            
		   //          		            ->where('order_id', $post['order_id']))
		   //          ->update($is_regifted)
		   //          ->first()->toArray();


		   //          $updateorderDetails["user_id"]     = $post['user_id'];
					// $updateorderDetails["senders_id"]  = $post['senders_id'];
					// $updateorderDetails["is_redeemed"] = 0;
					// $updateorderDetails["is_regifted"] = 0;
					// $updateorderDetails["created_at"]  = Date("Y-m-d H:i:s");
					// $updateorderDetails["updated_at"]  = Date("Y-m-d H:i:s");

					// unset($updateorderDetails['order_id']); 
	    //     		BarorderModel::create($updateorderDetails);	



     
                	$responcearray = array('status' => 200, "success" => true, "message" =>GIFTREQUEST_ACCEPTED, "result" => new \stdClass());

            	}
            	elseif ($updateStatus->request_status == 2) {
            		
                	$responcearray = array('status' => 200, "success" => true, "message" =>GIFTREQUEST_REJECTED, "result" => new \stdClass());

            	}else{

               		$responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());

            	}
                
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>"Order not available", "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }

    public function generateNumericOTP($n) 
    {     
        
        $generator = "1357902468";         

        $result = ""; 

        for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
     
        return $result; 
    }

	public function android($parms) {        
       
        $msg = array
        (
            'title'     => $parms['title'],
            'body'      => $parms['body'],
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );

        $fields = array
        (
            'to' => $parms['device_token'],
            'notification'  => $msg,
            // 'data' => $parms['data']
        );

        // print_r($fields);exit;

        $headers = array
        (
            'Authorization: key=' . SERVER_KEY,
            'Content-Type: application/json'
        ); 

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        if ($result === FALSE) 
        {
               die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close( $ch );
        
        return json_decode($result);
    }

    public function ios($parms)
    {
       
        // $apnsPem = resource_path('ios_apns/cert.pem');
        // $passphrase = resource_path('ios_apns/cert.p12');


            $deviceToken = $parms['device_token']; //  iPad 5s Gold prod


                        // Put your private key's passphrase here:
            $passphrase = '1234';
            $pemfilename = resource_path('ios_apns/cert.pem');
            $body['aps'] = array(
            'alert' => array(
            'title' => $parms['title'],
            'body' => $parms['body'],
            'data' => $parms['data']
            ),
            // 'badge' => $parms['badgeCount'],
            'sound' => 'default',
            ); 
            // Create the payload body            ////////////////////////////////////////////////////////////////////////////////            

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfilename);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);           
            $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // Open a connection to the APNS server
            if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
            'Connected to APNS' . PHP_EOL;
            $payload = json_encode($body); // Encode the payload as JSON
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload; // Build the binary notification
            $result = fwrite($fp, $msg, strlen($msg)); // Send it to the server
            if (!$result)
            return false;
            else
            return array("status"=>1);

            fclose($fp); // Close the connection to the server        
    }
}