@extends('Administrador.layout')
@section('title')
    Proveedores
@endsection
@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
          
        <h1 class=""><b>Lista de Proveedores</b> </h1><br>
        <div class="row">
            <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                            + Nuevo
                          </button>
            </div>
              
              <div class="col-md-4">
                    <div class="input-group">
                          <input id="filtro" type="text" class="form-control" placeholder="Consultar" aria-label="Nombre de provedor" aria-describedby="colored-addon3">
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
      <th scope="col"><b>NIT o identificacion</b></th>
      <th scope="col">Nombres o entidad</th>
      <th scope="col">Tipo</th>
      <th scope="col">Direccion o contacto</th>
      <th scope="col">Telefono</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody id="bodytable">
  	@foreach($Provedores as $provedor)
    <tr data-id="{{$provedor->id}}">
      <th>{{$provedor->id}}</th>
      <td>{{$provedor->nombre}}</td>
      <td>{{$provedor->tipo}}</td>
      <td>{{$provedor->direccion}}</td>
      <td>{{$provedor->telefono}}</td>
      <td> <a title="Eliminar provedor" style="cursor: pointer" class="mr-4 btnEliminar"><i style="font-size: 25px; color: red;" class="mdi mdi-delete "></i></a>      <a style="cursor: pointer" title="Editar a {{$provedor->nombre}} {{$provedor->apellido}}"><i style="font-size: 25px; color: red;" class="mdi mdi-account-edit btnSeleccionar"></i></a></td>

    </tr>
    @endforeach
  </tbody>
  
  {!!Form::open(['route' => ['destroyProvedor',':codigoProvedor'], 'method'=>'DELETE', 'id'=>'form-eliminar']) !!}

  {!!Form::close() !!}
  {!!Form::open(['route' => ['selectProvedor',':codigoProvedor'], 'method'=>'POST', 'id'=>'form-seleccionar']) !!}

  {!!Form::close() !!}
  
 


  <!-- MODAL PARA REGISTRAR -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo provedor</h5>
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
                    <form action="crear-provedor" method="POST" class="forms-sample">
                {{ csrf_field() }}
                     <div class="form-group">
                        <label>NIT o identificacion</label>
                        <input type="text" class="form-control" name="id" placeholder="Identificacion" >
                      </div>
                      <div class="form-group">
                        <label>Nombres o entidad</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" >
                      </div>
                      <div class="form-group">
                            <label >Tipo</label>
                      <select class=" form-control form-control-sm" name="tipo">
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editorial</font></font></option>
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Persona natural</font></font></option>
                          </select>
                        </div>
                      <div class="form-group">
                            <label >Direccion o contacto</label>
                            <input type="text" class="form-control" name="direccion" placeholder="Direccion">
                          </div>
                   
                          <div class="form-group">
                                <label >Telefono</label>
                                <input type="text" class="form-control" name="telefono" placeholder="Telefono">
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
              <h5 class="modal-title" id="exampleModalLongTitle">Editar provedor</h5>
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
                       {!!Form::open(['route' => ['updateProvedor',':codigoProvedor'], 'method'=>'POST', 'id'=>'form-editar']) !!}

                         <div class="form-group">
                            <label>NIT o identificacion</label>
                            <input disabled id="id" type="text" class="form-control" name="cedula" placeholder="Identificacion" >
                          </div>
                          <div class="form-group">
                            <label>Nombre o entidad</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" >
                          </div>
                          <div class="form-group">
                                <label >Tipo</label>
                                <select class=" form-control form-control-sm" id="tipo" name="tipo">
                                        <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editorial</font></font></option>
                                        <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Persona natural</font></font></option>
                                      </select>
                            </div>
                          <div class="form-group">
                                <label >Direccion o contacto</label>
                                <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Direccion">
                              </div>
                              <div class="form-group">
                                    <label >Telefono</label>
                                    <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Telefono">
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
    
<script src="jsAdministrador/provedor.js"></script>
@endsection