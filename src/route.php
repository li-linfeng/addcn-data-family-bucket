<?php

use Illuminate\Support\Facades\Route;

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




Route::group(
    [
        'prefix' => 'api',
        'middleware' => ['api']
    ],
    function () {
        //"start_page": 要去的頁面  
        //"end_page": ": 要關閉的頁面  
        Route::get('/stats', function () {
            return [
                'message' => 'success',
                'data' => []
            ];
        });

        //"flag": launch首次打開   close 關閉   reverse 從後台回復到前台  
        Route::get('/app_life_cycle', function () {
            return [
                'message' => 'success',
                'data' => []
            ];
        });
    }
);
