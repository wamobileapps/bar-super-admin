	<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});
    Route::post('login1', "ApiController@authenticate");
    Route::group(['middleware' => ['jwt.verify']], function() {

       
        });
     Route::post("register", "ApiController@register");

Route::post("signup", "Api\AuthenticationController@create");
Route::post("createToken", "Api\AuthenticationController@createToken");
Route::post("login", "Api\AuthenticationController@index");

Route::post("socialLogin", "ApiController@SocialLogin");
Route::post("socialLogin1", "Api\AuthenticationController@SocialLogin");

Route::post("BarLogin", "Api\BarController@BarLogin");
Route::post("forgetPassword", "Api\AuthenticationController@show");
Route::post("barForgetPassword", "Api\BarController@forgetPassword");
Route::post("barResetPassword", "Api\BarController@resetPassword");

Route::post("CompleteProfile", "Api\UserController@update");
Route::post("getUserProfile", "Api\UserController@index");
Route::get("getAllUserProfile/{id}", "Api\UserController@show");
Route::get("getAllDAta/{id}", "Api\UserController@getAllDAta");

Route::get("getFavouriteGames/{id}", "Api\UserfavouriteController@index");
Route::get("GetFavouriteBars/{id}", "Api\UserfavouriteController@GetFavouriteBars");
Route::get("GetFavouriteBarsorcheckin/{id}", "Api\UserfavouriteController@GetFavouriteBarsorcheckin");
Route::get("GetFavouriteEvents/{id}", "Api\UserfavouriteController@GetFavouriteEvents");

Route::post("addGameToFavourite", "Api\UserfavouriteController@create");
Route::post("addBarToFavourite", "Api\UserfavouriteController@createFavouriteBars");
Route::post("addEventToFavourite", "Api\UserfavouriteController@createFavouriteEvent");
Route::post("saveEvent", "Api\UserfavouriteController@saveEvent");
Route::get("getSavedEvent/{id}", "Api\UserfavouriteController@getSavedEvent");

Route::post("uploadProfilePhoto", "Api\UserController@uploadProfilePhoto");
Route::post("editUserInfo", "Api\UserController@edit");

Route::get("getBlockedUserList/{id}", "Api\UserController@getBlockedUserList");
Route::post("blockUser", "Api\UserController@blockUser");
Route::post("addFriend", "Api\UserController@addFriend");
Route::get("getFrinedsList/{id}", "Api\UserController@getFrinedsList");
Route::post("saveUserEvent", "Api\UserController@saveUserEvent");
Route::post("addRemoveFavoriteDrink", "Api\UserController@addRemoveFavoriteDrink");
Route::get("getFavoriteDrink/{id}", "Api\UserController@getFavoriteDrink");
Route::post("addFavoriteUser", "Api\UserController@addFavoriteUser");
Route::get("getFavoriteUser/{id}", "Api\UserController@getFavoriteUser");
Route::post("addUserPhotowall", "Api\UserController@addUserPhotowall");
Route::get("getUserPhotowall/{id}", "Api\UserController@getUserPhotowall");
Route::post("deleteUserPhotowall", "Api\UserController@deletePhotowall");
Route::post("acceptOrRejectFriendRequest", "Api\UserController@acceptOrRejectFriendRequest");
Route::post("seachUserByName", "Api\UserController@seachUserByName");
Route::post("seachUserByEmail", "Api\UserController@seachUserByEmail");
Route::post("userCheckInCheckOut", "Api\UserController@userCheckInCheckOut");
Route::post("removeFriend", "Api\UserController@removeFriend");

Route::get("getUserEvents/{id}", "Api\UserController@getUserEvents");
Route::get("sendPushTry", "Api\UserController@notification");


Route::post("AddBar", "Api\BarController@create");
Route::post("getAllBar", "Api\BarController@index");
Route::post("test", "Api\BarController@test");
Route::post("getBar", "Api\BarController@show");
Route::post("update_time", "Api\BarController@update_time");
Route::post("getSearch", "Api\BarController@getSearch");
Route::post("sendMailBardetails", "Api\BarController@sendMailBardetails");
Route::post("getGuestByBar", "Api\BarController@getGuestByBar");
Route::get("getcheckedInUsers/{id}", "Api\BarController@getAllCheckedInUser");


Route::post("addBarPhotoWall", "Api\BarPhotoWallController@create");

Route::post("deleteBarPhotowall", "Api\BarPhotoWallController@destroy");
Route::get("getBarPhotoWall/{id}", "Api\BarPhotoWallController@show");

Route::post("getBarMenu", "Api\BarController@getBarMenu");
Route::get("getweek/{id}", "Api\BarController@getweek");
Route::post("updateBar/{id}", "Api\BarController@barUpdate");
Route::delete("deleteBar/{id}", "Api\BarController@destroy");

Route::post("AddBarmenu", "Api\BarmenuController@create");
Route::get("getBarmenu", "Api\BarmenuController@index");
Route::get("getBarmenu/{id}", "Api\BarmenuController@show");
Route::post("updateBarmenu", "Api\BarmenuController@update");
Route::get("deleteBarmenu/{id}", "Api\BarmenuController@destroy");

Route::post("AddBarmenuCategory", "Api\MenucategoryController@create");
Route::post("updateBarmenuCategory", "Api\MenucategoryController@update");
Route::get("getBarmenuCategory", "Api\MenucategoryController@index");
Route::get("getBarmenuCategory/{id}", "Api\MenucategoryController@show");
//Route::post("updateBarmenuCategory", "Api\MenucategoryController@update");
Route::delete("deleteBarmenuCategory/{id}", "Api\MenucategoryController@destroy");

Route::post("AddBargame", "Api\BargameController@create");
Route::get("getBargame", "Api\BargameController@index");
// Route::get("getBargame/{id}", "Api\BargameController@show");
Route::post("getBargame", "Api\BargameController@getBargame");
Route::post("updateBargame", "Api\BargameController@update");
Route::get("deleteBargame/{id}", "Api\BargameController@destroy");

Route::post("addBarevent", "Api\BareventController@create");
Route::get("getBarevent", "Api\BareventController@index");
Route::post("getEventsByBar", "Api\BareventController@getEventsByBar");
Route::get("getBarevent/{id}", "Api\BareventController@show");
Route::put("updateBarevent/{id}", "Api\BareventController@update");
Route::delete("deleteBarevent/{id}", "Api\BareventController@destroy");

Route::post("buyNow", "Api\PaymentController@index");

Route::get("supergame", "Api\BargameController@supergame");

// Route::apiResource('authentication', 'Api/AuthenticationController');

// Notification
Route::post("sendNotification", "Api\NotificationController@index");
Route::get("android", "Api\NotificationController@android");
Route::get("getAllNotifications/{id}", "Api\NotificationController@getAllNotifications");
Route::get("deleteNotification/{notID}", "Api\NotificationController@deleteNotification");

// Order
Route::post("placeOrder", "Api\BarorderController@index");
Route::post("updateOrderStatus", "Api\BarorderController@updateOrderStatus");
Route::get("getUserOrder/{id}", "Api\BarorderController@getUserOrder");
Route::get("getAwaitedOrder/{id}", "Api\BarorderController@getAwaitedOrder");
Route::get("getTransaction/{id}", "Api\BarorderController@getTransaction");
Route::get("getTransaction/{id}/{option}", "Api\BarorderController@getTransaction");
Route::get("getAllTypeBarUser/{id}", "Api\BarController@getAllTypeBarUser");
Route::post("redeem", "Api\BarorderController@redeem");	
Route::post("cancelRedeem", "Api\BarorderController@cancelRedeem");	
Route::get("pandingRedeem/{id}", "Api\BarorderController@pandingRedeem");	
Route::post("regift", "Api\BarorderController@regift");	
Route::post("acceptOrRejectGift", "Api\BarorderController@acceptOrRejectGift");	
Route::post("updateDrunkLevel", "Api\UserController@updateDrunkLevel");	

// 03-02-21

Route::resource('question', 'Api\QuestionController');
Route::get('QuestionAnswer/{id}', 'Api\QuestionAnswerController@index');
Route::get('NeverHaveEverAnswer/{id}', 'Api\NeverHaveEverAnswerController@index');
Route::resource('QuestionAnswer', 'Api\QuestionAnswerController');
Route::resource('NeverHaveEverAnswer', 'Api\NeverHaveEverAnswerController');

Route::resource('NeverHaveEver', 'Api\NeverHaveEverController');
Route::get('getBanner', 'Api\BannerController@index');

// 03-02-21
Route::post("gameNotification", "Api\NotificationController@gameNotification");	
Route::post("barGameNotification", "Api\NotificationController@barGameNotification");	
Route::post("acceptOrRejectFGame", "Api\NotificationController@acceptOrRejectFGame");

Route::post('requestDrink', 'Api\UserController@requestDrink');
Route::get('sendDrinkList/{id}', 'Api\UserController@sendDrinkList');
Route::get('requestDrinkList/{id}', 'Api\UserController@requestDrinkList');
Route::post('sendDrink', 'Api\UserController@sendDrink');


Route::post('createChannel', 'Api\AuthenticationController@createChannel');
Route::post('deleteChannel', 'Api\AuthenticationController@deleteChannel');
Route::post('getUserChannel', 'Api\AuthenticationController@getUserChannel');

Route::post("userEventPossible", "Api\BarController@userEventPossible");
Route::get("activities/{id}", "Api\BargameController@activities");
Route::get("selectactivities/{id}", "Api\BargameController@selectactivities");
Route::get("get_activity/{id}", "Api\BargameController@getActivity");
Route::get("getActivityById/{id}", "Api\BargameController@getActivityById");
Route::POST("add_bar_to_activity", "Api\BargameController@selectCategory");
Route::POST("remove_bar_from_activity", "Api\BargameController@RemoveBarFromActivity");
Route::POST("updateBardata/{id}", "Api\BargameController@updateBardata");
Route::get("getGameById/{id}", "Api\BargameController@getGameById");


Route::get("my", "Api\BargameController@myFunction");

Route::post("moodAtBar", "Api\UserController@moodAtBar");
Route::resource('Doors', 'Api\DoorsController');
Route::post('addDoor', 'Api\UserController@addDoor');
Route::get('getUserDoor', 'Api\UserController@getUserDoor');
Route::post("getPossibleUserList", "Api\BareventController@getPossibleUserList");


//05-05-22


Route::get('refresh/{account_id}', 'Api\BarController@refreshID');
Route::get('refresh', 'Api\BarController@refresh');
Route::get('return/{email}', 'Api\BarController@returnLink');
Route::get('return/{id}', 'Admin\BarController@return1');