<?php

namespace App\Http\Controllers;

use App\Provedor;
use App\Factura_compra;
use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCompra()
    {
       //$Provedors = DB::table('Provedor')->paginate(2);
       $sql = "SELECT id,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha,codigo_Provedor,(SELECT nombre from provedor where id = codigo_Provedor) as nombre_Provedor, (SELECT sum(valorNeto) from detalle_factura_compra where codigo_Factura_compra = id) as valorNeto FROM factura_compra";
       $Compras = DB::select($sql);
       $Provedores = Provedor::all();
       $Libros = Libro::all();

       // $total_Provedors = $Provedors->count();
        return view('Administrador.abastecimiento',compact('Compras'),compact('Provedores','Libros'));
    }

    public function detallesCompra(Request $request, $id)
    {
        if($request->ajax()){
            $sql = "SELECT dc.ISBN as idLibro,l.titulo,l.precioCompra, l.cantidadActual as cantidadactual, dc.cantidad as cantidadcomprada, dc.valorNeto as totaldetalle FROM detalle_factura_compra dc, libro l WHERE l.id = dc.ISBN AND dc.codigo_Factura_Compra = '".$id."'";
            $detalles = DB::select($sql);  
            return response()->json($detalles);
        }
    }

    public function indexVenta()
    {
       $sql = "SELECT id,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha,codigo_Usuario as codigo_Usuario,(SELECT nombre apellido from usuario where id = codigo_Usuario) as nombre_Usuario, (SELECT sum(valorNeto) from detalle_factura_venta where codigo_Factura_Venta = id) as valorNeto FROM factura_venta";
       $Ventas = DB::select($sql);  
       return view('Administrador.ventas',compact('Ventas'));
    }

    public function detallesVenta(Request $request, $id)
    {
        if($request->ajax()){
            $sql = "SELECT dc.ISBN as idLibro,l.titulo,l.precioVenta, l.cantidadActual as cantidadactual, dc.cantidad as cantidadvendida, dc.valorNeto as totaldetalle FROM detalle_factura_venta dc, libro l WHERE l.id = dc.ISBN AND dc.codigo_Factura_Venta = '".$id."'";
            $detalles = DB::select($sql);  
            return response()->json($detalles);
        }
    }
  

    public function guardarCompra(Request $request){
        $compra = new Factura_compra();
        $compra->codigo_Provedor = $request->input('provedor');
        $compra->save();
        $idcompra = $compra->id;
        $detalles = $request->input('listadedetalles');
        foreach ($detalles as $i => $detalle) {
            $libro = Libro::find($detalle["libro"]);
            $cantidad = $detalle["cantidad"];
            $precio = $libro->precioCompra;
            $valorNeto = $cantidad * $precio;
            DB::insert("INSERT INTO detalle_factura_compra(cantidad, precio, valorNeto, codigo_Factura_Compra, ISBN)
             VALUES ('".$cantidad."','".$precio."','".$valorNeto."','".$idcompra."','".$libro->id."')");  
            $libro->cantidadActual =  $libro->cantidadActual + $cantidad;
            $libro->save();
        }
        return response()->json("ok");
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
