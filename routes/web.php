<?php

Route::get('/auth/facebook/login',              'UserController@facebookLogin');
Route::get('/auth/facebook/callback',           'UserController@facebookLoginCallback');

Route::get('/auth/google/login',              'UserController@googleLogin');
Route::get('/auth/google/callback',           'UserController@googleLoginCallback');

Route::get('/print-pdf', 'PDFCOntroller@printPdf');
Route::get('/print/numero-conversas-dia', 'PDFCOntroller@numeroConversasDia');
Route::get('/print/numero-amizades-dia', 'PDFCOntroller@numeroAmizadesDia');
Route::get('/print/numero-usuarios-dia', 'PDFCOntroller@numeroUsuarioDia');
Route::get('/print/numero-denuncias-dia', 'PDFCOntroller@numeroDenunciaDia');
Route::get('/print/assuntos-mais-populares', 'PDFCOntroller@assuntosMaisPopulares');
Route::get('/print/total-conversas-trimestre', 'PDFCOntroller@totalConversasTrimestre');
