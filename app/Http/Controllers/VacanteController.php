<?php

namespace App\Http\Controllers;

use App\Salario;
use App\Vacante;
use App\Categoria;
use App\Ubicacion;
use App\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    // public function __construct()
    // {
    //     //REVISAR QUE USUARIO ESTEA AUTENTICADO Y VERIFICADO
    //     $this->middleware(['auth', 'verified']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id )->latest()->simplePaginate(5);
        return view('vacantes.index', compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //CONSULTAS
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.create')
                   ->with('categorias', $categorias)
                   ->with('experiencias', $experiencias)
                   ->with('ubicaciones', $ubicaciones)
                   ->with('salarios', $salarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDACION
        $data = $request->validate([
            'titulo'=> 'required|min:8',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required',

        ]);

        //ALMACENAR EN BASE DE DATOS
        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'descripcion' => $data['descripcion'],
            'skills' => $data['skills'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario'],
        ]);

        return redirect()->action('VacanteController@index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        // if($vacante->activa === 0) return abort(404);
        return view('vacantes.show')->with('vacante', $vacante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {

        $this->authorize('view', $vacante);
      //CONSULTAS
      $categorias = Categoria::all();
      $experiencias = Experiencia::all();
      $ubicaciones = Ubicacion::all();
      $salarios = Salario::all();

      return view('vacantes.edit')
                 ->with('categorias', $categorias)
                 ->with('experiencias', $experiencias)
                 ->with('ubicaciones', $ubicaciones)
                 ->with('salarios', $salarios)
                 ->with('vacante', $vacante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        $this->authorize('update', $vacante);
        // dd($request->all());
         //VALIDACION
         $data = $request->validate([
            'titulo'=> 'required|min:8',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required',
        ]);

        $vacante->titulo = $data['titulo'];
        $vacante->skills = $data['skills'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];

        $vacante->save();

        //REDIRECCIONAR
        return redirect()->action('VacanteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {
        $this->authorize('delete', $vacante);
        //return response()->json($vacante);
        //return response()->json($request);

        $vacante->delete();
        return response()->json(['mensaje' => 'Se elimino vacante ' . $vacante->titulo]);
    }


    //CAMPOS EXTRAS
    public function imagen(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/vacantes') , $nombreImagen);
        return response()->json(['correcto' => $nombreImagen]);
    }

    //BORRAR IMAGEN VIA AJAX
    public function borrarimagen(Request $request)
    {
        if($request->ajax()) {
            $imagen = $request->get('imagen');

            if( File::exists( 'storage/vacantes/' . $imagen ) ) {
                File::delete( 'storage/vacantes/' . $imagen );
            }

            return response('imagen eliminada', 200);
        }
    }

    //CAMBIA EL ESTADO DE UNA VACANTE
    public function estado(Request $request, Vacante $vacante)
    {

        //LEER NUEVO ESTADO Y ASIGNARLO
        $vacante->activa = $request->estado;

        //GUARDARLO EN BD
        $vacante->save();

        return response()->json(['respuesta' => 'Correcto']);
    }

    public function buscar(Request $request)
    {
        //VALIDAR
        $data = $request->validate([
            'categoria' => 'required',
            'ubicacion' => 'required'
        ]);

        //ASIGNAR VALORES
        $categoria = $data['categoria'];
        $ubicacion = $data['ubicacion'];

         $vacantes = Vacante::latest()
             ->where('categoria_id', $categoria)
             ->where('ubicacion_id', $ubicacion)
             ->get();

        // $vacantes = Vacante::where([
        //     'categoria_id' => $categoria,
        //     'ubicacion_id' => $ubicacion
        // ])->get();

        return view('buscar.index', compact('vacantes'));

    }

    public function resultados()
    {
        return "mostrando resultados";
    }
}
