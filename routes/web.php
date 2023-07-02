<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\VaccineTypeController;
use App\Http\Controllers\UserManage\UserManagerController;
use App\Models\UserManagement;

Route::group(['middleware' => 'RevalidateBackHistory'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/', function () {
        return view('admin.admin_login');
    });

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LogoutController::class, 'index'])->name('logout');
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware('guest');
    Route::get('/admin/register', [AdminController::class, 'AdminRegister'])->name('admin.register')->middleware('guest');
    Route::get('/admin/email', [AdminController::class, 'AdminEmail'])->name('admin.email')->middleware('guest');
    Route::get('/admin/reset/{token}', [AdminController::class, 'AdminReset'])->name('admin.reset')->middleware('guest');



    
    // Different dashboards

    // Admin group middleware
    Route::middleware(['auth','role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
        Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
        Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
        Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
        Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    });

    // Admin doctor middleware
    Route::middleware(['auth','role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', [DoctorController::class, 'DoctorDashboard'])->name('doctor.dashboard');
        Route::get('/doctor/logout', [DoctorController::class, 'DoctorLogout'])->name('doctor.logout');
        Route::get('/doctor/profile', [DoctorController::class, 'DoctorProfile'])->name('doctor.profile');
        Route::post('/doctor/profile/store', [DoctorController::class, 'DoctorProfileStore'])->name('doctor.profile.store');
        Route::get('/doctor/change/password', [DoctorController::class, 'DoctorChangePassword'])->name('doctor.change.password');
        Route::post('/doctor/update/password', [DoctorController::class, 'DoctorUpdatePassword'])->name('doctor.update.password');

    });


    //parent group middleware
    Route::middleware(['auth','role:parent'])->group(function () {
        Route::get('/parent/dashboard', [ParentController::class, 'ParentDashboard'])->name('parent.dashboard');
        Route::get('/parent/logout', [ParentController::class, 'ParentLogout'])->name('parent.logout');
        Route::get('/parent/profile', [ParentController::class, 'ParentProfile'])->name('parent.profile');
        Route::post('/parent/profile/store', [ParentController::class, 'ParentProfileStore'])->name('parent.profile.store');
        Route::get('/parent/change/password', [ParentController::class, 'ParentChangePassword'])->name('parent.change.password');
        Route::post('/parent/update/password', [ParentController::class, 'ParentUpdatePassword'])->name('parent.update.password');
    });

    //user group middleware
    Route::middleware(['auth','role:user'])->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
        Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
        Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
        Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
        Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
        Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    });



    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    });

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verificationVerify'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');
    


});


Route::middleware(['auth','role:admin'])->group(function () {
   
    // Vaccine types all routes
    Route::controller(VaccineTypeController::class)->group(function()
    {
        Route::get('/all/types', 'AllType')->name('all.type');
        Route::get('/add/types', 'AddType')->name('add.type');
        Route::post('/store/types', 'StoreType')->name('store.vaccineType');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.vaccineType');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });

    // User Management routes
    Route::controller(UserManagerController::class)->group(function()
    {
        Route::get('/all/users', 'UserAllType')->name('userall.type');
        Route::get('/add/user', 'UserAddType')->name('useradd.type');
        Route::post('/store/user', 'UserStoreType')->name('store.userType');
        Route::get('/edit/user/{id}', 'UserEditType')->name('useredit.type');
        Route::post('/update/user', 'UserUpdateType')->name('update.userType');
        Route::get('/delete/user/{id}', 'UserDeleteType')->name('delete.usertype');
        Route::post('/user/filter', 'UserFilterByRole')->name('filter.userType');

    });

});
