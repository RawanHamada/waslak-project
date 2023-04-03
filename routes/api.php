


<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\API\AddressesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\ContactsController;
use App\Http\Controllers\API\MarketsController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\RattingController;
use App\Http\Controllers\API\TechnicalSupportController;
use App\Http\Controllers\API\TermsAndPolicyController;
use App\Http\Controllers\API\VerifyController;
use Illuminate\Http\Request;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('access-tokens', [AccessTokensController::class, 'login'])
                ->middleware('guest:sanctum');

    Route::post('/register', [AuthController::class, 'register']);
    Route::delete('/access-tokens/{token?}', [AccessTokensController::class, 'destroy'])
                 ->middleware('auth:sanctum');

    Route::post('/profile/update', [AuthController::class, 'update'])
                ->middleware('auth:sanctum');

    Route::delete('/delete-account', [AccessTokensController::class, 'deleteAccount'])
                 ->middleware('auth:sanctum');

    Route::post('/logout', [AccessTokensController::class, 'logout'])
            ->middleware('auth:sanctum');



});




Route::apiResource('orders', OrdersController::class)
->middleware('auth:sanctum');
Route::apiResource('markets', MarketsController::class);
Route::apiResource('address', AddressesController::class);
Route::apiResource('termspolicy', TermsAndPolicyController::class);
Route::apiResource('technicalsupport', TechnicalSupportController::class);
Route::apiResource('contacts', ContactsController::class);
Route::apiResource('ratting', RattingController::class);
Route::apiResource('verify_code', VerifyController::class);



