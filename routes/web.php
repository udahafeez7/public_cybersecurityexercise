<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LearningController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\UserLearningController;

// Route for the home page
Route::get('/', [UserController::class, 'Index'])->name('index');


Route::get('/dashboard', function () {
    return view('frontend.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [UserController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/change/password', [UserController::class, 'ChangePassword'])->name('change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

    // Add Profile routes here
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit Profile Route
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // Update Profile Route

});

require __DIR__ . '/auth.php';

// Admin routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

//admin/LearningController
Route::middleware('admin')->group(function () {
    Route::controller(LearningController::class)->group(function () {
        Route::get('/all/pretasks', 'AllPretasks')->name('all.pretasks');
        Route::get('/add/pretasks', 'AddPretasks')->name('add.pretasks');
        Route::post('/store/pretasks', 'StorePretasks')->name('pretasks.store');
        Route::get('/edit/pretasks/{id}', 'EditPretasks')->name('edit.pretasks');
        Route::post('/update/pretasks', 'UpdatePretasks')->name('pretasks.update');
        Route::get('/delete/pretasks{id}', 'DeletePretasks')->name('delete.pretasks');
    });

    Route::controller(LearningController::class)->group(function () {
        Route::get('/all/material', 'AllMaterial')->name('all.material');
        Route::get('/add/material', 'AddMaterial')->name('add.material');
        Route::post('/store/material', 'StoreMaterial')->name('material.store');
        Route::get('/edit/material/{id}', 'EditMaterial')->name('edit.material');
        Route::post('/update/material', 'UpdateMaterial')->name('material.update');
        Route::get('/delete/material/{id}', 'DeleteMaterial')->name('delete.material');
    });

    Route::controller(LearningController::class)->group(function () {
        Route::get('/all/gallery', 'AllGallery')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/store/gallery', 'StoreGallery')->name('gallery.store');
        Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
        Route::post('/update/gallery', 'UpdateGallery')->name('gallery.update');
        Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('permission.store');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('permission.update');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    });
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('roles.store');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('roles.update');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
    });
    Route::controller(RoleController::class)->group(function () {
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');

        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');

        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delect/roles/{id}', 'AdminDelectRoles')->name('admin.delect.roles');
    });
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::post('/admin/login_submit', [AdminController::class, 'AdminLoginSubmit'])->name('admin.login_submit');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('admin.forget_password');

Route::post('/admin/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('admin.password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminController::class, 'AdminResetPassword']);
Route::post('/admin/reset_password_submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('admin.reset_password_submit');



/// ALL ROUTE FOR CLIENT

Route::middleware('client')->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'ClientDashboard'])->name('client.dashboard');
    Route::get('/client/profile', [ClientController::class, 'ClientProfile'])->name('client.profile');
    Route::post('/client/profile/store', [ClientController::class, 'ClientProfileStore'])->name('client.profile.store');
    Route::get('/client/change/password', [ClientController::class, 'ClientChangePassword'])->name('client.change.password');
    Route::post('/client/password/update', [ClientController::class, 'ClientPasswordUpdate'])->name('client.password.update');
});

Route::get('/client/login', [ClientController::class, 'ClientLogin'])->name('client.login');
Route::get('/client/register', [ClientController::class, 'ClientRegister'])->name('client.register');
Route::post('/client/register/submit', [ClientController::class, 'ClientRegisterSubmit'])->name('client.register.submit');
Route::post('/client/login_submit', [ClientController::class, 'ClientLoginSubmit'])->name('client.login_submit');
Route::get('/client/logout', [ClientController::class, 'ClientLogout'])->name('client.logout');

//all category

Route::middleware('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });
});

// Route to show all segmented materials in the dashboard
Route::get('/user/materials', [UserLearningController::class, 'AllUserMaterials'])->name('user.materials');

Route::prefix('tasks')->group(function () {
    Route::get('/fuzzy-ahp', [UserLearningController::class, 'FuzzyAHP'])->name('tasks.fuzzy-ahp');
    Route::get('/domain-mapping', [UserLearningController::class, 'DomainMapping'])->name('tasks.domain-mapping');
    Route::get('/fuzzy-logic', [UserLearningController::class, 'FuzzyLogic'])->name('tasks.fuzzy-logic');
    Route::get('/cost_benefit_analysis', [UserLearningController::class, 'CostBenefitAnalysis'])->name('tasks.cost_benefit_analysis');

    // New Multimedia Repository Route
    Route::get('/multimedia-repository', [UserLearningController::class, 'Multimedia1'])->name('tasks.multimedia-repository');
});