<?php 

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\AdminModel;
use App\Models\BarModel;
use App\Models\ActivityModel;
use App\Models\BareventModel;
use App\Models\BargameModel;
use App\Models\GameModel;
use App\Models\MenucategoryModel;
use App\Models\BarmenuModel;
use App\Models\UserEventModel;
use App\Models\BannerModel;
use App\Models\PhotoWallModel;
use App\Models\UserDrinkFavourite;
use App\Models\PossibleModel;
use App\Models\BarorderModel;
use App\Models\PaymentModel;
use App\Models\UserChekinModel;
use Session;
use Carbon\Carbon;
use Redirect;

class BarController extends Controller
{
    public function __construct()
    {
        
        // $this->middleware(function ($request, $next){
        //     $user_id = session()->get('adminEmail');

        //     if(empty($user_id))
        //     {
        //         return redirect()->to('login');
        //     }

        //     return $next($request);
        // });
    }
    
	public function index()
    {
        
       
        $date = date('Y-m-d');
        $bars = BarModel::select('*')->get();
        foreach($bars as $bar){
            $bar->close_time = date('h:i A', strtotime($bar->close_time));
            $bar->open_time = date('h:i A', strtotime($bar->open_time));
            $bar->totalRevenue = PaymentModel::where('bar_id', $bar->bar_id)->sum('amount');
            $bar->todayRevenue = PaymentModel::where('bar_id', $bar->bar_id)->whereDate('created_at', '=', $date)->sum('amount');
        }
        
        $bars->quantity = BarorderModel::sum('quantity');
        $bars->totalRevenue = PaymentModel::sum('amount');
        $bars->todayRevenue = PaymentModel::whereDate('created_at', '=', $date)->sum('amount');
        
        return view("barsManager", compact('bars'));
    }

    public function barsDetails($id='')
    {
        $month = date('m');
        $date = date('Y-m-d');

        $bars = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if($bars)
        {

            $bars->banners = BannerModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('id', 'DESC')
                            ->limit(5)
                            ->get();

            $bars->photowall = PhotoWallModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('id', 'DESC')
                            ->limit(5)
                            ->get();

            $bars->orders = BarorderModel::select('*')
                            ->join('t_user', 't_user.user_id', '=', 't_order.user_id')
                            ->where('t_order.bar_id', '=', $id)
                            ->orderBy('order_id', 'DESC')
                            ->limit(5)
                            ->get();

            $bars->categories = MenucategoryModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('id', 'DESC')
                            ->limit(5)
                            ->get();

            $bars->menus = BarmenuModel::select('*','t_bar_menu_category.name as categoryName')
                            ->join('t_bar_menu_category', 't_bar_menu_category.id', '=', 't_bar_menu.category_id')
                            ->where('t_bar_menu.bar_id', '=', $id)
                            ->orderBy('menu_id', 'DESC')
                            ->limit(5)
                            ->get();

            $bars->events = BareventModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('event_id', 'DESC')
                            ->limit(5)
                            ->get();
            foreach ($bars->events as $key => $event) {

                $event->start_time = date('h:i A', strtotime($event->start_time));
                $event->end_time = date('h:i A', strtotime($event->end_time));
            }

            $bars->games = BargameModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('id', 'DESC')
                            ->limit(5)
                            ->get();

            $bars->quantity = BarorderModel::where('bar_id', '=', $id)->sum('quantity');
            $bars->totalRevenue = PaymentModel::where('bar_id', '=', $id)->sum('amount');
            $bars->todayRevenue = PaymentModel::whereDate('created_at', '=', $date)->where('bar_id', '=', $id)->sum('amount');

            return view("barsDetails", compact('bars'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function editBar($id='')
    {
        if(!empty($id))
        {
            $bar = BarModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->get()->first();
            $data= DB::table('bar_times')->select("bar_times.close_time","bar_times.is_closed","bar_times.close_next_day","bar_times.open_time","week_days.day")
                ->join('t_bar','t_bar.bar_id','=','bar_times.t_bar_id')
                ->join('week_days','bar_times.day_of_week','=','week_days.id')
                ->where('bar_times.t_bar_id',$id)
                ->get();
            if(count($data)<=0){

                $arrayOfArrays =array(
                    array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Sunday'
                    ), array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Monday'
                    ), array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Tuesday'
                    ), array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Wednesday'
                    ), array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Thursday'
                    ), array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Friday'
                    ), array(
                        'close_time' => '00:00:00',
                        'is_closed' => 1,
                        'close_next_day' => 0,
                        'open_time' => '00:00:00',
                        'day' => 'Saturday'
                    ),);
                $data = array();

// Iterate over each sub-array and create an object using its values
                foreach ($arrayOfArrays as $subArray) {
                    $object = (object) $subArray;
                    $data[] = $object;
                }

            }

            if($bar)
            {
                return view("editBar", compact("bar",'data'));
            }
            else
            {
                session::flash('BarError','Invailid ID');
                return redirect('Bar');
            }
            
        }
        else
        {
                session::flash('BarError','Invailid ID');
                return redirect('Bar');
        }
    }

    public function create()
    {
        return view("addBar");
    }

    public function barSave(Request $request)
    {
        
        
        $post =  $post = $request->except('open_time','close_time','close_next_day','is_closed');
          
        $rules = array( 
            "name" => 'required|unique:t_bar',
            "email" => 'required|unique:t_bar', 
//            "people_in" => 'required|numeric',
            "address" => 'required',
            "latitude" => 'required|numeric',
            "longitude" => 'required|numeric',
//            "open_time" => 'required',
            "password" => 'required',
//            "close_time" => 'required|after:open_time',
//            "bank_account_name"=>'required',
//            "account_number"=>'required|numeric',
//            "routing_number"=>'required|numeric|min:9'

        
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            
            return redirect('addBar')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {

            if(isset($post['cover_image']) && !empty($post['cover_image']))
            {
                $imagename = time().uniqid()."_barimage";

                $imageName = $imagename.'.'.$request->cover_image->extension();  

                $request->cover_image->move(public_path('Uploads/bar/'), $imageName);
                $post['cover_image'] = url('Uploads/bar/'.$imageName);
            }
            else
            {
                $post['cover_image'] = url('img/bar-default-image.png');
            }

            
            // print_r($post);

            // exit;

            $post['password'] = md5($post['password']);
if( $request->account_number) {
    die('herer');
    try {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_TEST')
        );


        $token = $stripe->tokens->create([

            'bank_account' => [
                'country' => 'US',
                'currency' => 'usd',
                'account_holder_name' => $request->bank_account_name,
                'account_holder_type' => 'individual',
                'routing_number' => $request->routing_number,
                'account_number' => $request->account_number,
            ],
        ]);


        $account = $stripe->accounts->create([
            'type' => 'custom',
            'country' => 'US',
            'email' => $post['email'],
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
        ]);

        $bank_account = $stripe->accounts->createExternalAccount(
            $account->id,
            [
                'external_account' => $token->id,

            ]
        );

        $link = $stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => env('STRIPE_CONNECT_REFRESH_URL') . '/' . $account->id,
            'return_url' => env('STRIPE_CONNECT_RETURN_URL') . '/' . $request->email,
            'type' => 'account_onboarding',
        ]);
//Bar admin can login if it has completed stripe onboarding  
        $post['status'] = 9;
//        $post['account'] = $account->id;
//        $post['bank_account_name'] = $request->bank_account_name;
//        $post['routing_number'] = $request->routing_number;
//        $post['$account_number'] = $request->account_number;
//        $post['bank_account'] = $bank_account->id;



    } catch (\Stripe\Exception\CardException $e) {
        // Since it's a decline, \Stripe\Exception\CardException will be caught
        $e = $e->getMessage();

        session::flash('BarError', $e);
        return redirect('addBar')->withInput();
    } catch (\Stripe\Exception\RateLimitException $e) {
        $e = $e->getMessage();

        session::flash('BarError', $e);
        return redirect('addBar')->withInput();
        // Too many requests made to the API too quickly
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Invalid parameters were supplied to Stripe's API
        $e = $e->getMessage();
        session::flash('BarError', $e);
        return redirect('addBar')->withInput();
    } catch (\Stripe\Exception\AuthenticationException $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $e = $e->getMessage();
        session::flash('BarError', $e);
        return redirect('addBar')->withInput();
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Network communication with Stripe failed
        $e = $e->getMessage();
        session::flash('BarError', $e);
        return redirect('addBar')->withInput();
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $e = $e->getMessage();
        session::flash('BarError', $e);
        return redirect('addBar')->withInput();
    }

}
            $bar = BarModel::create($post);
//            \Mail::to($bar->email)->send(new \App\Mail\StripeLinkMail($bar, $link->url));
            if ($bar) {
                session::flash('BarSuccess', 'Bar has been created successfully');
                return redirect('Bar');

            } else {
                session::flash('BarError', 'Bar has been not created');
                return redirect('Bar');
            }
        }
    }
    public function refreshID($account_id)
  {
    $bar=BarModel::where('account',$account_id)->first();

    try{
    $stripe = new \Stripe\StripeClient(
          env('STRIPE_SECRET_TEST')
        );

    $link=  $stripe->accountLinks->create([
          'account' => $account_id,
          'refresh_url' => env('STRIPE_CONNECT_REFRESH_URL'),
          'return_url' => env('STRIPE_CONNECT_RETURN_URL').'/'.$bar->email,
          'type' => 'account_onboarding',
        ]);

      return redirect($link->url);


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
                            "message" => 'Stripe Connect Process Incompleted ',

                              ]);  
    } 

     public function returnLink($email)
  {

            $bar = BarModel::where('email',$email)->update(['status'=>'1']);
              $url=env('LOGIN_BARADMIN');
                 return Redirect::to($url);
                
    }
   


    public function return1($email)
  {
    $bar = BarModel::where('email',$email)->update(['status'=>'1']);
        $url=env('LOGIN_BARADMIN');
                 return Redirect::to($url);
                            
}
    public function barUpdate(Request $request, $id='')
    {
        if(!empty($id))
        {
        
            $post = $request->except('open_time','close_time','close_next_day','is_closed');
              
            $rules = array( 
                "name" => 'required',
                "email" => 'required', 
//                "people_in" => 'required|numeric',
                "address" => 'required',
                "latitude" => 'required|numeric',
                "longitude" => 'required|numeric',
//                "open_time" => 'required',
//                "close_time" => 'required',
//                "bank_account_name"=>'required',
//            "account_number"=>'required|numeric',
//            "routing_number"=>'required|numeric|min:9'
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {

                return redirect('Bar/editBar/'.$id)
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
                unset($post['_token']);
                unset($post['submit']);
                if($post['password']){
                $post['password'] = md5($post['password']);
            } else{
                unset($post['password']);
            }
                
                if(isset($post['cover_image']) && !empty($post['cover_image']))
                {
                    $imagename = time().uniqid()."_barimage";

                    $imageName = $imagename.'.'.$request->cover_image->extension();  

                    $request->cover_image->move(public_path('Uploads/bar/'), $imageName);
                    $post['cover_image'] = url('Uploads/bar/'.$imageName);
                }
                unset($post['url']);
$bar = BarModel::where('bar_id', $id)->first();

if($request->routing_number) {
    if (($bar->account_number != $request->account_number) || ($bar->routing_number != $request->routing_number) || ($bar->bank_account_name != $request->bank_account_name)) {

// return  $bar->bank_account_name;
        if ($request->bank_account_name) {
            try {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $token = $stripe->tokens->create([

                    'bank_account' => [
                        'country' => 'US',
                        'currency' => 'usd',
                        'account_holder_name' => $request->bank_account_name,
                        'account_holder_type' => 'individual',
                        'routing_number' => $request->routing_number,
                        'account_number' => $request->account_number,
                    ],
                ]);


                $bank_account = $stripe->accounts->createExternalAccount(
                    $bar->account,
                    [
                        'external_account' => $token->id,
                        'default_for_currency' => true,
                    ]
                );

                $stripe->accounts->deleteExternalAccount(
                    $bar->account,
                    $bar->bank_account,
                    []
                );

            } catch (\Stripe\Exception\CardException $e) {
                // Since it's a decline, \Stripe\Exception\CardException will be caught
                $e = $e->getMessage();

                session::flash('BarError', $e);
                return redirect('Bar/editBar/' . $id)
                    ->withInput();
            } catch (\Stripe\Exception\RateLimitException $e) {
                $e = $e->getMessage();

                session::flash('BarError', $e);
                return redirect('Bar/editBar/' . $id)->withInput();
                // Too many requests made to the API too quickly
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // Invalid parameters were supplied to Stripe's API
                $e = $e->getMessage();
                session::flash('BarError', $e);
                return redirect('Bar/editBar/' . $id)->withInput();
            } catch (\Stripe\Exception\AuthenticationException $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
                $e = $e->getMessage();
                session::flash('BarError', $e);
                return redirect('Bar/editBar/' . $id)->withInput();
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                // Network communication with Stripe failed
                $e = $e->getMessage();
                session::flash('BarError', $e);
                return redirect('Bar/editBar/' . $id)->withInput();
            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $e = $e->getMessage();
                session::flash('BarError', $e);
                return redirect('Bar/editBar/' . $id)->withInput();
            }
        }

    }
}
//        $post['bank_account_name']=$request->bank_account_name;
//        $post['routing_number']=$request->routing_number;
//        $post['$account_number']=$request->account_number;
//        $post['bank_account']=$bank_account->id;
         $bar = BarModel::where('bar_id', $id)->update($post);
            

                if($bar)
                {
                    session::flash('BarSuccess','Bar has been updated successfully');
                    return redirect('Bar');

                }
                else
                {
                    session::flash('BarError','Bar has been not updated');
                    return redirect('Bar');
                }
            }
        }
        
        else
        {
                session::flash('BarError','Invailid ID');
                return redirect('Bar');
        }
    }

    public function deleteBar($id='')
    {
        if(!empty($id))
        {
            $delete = BarModel::where('bar_id', $id)->delete();

            $checkIn = UserChekinModel::where('bar_id', $id)->delete();
            $userDrinkFavourite = UserDrinkFavourite::where('bar_id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar has been deleted successfully');
                return redirect('Bar');
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return redirect('Bar');
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function barChangeStatus($id='')
    {
        $data = new \stdClass();
        $bar = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bar)
        {
            
          $status = ($bar->status > 0)?0:1;
          $message = ($bar->status > 0)?"Your barconex bar account is suspended":"Your barconex bar account is active";

          $update = BarModel::where('bar_id', $id)->update(array('status'=>$status));

          if($update)
          {
            if(!empty($bar->email))
            {

                $array = array('message' => $message, 'email' => $bar->email, 'name' => $bar->name);

                \Mail::to($bar->email)->send(new \App\Mail\SuspendEmail($array));
            }
            session::flash('BarSuccess','Status changed successfully');
            return back();
          }
          else
          {
            session::flash('BarError','status changed failed');
            return back();
          }



            // return view("userFriends", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }



    // Order Section  

    public function barOrders($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        if(!empty($id))
        {
            $data->orders = BarorderModel::select('*', 't_order.price', 't_order.created_at')
                            ->leftJoin('t_user', 't_user.user_id', '=', 't_order.user_id')
                            ->leftJoin('t_bar_menu', 't_bar_menu.menu_id', '=', 't_order.menu_id')
                            ->where('t_order.bar_id', '=', $id)
                            ->orderBy('t_order.order_id', 'DESC')
                            ->get();

            return view("barOrders", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function deleteBarOrder($id='')
    {
        if(!empty($id))
        {
            $delete = BarorderModel::where('order_id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar order has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    // Banner section

    public function barBanner($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        if(!empty($id))
        {
            $data->banners = BannerModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->orderBy('id', 'DESC')
                        ->get();

            return view("barBanner", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function addBarBanner($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        $bars = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if($bars)
        {

            if(!empty($id))
            {
                return view("addBarBanner", compact('data'));
            }
            else
            {
                session::flash('BarError','Invailid ID');
                return redirect('Bar');
            }
        }
        else{
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }


    public function barBannerSave(Request $request)
    {
    
            $post = $request->all();

            $rules = array( 
                 
                "start_date" => 'required',
                "expiry_date" => 'required',
                "bar_id" => 'required|numeric',
                "banner_image" => 'required|image|mimes:jpeg,png,jpg',
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {
                
                return redirect('Bar/addBarBanner/'.$post['bar_id'])
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
                unset($post['_token']);

                $imagename = time().uniqid()."_barimage";

                $imageName = $imagename.'.'.$request->banner_image->extension();  

                $request->banner_image->move(public_path('Uploads/banner/'), $imageName);
                $post['banner_image'] = url('Uploads/banner/'.$imageName);

                $bar = BannerModel::create($post);

                if($bar)
                {
                    session::flash('BarSuccess','Banner has been created successfully');
                    return redirect('Bar/barBanner/'.$post['bar_id']);
                }
                else
                {
                    session::flash('BarError','Banner has been not created');
                    return redirect('Bar/barBanner/'.$post['bar_id']);
                }
            }
        
    }

    public function editBarBanner($id = '')
    {

        $data = new \stdClass();
        $banner = BannerModel::select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $banner)
        {

                $data = BannerModel::select('*')
                            ->where('id', '=', $id)
                            ->get()->first();

                return view("editBarBanner", compact('data'));
            
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }


    public function barBannerUpdate(Request $request, $id='')
    {
        if(!empty($id))
        {
            $post = $request->all();

            $rules = array( 
                 
                "start_date" => 'required',
                "expiry_date" => 'required',
                "bar_id" => 'required|numeric',
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {
                
                return redirect('Bar/addBarBanner/'.$post['bar_id'])
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
               // print_r($post);
               // die();
                unset($post['_token']);

                if($post['banner_image'])
                {
                    $imagename = time().uniqid()."_barimage";

                    $imageName = $imagename.'.'.$request->banner_image->extension();  

                    $request->banner_image->move(public_path('Uploads/banner/'), $imageName);
                    $post['banner_image'] = url('Uploads/banner/'.$imageName);
                }

                $bar = BannerModel::where('id', $id)->update($post);

                if($bar)
                {
                    session::flash('BarSuccess','Banner has been updated successfully');
                    return redirect('Bar/barBanner/'.$post['bar_id']);
                }
                else
                {
                    session::flash('BarError','Banner has been not updated');
                    return redirect('Bar/barBanner/'.$post['bar_id']);
                }
            }
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar/barBanner/'.$post['bar_id']);
        }
        
    }

    public function deleteBarBanner($id='')
    {
        if(!empty($id))
        {
            $delete = BannerModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }


    // Photo Wall 

    public function photoWall($id='')
    {
        $data = new \stdClass();
        $bar = barModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bar)
        {
                $data->bar_id = $id;
                $data->photowalls = PhotoWallModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('id', 'DESC')
                            ->get();

                return view("photoWall", compact('data'));
            
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function deleteBarphotoWall($id='')
    {
        if(!empty($id))
        {
            $delete = PhotoWallModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar photoWall has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    // Menu Category section

    public function barMenuCategory($id='')
    {

        $data = new \stdClass();
        $bar = barModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bar)
        {
                $data->bar_id = $id;
                $data->categories = MenucategoryModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->orderBy('id', 'DESC')
                            ->get();

                return view("barMenuCategory", compact('data'));
            
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function addBarMenuCategory($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        $bars = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bars)
        {
            return view("addBarMenuCategory", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function barMenuCategorySave(Request $request)
    {
    
        $post = $request->all();

        $rules = array( 
             
            "menu_type" => 'required',
            "name" => 'required',
            "bar_id" => 'required|numeric', 
            "image" => 'required|image|mimes:jpeg,png,jpg',
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            
            return redirect('Bar/addBarMenuCategory/'.$post['bar_id'])
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            unset($post['_token']);

            $imagename = time().uniqid()."_barimage";
            $imageName = $imagename.'.'.$request->image->extension();  
            $request->image->move(public_path('Uploads/barcategory/'), $imageName);
            $post['image'] = url('Uploads/barcategory/'.$imageName);

            $bar = MenucategoryModel::create($post);

            if($bar)
            {
                session::flash('BarSuccess','Bar menu category has been created successfully');
                return redirect('Bar/barMenuCategory/'.$post['bar_id']);
            }
            else
            {
                session::flash('BarError','Bar menu category has been not created');
                return redirect('Bar/barMenuCategory/'.$post['bar_id']);
            }
        }    
    }

    public function editBarMenuCategory($id='')
    {
        $data = new \stdClass();
        $data = MenucategoryModel::select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        if(!empty($id) && !empty($data))
        {
            return view("editBarMenuCategory", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function BarMenuCategoryUpdate(Request $request, $id='')
    {
        if(!empty($id))
        {
            $post = $request->all();

            $rules = array( 
                 
                "menu_type" => 'required',
                "name" => 'required',
                "bar_id" => 'required|numeric',
                "image" => 'image|mimes:jpeg,png,jpg',
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {
                
                return redirect('Bar/editBarMenuCategory/'.$post['bar_id'])
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
               // print_r($post);
               // die();
                unset($post['_token']);

                if(!empty($post['image']))
                {
                    $imagename = time().uniqid()."_barimage";
                    $imageName = $imagename.'.'.$request->image->extension();  
                    $request->image->move(public_path('Uploads/barcategory/'), $imageName);
                    $post['image'] = url('Uploads/barcategory/'.$imageName);
                }

                $bar = MenucategoryModel::where('id', $id)->update($post);

                if($bar)
                {
                    session::flash('BarSuccess','Banner has been updated successfully');
                    return redirect('Bar/barMenuCategory/'.$post['bar_id']);
                }
                else
                {
                    session::flash('BarError','Banner has been not updated');
                    return redirect('Bar/barMenuCategory/'.$post['bar_id']);
                }
            }
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }   
    }

    public function deleteBarMenuCategory($id='')
    {
        if(!empty($id))
        {
            $delete = MenucategoryModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar menu category has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }


    // Bar menu section

    public function barMenu($id='')
    {
        $data = new \stdClass();
        $bar = barModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bar)
        {
                $data->bar_id = $id;
                $data->menues = BarmenuModel::select('t_bar_menu.menu_id', 't_bar_menu.name', 't_bar_menu.image', 't_bar_menu.description', 't_bar_menu.created_at', 't_bar_menu_category.name as category_name')
                        ->join('t_bar_menu_category', 't_bar_menu_category.id', '=', 't_bar_menu.category_id')
                        ->where('t_bar_menu.bar_id', '=', $id)
                        ->orderBy('t_bar_menu.menu_id', 'DESC')
                            ->get();

                return view("barMenu", compact('data'));
            
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function addBarMenu($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        $bars = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bars)
        {
            $data->categories = MenucategoryModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get();
       
            return view("addBarMenu", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function barMenuSave(Request $request)
    {
        $messages = [
            'category_id.required' => 'The category field is required.',     
        ];
    
        $post = $request->all();

        $rules = array( 
             
            "category_id" => 'required|numeric',
            "name" => 'required',
            "description" => 'required',
            "bar_id" => 'required|numeric', 
            "image" => 'required|image|mimes:jpeg,png,jpg',
        );

        $validator = Validator::make($post, $rules, $messages);

        if ($validator->fails()) {
            
            return redirect('Bar/addBarMenu/'.$post['bar_id'])
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            unset($post['_token']);

            $imagename = time().uniqid()."_barimage";
            $imageName = $imagename.'.'.$request->image->extension();  
            $request->image->move(public_path('Uploads/barcategory/'), $imageName);
            $post['image'] = url('Uploads/barcategory/'.$imageName);

            $bar = BarmenuModel::create($post);

            if($bar)
            {
                session::flash('BarSuccess','Bar menu category has been created successfully');
                return redirect('Bar/barMenu/'.$post['bar_id']);
            }
            else
            {
                session::flash('BarError','Bar menu category has been not created');
                return redirect('Bar/barMenu/'.$post['bar_id']);
            }
        }    
    }

    public function editBarMenu($id='')
    {
        $data = new \stdClass();
        $data = BarmenuModel::select('*')
                        ->where('menu_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && !empty($data))
        {
            $data->categories = MenucategoryModel::select('*')
                            ->where('bar_id', '=', $data->bar_id)
                            ->get();

            return view("editBarMenu", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
        
    }

    public function BarMenuUpdate(Request $request, $id='')
    {
        $messages = [
            'category_id.required' => 'The category field is required.',     
        ];

        if(!empty($id))
        {
            $post = $request->all();

            $rules = array( 
                 
                "category_id" => 'required|numeric',
                "name" => 'required',
                "description" => 'required',
                "bar_id" => 'required|numeric', 
                "image" => 'image|mimes:jpeg,png,jpg',
            );

            $validator = Validator::make($post, $rules, $messages);

            if ($validator->fails()) {

                // print_r($validator->messages()->all());
                
                return redirect('Bar/editBarMenu/'.$id)
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
               // print_r($post);
               // die();
                unset($post['_token']);

                if(!empty($post['image']))
                {
                    $imagename = time().uniqid()."_barimage";
                    $imageName = $imagename.'.'.$request->image->extension();  
                    $request->image->move(public_path('Uploads/barcategory/'), $imageName);
                    $post['image'] = url('Uploads/barcategory/'.$imageName);
                }

                $bar = BarmenuModel::where('menu_id', $id)->update($post);

                if($bar)
                {
                    session::flash('BarSuccess','Bar menu has been updated successfully');
                    return redirect('Bar/barMenu/'.$post['bar_id']);
                }
                else
                {
                    session::flash('BarError','Bar menu has been not updated');
                    return redirect('Bar/barMenu/'.$post['bar_id']);
                }
            }
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }   
    }

    public function deleteBarMenu($id='')
    {
        if(!empty($id))
        {
            $delete = BarmenuModel::where('menu_id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar menu has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }



    // Bar Event Section


    public function barEvent($id='')
    {

        $data = new \stdClass();
        $bar = barModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bar)
        {
                $data->bar_id = $id;
                $data->events = BareventModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->orderBy('event_id', 'DESC')
                        ->get();

                foreach($data->events as $event){
                    $event->close_time = date('h:i A', strtotime($event->close_time));
                    $event->open_time = date('h:i A', strtotime($event->open_time));
                }

                return view("barEvent", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function addBarEvent($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        $bars = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bars)
        {
            return view("addBarEvent", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }   
    }

    public function barEventSave(Request $request)
    {
        $post = $request->all();

        $rules = array(
             
            "bar_id" => "required|numeric", 
            "name" => "required", 
            "description" => "required", 
            "icon" => "required|image|mimes:jpeg,png,jpg", 
            "image" => "required|image|mimes:jpeg,png,jpg", 
            "color" => "required", 
            "event_type" => "required", 
            "start_date" => "required", 
            "start_time" => "required", 
            "end_time" => "required", 
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            // dd($post['_token']);
            unset($post['_token']);

            if(!empty($post['image']))
            {
                $imagename = time().uniqid()."_eventimage";
                $imageName = $imagename.'.'.$request->image->extension();  
                $request->image->move(public_path('Uploads/barevent/'), $imageName);
                $post['image'] = url('Uploads/barevent/'.$imageName);
            }

            if(!empty($post['icon']))
            {
                $iconname = time().uniqid()."_eventicon";
                $iconName = $iconname.'.'.$request->icon->extension();  
                $request->icon->move(public_path('Uploads/barevent/'), $iconName);
                $post['icon'] = url('Uploads/barevent/'.$iconName);
            }

            // dd($post);

            $bar = BareventModel::create($post);

            if($bar)
            {
                session::flash('BarSuccess','Bar event has been created successfully');
                return redirect('Bar/barEvent/'.$post['bar_id']);
            }
            else
            {
                session::flash('BarError','Bar event has been not created');
                return redirect('Bar/barEvent/'.$post['bar_id']);
            }
        }    
    }

    public function editBarEvent($id='')
    {
        $data = new \stdClass();
        $data = BareventModel::select('*')
                        ->where('event_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && !empty($data))
        {
            return view("editBarEvent", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
        
    }

    public function BarEventUpdate(Request $request, $id='')
    {

        if(!empty($id))
        {
            $post = $request->all();

            $rules = array(
                "bar_id" => "required|numeric", 
                "name" => "required", 
                "description" => "required", 
                "icon" => "image|mimes:jpeg,png,jpg", 
                "image" => "image|mimes:jpeg,png,jpg", 
                "color" => "required", 
                "event_type" => "required", 
                "start_date" => "required", 
                "start_time" => "required",  
                "end_time" => "required", 
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {
                
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
               // print_r($post);
               // die();
                unset($post['_token']);

                if(!empty($post['image']))
                {
                    $imagename = time().uniqid()."_eventimage";
                    $imageName = $imagename.'.'.$request->image->extension();  
                    $request->image->move(public_path('Uploads/barevent/'), $imageName);
                    $post['image'] = url('Uploads/barevent/'.$imageName);
                }

                if(!empty($post['icon']))
                {
                    $iconname = time().uniqid()."_eventicon";
                    $iconName = $iconname.'.'.$request->icon->extension();  
                    $request->icon->move(public_path('Uploads/barevent/'), $iconName);
                    $post['icon'] = url('Uploads/barevent/'.$iconName);
                }

                $bar = BareventModel::where('event_id', $id)->update($post);

                if($bar)
                {
                    session::flash('BarSuccess','Bar event has been updated successfully');
                    return redirect('Bar/barEvent/'.$post['bar_id']);
                }
                else
                {
                    session::flash('BarError','Bar event has been not updated');
                    return redirect('Bar/barEvent/'.$post['bar_id']);
                }
            }
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }   
    }

    public function deleteBarEvent($id='')
    {
        if(!empty($id))
        {
            $delete = BareventModel::where('event_id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar event has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }


    //  Bar Game section

   
public function activities()
    {
        

    $data = new \stdClass();
    $data->games = GameModel::select('*')
                       
                        ->orderBy('id', 'DESC')
                        ->get();

                return view("Activity.index", compact('data'));   
       
    }

public function activitySave(Request $request)
    {
        $post = $request->all();

        $rules = array(
          
            "name" => "required",           
            "image" => "required|image|mimes:jpeg,png,jpg", 
            
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            unset($post['_token']);

            if(!empty($post['image']))
            {
                $imagename = time().uniqid()."_gameimage";
                $imageName = $imagename.'.'.$request->image->extension();  
                $request->image->move(public_path('Uploads/bargame/'), $imageName);
                $post['image'] = url('Uploads/bargame/'.$imageName);
            }

            // dd($post);

            $bar = GameModel::create($post);

            if($bar)
            {
                session::flash('BarSuccess','Activity has been created successfully');
                return redirect('/activities');
            }
            else
            {
                session::flash('BarError','Activity has been not created');
                return redirect('Bar/barGame/'.$post['bar_id']);
            }
        }    
    }
    public function activityDelete($id)
    {
        if(!empty($id))
        {
            $delete = GameModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Activity has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
           
    }
    public function activityUpdate($id ,Request $request)
    {
        if(!empty($id))
        {
            $post = $request->all();

            $rules = array(
                
                "name" => "required", 
                "image" => "image|mimes:jpeg,png,jpg", 
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {
                
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {

                unset($post['_token']);

                if(!empty($post['image']))
                {
                    $imagename = time().uniqid()."_gameimage";
                    $imageName = $imagename.'.'.$request->image->extension();  
                    $request->image->move(public_path('Uploads/bargame/'), $imageName);
                    $post['image'] = url('Uploads/bargame/'.$imageName);
                }

                $bar = GameModel::where('id', $id)->update($post);

                if($bar)
                {
                    session::flash('BarSuccess','Activity has been updated successfully');
                    return redirect('/activities');
                }
                else
                {
                    session::flash('BarError','Activity has been not updated');
                    return redirect('/activities');
                }
            }
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }   
    }

     public function saveImage(Request $request)
    {
        $post = $request->all();

         

                if(!empty($post['image']))
                {
                    $imagename = time().uniqid()."_gameimage";
                    $imageName = $imagename.'.'.$request->image->extension();  
                    $request->image->move(public_path('Uploads/bargame/'), $imageName);
                    $post['image'] = url('Uploads/bargame/'.$imageName);
                }


         return response()->json([
                'status'=>success,
                "image" => $post['image'],
            ]);

       
    }



    public function barGame($id='')
    {
        
        $data = new \stdClass();
        $bar = barModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->first();

        if(!empty($id) && $bar)
        {
                $data->bar_id = $id;
                $data->games = BargameModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->orderBy('id', 'DESC')
                        ->get();

                return view("barGame", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function addBarGame($id='')
    {
        $data = new \stdClass();
        $data->bar_id = $id;
        $bars = BarModel::select('*')
                        ->where('bar_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $bars)
        {
            return view("addBarGame", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('Bar');
        }
    }

    public function barGameSave(Request $request)
    {
        $post = $request->all();

        $rules = array(
            "bar_id" => "required|numeric", 
            "name" => "required", 
            "description" => "required",  
            "image" => "required|image|mimes:jpeg,png,jpg", 
            "no_of_players" => "required", 
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            unset($post['_token']);

            if(!empty($post['image']))
            {
                $imagename = time().uniqid()."_gameimage";
                $imageName = $imagename.'.'.$request->image->extension();  
                $request->image->move(public_path('Uploads/bargame/'), $imageName);
                $post['image'] = url('Uploads/bargame/'.$imageName);
            }

            // dd($post);

            $bar = BargameModel::create($post);

            if($bar)
            {
                session::flash('BarSuccess','Bar game has been created successfully');
                return redirect('Bar/barGame/'.$post['bar_id']);
            }
            else
            {
                session::flash('BarError','Bar game has been not created');
                return redirect('Bar/barGame/'.$post['bar_id']);
            }
        }    
    }

    public function editBarGame($id='')
    {
        $data = new \stdClass();
        $data = BargameModel::select('*')
                        ->where('id', '=', $id)
                        ->get()->first();

        if(!empty($id) && !empty($data))
        {
            return view("editBarGame", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function barGameUpdate(Request $request, $id='')
    {

        if(!empty($id))
        {
            $post = $request->all();

            $rules = array(
                "bar_id" => "required|numeric", 
                "name" => "required", 
                "description" => "required",  
                "image" => "image|mimes:jpeg,png,jpg", 
                "no_of_players" => "required", 
            );

            $validator = Validator::make($post, $rules);

            if ($validator->fails()) {
                
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {

                unset($post['_token']);

                if(!empty($post['image']))
                {
                    $imagename = time().uniqid()."_gameimage";
                    $imageName = $imagename.'.'.$request->image->extension();  
                    $request->image->move(public_path('Uploads/bargame/'), $imageName);
                    $post['image'] = url('Uploads/bargame/'.$imageName);
                }

                $bar = BargameModel::where('id', $id)->update($post);

                if($bar)
                {
                    session::flash('BarSuccess','Bar event has been updated successfully');
                    return redirect('Bar/barGame/'.$post['bar_id']);
                }
                else
                {
                    session::flash('BarError','Bar event has been not updated');
                    return redirect('Bar/barGame/'.$post['bar_id']);
                }
            }
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }   
    }

    public function deleteBarGame($id='')
    {
        if(!empty($id))
        {
            $delete = BargameModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar event has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }




}

?>