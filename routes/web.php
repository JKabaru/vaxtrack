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
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\InfantController;
use App\Http\Controllers\VaccinationCompletionRatesController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\NotificationController;

// email
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

use App\Http\Controllers\UserManage\UserManagerController;
use App\Models\UserManagement;


// Email verification route
// Route::get('/email/verify/{id}', [VerificationController::class, 'verifyEmail1'])
//     ->middleware(['signed'])
//     ->name('verification.verifymine');





//Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'RevalidateBackHistory'], function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/', function () {
        return view('admin.admin_login');
    });


    Route::middleware(['guest'])->group(function () {
        // Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
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
       
    });





    



    
    // Different dashboards

    // Admin group middleware
    Route::middleware(['auth','role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
        Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
        Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
        Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
        Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
        Route::get('/send-verification-email/{user_id}', [AdminController::class, 'sendVerificationEmail'])->name('send.verification');

        Route::get('/send-reminder-email/{infant_id}/{vaccine_id}', [AdminController::class, 'sendVaccineReminderEmails'])->name('send.reminder');

        Route::get('/admin/notifications', [AdminController::class, 'ViewNotifications'])->name('adminnotifications.index');
        Route::get('/admin/markasred/{id}', [AdminController::class, 'MarkAsRed'])->name('adminmarkasred');

        Route::get('/admin/markAllred', [AdminController::class, 'markAllAsRed'])->name('adminmarkAllred');

    });

    //  doctor middleware
    Route::middleware(['auth','role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', [DoctorController::class, 'DoctorDashboard'])->name('doctor.dashboard');
        Route::get('/doctor/logout', [DoctorController::class, 'DoctorLogout'])->name('doctor.logout');
        Route::get('/doctor/profile', [DoctorController::class, 'DoctorProfile'])->name('doctor.profile');
        Route::post('/doctor/profile/store', [DoctorController::class, 'DoctorProfileStore'])->name('doctor.profile.store');
        Route::get('/doctor/change/password', [DoctorController::class, 'DoctorChangePassword'])->name('doctor.change.password');
        Route::post('/doctor/update/password', [DoctorController::class, 'DoctorUpdatePassword'])->name('doctor.update.password');
        Route::get('/doctor/notifications', [DoctorController::class, 'ViewNotifications'])->name('doctornotifications.index');       
        Route::get('/doctor/markasred/{id}', [DoctorController::class, 'MarkAsRed'])->name('doctormarkasred');

        Route::get('/doctor/markAllred', [DoctorController::class, 'markAllAsRed'])->name('doctormarkAllred');

    });


    //parent group middleware
    Route::middleware(['auth','role:parent'])->group(function () {
        Route::get('/parent/dashboard', [ParentController::class, 'ParentDashboard'])->name('parent.dashboard');
        Route::get('/parent/logout', [ParentController::class, 'ParentLogout'])->name('parent.logout');
        Route::get('/parent/profile', [ParentController::class, 'ParentProfile'])->name('parent.profile');
        Route::post('/parent/profile/store', [ParentController::class, 'ParentProfileStore'])->name('parent.profile.store');
        Route::get('/parent/change/password', [ParentController::class, 'ParentChangePassword'])->name('parent.change.password');
        Route::post('/parent/update/password', [ParentController::class, 'ParentUpdatePassword'])->name('parent.update.password');
        Route::get('/parent/notifications', [ParentController::class, 'ViewNotifications'])->name('parentnotifications.index');
        Route::get('/parent/markasred/{id}', [ParentController::class, 'MarkAsRed'])->name('parentmarkasred');
        Route::get('/parent/markAllred', [ParentController::class, 'markAllAsRed'])->name('parentmarkAllred');
        
    });

    //user group middleware
    Route::middleware(['auth','role:user'])->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
        Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
        Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
        Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
        Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
        Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
        Route::get('/user/notifications', [UserController::class, 'ViewNotifications'])->name('usernotifications.index');
        Route::get('/user/markasred/{id}', [UserController::class, 'MarkAsRed'])->name('usermarkasred');
        
        Route::get('/user/markAllred', [UserController::class, 'markAllAsRed'])->name('usermarkAllred');

    });



    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    });

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verificationVerify'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

        Route::get('/email/verify/{id}', [VerifyEmailController::class, 'verifyEmail1'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verifymine');  
    
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
                Route::get('/all/disabled-users', 'UserActivationType')->name('useractivation.type');
        
            });
        
            // Permission All Route
        
            Route::controller(RoleController::class)->group(function()
            {
                Route::get('/all/permission', 'AllPermission')->name('all.permission');
                Route::get('/add/permission', 'AddPermission')->name('add.permission');
                Route::post('/store/permission', 'StorePermission')->name('store.permission');
                Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
                Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
                Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
        
            });
        
            // Roles all routes
            Route::controller(RoleController::class)->group(function()
            {
                Route::get('/all/roles', 'AllRoles')->name('all.roles');
                Route::get('/add/roles', 'AddRoles')->name('add.roles');
                Route::post('/store/roles', 'StoreRoles')->name('store.roles');
                Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
                Route::post('/update/roles', 'Updateroles')->name('update.roles');
                Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role');
        
                Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
                Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
                Route::post('/all/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
                Route::get('/all/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
                
            });
        
             // Infants All Route
        
             Route::controller(InfantController::class)->group(function()
             {
                 Route::get('/all/infants', 'AllInfants')->name('all.infants');
                 Route::get('/add/infant', 'AddInfant')->name('add.infant');
                 Route::post('/store/infant', 'StoreInfant')->name('store.infant');
                 Route::get('/edit/infant/{id}', 'EditInfant')->name('edit.infant');
                 Route::post('/update/Infant', 'UpdateInfant')->name('update.infant');
                 Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
                 
                 Route::get('/all/infants/vaccines', 'getVaccineSchedule')->name('all.infants.vaccines');
                 Route::post('/admin/schedule/{infant}', 'schedule')->name('admin.schedule');
                 Route::get('/admin/infant-vaccinations', 'infantVaccinations')->name('admin.infantVaccinations');
                 Route::get('/edit/Infant-vaccinations/{id}', 'editInfantVaccinations')->name('edit.infantvaccinations');
                 Route::post('/update/Infant-vaccinations}', 'updateInfantVaccine')->name('update.infantvaccinations');

                //  bulk  setting reminder 
                Route::post('/update/infantvaccinations/bulk', 'bulkUpdateInfantVaccinations')->name('bulk.update.infantvaccinations');

                
                 
                 Route::post('/infant/filter', 'InfantFilterByAgeallinfants')->name('filter.infantType');
        
                 Route::post('/vaccines/filter', 'FilterInfantVaccinations')->name('filter.infants.vaccinations');

                 Route::get('/vaccines/country/filter', 'FilterInfantVaccinations')->name('filter.infants.vaccinations.country');
                
             });
        
        
             Route::controller(VaccinationCompletionRatesController::class)->group(function()
             {
                Route::get('/vaccination-completion-rates', 'index')->name('vaccination-completion-rates');
                Route::get('/age-based-analysis', 'ageBasedAnalysis')->name('age-based-analysis');
                Route::get('/completion-rate-by-age', 'completionRateByAge')->name('completion-rate-by-age');
                Route::get('/parent-doctor-analysis', 'parentAndDoctorAnalysis')->name('parent-doctor-analysis');
        
        
             });
        

               // notifications
               //Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
             
        
        
        
        });


        // // notifications
         ///Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');


});



