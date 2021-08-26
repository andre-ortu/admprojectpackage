<?php
use AndreaOrtu\AdmProject\Controllers\PeopleController;

Route::get('api/people', [PeopleController::class, 'index']);
Route::get('api/people/{people}', [PeopleController::class, 'show'])->middleware('bindings');
