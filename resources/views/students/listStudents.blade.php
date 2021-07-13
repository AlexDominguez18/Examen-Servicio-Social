@extends('template')
<!--Titulo-->
@section('title','Estudiantes')
<!--Contenido-->
@section('content')
    <h1> Estudiantes </h1>
    <hr>
    <a href="{{route('students.create')}}">Nuevo estudiante</a>
    <hr>
    @if(session()->has('message'))
    <div style="color: green;">
        {{ session()->get('message') }}
    </div>
    @endif
        @if ($students->count())
        <table>
            <tr>
              <th>Nombre</th>
              <th>Código</th>
              <th>Carrera</th>
              <th>Créditos cursados</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>    
            @foreach ($students as $student)
            <tr>
                <td><a href="{{route('students.show',$student)}}">{{$student->nombre}}</td>
                <td>{{$student->codigo}}</td>
                @if ($student->carrera != null)
                <td>{{$student->carrera}}</td>
                @else
                <td>-</td>
                @endif
                <td>{{$student->creditos_cursados}}</td>
                @if ($student->correo != null)
                <td>{{$student->correo}}</td>
                @else
                <td>-</td>
                @endif
                <td>
                    <a href="{{route('students.edit',$student)}}">Editar</a>
                    <form method="POST" action="{{route('students.destroy',$student)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Eliminar</button>
                    </form>
                </td>    
            </tr>
            @endforeach
        </table>
        @else
        <p>No hay estudiantes registrados</p>
        @endif
@endsection