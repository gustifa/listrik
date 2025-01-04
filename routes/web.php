<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\CartController;

use App\Http\Controllers\Backend\CouponController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'role:user', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/user/profile',[UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update',[UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::post('/user/password/update',[UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/user/logout',[UserController::class, 'UserLogout'])->name('user.logout');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(WishListController::class)->group(function(){
        Route::get('/user/wishlist','AllWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-course','GetWishlistCourse');
        Route::get('/wishlist-remove/{id}','RemoveWishlist');
    });

    

});

require __DIR__.'/auth.php';



// Awal Admin Group Middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'adminPassword'])->name('admin.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');


    /* Instructor Active */
    Route::controller(AdminController::class)->group(function(){
        Route::get('/instructor/all', 'AllInstructor')->name('all.instructor');
        Route::post('/update/user/status', 'UpdateUserStatus')->name('update.user.status');
        Route::get('/instructor/add', 'AddInstructor')->name('add.instructor');
    });

    //Route Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/all', 'AllCategory')->name('all.category');
        Route::get('/category/add', 'AddCategory')->name('add.category');
        Route::post('/category/store', 'StoreCategory')->name('store.category');
        Route::get('/category/edit/{id}', 'EditCategory')->name('edit.category');
        Route::post('/category/update', 'UpdateCategory')->name('update.category');
        Route::get('/category/delete/{id}', 'DeleteCategory')->name('delete.category');
    });

    // Sub Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/subcategory/all', 'AllSubCategory')->name('all.subcategory');
        Route::get('/subcategory/add', 'AddSubCategory')->name('add.subcategory');
        Route::post('/subcategory/store', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/subcategory/edit/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/subcategory/update', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/subcategory/delete/{id}', 'DeleteSubCategory')->name('delete.subcategory');

    });

    // Admin Coruses All Route 
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/all/course','AdminAllCourse')->name('admin.all.course');
    Route::post('/update/course/stauts','UpdateCourseStatus')->name('update.course.stauts');
    Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');
   
});

    // Admin Coupon All Route 
    Route::controller(CouponController::class)->group(function(){
        Route::get('/admin/all/coupon','AdminAllCoupon')->name('admin.all.coupon');
        Route::get('/admin/add/coupon','AdminAddCoupon')->name('admin.add.coupon');
        Route::post('/admin/store/coupon','AdminStoreCoupon')->name('admin.store.coupon');
        Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('admin.edit.coupon');
        Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('admin.update.coupon');
        Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('admin.delete.coupon'); 

    });

}); ///Akhir Admin Group Middleware

// Awal Instructor Group Middleware
Route::middleware(['auth','role:instructor'])->group(function(){
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');

    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorPassword'])->name('instructor.password');
    Route::post('/instructor/update/password', [InstructorController::class, 'InstructorUpdatePassword'])->name('instructor.update.password');

    // Course Group Middleware
    Route::controller(CourseController::class)->group(function(){
        Route::get('/course/all', 'AllCourse')->name('all.course');
        Route::get('/course/add', 'AddCourse')->name('add.course');

        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
        Route::post('/save-lecture','SaveLecture')->name('save-lecture');
        Route::post('/course/store', 'StoreCourse')->name('store.course');
        Route::get('/course/edit/{id}', 'EditCourse')->name('edit.course');
        Route::post('/course/update', 'UpdateCourse')->name('update.course');
        Route::get('/course/delete/{id}', 'DeleteCourse')->name('delete.course');
        Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal','UpdateCourseGoal')->name('update.course.goal');

    });

    // Course Section and Lecture All Route
    Route::controller(CourseController::class)->group(function(){
        Route::get('/course/lecture/add/{id}','AddCourseLecture')->name('add.course.lecture');
        Route::post('/course/section/add','AddCourseSection')->name('add.course.section');

        Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
        Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');
        Route::post('/delete/section/{id}','DeleteSection')->name('delete.section');
    });


}); ///Akhir Instructor Group Middleware



// User Group Middleware
Route::middleware(['auth','role:user'])->group(function(){
        // User Wishlist All Route

});

// Route Accessable for ALl
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');
Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/become/instructor/register', [AdminController::class, 'BecomeInstructorRegister'])->name('become.instructor.register');

Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails'])->name('course.details');
Route::get('/category/{id}/{slug}', [IndexController::class, 'CategoryCourse'])->name('category.course');
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'SubCategoryCourse']);
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');

Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'AddToWishList']);

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::post('/buy/data/store/{id}', [CartController::class, 'AddToCart']);

Route::get('/cart/data/', [CartController::class, 'CartData']);


// Get Data from Minicart 
Route::get('/course/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);




Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::post('/inscoupon-apply', [CartController::class, 'InsCouponApply']);


Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Cart All Route 
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-remove/{rowId}','CartRemove');
    
});

/// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::post('/payment', [CartController::class, 'Payment'])->name('payment');
Route::post('/stripe_order', [CartController::class, 'StripeOrder'])->name('stripe_order');



// Route End Accessable for ALl





