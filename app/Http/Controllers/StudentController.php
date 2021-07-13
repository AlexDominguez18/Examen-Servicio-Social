<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $rules;

    public function __construct()
    {
        $this->rules = [
            'nombre' => ['required','string'],
            'codigo' => ['required','digits:9'],
            'carrera' => ['string','nullable'],
            'creditos' => ['min:0']
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::get();
        return view('students.listStudents',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.newStudent');
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
        $request->validate($this->rules,[
           'correo' => ['nullable','string','unique:App\Models\Student,correo']
        ]);

        //Guardando den la base de datos
        Student::create($request->except('_token'));

        //Redirecccionando a index estudiantes
        return redirect()->route('students.index')->with('message','Estudiante registrado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $subjects = Subject::get();
        return view('students.showStudent',compact(['student','subjects']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.editStudent',compact('student'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Student $student)
    {
        //Validacion del lado del servidor
        $request->validate($this->rules);

        //Actualizando informacion
        Student::where('id',$student->id)->update($request->except(['_token','_method']));

        //Redireccionamiento
        return redirect()->route('students.index')->with('message','Información de estudiante actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //Eliminando registro
        Student::destroy($student->id);
        
        //Redireccionamiento
        return redirect()->route('students.index')->with('message','Registro elminado con éxito!');
    }

    public function addSubject(Request $request,Student $student)
    {
        //Validando que no se agrege la misma materia
        $request->validate([
            'subject_id' => ['exists:App\Models\Subject,id']
        ]);

        //Guardando en pivote
        $student->subjects()->attach($request->subject_id);

        //Redireccionamiento
        return redirect()->route('students.show',$student)->with('message','Materia añadida con éxtio!');
    }

    public function deleteSubject(Student $student,Subject $subject)
    {
        //Eliminando relacion del pivote
        $student->subjects()->detach($subject->id);

        return redirect()->route('students.show',$student)->with('message','Materia eliminada con éxito!');
    }
}
