@extends('template')
@include('students.studentForm')
<!--Titulo-->
@section('title','Registrar estudiante')
<!--Contenido-->
@section('content')
    <h1> Registrar estudiante </h1>
    <hr>
    @yield('student-form')
@endsection