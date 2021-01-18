<?php
use App\Http\middleware\CheckApiToken;
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

Route::post('/user/recuperar-senha',                'UserController@recuperarSenha');
Route::post('/user/recuperar-senha-finalizar',      'UserController@recuperarSenhaFinalizar');
Route::post('/contato/registra-contato',              'ContatosController@saveContato');

Route::middleware([CheckApiToken::class])->group(function(){

    Route::get( '/user/editarusuario',                          'UserController@editarusuario');
    Route::get( '/user/pesquisar',                              'UserController@find');
    Route::get( '/user/{user}',                                 'UserController@getUserById');
    Route::get( '/user/{user}/assuntos',                        'UserController@getAssuntosByUser');
    Route::get( '/user/{user}/listar/{assunto}/{tipo_assunto}', 'UserController@getUserByAssuntos');
    Route::post('/user/salvar-perfil',                          'UserController@salvarinfoPerfil');
    Route::post('/user/upload-foto',                            'UserController@uploadPhoto');
    Route::post('/user/deletar-usuario',                        'UserController@softDeleteUser');
    Route::post('/user/desbloquear-usuario',                    'UserController@unblockUser');

    Route::get( '/assunto',                 'AssuntosController@find');
    Route::get( '/assunto/edit',            'AssuntosController@edit');
    Route::get( '/assunto/vinculados',      'AssuntosController@findAssuntosUser');

    Route::post('/assunto/store',                        'AssuntosController@store');
    Route::post('/assunto/liberar-assunto',           'AssuntosController@approveAssunto');
    Route::post('/assunto/inativar-assunto',           'AssuntosController@softdeleteAssunto');
    Route::get('/assunto/pesquisar-assunto',           'AssuntosController@find');

    Route::get( '/chat/listar/{user}',                  'ChatController@listChat');
    Route::get( '/chat/abrir/{hash}',                   'ChatController@openChat');
    Route::get( '/chat/{chat}/mensagens',               'ChatController@getMessages');
    Route::post('/chat/novo-chat',                      'ChatController@newChat');
    Route::post('/chat/{chat}/mensagens',               'ChatController@sendMessage');

    Route::get( '/contato/pesquisar-contato',                 'ContatosController@findContato');
    Route::post( '/contato/limpar-contato',                            'ContatosController@softDeleteContato');
    Route::post( '/contato/{contato}/enviar-mensagem',                        'ContatosController@sendMessageContato');

    Route::post('/denuncia/{denuncia}/confirm',                             'DenunciasController@confirmDenuncia');
    Route::post('/denuncia/{denuncia}/ignore',                             'DenunciasController@ignoreDenuncia');
    Route::post('/denuncia/enviar-denuncia/{denunciador}/{denunciado}',     'DenunciasController@sendDenuncia');
    Route::get('/denuncia/pesquisar-denuncias',                             'DenunciasController@listarDenuncias');

    Route::get(   '/amizades/listar/{user}',                          'AmizadeController@list');
    Route::delete('/amizades/{user}/{friend}/desfazer-amizade',       'AmizadeController@unfriend');
});





Route::post('/user', 'UserController@store');
Route::post('/login', 'UserController@login');



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
