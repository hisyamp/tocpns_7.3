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
// Auth::routes(['verify' => true]);

// auth
Route::get('/', 'auth\LoginController@formlogin')->name('login');;
Route::post('/postlogin', 'auth\LoginController@postLogin');
Route::get('/logout', 'auth\LoginController@logout')->name('logout');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::post('/regis', 'auth\RegisterController@regis')->name('register');

Route::group(['middleware' => 'auth'], function(){

// user
Route::get('/paymentacc', 'User\UserController@paymentacc');
Route::get('/listuser', 'User\UserController@listuser')->name('listuser');
Route::get('/apilistuser', 'User\UserController@apilistuser');
Route::get('/passwordreset', 'User\UserController@passwordreset');
Route::post('/reset_password', 'User\UserController@reset_password');
Route::get('/upgrade', 'User\UserController@upgrade_member');
Route::get('/soal', 'User\UserController@soal');
// });

// home
Route::get('/home', 'Home\HomeController@beranda')->name('home');

// skd
Route::get('/banksoaltoskd', 'SKD\SkdController@banksoalskd');
Route::get('/apibankskd/{ju}', 'SKD\SkdController@apibankskd');
Route::get('/materiskd', 'SKD\SkdController@materiskd');
Route::get('/latsoalskd', 'SKD\SkdController@latsoalskd');
Route::get('/tomandiriskd', 'SKD\SkdController@tomandiriskd');
Route::get('/toakbarskd', 'SKD\SkdController@toakbarskd');
Route::get('/apitoskd', 'SKD\SkdController@apiToSkd');
Route::get('/generatePaket', 'SKD\SkdController@generatePaket');
Route::post('/buatpaketskd', 'SKD\SkdController@buatPaket');
Route::get('/apiLatRandSkd', 'SKD\SkdController@apiLatRandSkd');
Route::get('/apirekom', 'SKD\SkdController@apirekom');
Route::get('/detailpaket/{ju}', 'SKD\SkdController@detailPaket');
Route::get('/detailsoal/{id}', 'SKD\SkdController@detailSoal');
Route::get('/allskd', 'SKD\SkdController@allskd');
Route::post('/soalgambar', 'SKD\SkdController@soalgambar');
Route::post('/soalcerita', 'SKD\SkdController@soalcerita');
Route::get('/apiallskd', 'SKD\SkdController@apiallskd');


//skb
Route::get('/banksoalskb', 'SKB\SkbController@banksoalskb');
Route::get('/apibankskb/{ju}', 'SKB\SkbController@apibankskb');
Route::get('/apitoskb', 'SKB\SkbController@apiToSkb');
Route::post('/buatpaketskb', 'SKB\SkbController@buatPaket');

//pppk
Route::get('/banksoalpppk', 'PPPK\PppkController@banksoalpppk');
Route::get('/apibankpppk/{ju}', 'PPPK\PppkController@apibankpppk');
Route::get('/apitopppk', 'PPPK\PppkController@apiToPppk');
Route::get('/buatpaketpppk', 'PPPK\PppkController@buatPaketPppk');

//payment
Route::get('/payment', 'Payment\PaymentController@index');
Route::get('/pay', 'Payment\PaymentController@checkout');

});