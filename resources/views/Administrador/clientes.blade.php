@extends('Administrador.layout')
@section('title')
    Clientes
@endsection
@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
          
        <h1 class=""><b>Lista de Clientes</b> </h1><br>
        <div class="row">
            <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                            + Nuevo
                          </button>

            </div>
              
              <div class="col-md-4">
                    <div class="input-group">
                          <input id="filtro" type="text" class="form-control" placeholder="Consultar" aria-label="Nombre de usuario" aria-describedby="colored-addon3">
                          <div class="input-group-append bg-primary border-primary">
                            <span class="input-group-text bg-transparent">
                              <i class="mdi mdi-magnify text-white"></i>
                            </span>
                          </div>
                        </div>
              </div>
        </div>
            
       
        <div class="table-responsive">
    <br>
    <div style="display: none;" id="alert" class="alert"></div>
    <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col"><b>Cedula</b></th>
      <th scope="col">Nombre y apellido</th>
      <th scope="col">Correo electronico</th>
      <th scope="col">Telefono</th>
      <th scope="col">Direccion</th>
      <th scope="col">Opciones</th>
      <!-- <th scope="col">Usuario</th>
      <th scope="col">Contraseña</th> -->
    </tr>
  </thead>
  <tbody id="bodytable">
  	@foreach($Usuarios as $usuario)
    <tr data-id="{{$usuario->id}}">
      <th>{{$usuario->id}}</th>
      <td>{{$usuario->nombre}} {{$usuario->apellido}}</td>
     
      <td>{{$usuario->correo}}</td>
      <td>{{$usuario->numeroTelefono}}</td>
      <td>{{$usuario->direccion}}</td>
      <td> <a title="Eliminar cliente" style="cursor: pointer" class="mr-4 btnEliminar"><i style="font-size: 25px; color: red;" class="mdi mdi-delete "></i></a>      <a style="cursor: pointer" title="Editar a {{$usuario->nombre}} {{$usuario->apellido}}"><i style="font-size: 25px; color: red;" class="mdi mdi-account-edit btnSeleccionar"></i></a></td>

    </tr>
    @endforeach
  </tbody>
  
  {!!Form::open(['route' => ['destroyUsuario',':codigoUsuario'], 'method'=>'DELETE', 'id'=>'form-eliminar']) !!}

  {!!Form::close() !!}
  {!!Form::open(['route' => ['selectUsuario',':codigoUsuario'], 'method'=>'POST', 'id'=>'form-seleccionar']) !!}

  {!!Form::close() !!}
  
 


  <!-- MODAL PARA REGISTRAR -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class=""><b>Datos Personales</b></h2>
                   <br>
                    <form action="crear-usuario-usu" method="POST" class="forms-sample">
                {{ csrf_field() }}
                     <div class="form-group">
                        <label>Cedula</label>
                        <input type="text" class="form-control" name="id" placeholder="Identificacion" >
                      </div>
                      <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" >
                      </div>
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" name="apellido" placeholder="Apellidos">
                      </div>
                      <div class="form-group">
                            <label >Correo electronico</label>
                            <input type="text" class="form-control" name="correo" placeholder="Email">
                          </div>
                          <div class="form-group">
                                <label >Telefono</label>
                                <input type="text" class="form-control" name="numeroTelefono" placeholder="Telefono">
                              </div>
                              <div class="form-group">
                                    <label >Direccion</label>
                                    <input type="text" class="form-control" name="direccion" placeholder="Direccion">
                                  </div>
                                  <div class="form-group">
                                        <label >Usuario</label>
                                        <input type="text" class="form-control" name="user" placeholder="Usuario">
                                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-success mr-2">Registrar</button>
                
                    </form>
                  </div>
                </div>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

</table>
</div>
</div>



  <!-- MODAL PARA EDITAR -->
  <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Editar Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h2 class=""><b>Datos Personales</b></h2>
                       <br>
                       {!!Form::open(['route' => ['updateUsuario',':codigoUsuario'], 'method'=>'POST', 'id'=>'form-editar']) !!}

                         <div class="form-group">
                            <label>Cedula</label>
                            <input disabled id="id" type="text" class="form-control" name="cedula" placeholder="Identificacion" >
                          </div>
                          <div class="form-group">
                            <label>Nombres</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" >
                          </div>
                          <div class="form-group">
                            <label>Apellidos</label>
                            <input id="apellido" type="text" class="form-control" name="apellido" placeholder="Apellidos">
                          </div>
                          <div class="form-group">
                                <label >Correo electronico</label>
                                <input id="correo" type="text" class="form-control" name="correo" placeholder="Email">
                              </div>
                              <div class="form-group">
                                    <label >Telefono</label>
                                    <input id="numeroTelefono" type="text" class="form-control" name="numeroTelefono" placeholder="Telefono">
                                  </div>
                                  <div class="form-group">
                                        <label >Direccion</label>
                                        <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Direccion">
                                      </div>
                                      <div class="form-group">
                                            <label >Usuario</label>
                                            <input id="usuario" type="text" class="form-control" name="user" placeholder="Usuario">
                                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                          </div>
                          <button id="btnEditar"  class="btn btn-success mr-2">Guardar Cambios</button>
                    
                        </form>
                        {!!Form::close() !!}
                      </div>
                    </div>
                  </div>
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    
    </table>
    </div>
    </div>
    
<script src="jsAdministrador/usuario.js"></script>
@endsection