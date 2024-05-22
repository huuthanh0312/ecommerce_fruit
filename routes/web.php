<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SmtpSettingController;
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
            Route::get('/category/all', 'AllCategory' )->name('category.all');
    
            Route::get('/category/add', 'AddCategory' )->name('category.add');
    
            Route::post('/category/store', 'StoreCategory' )->name('category.store');
    
            Route::get('/category/edit/{id}', 'EditCategory' )->name('category.edit');
    
            Route::post('/category/update', 'UpdateCategory' )->name('category.update');
    
            Route::get('/category/delete/{id}', 'DeleteCategory' )->name('category.delete');
    
        });

       // Product Routes
        Route::controller(ProductController::class)->group(function (){
            //// Product CRUD
            Route::get('/product/all', 'AllProduct' )->name('product.all');
    
            Route::get('/product/add', 'AddProduct' )->name('product.add');
    
            Route::post('/product/store', 'StoreProduct' )->name('product.store');
    
            Route::get('/product/edit/{id}', 'EditProduct' )->name('product.edit');
    
            Route::post('/product/update', 'UpdateProduct' )->name('product.update');
    
            Route::get('/product/delete/{id}', 'DeleteProduct' )->name('product.delete');

            Route::post('/product/status', 'UpdateProductStatus' )->name('product.update.status');
    
        });
        Route::controller(OrderController::class)->group(function (){
            //// Order CRUD
            Route::get('/order/all', 'AllOrder' )->name('order.all');
    
            Route::get('/order/details/{code}', 'OrderDetailsStatus' )->name('order.get');
    
            Route::post('/order/details/status', 'UpdateOrderStatus' )->name('order.update.status');
    
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



        // SMTP Setting Routes
        Route::controller(SmtpSettingController::class)->group(function (){
            //// SMTP Setting
            Route::get('/smtp-setting', 'SmtpSetting' )->name('smtp.setting');

            Route::post('/smtp-setting/update', 'UpdateSmtpSetting' )->name('smtp.update');
        
        });

        // site-setting Routes
        Route::controller(SiteSettingController::class)->group(function (){
            
            Route::get('/site-setting/show', 'ShowSiteSetting' )->name('site.setting.show');
   
            Route::post('/site-setting/update', 'UpdateSiteSetting' )->name('site.setting.update');
                
        });                
    
}); // End Admin Group Function 


//frontend routes
Route::controller(FrontendController::class)->group(function (){
    Route::get('about', 'About')->name('about');

    Route::get('policy/{slug}', 'Policy')->name('policy');

    Route::get('contact', 'Contact')->name('contact');

    Route::post('contact/store', 'ContactStore')->name('contact.store');

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