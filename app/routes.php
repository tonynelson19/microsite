<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', array(
    'as'   => 'index.index',
    'uses' => 'IndexController@indexAction',
));

Route::any('/section/{id}', array(
    'as'   => 'index.section',
    'uses' => 'IndexController@sectionAction',
));

Route::any('/product/{id}', array(
    'as'   => 'index.product',
    'uses' => 'IndexController@productAction',
));

Route::any('/admin', array(
    'as'   => 'admin.index',
    'uses' => 'AdminController@indexAction',
));