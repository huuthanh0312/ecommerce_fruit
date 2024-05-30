<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleInPermissionController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SmtpSettingController;
use App\Http\Controllers\BackendRoleInPermissionController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\FrOrderController;
use App\Http\Controllers\Frontend\FrProductController;
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
            Route::get('/category/all', 'AllCategory' )->name('category.all')->middleware('permission:category.menu');
    
            Route::get('/category/add', 'AddCategory' )->name('category.add')->middleware('permission:category.action');
    
            Route::post('/category/store', 'StoreCategory' )->name('category.store')->middleware('permission:category.action');
    
            Route::get('/category/edit/{id}', 'EditCategory' )->name('category.edit')->middleware('permission:category.action');
    
            Route::post('/category/update', 'UpdateCategory' )->name('category.update')->middleware('permission:category.action');
    
            Route::get('/category/delete/{id}', 'DeleteCategory' )->name('category.delete')->middleware('permission:category.action');
    
        });

       // Product Routes
        Route::controller(ProductController::class)->group(function (){
            //// Product CRUD
            Route::get('/product/all', 'AllProduct' )->name('product.all')->middleware('permission:product.menu');
    
            Route::get('/product/add', 'AddProduct' )->name('product.add')->middleware('permission:product.action');
    
            Route::post('/product/store', 'StoreProduct' )->name('product.store')->middleware('permission:product.action');
    
            Route::get('/product/edit/{id}', 'EditProduct' )->name('product.edit')->middleware('permission:product.action');
    
            Route::post('/product/update', 'UpdateProduct' )->name('product.update')->middleware('permission:product.action');
    
            Route::get('/product/delete/{id}', 'DeleteProduct' )->name('product.delete')->middleware('permission:product.action');

            Route::post('/product/status', 'UpdateProductStatus' )->name('product.update.status')->middleware('permission:product.action');
    
        });
        Route::controller(OrderController::class)->group(function (){
            //// Order CRUD
            Route::get('/order/all', 'AllOrder' )->name('order.all')->middleware('permission:order.menu');
    
            Route::get('/order/details/{code}', 'OrderDetailsStatus' )->name('order.get')->middleware('permission:order.action');
    
            Route::post('/order/details/status', 'UpdateOrderStatus' )->name('order.update.status')->middleware('permission:order.action');

            // Route::get('tracking' , 'Tracking')->name('tracking');

            // Route::post('order/tracking' , 'OrderTracking')->name('tracking.search');
    
        });
        // Customer Routes
        Route::controller(CustomerController::class)->group(function (){
            //// Custommer CRUD
            Route::get('/customer/all', 'AllCustomer' )->name('customer.all')->middleware('permission:customer.menu');

            Route::get('/customer/edit/{id}', 'EditCustomer' )->name('customer.edit')->middleware('permission:customer.action');

            Route::post('/customer/update', 'UpdateCustomer' )->name('customer.update')->middleware('permission:customer.action');

            Route::post('/customer/status', 'UpdateCustomerStatus' )->name('customer.update.status')->middleware('permission:customer.action');

            

        });
        // Post Routes
        Route::controller(PostController::class)->group(function (){
            //// Post CRUD
            Route::get('/post/all', 'AllPost' )->name('post.all')->middleware('permission:post.menu');
    
            Route::get('/post/add', 'AddPost' )->name('post.add')->middleware('permission:post.action');
    
            Route::post('/post/store', 'StorePost' )->name('post.store')->middleware('permission:post.action');
    
            Route::get('/post/edit/{id}', 'EditPost' )->name('post.edit')->middleware('permission:post.action');
    
            Route::post('/post/update', 'UpdatePost' )->name('post.update')->middleware('permission:post.action');
    
            Route::get('/post/delete/{id}', 'DeletePost' )->name('post.delete')->middleware('permission:post.action');
    
        });
        
        // contact Routes
        Route::controller(ContactController::class)->group(function (){
            //// Contact CRUD
            Route::get('/contact/all', 'AllContact' )->name('contact.all')->middleware('permission:contact.menu');
    
            Route::get('/contact/edit/{id}', 'EditContact' )->name('contact.edit')->middleware('permission:contact.action');
    
            Route::post('/contact/update', 'UpdateContact' )->name('contact.update')->middleware('permission:contact.action');
    
            Route::get('/contact/delete/{id}', 'DeleteContact' )->name('contact.delete')->middleware('permission:contact.action');
    
        });



        // SMTP Setting Routes
        Route::controller(SmtpSettingController::class)->group(function (){
            //// SMTP Setting
            Route::get('/smtp-setting', 'SmtpSetting' )->name('smtp.setting')->middleware('permission:smtp.setting.menu');

            Route::post('/smtp-setting/update', 'UpdateSmtpSetting' )->name('smtp.update')->middleware('permission:smtp.setting.menu');
        
        });

        // site-setting Routes
        Route::controller(SiteSettingController::class)->group(function (){
            
            Route::get('/site-setting/show', 'ShowSiteSetting' )->name('site.setting.show')->middleware('permission:site.setting.menu');
   
            Route::post('/site-setting/update', 'UpdateSiteSetting' )->name('site.setting.update')->middleware('permission:site.setting.menu');
                
        });   

        // Role In Permission Routes
        Route::controller(RoleInPermissionController::class)->group(function (){
            // Permission CRUD
            Route::get('/permission/all', 'AllPermission' )->name('permission.all')->middleware('permission:role.permission.menu');
    
            Route::post('/permission/store', 'StorePermission' )->name('permission.store')->middleware('permission:role.permission.action');
            
            Route::get('/permission/edit/{id}', 'EditPermission' )->name('permission.edit')->middleware('permission:role.permission.action');

            Route::post('/permission/update', 'UpdatePermission' )->name('permission.update')->middleware('permission:role.permission.action');
            
            Route::get('/permission/delete/{id}', 'DeletePermission' )->name('permission.delete')->middleware('permission:role.permission.action');

            // Role CRUD

            Route::get('/role/all', 'AllRole' )->name('role.all')->middleware('permission:role.permission.menu');
    
            Route::post('/role/store', 'StoreRole' )->name('role.store')->middleware('permission:role.permission.action');
            
            Route::get('/role/edit/{id}', 'EditRole' )->name('role.edit')->middleware('permission:role.permission.action');

            Route::post('/role/update', 'UpdateRole' )->name('role.update')->middleware('permission:role.permission.action');
            
            Route::get('/role/delete/{id}', 'DeleteRole' )->name('role.delete')->middleware('permission:role.permission.action');

            //Role In permission
            Route::get('/role-permission/all', 'AllRoleInPermission' )->name('role.permission.all')->middleware('permission:role.permission.menu');
    
            Route::post('/role-permission/store', 'StoreRoleInPermission' )->name('role.permission.store')->middleware('permission:role.permission.action');

            Route::get('/role-permission/edit/{id}', 'EditRoleInPermission' )->name('role.permission.edit')->middleware('permission:role.permission.action');
    
            Route::post('/role-permission/update/{id}', 'UpdateRoleInPermission' )->name('role.permission.update')->middleware('permission:role.permission.action');

            Route::get('/role-permission/delete/{id}', 'DeleteRoleInPermission' )->name('role.permission.delete')->middleware('permission:role.permission.action');

        }); 

        //Setup Admin User Routes
        Route::controller(AdminController::class)->group(function (){
            // Admin User CRUD
            Route::get('/admin-setup-user/all', 'AllAdminUser' )->name('admin.user.all')->middleware('permission:admin.user.menu');

            Route::post('/admin-setup-user/store', 'StoreAdminUser' )->name('admin.user.store')->middleware('permission:admin.user.action');

            Route::get('/admin-setup-user/edit/{id}', 'EditAdminUser' )->name('admin.user.edit')->middleware('permission:admin.user.action');

            Route::post('/admin-setup-user/update', 'UpdateAdminUser' )->name('admin.user.update')->middleware('permission:admin.user.action');

            Route::get('/admin-setup-user/delete/{id}', 'DeleteAdminUser' )->name('admin.user.delete')->middleware('permission:admin.user.action');
        }); 
}); // End Admin Group Function 


//frontend routes
Route::controller(FrontendController::class)->group(function (){
    Route::get('about', 'About')->name('about');

    Route::get('policy/{slug}', 'Policy')->name('policy');

    Route::get('contact', 'Contact')->name('contact');

    Route::post('contact/store', 'ContactStore')->name('contact.store');

    Route::get('search', 'Search')->name('search');


});
 
Route::controller(FrProductController::class)->group(function (){
    // get Product By Category
    Route::get('/category/{slug}', 'ProductByCategory')->name('category.product');
    // get Product alls
    Route::get('/products', 'AllProduct')->name('products');
    // get product details
    Route::get('/products/{slug}', 'ProductDetails')->name('product.details');

    // Cart Add get Javascript
    Route::post('/cart/add-js', 'AddCartForJS')->name('cart.add.js');

    Route::post('/cart/update-js', 'UpdateCartForJS')->name('cart.update.js');

    Route::post('/cart/delete-js', 'DeleteCartForJS')->name('cart.delete.js');
    // Cart Add by Product Details
    Route::post('/cart/store', 'StoreCart')->name('cart.store');
    //list cart product
    Route::get('cart', 'ListCart')->name('cart');


});


/// Auth customers

/// User Profile Auth
Route::middleware('auth')->group(function () {
    Route::controller(FrOrderController::class)->group(function (){
        Route::get('/checkout', 'Checkout')->name('checkout');

        // Check out 
        Route::post('/checkout-store', 'CheckoutStore' )->name('checkout.store');

        Route::match(['get', 'post'],'/stripe_pay', [FrOrderController::class, 'stripe_pay'])->name('stripe_pay');

        // Tracking Order
        Route::get('/order', 'ListOrder')->name('order');
        // Tracking Order
        Route::get('/order-details/{code}', 'OrderDetails')->name('order.details');


    });
});