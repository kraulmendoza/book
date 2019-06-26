<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $Libros = Libro::all();
        $Catalogos = Catalogo::all();
        return view('Administrador.Libros',compact('Libros'),compact('Catalogos'));
    }

    public function buscarLibro(Request $request, $id)
    {   
        if($request->ajax()){
            $libro = Libro::where('id', $id)->first();
            $catalogos = DB::select("SELECT c.id id, c.categoria as categoria FROM libro_por_catalogo lc, catalogo c where lc.codigo_Catalogo=c.id and ISBN='".$id."'");
            return response()->json(["libro" =>$libro , "catalogos"=>$catalogos]);
        }
       
        //
    }
    
   

    public function crearLibro(Request $request, $Array){
        try {
            
      
    if($request->ajax()){     
    $libro = Libro::find($request->input('id'));

    if (!$libro) {
        $idLibro = $request->input('id');
        $libro = new Libro();
        $libro->id = $request->input('id');
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor');
        $libro->precioCompra = $request->input('precioCompra');
        $libro->precioVenta = $request->input('precioVenta');
        $libro->fechaPublicacion = $request->input('fechaPublicacion');
        $libro->save();
        //los catalogos vienen separador por comas (,) hago un split
        $catalogos = explode(',', $Array);
        //Guardo los catalogos a los q este libro pertenecen
        foreach ($catalogos as $i => $catalogo) {
         DB::insert("INSERT INTO libro_por_catalogo VALUES ('".$catalogo."','".$idLibro."')");

        }
          
        return response()->json([
            'id' =>'ok',
            'mensaje' =>'Registrado Correctamente'
        ]);
    }else{
        return response()->json([
            'id' =>'error',
            'mensaje' =>'Error. Este libro ya existe'
        ]);
    }
     
    }

} catch (\Throwable $th) {
    return response()->json([
        'id' =>'error',
        'mensaje' =>'Error. NO se ah podido guardar el libro'
    ]);
}
}

 
public function update(Request $request, $Array)
{   
    
    if($request->ajax()){
        $id = $request->input('id');
        if ($Array!="0") {
            DB::table('libro_por_catalogo')->where('ISBN', '=', $id)->delete();
            $catalogos = explode(',', $Array);
            foreach ($catalogos as $i => $catalogo) {
                DB::insert("INSERT INTO libro_por_catalogo VALUES ('".$catalogo."','".$id."')");
            }
        }

        $libro = Libro::where('id', $id)->first();
        $libro->titulo = $request->input('titulo');
        $libro->autor = $request->input('autor');
        $libro->precioCompra = $request->input('precioCompra');
        $libro->precioVenta = $request->input('precioVenta');
        $libro->fechaPublicacion = $request->input('fechaPublicacion');
        $libro->save();
            return response()->json([
                'mensaje' =>'Editado Correctamente'
            ]);          
    }
}
    public function destroy(Request $request, $id){
        try {
        if($request->ajax()){
            DB::table('libro_por_catalogo')->where('ISBN', '=', $id)->delete(); 
            $libro = Libro::where('id', $id)->delete(); 
            return response()->json([
                'id' =>'ok',
                'mensaje' =>'Eliminado Correctamente'
            ]);
            
        } 
            
        } catch (\Throwable $th) {
            return response()->json([
                'id' =>'error',
                'mensaje' =>'El libro no se pudo eliminar'
            ]);
        }
    }
}
