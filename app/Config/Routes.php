<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*
$routes->get('CargarAmo', 'CargarAmo::index');
$routes->post('form/exito', 'CargarAmo::');
*/

$routes->get('mostrar_amo', 'Amos::index');
$routes->get('cargar_amo', 'Amos::cargar');

$routes->get('borrar/(:num)', 'Amos::borrar/$1'); 
$routes->get('editar/(:num)', 'Amos::editar/$1');
$routes->post('actualizar', 'Amos::actualizar');
$routes->get('mascota_de_amo/(:num)', 'VerMascotas::mascota_de_amo/$1');


//estos yes
$routes->get('/', 'Home::index');

//Usuarios
$routes->get('mostrarFormularioLogin', 'Usuarios::mostrarFormularioLogin');
$routes->get('mostrarFormularioRegistro', 'Usuarios::mostrarFormularioRegistro');
$routes->post('guardarRegistro', 'Usuarios::guardarRegistro');
$routes->post('guardarLogin', 'Usuarios::guardarLogin');
$routes->get('logout', 'Usuarios::logout');

//Usuarios:perfil
$routes->get('perfil', 'Usuarios::perfil');
$routes->post('actualizar_perfil', 'Usuarios::actualizarPerfil');


//tareas
$routes->get('tareas', 'Tareas::index'); // o el nombre correcto de tu método

$routes->get('formCrearTarea', 'Tareas::cargar');
$routes->post('guardarTarea', 'Tareas::guardarTarea');
$routes->get('mostrar_tareas', 'Tareas::index');
$routes->get('cargar_tarea', 'Tareas::cargar');
$routes->get('completar_tarea/(:num)', 'Tareas::completar_tarea/$1');
$routes->get('tareas_proximas', 'Tareas::tareas_proximas');



$routes->get('editar_tarea/(:num)', 'Tareas::editar/$1');
$routes->post('actualizar_tarea', 'Tareas::actualizar');
$routes->get('borrar_tarea/(:num)', 'Tareas::borrar/$1'); 
$routes->get('ver_tarea/(:num)', 'Tareas::ver_tarea/$1'); 
$routes->get('archivar_tarea/(:num)', 'Tareas::archivar_tarea/$1');
$routes->get('mostrar_archivadas', 'Tareas::mostrarArchivadas');



//colaboradores
$routes->post('agregar_colaborador', 'Colaboraciones::agregar_colaborador');
$routes->get('tareas_colaborando', 'Tareas::tareasColaborando');



$routes->post('asignar_responsable', 'Subtareas::asignar_responsable');
$routes->post('guardar_subtarea', 'Subtareas::guardar_subtarea');
$routes->get('completar_subtarea/(:num)/(:num)', 'Subtareas::completar_subtarea/$1/$2');
$routes->get('borrar_subtarea/(:num)/(:num)', 'Subtareas::borrar_subtarea/$1/$2');
$routes->post('actualizar_subtarea', 'Subtareas::actualizar_subtarea');






