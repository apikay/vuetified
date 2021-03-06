<?php
Route::group(['middleware' => ['auth:api']], function () {

    Route::post('/@me', 'Api\UsersController@me')->name('api.@me');
    Route::post('/users', 'Api\UsersController@index')->name('api.user.index');
    Route::post('/users/username/{username}', 'Api\UsersController@findByUsername')->name('api.user.findByUsername');
    Route::post('/users/email/{email}', 'Api\UsersController@findByEmail')->name('api.user.findByEmail');
    Route::post('/users/{id}', 'Api\UsersController@show')->name('api.user.show');

    Route::post('/getAuth', 'Api\Auth\ACLController@getAuth')->name('api.auth.getAuth');
    Route::post('/auth/check', 'Api\Auth\LoginController@check')->name('api.auth.check');

    Route::get('/getPermissionsViaRoles', 'Api\Auth\ACLController@getPermissionsViaRoles')->name('api.auth.getPermissionsViaRoles');
    Route::get('/getDirectPermissions', 'Api\Auth\ACLController@getDirectPermissions')->name('api.auth.getDirectPermissions');
    Route::get('/getAllPermissions', 'Api\Auth\ACLController@getAllPermissions')->name('api.auth.getAllPermissions');
    Route::get('/hasPermissionTo', 'Api\Auth\ACLController@hasPermissionTo')->name('api.auth.hasPermissionTo');
    Route::get('/hasAnyPermission', 'Api\Auth\ACLController@hasAnyPermission')->name('api.auth.hasAnyPermission');

    Route::get('/getRoles', 'Api\Auth\ACLController@getRoles')->name('api.auth.getRoles');
    Route::get('/hasRole', 'Api\Auth\ACLController@hasRole')->name('api.auth.hasRole');
    Route::get('/hasAnyRole', 'Api\Auth\ACLController@hasAnyRole')->name('api.auth.hasAnyRole');
    Route::get('/hasAllRoles', 'Api\Auth\ACLController@hasAllRoles')->name('api.auth.hasAllRoles');

    Route::post('/auth/logout', 'Api\Auth\LoginController@logout')->name('api.auth.logout');
});

Route::post('/auth/register', 'Api\Auth\RegisterController@register')->name('api.auth.register');
Route::post('/auth/login', 'Api\Auth\LoginController@login')->name('api.auth.login');
Route::post('/auth/refresh', 'Api\Auth\LoginController@refresh')->name('api.auth.refresh');
Route::post('/auth/social', 'Api\Auth\SocialAuthController@socialAuth')->name('api.auth.social');
Route::post('/sendResetEmail', 'Api\Auth\ForgotPasswordController@sendResetEmail')->name('api.auth.forgotpassword');

Route::post('/resetPassword', 'Api\Auth\ResetPasswordController@resetPassword')->name('api.auth.reset-password');

Route::get('/categories', 'Api\CategoriesController@index')->name('api.category.index');
Route::get('/categories/{slug}', 'Api\CategoriesController@show')->name('api.category.show');

Route::get('/products', 'Api\ProductsController@index')->name('api.product.index');
Route::get('/products/{slug}', 'Api\ProductsController@show')->name('api.product.show');



// Route::post('/checkout', 'Api\CheckoutController@checkout')->name('api.product.show');
// Checkout Will Save A New Order For Specific Authenticated User
