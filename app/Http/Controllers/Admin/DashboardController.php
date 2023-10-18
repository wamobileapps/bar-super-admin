<?php 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\AdminModel;
use App\Models\BarModel;
use App\Models\BareventModel;
use App\Models\BargameModel;
use App\Models\MenucategoryModel;
use App\Models\BarmenuModel;
use App\Models\UserEventModel;
use App\Models\BannerModel;
use App\Models\PhotoWallModel;
use App\Models\PossibleModel;
use App\Models\BarorderModel;
use App\Models\AuthenticationModel;
use App\Models\PaymentModel;
use Session;
use Auth;


class DashboardController extends Controller
{

    public function __construct()
    {
    	
    	
    }

    public function index()
    {


      

          $dash = new \stdClass();

          $month = date('m');
          $date = date('Y-m-d');

        

          $dash->bars = BarModel::select('*')
                          ->limit(5)
                          ->orderBy('bar_id', 'DESC')
                          ->get();

          $totalBar = BarModel::select('*')
                            ->get();
          $dash->totalBar = $totalBar->count();

          $dash->users = AuthenticationModel::select('*')
                          ->limit(5)
                          ->orderBy('id', 'DESC')
                          ->get();

          $totalUser = AuthenticationModel::select('*')
                                          ->get();

          $dash->userCount = $dash->users->count();
          $dash->barCount = $dash->bars->count();

          $dash->totalUser = $totalUser->count();

          $dash->totalRevenue = PaymentModel::sum('amount');
          $dash->todayRevenue = PaymentModel::whereDate('created_at', '=', $date)->sum('amount');
          
          $dash->completeProfile = AuthenticationModel::select('profile_completed', DB::raw('count(id) as total'))
                                              ->groupBy('profile_completed')
                                              ->whereMonth('created_at', '=', $month)
                                              ->get();

          $dash->appDown = AuthenticationModel::select(DB::raw('count(id) total, YEAR(created_at) year, MONTH(created_at) month'))
                                    ->groupBy('year','month')
                                    ->whereYear('created_at', '=', 2020)
                                    ->orderby('month', 'asc')
                                    ->get();


        
                                                               	
      return view("index", compact('dash'));
    }

    public function logout()
    { 
    	  Session()->flush();   	
        return redirect()->to('login');
    }  

 


}

?>