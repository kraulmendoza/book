<?php

namespace App\Http\Controllers;
use Session;
use App\Usuario;
use App\Libro;
use App\Provedor;
use App\Factura_venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$Usuarios = DB::table('usuario')->paginate(2);
        $Usuarios = Usuario::all();
       // $total_usuarios = $Usuarios->count();
        return view('Administrador.clientes',compact('Usuarios'));
    }

    public function miPerfil()
    {
        //$Usuarios = DB::table('usuario')->paginate(2);
        $id = Session::get('id');
        $usuario = Usuario::where('id', $id)->first();
       // $total_usuarios = $Usuarios->count();
        return view('Usuario.perfil',compact('usuario'));
    }
    
    public function loguearse(Request $request){
        $usuario = $request["usuario"];
        $cliente = Usuario::where('user', $usuario)->first();
        if (is_null($cliente)) {
            return response()->json([
                "id"=>"error",
                "mensaje"=>"Esta cuenta no existe" 
            ]); 
        }
        if(($cliente->password) != $request["password"]){
            return response()->json([
                "id"=>"error",
                "mensaje"=>"Contraseña incorrecta" 
            ]); 
        }

        //Creo las sesiones
        Session::put('password', $cliente->password);
        Session::put('usuario', $cliente->user);
        Session::put('id', $cliente->id);
        Session::put('nombre', $cliente->nombre);
        Session::put('apellido', $cliente->apellido);
        Session::put('rol', $cliente->rol);
            return response()->json([
                "id"=>"ok",
                "mensaje"=>"Ingresando...",
                "rol"=>$cliente->rol
            ]); 
            }


    public function cerrarSesion(){
        Session::forget('password');
        Session::forget('usuario');
        Session::forget('id');
        Session::forget('nombre');
        Session::forget('apellido');
        return Redirect::to('Login');

    }

    public function panelInicial(){
        $totalUsuarios = Usuario::all()->count();
        $totalProvedores = Provedor::all()->count();
        $totalLibros = Libro::all()->count();
        $totalVentas = Factura_venta::all()->count();
        $ultimaVenta = Factura_venta::all()->last();

        return view('Administrador.index',compact(['totalUsuarios','totalLibros','totalProvedores','totalVentas','ultimaVenta']));


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
        Usuario::create($request->all());
        $Usuarios = Usuario::all();
        return Redirect::to('Clientes');
    }

    public function crearUsuario(Request $request)
    {
        try {
            Usuario::create($request->all());
            $Usuarios = Usuario::all();
            return Redirect::to('Login');
        } catch (\Throwable $th) {
            return Redirect::to('ClientesInicio');
        }
       
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
            $cliente = Usuario::where('id', $cedula)->first();
            $data = $request->all();
                $cliente->fill($data);
                $cliente->save();
                return response()->json([
                    'mensaje' =>'Editado Correctamente'
                ]);   
                
                                
        }
    }

    public function buscarUsuario(Request $request, $cedula)
    {   
        if($request->ajax()){
            $cliente = Usuario::where('id', $cedula)->first();
            return response()->json($cliente);
        }
       
        //
    }

    public function destroy(Request $request, $cedula){
        if($request->ajax()){
            $cliente = Usuario::where('id', $cedula)->delete();
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
