<?php

namespace App\Http\Controllers;

use App\Provedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$Provedors = DB::table('Provedor')->paginate(2);
        $Provedores = Provedor::all();
       // $total_Provedors = $Provedors->count();
        return view('Administrador.provedores',compact('Provedores'));
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Provedor::create($request->all());
        $Provedores = Provedor::all();
        return Redirect::to('Provedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function show(Libros $libros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $cedula)
    {   
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cedula)
    {   

        if($request->ajax()){
            $provedor = Provedor::where('id', $cedula)->first();
            $data = $request->all();
                $provedor->fill($data);
                $provedor->save();
                return response()->json([
                    'mensaje' =>'Editado Correctamente'
                ]);   
                
                                
        }
    }

    public function buscarProvedor(Request $request, $cedula)
    {   
        if($request->ajax()){
            $provedor = Provedor::where('id', $cedula)->first();
            return response()->json($provedor);
        }
       
        //
    }

    public function destroy(Request $request, $cedula){
        if($request->ajax()){
            $provedor = Provedor::where('id', $cedula)->delete();
            return response()->json([
                'mensaje' =>'Eliminado Correctamente'
            ]);
        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    
}
