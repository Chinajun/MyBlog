<?php
use think\Route;

Route::post('blog/register','blog/User/register');
Route::post('blog/validateUser','blog/User/validateUser');
Route::post('blog/login','blog/User/login');
Route::post('blog/logout','blog/User/logout');
Route::post('blog/getUsers','blog/User/getUsers');
Route::post('blog/getInfo','blog/User/getInfo');
Route::post('blog/updateUser','blog/User/updateUser');

Route::post('blog/addArticle','blog/Article/addArticle');
Route::post('blog/getArticle','blog/Article/getArticle');
Route::post('blog/getDetailArticle','blog/Article/getDetailArticle');

Route::post('blog/addComment','blog/Comment/addComment');
Route::post('blog/getComment','blog/Comment/getComment');