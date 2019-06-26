<?php



Route::get('/', function() {
    return view('Usuario.index');
});
//LOGUEO
Route::post('loguearse','UsuarioController@loguearse')->name('logueo');;
Route::get('CerrarSesion', 'UsuarioController@cerrarSesion');


//ADMINISTRADOR

Route::resource('Clientes', 'UsuarioController');
Route::post('crear-usuario','UsuarioController@store');
Route::delete('eliminar-usuario/{codigoUsuario}','UsuarioController@destroy')->name('destroyUsuario');
Route::post('buscar-usuario/{codigoUsuario}','UsuarioController@buscarUsuario')->name('selectUsuario');
Route::post('editar-usuario/{codigoUsuario}','UsuarioController@update')->name('updateUsuario');


Route::resource('Libros', 'LibroController');
Route::post('crear-libro/{catalogos}','LibroController@crearLibro')->name('insertLibro');
Route::delete('eliminar-libro/{codigoLibro}','LibroController@destroy')->name('destroyLibro');
Route::post('buscar-libro/{codigoLibro}','LibroController@buscarLibro')->name('selectLibro');
Route::post('editar-libro/{catalogos}','LibroController@update')->name('updateLibro');


Route::resource('Catalogos', 'CatalogoController');
Route::post('crear-catalogo','CatalogoController@store');
Route::delete('eliminar-catalogo/{codigoCatalogo}','CatalogoController@destroy')->name('destroyCatalogo');
Route::post('buscar-catalogo/{codigoCatalogo}','CatalogoController@buscarCatalogo')->name('selectCatalogo');
Route::post('editar-catalogo/{codigoCatalogo}','CatalogoController@update')->name('updateCatalogo');


Route::resource('Provedores', 'ProvedorController');
Route::post('crear-provedor','ProvedorController@store');
Route::delete('eliminar-provedor/{codigoProvedor}','ProvedorController@destroy')->name('destroyProvedor');
Route::post('buscar-provedorusuario/{codigoProvedor}','ProvedorController@buscarProvedor')->name('selectProvedor');
Route::post('editar-provedor/{codigoProvedor}','ProvedorController@update')->name('updateProvedor');


Route::get('Abastecimientos', 'TransaccionController@indexCompra');
Route::post('buscar-detalles/{codigoCompra}','TransaccionController@detallesCompra')->name('selectDetalles');
Route::post('guardar-abastecimiento','TransaccionController@guardarCompra')->name('insertAbastecimiento');


Route::get('Ventas', 'TransaccionController@indexVenta');
Route::post('buscar-detalles-venta/{codigoCompra}','TransaccionController@detallesVenta')->name('selectDetallesVentas');
Route::get('Login',function(){
    return view("Login");
});

//USUARIO O CLIENTE

Route::post('crear-usuario-usu','UsuarioController@crearUsuario');
Route::get('CatalogosLibreria', 'CatalogoController@indexUsuario');
Route::get('MiPerfil', 'UsuarioController@miPerfil');


Route::get('Inicio',function(){
    return view("Usuario.index");
});
Route::get('layoutAdmin',function(){
    return view("Administrador.layout");
});
Route::get('layoutUser',function(){
    return view("Usuario.layout");
});

Route::get('Administrador', 'UsuarioController@panelInicial');
