@extends('Administrador.layout')
@section('title')
    Transacciones-Abastecimiento
@endsection
@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
          
        <h1 class=""><b>Transacciones - Listado de Abastecimientos </b> </h1><br>
        <div class="row">
            <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                            + Nuevo Abastecimiento
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
      <th scope="col" class="text-center"><b>N°</b></th>
      <th scope="col" class="text-center"><b>Fecha de Realizacion</b></th>
      <th scope="col" class="text-center">Proveedor</th>
      <th scope="col" class="text-center">Valor Neto Pagado</th>
      <th scope="col" class="text-center">Detalles</th>
      <!-- <th scope="col">Usuario</th>
      <th scope="col">Contraseña</th> -->
    </tr>
  </thead>

  <tbody id="bodytable">
      @php
          $cont=1;
      @endphp
  	@foreach($Compras as $compra)
    <tr data-id="{{$compra->id}}">
        
      <th class="text-center">{{$cont}}</th>
      <th class="text-center">{{$compra->fecha}}</th>
      <td class="text-center">{{$compra->nombre_Provedor}}</td>
      <td class="text-center"><b>{{$compra->valorNeto}} </b></td>         
      <td class="text-center"> <a title="Ver lo detalles de esta factura" style="cursor: pointer" class="mr-4 btnVerDetalles"><i style="font-size: 25px; color: red;" class="mdi mdi-format-list-bulleted-type "></i></a>     </td>
      @php
          $cont++;
      @endphp
    </tr>
    @endforeach
  </tbody>
  

  
  {!!Form::open(['route' => ['selectDetalles',':codigoCompra'], 'method'=>'POST', 'id'=>'form-ver-detalles']) !!}

  {!!Form::close() !!}




  <!-- MODAL PARA REGISTRAR -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Abastecimiento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class=""><b>Transaccion</b></h2>
                   <br>
                   {!!Form::open(['route' => ['insertAbastecimiento'], 'method'=>'POST', 'id'=>'form-guardar']) !!}

                  
                     <div class="form-group">
                        <label>Provedor</label>
                        <select class=" form-control form-control-sm" id="codigo_Provedor" name="codigo_Provedor" >
                                @foreach($Provedores as $provedor) 
                                <option value="{{$provedor->id}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$provedor->nombre}}</font></font></option>
                                @endforeach
                        </select>
                      </div>
                      <hr>
                            <div class="form-group">
                                          <label>Libro</label>
                                          <select class=" form-control form-control-sm col-md-6" id="detalle" >
                                                  @foreach($Libros as $libro) 
                                                  <option value="{{$libro->id}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$libro->titulo}}</font></font></option>
                                                  @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                              <label>Cantidad</label>
                                              <input id="cantidad" type="text" class="form-control" placeholder="Cantidad" >
                                      </div>
                                      <div class="form-group">
                                            <label><i>Total de libros a abastecer en esta compra: <b id="totalcarrito">0</b></i></label>
                                    </div>
                                      <hr>
                                      <div class="form-group">
                      <button id="agregarlibro" class="btn btn-info mr-2">+ Agregar otro libro</button>
                      <button id="btnGuardar" class="btn btn-success mr-2">Registrar </button>
                </div>
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
  <div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Ver detalles de factura</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h2 class=""><b>Detalles de factura</b></h2>
                       <br>
                         <div id="infodetalles" class="form-group">
                           
                          </div>
                          
                    
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
    <script src="jsAdministrador/detalleCompra.js"></script>

@endsection