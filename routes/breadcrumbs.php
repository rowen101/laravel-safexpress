<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Home > User
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('User', url('admin/user'));
});

// Home > User > [Create]
Breadcrumbs::for('createuser', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('Create', url('admin/user/create'));
});
////////////////////////////////////////////


// Home > App
Breadcrumbs::for('apps', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Application', url('admin/apps'));
});

// Home > App > [Create]
Breadcrumbs::for('createapps', function (BreadcrumbTrail $trail) {
    $trail->parent('apps');
    $trail->push('Create', url('admin/app/create'));
});
////////////////////////////////////////////////


// Home > Menu
Breadcrumbs::for('menu', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Menu', url('admin/menu'));
});

// Home > Menu > [Create]
Breadcrumbs::for('createmenu', function (BreadcrumbTrail $trail) {
    $trail->parent('menu');
    $trail->push('Create', url('admin/menu/create'));
});
///////////////////////////////
// Home > Gallery
Breadcrumbs::for('gallery', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Gallery', url('admin/gallery'));
});

// Home > Menu > [Create]
Breadcrumbs::for('creategallery', function (BreadcrumbTrail $trail) {
    $trail->parent('gallery');
    $trail->push('Create', url('admin/gallery/create'));
});
// Home > Menu > [iamge]
Breadcrumbs::for('imagegallery', function (BreadcrumbTrail $trail) {
    $trail->parent('gallery');
    $trail->push('Image', url('admin/gallery/create'));
});
