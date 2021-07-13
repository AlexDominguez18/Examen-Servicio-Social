@extends('template')
@include('subjects.subjectForm')
<!--Titulo-->
@section('title','Registrar materia')
<!--Contenido-->
@section('content')
    <h1>Registrar materia</h1>
    <hr>
    @yield('subject-form')
@endsection