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

//Kriteria
Breadcrumbs::for('kriteria', function ($trail) {
    $trail->push('Kriteria', route('Kriteria.index'));
});
//Crips
Breadcrumbs::for('crips', function (BreadcrumbTrail $trail) {
    $trail->parent('kriteria');
    $trail->push('Crips', url('Crips'));
});

//User
Breadcrumbs::for('user', function ($trail) {
    $trail->push('User', route('User.index'));
});

//Perusahaan
Breadcrumbs::for('perusahaan', function ($trail) {
    $trail->push('Peserta', route('Perusahaan.index'));
});

// Penilaian
Breadcrumbs::for('penilaian', function ($trail) {
    $trail->push('Penilaian', route('Penilaian.index'));
});
//Perhitungan
Breadcrumbs::for('perhitungan', function ($trail) {
    $trail->push('Perhitungan', url('Perhitungan'));
});
