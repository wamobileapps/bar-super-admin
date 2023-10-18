<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return redirect()->route('dashboard');
});




Route::resource("Bar", "Admin\BarController");
Route::resource("User", "Admin\UserController");

Route::get("changePassword/{id}", "Api\AuthenticationController@store");
Route::post("updatePassword", "Api\AuthenticationController@update");
// Route::get("login", "Admin\LoginController@index");
Route::post("loginProcess", "Admin\LoginController@loginProcess");
Route::get("reset-password", "Admin\LoginController@ResetPassword")->name('reset-password');
Route::POST("reset", "Admin\LoginController@Reset")->name('reset');


Route::get("dashboard", "Admin\DashboardController@index")->name('dashboard');
Route::get("logout", "Admin\DashboardController@logout");
// Route::get("showMail", "Api\AuthenticationController@show");


Route::get("Bar/barsDetails/{id}", "Admin\BarController@barsDetails");
Route::get("Bar/editBar/{id}", "Admin\BarController@editBar");
Route::get("addBar", "Admin\BarController@create");
Route::post("barSave", "Admin\BarController@barSave");
Route::get("Bar/barChangeStatus/{id}", "Admin\BarController@barChangeStatus");
Route::get("Bar/barOrders/{id}", "Admin\BarController@barOrders");
Route::get("Bar/deleteBarOrder/{id}", "Admin\BarController@deleteBarOrder");

Route::get("Bar/deleteBar/{id}", "Admin\BarController@deleteBar");
Route::post("Bar/barUpdate/{id}", "Admin\BarController@barUpdate");

Route::get("Bar/barBanner/{id}", "Admin\BarController@barBanner");
Route::post("barBannerSave", "Admin\BarController@barBannerSave");
Route::post("Bar/barBannerUpdate/{id}", "Admin\BarController@barBannerUpdate");
Route::get("Bar/deleteBarBanner/{id}", "Admin\BarController@deleteBarBanner");

Route::get("Bar/photoWall/{id}", "Admin\BarController@photoWall");
Route::get("Bar/deleteBarphotoWall/{id}", "Admin\BarController@deleteBarphotoWall");

Route::resource('question', 'Admin\QuestionController');
Route::resource('NeverHaveEver', 'Admin\NeverHaveEverController');
Route::resource('Notification', 'Admin\NotificationController');



Route::get("Bar/addBarBanner/{id}", "Admin\BarController@addBarBanner");
Route::get("Bar/editBarBanner/{id}", "Admin\BarController@editBarBanner");

Route::get("Bar/barMenuCategory/{id}", "Admin\BarController@barMenuCategory");
Route::get("Bar/addBarMenuCategory/{id}", "Admin\BarController@addBarMenuCategory");
Route::post("barMenuCategorySave", "Admin\BarController@barMenuCategorySave");
Route::get("Bar/editBarMenuCategory/{id}", "Admin\BarController@editBarMenuCategory");
Route::post("Bar/BarMenuCategoryUpdate/{id}", "Admin\BarController@BarMenuCategoryUpdate");
Route::get("Bar/deleteBarMenuCategory/{id}", "Admin\BarController@deleteBarMenuCategory");

Route::get("Bar/barMenu/{id}", "Admin\BarController@barMenu");
Route::get("Bar/addBarMenu/{id}", "Admin\BarController@addBarMenu");
Route::post("barMenuSave", "Admin\BarController@barMenuSave");
Route::get("Bar/editBarMenu/{id}", "Admin\BarController@editBarMenu");
Route::post("Bar/BarMenuUpdate/{id}", "Admin\BarController@BarMenuUpdate");
Route::get("Bar/deleteBarMenu/{id}", "Admin\BarController@deleteBarMenu");


Route::get("Bar/barEvent/{id}", "Admin\BarController@barEvent");
Route::get("Bar/addBarEvent/{id}", "Admin\BarController@addBarEvent");
Route::post("barEventSave", "Admin\BarController@barEventSave");
Route::get("Bar/editBarEvent/{id}", "Admin\BarController@editBarEvent");
Route::post("Bar/BarEventUpdate/{id}", "Admin\BarController@BarEventUpdate");
Route::get("Bar/deleteBarEvent/{id}", "Admin\BarController@deleteBarEvent");


Route::get("activities", "Admin\BarController@activities")->name('activities');
Route::post("activity-save", "Admin\BarController@activitySave")->name('activity-save');
Route::get("deleteActivity/{id}", "Admin\BarController@activityDelete")->name('activity-delete');


Route::post("activity-update/{id}", "Admin\BarController@activityUpdate")->name('activity-update');
Route::post("saveImage", "Admin\BarController@saveImage");

Route::get("Bar/barGame/{id}", "Admin\BarController@barGame");
Route::get("Bar/addBarGame/{id}", "Admin\BarController@addBarGame");
Route::post("barGameSave", "Admin\BarController@barGameSave");
Route::get("Bar/editBarGame/{id}", "Admin\BarController@editBarGame");
Route::post("Bar/barGameUpdate/{id}", "Admin\BarController@barGameUpdate");
Route::get("Bar/deleteBarGame/{id}", "Admin\BarController@deleteBarGame");


Route::get("User/userDetails/{id}", "Admin\UserController@userDetails");
Route::get("User/deleteUser/{id}", "Admin\UserController@deleteUser");
Route::get("User/userOrders/{id}", "Admin\UserController@userOrders");
Route::get("User/userPhotoWall/{id}", "Admin\UserController@userPhotoWall");
Route::get("User/deleteUserPhotoWall/{id}", "Admin\UserController@deleteUserPhotoWall");
Route::get("User/userEvents/{id}", "Admin\UserController@userEvents");
Route::get("User/deleteUserEvent/{id}", "Admin\UserController@deleteUserEvent");
Route::get("User/userGames/{id}", "Admin\UserController@userGames");
Route::get("User/deleteUserGames/{id}", "Admin\UserController@deleteUserGames");
Route::get("User/userFriends/{id}", "Admin\UserController@userFriends");
Route::get("User/userblock/{id}", "Admin\UserController@userblock");
Route::get("User/userChangeStatus/{id}", "Admin\UserController@userChangeStatus");
Route::post("User/removeImage", "Admin\UserController@removeUserImage")->name('remove.image');
Route::post("User/addBackImage", "Admin\UserController@addBackImage")->name('add.back.image');

Route::get("User/editUser/{id}", "Admin\UserController@editUser");
Route::get("addUser", "Admin\UserController@addUser");
Route::post("userSave", "Admin\UserController@userSave");
Route::post("User/userUpdate/{id}", "Admin\UserController@userUpdate");

// Route::get("barsDetails/{id}", "Admin\BarController@create");
Route::get('/clearCache', function() {
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get("/my", "Admin\BarController@myFunction");
Route::get('connectlink', 'Admin\BarController@connectlink');
Route::get('refresh/{account_id}', 'Admin\BarController@refreshID');
Route::get('refresh', 'Admin\BarController@refresh');
Route::get('return/{email}', 'Admin\BarController@returnLink');
Route::get('return/{id}', 'Admin\BarController@return1');