@extends('template')
<!--Titulo-->
@section('title',$student->nombre)
<!--Contenido-->
@section('content')
    <h1>Información de {{$student->nombre}}</h1>
    <hr>
    <ul>
        <li>{{$student->nombre}}</li>
        <li>{{$student->codigo}}</li>
        @if ($student->carrera != null)
        <li>{{$student->carrera}}</li>
        @else
        <li> - </li>
        @endif
        <li>{{$student->creditos_cursados}}</li>
        @if ($student->correo != null)
        <li>{{$student->correo}}</li>
        @else
        <li> - </li>
        @endif        
    </ul>
    
    <!--Mostrar materias-->
    @if (isset($subjects))
    <h3>Materias asignadas</h3>
    <hr>
        @if ($student->subjects->count())
            <ol>
                @foreach ($student->subjects as $subject)
                    <li>
                        <div>
                            {{$subject->nombre}}
                        </div>
                        <form method="POST" action="{{route('students.delete-subject',[$student,$subject])}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Quitar</button>
                        </form>
                    </li>
                @endforeach
            </ol>
        @else
        <p>No tiene materias asignadas</p>
        @endif
    @endif
    <hr>
    <!--Agregar materias-->
    <form method="POST" action="{{route('students.add-subject',$student)}}">
        @csrf
        <label for="subject_id">Agregar materia:</label><br>
        <select id="subject_id" name="subject_id">
            <option value="0" selected> Ninguno </option>
            @foreach ($subjects as $subject)
                @if (array_search($subject->id,$student->subjects->pluck('id')->toArray()) === false)
                <option value="{{$subject->id}}">{{$subject->nombre}}</option>
                @endif
            @endforeach
        </select>
        <button type="submit">Agregar</button>
    </form>
    <!--Mostrando errores de asignacion-->
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <hr>
    <a href="{{route('subjects.index')}}">Regresar</a>
@endsection