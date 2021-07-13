@extends('template')
@include('students.studentForm',['student' => $student])
<!--Titulo-->
@section('title',$student->nombre)
<!--Contenido-->
@section('content')
    <h1>Editando registro de {{$student->nombre}}</h1>
    <hr>
    @yield('student-form','student')
@endsection