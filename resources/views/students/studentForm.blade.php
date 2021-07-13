@section('student-form')
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (isset($student))
    <form method="POST" action="{{route('students.update',$student)}}">
        @method('PATCH')
    @else
    <form method="POST" action="{{route('students.store')}}">
    @endif
        @csrf
        <label for="nombre">Nombre: </label><br>
        <input 
            type="text" 
            id="nombre" 
            name="nombre" 
            @if (isset($student))
            value="{{$student->nombre}}"    
            @else
            value="{{old('nombre')}}"
            @endif
        required>
        <br>
        <label for="codigo">Codigo: </label><br>
        <input 
            type="text"
            id="codigo"
            name="codigo"
            @if (isset($student))
            value="{{$student->codigo}}"
            @else
            value="{{old('codigo')}}"
            @endif
        required>
        <br>
        <label for="carrera">Carrera: </label><br>
        <input
            type="text"
            id="carrera"
            name="carrera"
            @if (isset($student))
            value="{{$student->carrera}}"
            @else
            value="{{old('carrera')}}"
            @endif
        >
        <br>
        <label for="creditos_cursados">Créditos cursados: </label><br>
        <input
            type="number"
            min="0"
            id="creditos_cursados"
            name="creditos_cursados"
            @if (isset($student))
            value="{{$student->creditos_cursados}}"
            @else
            value="{{old('creditos_cursados')}}"
            @endif
        required>
        <br>
        <label for="correo">Correo electronico: </label><br>
        <input
            type="email"
            id="correo"
            name="correo"
            @if (isset($student))
            value="{{$student->correo}}"
            @else
            value="{{old('correo')}}"
            @endif
        >
        <br>
        <hr>
        <button type="submit">Guardar información</button>
    </form>
    @endsection