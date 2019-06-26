@extends('Administrador.layout')
@section('title')
    Libros
@endsection
@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
          
        <h1 class=""><b>Listado de Libros</b> </h1><br>
        <div class="row">
            <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                            + Nuevo
                          </button>

            </div>
              
              <div class="col-md-4">
                    <div class="input-group">
                          <input id="filtro" type="text" class="form-control" placeholder="Consultar" aria-label="Nombre de libro" aria-describedby="colored-addon3">
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
      <th scope="col"><b>ISBN</b></th>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">Precio de compra</th>
      <th scope="col">Precio de venta</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Estado</th>
      <th scope="col">Fecha de publicacion</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody id="bodytable">
        @foreach($Libros as $libro)
      <tr data-id="{{$libro->id}}">
        <th>{{$libro->id}}</th>
        <th>{{$libro->titulo}}</th>
        <td>{{$libro->autor}}</td>
        <td class="text-center">{{$libro->precioCompra}}</td>
        <td class="text-center">{{$libro->precioVenta}}</td>
        <td class="text-center">{{$libro->cantidadActual}}</td>
        <td class="text-center">{{$libro->estado}}</td>
        <td class="text-center">{{$libro->fechaPublicacion}}</td>
        <td> <a title="Eliminar libro" style="cursor: pointer" class="mr-4 btnEliminar"><i style="font-size: 25px; color: red;" class="mdi mdi-delete "></i></a>      <a style="cursor: pointer" title="Editar libro : {{$libro->titulo}} o ver sus catalogos o generos"><i style="font-size: 25px; color: red;" class="mdi mdi-rename-box btnSeleccionar"></i></a></td>
      </tr>
      @endforeach
    </tbody>

  
  
  {!!Form::open(['route' => ['destroyLibro',':codigoLibro'], 'method'=>'DELETE', 'id'=>'form-eliminar']) !!}

  {!!Form::close() !!}
  {!!Form::open(['route' => ['selectLibro',':codigoLibro'], 'method'=>'POST', 'id'=>'form-seleccionar']) !!}

  {!!Form::close() !!}
  
 


  <!-- MODAL PARA REGISTRAR -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Libro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class=""><b>Datos Generales</b></h2>
                   <br>
                   {!!Form::open(['route' => ['insertLibro','catalogos'], 'method'=>'POST', 'id'=>'form-guardar']) !!}
                     <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="id" placeholder="ISBN" >
                      </div>
                      <div class="form-group">
                            <label>Titulo</label>
                            <input type="text" class="form-control" name="titulo" placeholder="Titulo" >
                          </div>
                    <div class="form-group">
                                <label>Autor</label>
                                <input type="text" class="form-control" name="autor" placeholder="Autor" >
                              </div>
                              <div class="form-group">
                                    <label>Precio de compra</label>
                                    <input type="number" class="form-control" name="precioCompra" placeholder="Precio de compra" >
                                  </div>
                                  <div class="form-group">
                                        <label>Precio de venta</label>
                                        <input type="number" class="form-control" name="precioVenta" placeholder="Precio de venta" >
                                      </div>
                                      <div class="form-group">
                                            <label>Fecha de publicacion</label>
                                            <input type="date" class="form-control" name="fechaPublicacion" placeholder="Fecha" >
                                          </div>        
                                                <div class="form-group">  
                                                    <label><b>Generos o catalogos relacionados</b></label><br>
                                                    @php
                                                    $cont = 1;
                                                    @endphp
                                                    @foreach ($Catalogos as $catalogo)
                                                    <input style='cursor:pointer; margin-left: 0px;' class='form-check-input' id="catalogo{{$cont}}" value='{{$catalogo->id}}' type='checkbox' >
                                                    <label style='margin-top: 5px; margin-left: 7px;' class='col-md-11'>{{$catalogo->categoria}}</label> <br>
                                                    @php
                                                    $cont++;
                                                    @endphp   
                                                    @endforeach
                                                    
                                                </div>
                                          
                      <button class="btn btn-success mr-2 btnGuardar">Registrar</button>
                
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


  <!-- MODAL PARA EDITAR -->
  <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Libro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class=""><b>Datos Generales</b></h2>
                   <br>
                   {!!Form::open(['route' => ['updateLibro','catalogos'], 'method'=>'POST', 'id'=>'form-editar']) !!}
                   <div class="form-group">
                    <label>ISBN</label>
                    <input id="id" type="text" class="form-control" name="id" placeholder="ISBN" >
                  </div>
                  <div class="form-group">
                        <label>Titulo</label>
                        <input id="titulo" type="text" class="form-control" name="titulo" placeholder="Titulo" >
                      </div>
                <div class="form-group">
                            <label>Autor</label>
                            <input id="autor" type="text" class="form-control" name="autor" placeholder="Autor" >
                          </div>
                          <div class="form-group">
                                <label>Precio de compra</label>
                                <input id="precioCompra" type="number" class="form-control" name="precioCompra" placeholder="Precio de compra" >
                              </div>
                              <div class="form-group">
                                    <label>Precio de venta</label>
                                    <input id="precioVenta" type="number" class="form-control" name="precioVenta" placeholder="Precio de venta" >
                                  </div>
                                  <div class="form-group">
                                        <label>Fecha de publicacion</label>
                                        <input id="fechaPublicacion" type="date" class="form-control" name="fechaPublicacion" placeholder="Fecha" >
                                      </div>  
                                      <div class="form-group">
                                        <label>Catalogos Actuales</label>
                                        <div id="catalogosactuales">
                                        </div>
                                      </div> 
                                                <div class="form-group">  
                                                    <label><b>Nuevos generos o catalogos relacionados</b></label><br>
                                                    @php
                                                    $cont = 1;
                                                    @endphp
                                                    @foreach ($Catalogos as $catalogo)
                                                    <input style='cursor:pointer; margin-left: 0px;' class='form-check-input' id="catalogoEditar{{$cont}}" value='{{$catalogo->id}}' type='checkbox' >
                                                    <label style='margin-top: 5px; margin-left: 7px;' class='col-md-11'>{{$catalogo->categoria}}</label> <br>
                                                    @php
                                                    $cont++;
                                                    @endphp   
                                                    @endforeach
                                                    <br><br>
                                                    <input style='cursor:pointer; margin-left: 0px;' class='form-check-input' id="cambiarcatalogos"  type='checkbox' >
                                                    <label style='margin-top: 5px; margin-left: 7px;' class='col-md-11'><i>Deseo cambiar los generos actuales a los seleccionados anteriormente</label></i>  <br>
                                                   
                                                </div>
                                          
                      <button class="btn btn-success mr-2 btnEditar">Guardar Cambios</button>
                
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





  
    
    </table>
    </div>
    </div>
    <script src="jsAdministrador/libro.js"></script>

   
@endsection