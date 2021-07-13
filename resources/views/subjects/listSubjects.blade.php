@extends('template')

<!--Titulo-->
@section('title','Materias')
<!--Contenido-->
@section('content')
    <h1>Materias</h1>
    <hr>
    <a href="{{route('subjects.create')}}">Registrar materia</a>
    <hr>
    @if(session()->has('message'))
    <div style="color: green;">
        {{ session()->get('message') }}
    </div>
    @endif
        @if ($subjects->count())
        <table>
            <tr>
              <th>Créditos</th>
              <th>Nombre</th>
              <th>Profesor</th>
              <th>Turno</th>
              <th>Disponibilidad</th>
              <th>Acciones</th>
            </tr>    
            @foreach ($subjects as $subject)
            <tr>
                <td>{{$subject->creditos}}</td>
                <td><a href="{{route('subjects.show',$subject)}}">{{$subject->nombre}}</td>
                <td>{{$subject->profesor}}</td>
                <td>{{$subject->turno}}</td>
                <td>
                    @if ($subject->disponible)
                    Disponible
                    @else
                    No disponible
                    @endif
                </td>
                <td>
                    <a href="{{route('subjects.edit',$subject)}}">Editar</a>
                    <form method="POST" action="{{route('subjects.destroy',$subject)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Eliminar</button>
                    </form>
                </td>    
            </tr>
            @endforeach
        </table>
        @else
        <p>No hay materias registrados</p>
        @endif
@endsection