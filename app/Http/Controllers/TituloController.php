<?php

namespace App\Http\Controllers;

use App\Models\Titulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TituloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulos = Titulo::latest()->paginate(5);

        return view('titulos.index',compact('titulos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('titulos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Titulo::create($request->all());

        return redirect()->route('titulos.index')
            ->with('success','Titulo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Titulo $titulo)
    {
        return view('titulos.show',compact('titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Titulo $titulo)
    {
        return view('titulos.edit',compact('titulo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Titulo $titulo)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $titulo->update($request->all());

        return redirect()->route('titulos.index')
            ->with('success','Titulo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Titulo $titulo)
    {
        $titulo->delete();

        return redirect()->route('titulos.index')
            ->with('success','Titulo eliminado correctamente');
    }

    public function read(){
        // $filtro = $request->input('filtro');
        // if ($filtro == "") {
        //     $pokemons = DB::select('Select * from pokemon');
        // }elseif ($filtro == "favorito") {
        //     $pokemons = DB::select('Select * from pokemon where favorito = 1');
        // }
        // else {
        //     $pokemons = DB::select('Select * from pokemon where nombre like ?',["%".$filtro."%"]);
        // }
        $titulos = DB::select('Select * from titulos');
        // Unicamente esto para ficheros ubicados en campos blob
        
        return response()->json($titulos, 200);
    }

    public function deleteTitulo(Request $request) {
        try {
            //return $id;
            DB::table('titulos')->Where('id', '=', $request->input('id_titulo'))->delete();
            //envio a la ruta mostrar
            return response()->json(array('resultado'=>'OK'), 200);
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=>'NOK'.$th->getMessage()), 200);
        }
    }

    public function createTitulo(Request $request) {
        try {
            DB::table('titulos')->insertGetId(['name'=>$request->input('name'),'description'=>$request->input('description')]);
            return response()->json(array('resultado'=>'OK'), 200);
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=>'NOK'.$th->getMessage()), 200);
        }
    }

    public function updateTitulo(Request $request){
        try {
            DB::table('titulos')->where('id', '=', $request->input('id_titulo'))->update(['name'=>$request->input('name'),'description'=>$request->input('description')]);
            return response()->json(array('resultado'=>'OK'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('resultado'=>'NOK'.$th->getMessage()), 200);
        }
    }
}
