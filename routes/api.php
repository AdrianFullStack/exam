<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

require __DIR__ . '/auth/auth.php';
require __DIR__ . '/auth/passwordReset.php';

Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::resource('nota', 'NotaController')->only([
        'store', 'index'
    ]);;
});
