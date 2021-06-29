<?php

Route::get('/auth/facebook/login',              'UserController@facebookLogin');
Route::get('/auth/facebook/callback',           'UserController@facebookLoginCallback');

Route::get('/auth/google/login',              'UserController@googleLogin');
Route::get('/auth/google/callback',           'UserController@googleLoginCallback');

Route::get('/print-pdf', 'PDFController@printPdf');
Route::get('/print/numero-conversas-dia', 'PDFController@numeroConversasDia');
Route::get('/print/numero-amizades-dia', 'PDFController@numeroAmizadesDia');
Route::get('/print/numero-usuarios-dia', 'PDFController@numeroUsuarioDia');
Route::get('/print/numero-denuncias-dia', 'PDFController@numeroDenunciaDia');
Route::get('/print/assuntos-mais-populares', 'PDFController@assuntosMaisPopulares');
Route::get('/print/total-conversas-trimestre', 'PDFController@totalConversasTrimestre');
