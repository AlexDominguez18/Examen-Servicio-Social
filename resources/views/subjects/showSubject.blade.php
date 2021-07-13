@extends('template')
<!--Titulo-->
@section('title',$subject->nombre)
<!--Contenido-->
@section('content')
    <h1>Información de {{$subject->nombre}}</h1>
    <hr>
    <ul>
        <li>{{$subject->creditos}}</li>
        <li>{{$subject->nombre}}</li>
        <li>{{$subject->profesor}}</li>
        <li>{{$subject->turno}}</li>
        <li>
            @if ($subject->disponible)
            Disponible    
            @else
            No disponible
            @endif
        </li>        
    </ul>
    <a href="{{route('subjects.index')}}">Regresar</a>
@endsection