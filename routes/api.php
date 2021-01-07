<?php
use App\Http\middleware\CheckApiToken;
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


Route::middleware([CheckApiToken::class])->group(function(){

    Route::get( '/user/editarusuario',      'UserController@editarusuario');
    Route::get( '/user/{user}',             'UserController@getUserById');
    Route::get( '/user/{user}/assuntos',    'UserController@getAssuntosByUser');
    Route::post('/user/salvar-perfil',      'UserController@salvarinfoPerfil');
    Route::post('/user/upload-foto',        'UserController@uploadPhoto');
    Route::post('/user/recuperar-senha',        'UserController@recuperarSenha');

    Route::get( '/assunto',                 'AssuntosController@find');
    Route::get( '/assunto/edit',            'AssuntosController@edit');
    Route::get( '/assunto/vinculados',      'AssuntosController@findAssuntosUser');
    Route::post('/assunto/store',           'AssuntosController@store');
});





Route::post('/user', 'UserController@store');
Route::post('/login', 'UserController@login');



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
