<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Rutas resource para ambos modelos & controladores

//Rutas de Estudiantes
Route::post('students/{student}/add-subject',[StudentController::class,'addSubject'])->name('students.add-subject');
Route::delete('students/{student}/{subject}/delete-subject',[StudentController::class,'deleteSubject'])->name('students.delete-subject');
Route::resource('students', StudentController::class);

//Rutas de Materias
Route::resource('subjects', SubjectController::class);
