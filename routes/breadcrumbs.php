<?php // routes/breadcrumbs.php
// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('Dashboard.index'));
});

//Peserta
Breadcrumbs::for('peserta', function ($trail){
    $trail->parent('pengadaanBarang');
    $trail->push('Peserta', route('Peserta.index'));
});

//PengadaanBarang
Breadcrumbs::for('pengadaanBarang', function ($trail){
    $trail->push('Pengadaan Barang', route('PengadaanBarang.index'));
});

//Kriteria
Breadcrumbs::for('kriteria', function ($trail){
    $trail->push('Kriteria', route('Kriteria.index'));
});

//User
Breadcrumbs::for('user', function ($trail){
    $trail->push('User', route('User.index'));
});
