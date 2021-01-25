<?php

Route::get('/auth/facebook/login',              'UserController@facebookLogin');
Route::get('/auth/facebook/callback',           'UserController@facebookLoginCallback');

Route::get('/auth/google/login',              'UserController@googleLogin');
Route::get('/auth/google/callback',           'UserController@googleLoginCallback');
