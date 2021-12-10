<?php

use App\Http\Controllers\PayerController;
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

Route::get('/', function () {
    return view('welcome');
});

//======================================================================
// Payement mobile money mtn & Orange
//======================================================================


//======================================================================
// Payement mobile money mtn 
//======================================================================

Route::get('/smspayer', [PayerController::class, 'index']);
Route::post('/smspayer_meth', [PayerController::class, 'mtn']);
//======================================================================
// retour et details
//======================================================================
Route::post('/lastpart', [PayerController::class, 'mtnretour']);



//======================================================================
// Payement mobile money Orange
//======================================================================

//======================================================================
// page intermediiare
//======================================================================
Route::post('/orange', [PayerController::class, 'orange']);
Route::post('/orangeretour', [PayerController::class, 'orangeretour']);
//======================================================================
// retour et details
//======================================================================
Route::get('/lastpartorange', [PayerController::class, 'orangelastretour']);