<?php

\App\Libraries\SiteVisit::registerVisits();

Auth::routes();

Route::get('/', 'HomeController@index');

//Route::post('home/send-mail','HomeController@sendEmail');


Route::post('home/search-online','CourseController@searchOnline');

//Route::get('about-us','AboutUsController@index');


Route::get('log-in','LoginController@index');
Route::get('login/doLogin', 'LoginController@showLogin');
Route::post('login/dologin', 'LoginController@doLogin');
Route::post('login/signUp', 'LoginController@saveOrUpdate');
Route::get('login/logout','LoginController@doLogout');
Route::post('login/change-password', 'LoginController@changePassword');
Route::get('login/check-user', 'LoginController@checkUser');
Route::get('login/check-email', 'LoginController@checkEmail');

Route::post('login/reset-password', 'LoginController@resetPassword');
Route::get('resetPassword/reset-password', 'ResetPasswordController@resetPassword');

Route::post('resetPassword/send-link', 'ResetPasswordController@sendLink');
Route::get('reset-password', 'ResetPasswordController@index');

//Route::get('email-template','EmailTemplateController@index');

//Route::get('dashboard','DashboardController@index');


Route::get('terms-of-use','DynamicContentController@terms');
Route::get('privacy-and-security','DynamicContentController@privacy');
Route::get('policy','DynamicContentController@index');
Route::get('frequently-asked-questions','DynamicContentController@faq');
Route::get('footer-sitemap','DynamicContentController@sitemap');
Route::get('admin/auth/forgot-password', 'Admin\AuthController@forgotPassword');

Route::post('admin/user-management/send-link', 'Admin\UserManagementController@sendLink');
Route::get('admin/user-management/reset-password', 'Admin\UserManagementController@resetPassword');
Route::post('admin/user-management/set-password', 'Admin\UserManagementController@setPassword');

Route::group( ['middleware' => ['auth', 'admin']], function()
{

    Route::post('admin/common/file-upload', 'CommonController@fileUpload');
    Route::post('admin/common/file-upload2', 'CommonController@fileUpload2');

    Route::get('admin/user-management','Admin\UserManagementController@index');
    Route::get('admin/user-management/list-all', 'Admin\UserManagementController@listAll');
    Route::get('admin/user-management/{id}/edit', 'Admin\UserManagementController@form');
    Route::get('admin/user-management/create', 'Admin\UserManagementController@form');
    Route::post('admin/user-management/save-or-update', 'Admin\UserManagementController@saveOrUpdate');
    Route::get('admin/user-management/delete', 'Admin\UserManagementController@delete');
    Route::get('admin/user-management/username-validation', 'Admin\UserManagementController@usernameValidation');

    Route::post('admin/auth/settings', 'Admin\AuthController@settings');
    Route::get('admin/user-management/change-password', 'Admin\UserManagementController@changePasswordForm');
    Route::post('admin/user-management/changepassword', 'Admin\UserManagementController@changePassword');

    Route::get('admin/activity-log', 'Admin\ActivityLogController@index');
    Route::get('admin/activity-log/list-all', 'Admin\ActivityLogController@listAll');
    Route::get('admin/activity-log/{id}/view', 'Admin\ActivityLogController@form');
    Route::post('admin/activity-log/export-excel', 'Admin\ActivityLogController@exportToExcel');

    Route::get('admin/terms-of-use', array('uses' => 'Admin\DynamicContentController@termsOfUse'));
    Route::get('admin/privacy-and-security', array('uses' => 'Admin\DynamicContentController@privacyAndSecurity'));
    Route::get('admin/policy', array('uses' => 'Admin\DynamicContentController@policy'));
    Route::get('admin/home-page', array('uses' => 'Admin\DynamicContentController@homepage'));
    Route::get('admin/about-us', array('uses' => 'Admin\DynamicContentController@aboutUs'));

    Route::get('admin/site-config', array('uses' => 'Admin\DynamicContentController@siteConfig'));
    Route::get('admin/slider', array('uses' => 'Admin\DynamicContentController@slider'));
    Route::get('admin/contact-us', array('uses' => 'Admin\DynamicContentController@contactUS'));


});

//Route::get('admin', array('uses' => 'Admin\AuthController@showLogin'));
Route::get('admin', 'Admin\AuthController@showLogin');

Route::get('admin/login', array('uses' => 'Admin\AuthController@showLogin'));
Route::post('admin/login', array('uses' => 'Admin\AuthController@doLogin'));
Route::get('admin/logout', array('uses' => 'Admin\AuthController@doLogout'));

Route::get('km/upload-file', 'KmController@uploadFile');
Route::get('search/courses', 'SearchController@listAll');

Route::get('/home', 'HomeController@index');

Route::get('test', function()
{
    dd(Config::get('mail'));
});
Route::get('/run-shell-command', function() {
    $output = shell_exec('ls');
    echo "<pre>$output</pre>";
});

