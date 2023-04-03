<?php

use App\Events\ChatEvent;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\MarketsWebController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\DashboadrController;
use App\Http\Controllers\Dashboard\ComplaintsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\TermAndPolicyController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('maps',function(){
    return view('admin.maps');
});




Route::get('/login',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/login',[LoginController::class,'adminLogin'])->name('admin.login');
Route::get('/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/register',[RegisterController::class,'createAdmin'])->name('admin.register');
Route::post('logout', [LoginController::class,'logout'])->name('logout');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



Route::prefix(LaravelLocalization::setLocale())->group(function() {


    Route::middleware(['auth:admin'])->group(function () {


        Route::get('/', [DashboadrController::class, 'index'])->name('admin.home');


            // Start Admin Controller [Homepage]
            Route::get('/users', [UserController::class, 'users'])->name('admin.users');


            Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admins.destroy');






        Route::get('terms',[TermAndPolicyController::class,'index'])->name('terms.index');
        Route::get('terms/create',[TermAndPolicyController::class,'create'])->name('terms.create');
        Route::post('terms',[TermAndPolicyController::class,'store'])->name('terms.store');
        Route::delete('terms/{id}',[TermAndPolicyController::class,'destroy'])->name('terms.destroy');

        Route::get('terms/{id}',[TermAndPolicyController::class,'edite'])->name('terms.edite');
        Route::put('terms/{id}',[TermAndPolicyController::class,'update'])->name('terms.update');





            Route::get('/complaint', [ComplaintsController::class, 'index'])->name('complaint.index');
            Route::delete('/complaint/{id}', [ComplaintsController::class, 'destroy'])->name('complaint.destroy');







            Route::get('market',[MarketsWebController::class,'index'])->name('market.testindex');
            Route::delete('market/{id}', [MarketsWebController::class, 'destroy'])->name('market.destroy');
            Route::get('market/create',[MarketsWebController::class,'create'])->name('market.create');
            Route::post('market/store',[MarketsWebController::class,'store'])->name('market.store');


            Route::get('market/{id}/edite',[MarketsWebController::class,'edite'])->name('market.edite');
            Route::put('market/{id}',[MarketsWebController::class,'update'])->name('market.testupdate');


        // Route::get('/search', [UserController::class,'searchByDropdown']);


            // End Admin Controller [Homepage]


            Route::group([
                'prefix' => '/user',
                'as' => 'user.',
            ], function () {

                // Start user Admin Controller


                // End user Admin Controller
            });
            Route::group([
                'prefix' => '/orders',
                'as' => 'orders',
            ], function () {

                // Start order Admin Controller
                Route::get('/', [OrderController::class, 'index']);
                Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('.delete');
                Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('.edit');
                Route::put('/{id}', [OrderController::class, 'update'])->name('.update');


                // End order Admin Controller


            });

            // Start Setting Routes [Admin]
            Route::group([
                'prefix' => '/profile',
                'as' => 'admin.profile.'
            ], function () {
                Route::get('/',[ProfileController::class,'index'])->name('index');
                Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('edit');
                Route::put('/contact/{id}', [ProfileController::class, 'update_contact'])->name('contact.update');

                Route::put('/{id}', [ProfileController::class, 'update'])->name('update');


            });
            // End Setting Routes [Admin]


        });

 });

