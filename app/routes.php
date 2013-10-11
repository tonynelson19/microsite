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
    'as'     => 'admin.index',
    'uses'   => 'AdminController@indexAction',
    'before' => 'admin',
));

Route::any('/admin/section/list', array(
    'as'     => 'admin.list-sections',
    'uses'   => 'AdminController@listSectionsAction',
    'before' => 'auth',
));

Route::any('/admin/section/add', array(
    'as'     => 'admin.add-section',
    'uses'   => 'AdminController@addSectionAction',
    'before' => 'auth',
));

Route::any('/admin/section/edit/{id}', array(
    'as'     => 'admin.edit-section',
    'uses'   => 'AdminController@editSectionAction',
    'before' => 'auth',
));

Route::any('/admin/section/delete/{id}', array(
    'as'     => 'admin.delete-section',
    'uses'   => 'AdminController@deleteSectionAction',
    'before' => 'auth',
));

Route::any('/admin/category/add/{id}', array(
    'as'     => 'admin.add-category',
    'uses'   => 'AdminController@addCategoryAction',
    'before' => 'auth',
));

Route::any('/admin/category/edit/{id}', array(
    'as'     => 'admin.edit-category',
    'uses'   => 'AdminController@editCategoryAction',
    'before' => 'auth',
));

Route::any('/admin/category/delete/{id}', array(
    'as'     => 'admin.delete-category',
    'uses'   => 'AdminController@deleteCategoryAction',
    'before' => 'auth',
));

Route::any('/admin/product/add/{id}', array(
    'as'     => 'admin.add-product',
    'uses'   => 'AdminController@addProductAction',
    'before' => 'auth',
));

Route::any('/admin/product/edit/{id}', array(
    'as'     => 'admin.edit-product',
    'uses'   => 'AdminController@editProductAction',
    'before' => 'auth',
));

Route::any('/admin/product/delete/{id}', array(
    'as'     => 'admin.delete-product',
    'uses'   => 'AdminController@deleteProductAction',
    'before' => 'auth',
));

Route::any('/admin/product/images/{id}', array(
    'as'     => 'admin.save-product-images',
    'uses'   => 'AdminController@saveProductImagesAction',
    'before' => 'auth',
));