<?php

namespace App\Http\Controllers;

use App\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$Usuarios = DB::table('usuario')->paginate(2);
        $Catalogos = DB::select('SELECT id,categoria, (SELECT COUNT(ISBN) FROM libro_por_catalogo where codigo_Catalogo = id) as libros FROM `catalogo`ORDER BY id');
       // $total_usuarios = $Usuarios->count();
        return view('Administrador.catalogos',compact('Catalogos'));
    }

    public function indexUsuario()
    {
        //$Usuarios = DB::table('usuario')->paginate(2);
        $Catalogos = DB::select('SELECT id,categoria, (SELECT COUNT(ISBN) FROM libro_por_catalogo where codigo_Catalogo = id) as libros FROM `catalogo`ORDER BY id');
       // $total_usuarios = $Usuarios->count();
        return view('Usuario.catalogos',compact('Catalogos'));
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
        Catalogo::create($request->all());
        $Catalogos = DB::select('SELECT id,categoria, (SELECT COUNT(ISBN) FROM libro_por_catalogo where codigo_Catalogo = id) as libros FROM `catalogo`ORDER BY id');
        return Redirect::to('Catalogos');
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
    public function update(Request $request, $id)
    {   

        if($request->ajax()){
            $catalogo = Catalogo::where('id', $id)->first();
            $data = $request->all();
                $catalogo->fill($data);
                $catalogo->save();
                return response()->json([
                    'mensaje' =>'Editado Correctamente'
                ]);   
                
                                
        }
    }

    public function buscarCatalogo(Request $request, $id)
    {   
        if($request->ajax()){
            $catalogo = Catalogo::where('id', $id)->first();
            return response()->json($catalogo);
        }
       
        //
    }

    public function destroy(Request $request, $id){
        try {
        if($request->ajax()){
            
            $catalogo = Catalogo::where('id', $id)->delete(); 
            return response()->json([
                'id' =>'ok',
                'mensaje' =>'Eliminado Correctamente'
            ]);
            
        } 
            
        } catch (\Throwable $th) {
            return response()->json([
                'id' =>'error',
                'mensaje' =>'El catalogo no se puede eliminar porque tiene libros activos'
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
