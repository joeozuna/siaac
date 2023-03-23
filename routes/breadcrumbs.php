<?php // routes/breadcrumbs.php

//'view' => 'breadcrumbs::bootstrap4',

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Inicio
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});

// Inicio > Roles
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});

// Inicio > Roles > Crear Rol
Breadcrumbs::for('crear_rol', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Crear Rol', route('roles.index'));
});

// Inicio > Roles > Editar Rol
Breadcrumbs::for('actualizar_rol', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Editar Rol', route('roles.index'));
});

// Inicio > Roles > Ver Rol
Breadcrumbs::for('ver_rol', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Ver Rol', route('roles.index'));
});