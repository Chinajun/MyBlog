<?php
use think\Route;

Route::post('register/login','register/Login/index');
Route::post('register/register','register/Register/index');
Route::post('register/getMsg','register/GetMsg/index');
Route::post('register/getAllMsg','register/GetAllMsg/index');
Route::post('register/deleteUser','register/DeleteUser/index');
Route::post('register/changeUser','register/ChangeUser/index');

//Route::post('product/saveProduct','product/SaveProduct/index');
//Route::post('product/getProduct','product/GetProduct/index');
//Route::post('product/deleteProduct','product/DeleteProduct/index');
//Route::post('product/readProduct','product/ReadProduct/index');
//Route::post('product/findProduct','product/FindProduct/index');
Route::post('product/saveProduct','product/Product/SaveProduct');
Route::post('product/getProduct','product/Product/GetProduct');
Route::post('product/deleteProduct','product/Product/DeleteProduct');
Route::post('product/readProduct','product/Product/ReadProduct');
Route::post('product/findProduct','product/Product/FindProduct');

Route::post('blog/register','blog/User/register');
Route::post('blog/validateUser','blog/User/validateUser');
Route::post('blog/login','blog/User/login');

Route::post('blog/addArticle','blog/Article/addArticle');
Route::post('blog/getArticle','blog/Article/getArticle');
Route::post('blog/getDetailArticle','blog/Article/getDetailArticle');