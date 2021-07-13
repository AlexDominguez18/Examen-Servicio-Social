@section('subject-form')
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (isset($subject))
    <form method="POST" action="{{route('subjects.update',$subject)}}">
        @method('PATCH')
    @else
    <form method="POST" action="{{route('subjects.store')}}">
    @endif
        @csrf
        <label for="creditos">Créditos: </label><br>
        <input 
            type="number"
            min="1" 
            id="creditos" 
            name="creditos" 
            @if (isset($subject))
            value="{{$subject->creditos}}"    
            @else
            value="{{old('creditos')}}"
            @endif
        required>
        <br>
        <label for="nombre">Nombre: </label><br>
        <input 
            type="text"
            id="nombre"
            name="nombre"
            @if (isset($subject))
            value="{{$subject->nombre}}"
            @else
            value="{{old('nombre')}}"
            @endif
        required>
        <br>
        <label for="profesor">Profesor: </label><br>
        <input
            type="text"
            id="profesor"
            name="profesor"
            @if (isset($subject))
            value="{{$subject->profesor}}"
            @else
            value="{{old('profesor')}}"
            @endif
        >
        <br>
        <label for="turno">Turno </label><br>
        <select id="turno" name="turno">
            @if (isset($subject))
                @if ($subject->turno === "Matutino")
                <option value="Matutino" selected>Matutino</option>
                <option value="Vespertino">Vespertino</option>
                @else
                <option value="Matutino">Matutino</option>
                <option value="Vespertino" selected>Vespertino</option>                
                @endif
            @else
            <option value="Matutino" selected>Matutino</option>
            <option value="Vespertino">Vespertino</option>
            @endif
        </select>
        <br>
        <label for="disponible">Disponibilidad: </label><br>
        @if (isset($subject))
            @if ($subject->disponible)
            <input type="radio" id="disponible" name="disponible" value="1" checked>Disponible</label><br>
            <input type="radio" id="disponible" name="disponible" value="0">No disponible</label><br>
            @else
            <input type="radio" id="disponible" name="disponible" value="1">Disponible</label><br>
            <input type="radio" id="disponible" name="disponible" value="0" checked>No disponible</label><br>    
            @endif
        @else    
            <input type="radio" id="disponible" name="disponible" value="1">Disponible</label><br>
            <input type="radio" id="disponible" name="disponible" value="0">No disponible</label><br>
        @endif
        <br>
        <hr>
        <button type="submit">Guardar información</button>
    </form>
@endsection