<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Route::resource('/', 'LandingPageController');


// Route for AdminController
Route::resource('admin', 'AdminController')->middleware('verified');

// Route for PatientsController
Route::resource('patient', 'PatientsController');

// Route for KinsController
Route::resource('kin', 'KinsController');

// Route for DoctorsController
Route::resource('doctor', 'DoctorsController');

// Route for DepartmentsController
Route::resource('department', 'DepartmentsController');

// Route for AppointmentsController
Route::resource('appointment', 'AppointmentsController');

// Route for PostsController
Route::resource('posts', 'PostsController');

// Route for ReceptionistsController
Route::resource('receptionists', 'ReceptionistsController');




// Route for chat History
Route::resource('chat', 'ChatsController');

// Route for Feedback
Route::resource('feedback', 'FeedbacksController');

// Route for  Prescriptions
Route::resource('prescription', 'PrescriptionsController');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::prefix('client')->group(function(){

    // Dashboard route
    Route::get('/', 'ClientController@index')->name('client.dashboard');

    // Client Details Registration Route
    Route::get('/home', 'ClientController@details')->name('client.details');

    // Login Routes
    Route::get('/login', 'Auth\ClientLoginController@showLoginForm')->name('client.login');
    Route::post('/login', 'Auth\ClientLoginController@login')->name('client.login.submit');

    // Logout route
    Route::post('/logout', 'Auth\ClientLoginController@logout')->name('client.logout');

    // Register routes
    Route::get('/register', 'Auth\ClientRegisterController@showRegistrationForm')->name('client.register');
    Route::post('/register', 'Auth\ClientRegisterController@register')->name('client.register.submit');

    // password reset routes
    Route::get('/password/reset', 'Auth\ClientForgotPasswordController@showLinkRequestForm')->name('client.password.request');
    Route::post('/password/email', 'Auth\ClientForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
    Route::get('/password/reset/{token}', 'Auth\ClientResetPasswordController@showResetForm')->name('client.password.reset');
    Route::post('/password/reset', 'Auth\ClientResetPasswordController@reset')->name('client.password.update');

});
