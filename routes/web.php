<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';

/// User Profile Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'ProfileStore'])->name('profile.store');
    //user logout
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    //change and update pass
    Route::post('password/change/store', [UserController::class, 'UserPasswordUpdate'])->name('password.change.store');
});


// Admin routes login
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::post('/admin/store/', [AuthenticatedSessionController::class, 'AdminStore'])->name('admin.store');


//Admin group Middleware Routes
Route::middleware(['auth', 'roles:admin'])->group(function (){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

}); // End Admin Group Middleware


// Backend Admin setup
Route::middleware(['auth', 'roles:admin'])->group(function (){
        // Category Routes
        Route::controller(CategoryController::class)->group(function (){
            //// Category CRUD
            Route::get('/category/all', 'AllCategory' )->name('category.all');
    
            Route::get('/category/add', 'AddCategory' )->name('category.add');
    
            Route::post('/category/store', 'StoreCategory' )->name('category.store');
    
            Route::get('/category/edit/{id}', 'EditCategory' )->name('category.edit');
    
            Route::post('/category/update', 'UpdateCategory' )->name('category.update');
    
            Route::get('/category/delete/{id}', 'DeleteCategory' )->name('category.delete');
    
        });


        
        // Customer Routes
        Route::controller(CustomerController::class)->group(function (){
            //// Custommer CRUD
            Route::get('/customer/all', 'AllCustomer' )->name('customer.all');

            Route::get('/customer/edit/{id}', 'EditCustomer' )->name('customer.edit');

            Route::post('/customer/update', 'UpdateCustomer' )->name('customer.update');

            Route::post('/customer/status', 'UpdateCustomerStatus' )->name('customer.update.status');

            

        });
        // Post Routes
        Route::controller(PostController::class)->group(function (){
            //// Post CRUD
            Route::get('/post/all', 'AllPost' )->name('post.all');
    
            Route::get('/post/add', 'AddPost' )->name('post.add');
    
            Route::post('/post/store', 'StorePost' )->name('post.store');
    
            Route::get('/post/edit/{id}', 'EditPost' )->name('post.edit');
    
            Route::post('/post/update', 'UpdatePost' )->name('post.update');
    
            Route::get('/post/delete/{id}', 'DeletePost' )->name('post.delete');
    
        });
        
        // contact Routes
        Route::controller(ContactController::class)->group(function (){
            //// Contact CRUD
            Route::get('/contact/all', 'AllContact' )->name('contact.all');
    
            Route::get('/contact/edit/{id}', 'EditContact' )->name('contact.edit');
    
            Route::post('/contact/update', 'UpdateContact' )->name('contact.update');
    
            Route::get('/contact/delete/{id}', 'DeleteContact' )->name('contact.delete');
    
        });

                
        
    
}); // End Admin Group Function 