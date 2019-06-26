@extends('Administrador.layout')
@section('title')
    Catalogos
@endsection
@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
          
        <h1 class=""><b>Listado de Catalogos</b> </h1><br>
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
      <th scope="col"><b>Codigo</b></th>
      <th scope="col">Categoria</th>
      <th scope="col">Total de libros</th>
      <th scope="col">Opciones</th>
      <!-- <th scope="col">Usuario</th>
      <th scope="col">Contraseña</th> -->
    </tr>
  </thead>

  <tbody id="bodytable">
  	@foreach($Catalogos as $catalogo)
    <tr data-id="{{$catalogo->id}}">
      <th>{{$catalogo->id}}</th>
      <td>{{$catalogo->categoria}}</td>
      <td><b>{{$catalogo->libros}} en total</b></td>         
      <td> <a title="Eliminar catalogo" style="cursor: pointer" class="mr-4 btnEliminar"><i style="font-size: 25px; color: red;" class="mdi mdi-delete "></i></a>      <a style="cursor: pointer" title="Editar catalogo de {{$catalogo->categoria}}"><i style="font-size: 25px; color: red;" class="mdi mdi-book-multiple btnSeleccionar"></i></a></td>
      
    </tr>
    @endforeach
  </tbody>
  
  {!!Form::open(['route' => ['destroyCatalogo',':codigoCatalogo'], 'method'=>'DELETE', 'id'=>'form-eliminar']) !!}

  {!!Form::close() !!}
  {!!Form::open(['route' => ['selectCatalogo',':codigoCatalogo'], 'method'=>'POST', 'id'=>'form-seleccionar']) !!}

  {!!Form::close() !!}



  <!-- MODAL PARA REGISTRAR -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Catalogo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class=""><b>Informacion Relevante</b></h2>
                   <br>
                    <form action="crear-catalogo" method="POST" class="forms-sample">
                {{ csrf_field() }}
                     <div class="form-group">
                        <label>Nombre del catalogo o categoria</label>
                        <input type="text" class="form-control" name="categoria" placeholder="Identificacion" >
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
              <h5 class="modal-title" id="exampleModalLongTitle">Editar Catalogo</h5>
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
                       {!!Form::open(['route' => ['updateCatalogo',':codigoCatalogo'], 'method'=>'POST', 'id'=>'form-editar']) !!}

                         <div class="form-group">
                            <label>Codigo</label>
                            <input disabled id="id" type="text" class="form-control" name="id" placeholder="Identificacion" >
                          </div>
                          <div class="form-group">
                            <label>Nombre de categoria</label>
                            <input id="categoria" type="text" class="form-control" name="categoria" placeholder="Nombre" >
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
    <script src="jsAdministrador/catalogo.js"></script>

@endsection