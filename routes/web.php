<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(array('domain' => '127.0.0.1'), function () {

    Route::get('/', 'ControladorWebHome@index');
    Route::get('/nosotros', 'ControladorWebNosotros@index');
    Route::get('/servicios', 'ControladorWebServicios@index');
    Route::get('/contacto', 'ControladorWebContacto@index');
    Route::post('/contacto', 'ControladorWebContacto@enviar');
    Route::get('/seguro/{id}', 'ControladorWebSeguros@index');
    Route::get('/recupero', 'ControladorWebRecupero@index');

    
    /* --------------------------------------------- */
    /* CONTROLADOR WEB MIS PRODUCTOS                   */
    /* --------------------------------------------- */
    Route::get('/mis-productos', 'ControladorWebMisProductos@index');
    Route::post('/mis-productos', 'ControladorWebMisProductos@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR WEB MIS RECLAMOS                   */
    /* --------------------------------------------- */
    Route::get('/mis-reclamos', 'ControladorWebMisReclamos@index');
    Route::get('/mis-reclamos/{id}', 'ControladorWebReclamo@index');
    Route::post('/mis-reclamos/{id}', 'ControladorWebReclamo@guardar');
    Route::get('/mis-reclamos/eliminar/{id}', 'ControladorWebReclamo@eliminar');

    
    /* --------------------------------------------- */
    /* CONTROLADOR WEB LISTADO POLIZAS                  */
    /* --------------------------------------------- */
    Route::get('/listado-poliza/{id}', 'ControladorWebListadoPoliza@index');
    
    /* --------------------------------------------- */
    /* CONTROLADOR HOME                   */
    /* --------------------------------------------- */
    Route::get('/admin/home', 'ControladorHome@index');
    Route::get('/admin', 'ControladorHome@index');
    /* --------------------------------------------- */
    /* CONTROLADOR LOGIN                           */
    /* --------------------------------------------- */
    Route::get('/admin/login', 'ControladorLogin@index');
    Route::get('/admin/logout', 'ControladorLogin@logout');
    Route::post('/admin/logout', 'ControladorLogin@entrar');
    Route::post('/admin/login', 'ControladorLogin@entrar');

    /* --------------------------------------------- */
    /* CONTROLADOR RECUPERO CLAVE                    */
    /* --------------------------------------------- */
    Route::get('/admin/recupero-clave', 'ControladorRecuperoClave@index');
    Route::post('/admin/recupero-clave', 'ControladorRecuperoClave@recuperar');

    /* --------------------------------------------- */
    /* CONTROLADOR PERMISO                           */
    /* --------------------------------------------- */
    Route::get('/admin/usuarios/cargarGrillaFamiliaDisponibles', 'ControladorPermiso@cargarGrillaFamiliaDisponibles')->name('usuarios.cargarGrillaFamiliaDisponibles');
    Route::get('/admin/usuarios/cargarGrillaFamiliasDelUsuario', 'ControladorPermiso@cargarGrillaFamiliasDelUsuario')->name('usuarios.cargarGrillaFamiliasDelUsuario');
    Route::get('/admin/permisos', 'ControladorPermiso@index');
    Route::get('/admin/permisos/cargarGrilla', 'ControladorPermiso@cargarGrilla')->name('permiso.cargarGrilla');
    Route::get('/admin/permiso/nuevo', 'ControladorPermiso@nuevo');
    Route::get('/admin/permiso/cargarGrillaPatentesPorFamilia', 'ControladorPermiso@cargarGrillaPatentesPorFamilia')->name('permiso.cargarGrillaPatentesPorFamilia');
    Route::get('/admin/permiso/cargarGrillaPatentesDisponibles', 'ControladorPermiso@cargarGrillaPatentesDisponibles')->name('permiso.cargarGrillaPatentesDisponibles');
    Route::get('/admin/permiso/{idpermiso}', 'ControladorPermiso@editar');
    Route::post('/admin/permiso/{idpermiso}', 'ControladorPermiso@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR GRUPO                             */
    /* --------------------------------------------- */
    Route::get('/admin/grupos', 'ControladorGrupo@index');
    Route::get('/admin/usuarios/cargarGrillaGruposDelUsuario', 'ControladorGrupo@cargarGrillaGruposDelUsuario')->name('usuarios.cargarGrillaGruposDelUsuario'); //otra cosa
    Route::get('/admin/usuarios/cargarGrillaGruposDisponibles', 'ControladorGrupo@cargarGrillaGruposDisponibles')->name('usuarios.cargarGrillaGruposDisponibles'); //otra cosa
    Route::get('/admin/grupos/cargarGrilla', 'ControladorGrupo@cargarGrilla')->name('grupo.cargarGrilla');
    Route::get('/admin/grupo/nuevo', 'ControladorGrupo@nuevo');
    Route::get('/admin/grupo/setearGrupo', 'ControladorGrupo@setearGrupo');
    Route::post('/admin/grupo/nuevo', 'ControladorGrupo@guardar');
    Route::get('/admin/grupo/{idgrupo}', 'ControladorGrupo@editar');
    Route::post('/admin/grupo/{idgrupo}', 'ControladorGrupo@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR USUARIO                           */
    /* --------------------------------------------- */
    Route::get('/admin/usuarios', 'ControladorUsuario@index');
    Route::get('/admin/usuarios/nuevo', 'ControladorUsuario@nuevo');
    Route::post('/admin/usuarios/nuevo', 'ControladorUsuario@guardar');
    Route::post('/admin/usuarios/{usuario}', 'ControladorUsuario@guardar');
    Route::get('/admin/usuarios/cargarGrilla', 'ControladorUsuario@cargarGrilla')->name('usuarios.cargarGrilla');
    Route::get('/admin/usuarios/buscarUsuario', 'ControladorUsuario@buscarUsuario');
    Route::get('/admin/usuarios/{usuario}', 'ControladorUsuario@editar');

    /* --------------------------------------------- */
    /* CONTROLADOR MENU                             */
    /* --------------------------------------------- */
    Route::get('/admin/sistema/menu', 'ControladorMenu@index');
    Route::get('/admin/sistema/menu/nuevo', 'ControladorMenu@nuevo');
    Route::post('/admin/sistema/menu/nuevo', 'ControladorMenu@guardar');
    Route::get('/admin/sistema/menu/cargarGrilla', 'ControladorMenu@cargarGrilla')->name('menu.cargarGrilla');
    Route::get('/admin/sistema/menu/eliminar', 'ControladorMenu@eliminar');
    Route::get('/admin/sistema/menu/{id}', 'ControladorMenu@editar');
    Route::post('/admin/sistema/menu/{id}', 'ControladorMenu@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR PATENTES                          */
    /* --------------------------------------------- */
    Route::get('/admin/patentes', 'ControladorPatente@index');
    Route::get('/admin/patente/nuevo', 'ControladorPatente@nuevo');
    Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');
    Route::get('/admin/patente/cargarGrilla', 'ControladorPatente@cargarGrilla')->name('patente.cargarGrilla');
    Route::get('/admin/patente/eliminar', 'ControladorPatente@eliminar');
    Route::get('/admin/patente/nuevo/{id}', 'ControladorPatente@editar');
    Route::post('/admin/patente/nuevo/{id}', 'ControladorPatente@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR CLIENTE                          */
    /* --------------------------------------------- */
    Route::get('/admin/clientes', 'ControladorCliente@index');
    Route::get('/admin/cliente/nuevo', 'ControladorCliente@nuevo');
    Route::post('/admin/cliente/nuevo', 'ControladorCliente@guardar');
    Route::get('/admin/cliente/cargarGrilla', 'ControladorCliente@cargarGrilla')->name('cliente.cargarGrilla');
    Route::get('/admin/cliente/eliminar', 'ControladorCliente@eliminar');
    Route::get('/admin/cliente/nuevo/{id}', 'ControladorCliente@editar');
    Route::post('/admin/cliente/nuevo/{id}', 'ControladorCliente@guardar');


    /* --------------------------------------------- */
    /* CONTROLADOR POLIZA                          */
    /* --------------------------------------------- */
    Route::get('/admin/polizas', 'ControladorPoliza@index');
    Route::get('/admin/poliza/nuevo', 'ControladorPoliza@nuevo');
    Route::post('/admin/poliza/nuevo', 'ControladorPoliza@guardar');
    Route::get('/admin/poliza/cargarGrilla', 'ControladorPoliza@cargarGrilla')->name('poliza.cargarGrilla');
    Route::get('/admin/poliza/eliminar', 'ControladorPoliza@eliminar');
    Route::get('/admin/poliza/nuevo/{id}', 'ControladorPoliza@editar');
    Route::post('/admin/poliza/nuevo/{id}', 'ControladorPoliza@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR SEGUROS                          */
    /* --------------------------------------------- */
    Route::get('/admin/seguros', 'ControladorSeguro@index');
    Route::get('/admin/seguro/nuevo', 'ControladorSeguro@nuevo');
    Route::post('/admin/seguro/nuevo', 'ControladorSeguro@guardar');
    Route::get('/admin/seguro/eliminar', 'ControladorSeguro@eliminar');
    Route::get('/admin/seguro/cargarGrilla', 'ControladorSeguro@cargarGrilla')->name('seguro.cargarGrilla');
    Route::get('/admin/seguro/nuevo/{id}', 'ControladorSeguro@editar');
    Route::post('/admin/seguro/nuevo/{id}', 'ControladorSeguro@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR ASEGURADORAS                          */
    /* --------------------------------------------- */
    Route::get('/admin/aseguradoras', 'ControladorAseguradora@index');
    Route::get('/admin/aseguradora/nuevo', 'ControladorAseguradora@nuevo');
    Route::post('/admin/aseguradora/nuevo', 'ControladorAseguradora@guardar');
    Route::get('/admin/aseguradora/cargarGrilla', 'ControladorAseguradora@cargarGrilla')->name('aseguradora.cargarGrilla');
    route::get('admin/aseguradora/eliminar', 'controladorAseguradora@eliminar');
    Route::get('/admin/aseguradora/nuevo/{id}', 'ControladorAseguradora@editar');
    Route::post('/admin/aseguradora/nuevo/{id}', 'ControladorAseguradora@guardar');
    /* --------------------------------------------- */
    /* CONTROLADOR RECLAMOS                          */
    /* --------------------------------------------- */
    Route::get('/admin/reclamos', 'ControladorReclamo@index');
    Route::get('/admin/reclamo/nuevo', 'ControladorReclamo@nuevo');
    Route::post('/admin/reclamo/nuevo', 'ControladorReclamo@guardar');
    Route::get('/admin/reclamo/cargarGrilla', 'ControladorReclamo@cargarGrilla')->name('reclamo.cargarGrilla');
    Route::get('/admin/reclamo/eliminar', 'ControladorReclamo@eliminar');
    Route::get('/admin/reclamo/nuevo/{id}', 'ControladorReclamo@editar');
    Route::post('/admin/reclamo/nuevo/{id}', 'ControladorReclamo@guardar');

     /* --------------------------------------------- */
    /* CONTROLADOR LOGIN  WEB                      */
    /* --------------------------------------------- */
    Route::get('/login', 'ControladorWebLogin@index');
    Route::get('/logout', 'ControladorWebLogin@logout');
    Route::post('/logout', 'ControladorWebLogin@entrar');
    Route::post('/login', 'ControladorWebLogin@entrar');

});
