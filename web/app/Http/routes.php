<?php

Route::get('phpinfo', function() { return phpinfo(); });
Route::get('frontpage', function() { return view('pages.front-guest'); });

/**
 * API FUNCTIONALITY
 */
Route::post('/login_api', 'Auth\AuthController@postCheckCredentials');
Route::post('/content', 'ContentController@postContent');
/**
 * WEB AUTHENTICATION
 */
Route::post('/register', 'Auth\AuthController@postRegister');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get( '/login', 'Auth\AuthController@getLogin');
Route::get( '/logout', 'Auth\AuthController@getLogout');

/**
 * WEB DATA ACCESS
 */

Route::get( '/status', 'ContentController@getStatus');
Route::get( '/text', 'ContentController@getText');
Route::get( '/files', 'ContentController@getFiles');
Route::get( '/settings', 'ContentController@getSettings');

/**
 * STATIC PAGES
 */
Route::get( '/', 'StaticPageController@index');
Route::get( '/info/what', 'StaticPageController@what');
Route::get( '/info/how', 'StaticPageController@how');
Route::get( '/info/todo', 'StaticPageController@todo');