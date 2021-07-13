@extends('template')
@include('subjects.subjectForm',['subject' => $subject])

@section('title',$subject->nombre)

@section('content')
    <h1>Editando materia: {{$subject->nombre}}</h1>
    <hr>
    @yield('subject-form')
@endsection