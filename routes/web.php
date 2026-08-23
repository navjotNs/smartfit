<?php
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

Route::get('/admin/login-url', [App\Http\Controllers\Auth\AuthController::class, 'getLogin'])->name('admin');

Route::post('/admin/login', [App\Http\Controllers\Auth\AuthController::class, 'postLogin']);
Route::get('/admin/logout', [App\Http\Controllers\Auth\AuthController::class, 'adminLogout'])->name('admin-logout');
Route::group(['middleware' => 'auth', 'after' => 'no-cache'], function () {

    Route::prefix('admin')->group(function () {

         // Route::get('dashboard', ['as' => 'dashboard', 'uses' => "App\Http\Controllers\DashboardController::class, 'index'"]);
         Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        // Customer route start
            Route::resource('customer','App\Http\Controllers\CustomerController', [
                'names' => [
                    // 'index'     => 'customer.index',
                    'create'    => 'customer.create',
                    'store'     => 'customer.store',
                    'edit'      => 'customer.edit',
                    'update'    => 'customer.update',
                ],
                'except' => ['show','destroy']
            ]);
            Route::get('customer', 'App\Http\Controllers\CustomerController@index')->name('customer');
            Route::any('customer/paginate/{page?}', ['as' => 'customer.paginate',
                'uses' => 'App\Http\Controllers\CustomerController@customerPaginate']);
            Route::any('customer/paginate-data-entry/{page?}', ['as' => 'customer.paginate-data-entry',
                'uses' => 'App\Http\Controllers\CustomerController@customerPaginate_data_entry']);
            Route::any('customer/action', ['as' => 'customer.action',
                'uses' => 'App\Http\Controllers\CustomerController@customerAction']);
            Route::any('admin-users', 'App\Http\Controllers\CustomerController@admin_users')->name('admin_users');
            Route::any('customer/toggle/{id?}', ['as' => 'customer.toggle',
                'uses' => 'App\Http\Controllers\CustomerController@customerToggle']);
            Route::any('customer/drop/{id?}', ['as' => 'customer.drop',
                'uses' => 'App\Http\Controllers\CustomerController@drop']);
            Route::any('customer/data-entry', 'App\Http\Controllers\CustomerController@customerdataentry')->name('customer.data-entry');
            Route::any('customer/action-data-entry', ['as' => 'customer-data-entry.action',
                'uses' => 'App\Http\Controllers\CustomerController@customerAction_data_entry']);
            Route::any('customer/export-users', 'App\Http\Controllers\CustomerController@export_users')->name('customer.export-users');
            Route::any('employee-attendance-list/{id}', 'App\Http\Controllers\CustomerController@employee_attendance_list')->name('employee-attendance-list');
            // Customer route end   
            
            Route::any('allotment', 'App\Http\Controllers\CustomerController@allotment')->name('allotment');
            Route::any('attendance/{id}', 'App\Http\Controllers\CustomerController@attendance')->name('attendance');
            Route::any('day-details/{date}/{id}', 'App\Http\Controllers\CustomerController@day_details')->name('day-details');
            
            Route::any('worker-reports', 'App\Http\Controllers\CustomerController@worker_reports')->name('worker-reports');
            
            Route::any('worker/paginate/{page?}', ['as' => 'worker.paginate',
                'uses' => 'App\Http\Controllers\CustomerController@workerPaginate']);
            Route::any('worker/action', ['as' => 'worker.action',
                'uses' => 'App\Http\Controllers\CustomerController@workerAction']);   

            // Change Password Routes
            Route::any('myaccount', ['as' => 'setting.manage-account',
                'uses' => 'App\Http\Controllers\SettingController@myAccount']);
            // Change Password Routes

            // Login Logs route start
            Route::resource('login-logs','App\Http\Controllers\LoginLogController', [
                'names' => [
                    'index'     => 'login-logs.index',
                    'create'    => 'login-logs.create',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('login-logs/paginate/{page?}', ['as' => 'login-logs.paginate',
                'uses' => 'App\Http\Controllers\LoginLogController@login_logsPaginate']);
            Route::any('login-logs/action', ['as' => 'login-logs.action',
                'uses' => 'App\Http\Controllers\LoginLogController@login_logsAction']);
            // Login Logs route end

            Route::get('getState', 'App\Http\Controllers\CustomerController@getState')->name('getState');
            Route::get('getCity', 'App\Http\Controllers\CustomerController@getCity')->name('getCity');
            
            
            Route::any('content', 'App\Http\Controllers\CustomerController@content_view')->name('content-view');
            Route::any('update-content', 'App\Http\Controllers\CustomerController@update_content')->name('update-content');

            // Ctegory Master route start
            Route::resource('category', 'App\Http\Controllers\CategoryController', [
                'names' => [
                    'index'     => 'category.index',
                    'create'    => 'category.create',
                    'store'     => 'category.store',
                    'edit'      => 'category.edit',
                    'update'    => 'category.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('category/paginate/{page?}', ['as' => 'category.paginate',
                'uses' => 'App\Http\Controllers\CategoryController@Paginate']);
            Route::any('category/action', ['as' => 'category.action',
                'uses' => 'App\Http\Controllers\CategoryController@Action']);
            Route::any('category/toggle/{id?}', ['as' => 'category.toggle',
                'uses' => 'App\Http\Controllers\CategoryController@Toggle']);
            Route::any('category/drop/{id?}', ['as' => 'category.drop',
                'uses' => 'App\Http\Controllers\CategoryController@drop']);
            // Category Master route end

            // projects Master route start
            Route::resource('projects', 'App\Http\Controllers\ProjectController', [
                'names' => [
                    'index'     => 'projects.index',
                    'create'    => 'projects.create',
                    'store'     => 'projects.store',
                    'edit'      => 'projects.edit',
                    'update'    => 'projects.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('projects/paginate/{page?}', ['as' => 'projects.paginate',
                'uses' => 'App\Http\Controllers\ProjectController@Paginate']);
            Route::any('projects/action', ['as' => 'projects.action',
                'uses' => 'App\Http\Controllers\ProjectController@Action']);
            Route::any('projects/toggle/{id?}', ['as' => 'projects.toggle',
                'uses' => 'App\Http\Controllers\ProjectController@Toggle']);
            Route::any('projects/drop/{id?}', ['as' => 'projects.drop',
                'uses' => 'App\Http\Controllers\ProjectController@drop']);
            // Projects Master route end

            // Article Master route start
            Route::resource('article', 'App\Http\Controllers\ArticleController', [
                'names' => [
                    'index'     => 'article.index',
                    'create'    => 'article.create',
                    'store'     => 'article.store',
                    'edit'      => 'article.edit',
                    'update'    => 'article.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('article/paginate/{page?}', ['as' => 'article.paginate',
                'uses' => 'App\Http\Controllers\ArticleController@Paginate']);
            Route::any('article/action', ['as' => 'article.action',
                'uses' => 'App\Http\Controllers\ArticleController@Action']);
            Route::any('article/toggle/{id?}', ['as' => 'article.toggle',
                'uses' => 'App\Http\Controllers\ArticleController@Toggle']);
            Route::any('article/drop/{id?}', ['as' => 'article.drop',
                'uses' => 'App\Http\Controllers\ArticleController@drop']);
            // Article Master route end

            // Sliders Master route start
            Route::resource('sliders', 'App\Http\Controllers\SliderController', [
                'names' => [
                    'index'     => 'sliders.index',
                    'create'    => 'sliders.create',
                    'store'     => 'sliders.store',
                    'edit'      => 'sliders.edit',
                    'update'    => 'sliders.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('sliders/paginate/{page?}', ['as' => 'sliders.paginate',
                'uses' => 'App\Http\Controllers\SliderController@Paginate']);
            Route::any('sliders/action', ['as' => 'sliders.action',
                'uses' => 'App\Http\Controllers\SliderController@Action']);
            Route::any('sliders/toggle/{id?}', ['as' => 'sliders.toggle',
                'uses' => 'App\Http\Controllers\SliderController@Toggle']);
            Route::any('sliders/drop/{id?}', ['as' => 'sliders.drop',
                'uses' => 'App\Http\Controllers\SliderController@drop']);
            // Sliders Master route end


            // Gallery Master route start
            Route::resource('gallery', 'App\Http\Controllers\GalleryController', [
                'names' => [
                    'index'     => 'gallery.index',
                    'create'    => 'gallery.create',
                    'store'     => 'gallery.store',
                    'edit'      => 'gallery.edit',
                    'update'    => 'gallery.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('gallery/paginate/{page?}', ['as' => 'gallery.paginate',
                'uses' => 'App\Http\Controllers\GalleryController@Paginate']);
            Route::any('gallery/action', ['as' => 'gallery.action',
                'uses' => 'App\Http\Controllers\GalleryController@Action']);
            Route::any('gallery/toggle/{id?}', ['as' => 'gallery.toggle',
                'uses' => 'App\Http\Controllers\GalleryController@Toggle']);
            Route::any('gallery/drop/{id?}', ['as' => 'gallery.drop',
                'uses' => 'App\Http\Controllers\GalleryController@drop']);
            // Gallery Master route end

            // reviews Master route start
            Route::resource('reviews', 'App\Http\Controllers\ReviewController', [
                'names' => [
                    'index'     => 'reviews.index',
                    'create'    => 'reviews.create',
                    'store'     => 'reviews.store',
                    'edit'      => 'reviews.edit',
                    'update'    => 'reviews.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('reviews/paginate/{page?}', ['as' => 'reviews.paginate',
                'uses' => 'App\Http\Controllers\ReviewController@Paginate']);
            Route::any('reviews/action', ['as' => 'reviews.action',
                'uses' => 'App\Http\Controllers\ReviewController@Action']);
            Route::any('reviews/toggle/{id?}', ['as' => 'reviews.toggle',
                'uses' => 'App\Http\Controllers\ReviewController@Toggle']);
            Route::any('reviews/drop/{id?}', ['as' => 'reviews.drop',
                'uses' => 'App\Http\Controllers\ReviewController@drop']);
            // reviews Master route end
            
            // contact Master route start
            Route::resource('contact', 'App\Http\Controllers\ContactController', [
                'names' => [
                    'index'     => 'contact.index',
                    'create'    => 'contact.create',
                    'store'     => 'contact.store',
                    'edit'      => 'contact.edit',
                    'update'    => 'contact.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('contact/paginate/{page?}', ['as' => 'contact.paginate',
                'uses' => 'App\Http\Controllers\ContactController@Paginate']);
            Route::any('contact/action', ['as' => 'contact.action',
                'uses' => 'App\Http\Controllers\ContactController@Action']);
            Route::any('contact/toggle/{id?}', ['as' => 'contact.toggle',
                'uses' => 'App\Http\Controllers\ContactController@Toggle']);
            Route::any('contact/drop/{id?}', ['as' => 'contact.drop',
                'uses' => 'App\Http\Controllers\ContactController@drop']);
            // contact Master route end

   });
});


Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('get-started');
Route::get('home', [App\Http\Controllers\Front\HomeController::class, 'home'])->name('home');
Route::any('contact', [App\Http\Controllers\Front\HomeController::class, 'contact'])->name('contact');
Route::get('continue-as-patient', [App\Http\Controllers\Front\HomeController::class, 'continue_as_patient'])->name('continue-as-patient');
Route::get('continue-as-doctor', [App\Http\Controllers\Front\HomeController::class, 'continue_as_doctor'])->name('continue-as-doctor');
Route::get('live_search', [App\Http\Controllers\Front\HomeController::class, 'action1'])->name('live_search');
Route::get('service/{url}', [App\Http\Controllers\Front\HomeController::class, 'articleDetails'])->name('placeDetails');
Route::get('project/{url}', [App\Http\Controllers\Front\HomeController::class, 'projectDetails'])->name('projectDetails');
Route::get('category/{url}', [App\Http\Controllers\Front\HomeController::class, 'categoryDetails'])->name('categoryDetails');
Route::get('getSubcategory', [App\Http\Controllers\CategoryController::class, 'getSubcategory'])->name('getSubcategory');
Route::post('contact-enquiry', [App\Http\Controllers\Front\HomeController::class, 'contactEnquiry'])->name('contact-enquiry');

Route::any('about-us', [App\Http\Controllers\Front\HomeController::class, 'AboutUs'])->name('about-us');
Route::any('gallery', [App\Http\Controllers\Front\HomeController::class, 'gallery'])->name('gallery');
Route::any('services', [App\Http\Controllers\Front\HomeController::class, 'services'])->name('services');
Route::any('projects', [App\Http\Controllers\Front\HomeController::class, 'projects'])->name('projects');
Route::get('kitchens', [App\Http\Controllers\Front\HomeController::class, 'kitchens'])->name('kitchens');
Route::get('custom-joinery', [App\Http\Controllers\Front\HomeController::class, 'joinery'])->name('joinery');
Route::get('builders-architects', [App\Http\Controllers\Front\HomeController::class, 'buildersArchitects'])->name('builders-architects');
Route::get('our-process', [App\Http\Controllers\Front\HomeController::class, 'ourProcess'])->name('our-process');

Route::get('reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return 'Cache cleared';
});










