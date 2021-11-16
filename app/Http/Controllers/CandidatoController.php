<?php

namespace App\Http\Controllers;

use App\Vacante;
use App\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            //'cv' => 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required'
        ]);


        //PRIMERA FORMA
        // $candidato = new Candidato();
        // $candidato->nombre = $data['nombre'];
        // $candidato->email = $data['email'];
        // $candidato->vacante_id = $data['vacante_id'];
        // $candidato->cv = "123.pdf";

        //SEGUNDA FORMA
        // $candidato = new Candidato($data);
        // $candidato->cv = "123.pdf";

        //TERCERA FORMA
        // $candidato = new Candidato();
        // $candidato->fill($data);
        // $candidato->cv = "123.pdf";

        //CUARTA FORMA
        $vacante = Vacante::find($data['vacante_id']);

        $vacante->candidatos()->create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'cv' => '123.pdf'
        ]);


        // $candidato->save();

        return "desde store";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
