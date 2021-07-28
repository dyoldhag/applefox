<?php

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

Route::get('/age-gate', 'PageController@ageGate');
Route::get('/QuenchYourCuriosity', 'PageController@home');
Route::get('/quenchyourcuriosity', 'PageController@home');

Route::get('/confirmwin', 'ConfirmWinController@confirmWin');
Route::post('/confirmwin', 'ConfirmWinController@confirmWinPost');
Route::get('/confirmwin-result', 'ConfirmWinController@confirmWinResult');
Route::get('/no-more-prizes', 'ConfirmWinController@noMorePrizes');

Route::get('/winfridge', 'WinFridgeController@winFridge');
Route::post('/winfridge', 'WinFridgeController@winFridgePost');
Route::get('/winfridge-detail', 'WinFridgeController@winFridgeDetail');
Route::post('/winfridge-detail', 'WinFridgeController@winFridgeDetailPost');
Route::get('/winfridge-done', 'WinFridgeController@winFridgeDone');

Route::get('/freebag', 'BagGiveawayController@freeBag');
Route::get('/outlet', 'BagGiveawayController@outlet');
#Route::get('/test', 'PageController@test');

////////////////////////AR////////////////////////
Route::get('/terms-and-conditions', 'Ar\PageController@termsOfUse');
Route::get('/privacy-policy', 'Ar\PageController@privacyPolicy');
Route::get('/foxit-age-gate', 'Ar\PageController@ageGate');
// Route::get('/foxit', 'Ar\PageController@home');
Route::get('/foxit-animation', 'Ar\PageController@scan');
Route::get('/foxit-answer', 'Ar\PageController@answer');
Route::post('/foxit-answer', 'Ar\PageController@answerPost');
Route::get('/foxit-submission', 'Ar\PageController@winner');
Route::post('/foxit-submission', 'Ar\PageController@winnerPost');
Route::get('/foxit-confirmation', 'Ar\PageController@confirmation');
////////////////////////END-AR////////////////////////

Route::get('/foxit', function () {
  return redirect('/');
});
////////////////////////AR phase 2//////////////////////// 
// Route::get('/foxit', 'Ar2\PageController@home'); 
// Route::get('/foxit-ar', 'Ar2\PageController@scan');
// Route::get('/foxit-congrats', 'Ar2\PageController@congrats');
// Route::post('/foxit-congrats', 'Ar2\PageController@congratsPost');
// Route::get('/foxit-submitdetail', 'Ar2\PageController@submitDetail');
// Route::post('/foxit-submitdetail', 'Ar2\PageController@submitDetailPost');
// Route::get('/foxit-confirmation-code', 'Ar2\PageController@confirmation');
// Route::post('/foxit-confirmation-code', 'Ar2\PageController@confirmationPost');
// Route::get('/redeem', 'Ar2\PageController@redemption');
// Route::post('/redeem', 'Ar2\PageController@redemptionPost');
// Route::get('/redemption-successful', 'Ar2\PageController@redemptionSuccessful');
////////////////////////END-AR phase 2 ////////////////////////

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'auth'],function(){
  Route::get('admin', 'Admin\DashboardController@index');
  Route::post('admin/setting/', 'Admin\DashboardController@update');
  
  ////////////////////////AR////////////////////////
  Route::get('admin/answers', 'Admin\AnswersController@index');
  Route::get('admin/answers/data', 'Admin\AnswersController@data');

  Route::get('admin/winners', 'Admin\WinnersController@index');
  Route::get('admin/winners/data', 'Admin\WinnersController@data');
  Route::get('admin/winners/export/{type}', 'Admin\WinnersController@exportFile')->name('winners.export.file');

  Route::get('admin/appledays', 'Admin\AppledaysController@index');
  Route::get('admin/appledays/data', 'Admin\AppledaysController@data');
  Route::get('admin/appledays/export/{type}', 'Admin\AppledaysController@exportFile')->name('appledays.export.file');
  ////////////////////////END - AR////////////////////////

  Route::get('admin/users', 'Admin\UsersController@index');
  Route::get('admin/users/data', 'Admin\UsersController@data');
  Route::post('admin/users/update/{id}', 'Admin\UsersController@update');
  Route::post('admin/users/store', 'Admin\UsersController@store');

  Route::get('admin/winfridge', 'Admin\WinFridgeController@index');
  Route::get('admin/winfridge/data', 'Admin\WinFridgeController@data');
  Route::get('admin/winfridge/export/{type}', 'Admin\WinFridgeController@exportFile')->name('winfridge.export.file');

  Route::get('admin/confirmwin', 'Admin\ConfirmWinController@index');
  Route::get('admin/confirmwin/data', 'Admin\ConfirmWinController@data');
  Route::get('admin/export/{type}', 'Admin\ConfirmWinController@exportFile')->name('export.file');

  Route::get('admin/prizes', 'Admin\PrizesController@index');
  Route::get('admin/prizes/data', 'Admin\PrizesController@data');
  Route::get('admin/prizes/edit/{id}', 'Admin\PrizesController@show');
  Route::post('admin/prizes/edit/{id}', 'Admin\PrizesController@update');
  Route::get('admin/prizes/create', 'Admin\PrizesController@create');
  Route::post('admin/prizes/store', 'Admin\PrizesController@store');

  Route::get('admin/baggiveaway', 'Admin\BagGiveawayController@index');
  Route::get('admin/baggiveaway/data', 'Admin\BagGiveawayController@data');
  Route::get('admin/baggiveaway/edit/{id}', 'Admin\BagGiveawayController@show');
  Route::post('admin/baggiveaway/edit/{id}', 'Admin\BagGiveawayController@update');
  Route::post('admin/baggiveaway/store', 'Admin\BagGiveawayController@store');

  Route::get('admin/outlet/data/{id}', 'Admin\OutletController@data');
  Route::post('admin/outlet/store', 'Admin\OutletController@store');
  Route::get('admin/outlet/edit/{id}', 'Admin\OutletController@show');
  Route::post('admin/outlet/edit/{id}', 'Admin\OutletController@update');
});