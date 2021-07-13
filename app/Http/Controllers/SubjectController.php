<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $rules;

    public function __construct()
    {
        $this->rules = [
            'creditos' => ['required','min:1'],
            'nombre' => ['required','string'],
            'profesor' => ['required','string'],
            'turno' => ['required','string'],
            'disponible' => ['required','boolean']
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::get();
        return view('subjects.listSubjects',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.newSubject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion del servidor
        $request->validate($this->rules);
        
        //Guardando en la base de datos
        Subject::create($request->except('_token'));

        //Redireccionamiento
        return redirect()->route('subjects.index')->with('message','Materia registrada con extio!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subjects.showSubject',compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects.editSubject',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //Validacion del servidor
        $request->validate($this->rules);

        //Actualizando informacion
        Subject::where('id',$subject->id)->update($request->except(['_token','_method']));
        
        //Redireccionamiento
        return redirect()->route('subjects.index')->with('message','Información de materia actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        Subject::destroy($subject->id);

        return redirect()->route('subjects.index')->with('message','Materia eliminada con éxito!');
    }
}
