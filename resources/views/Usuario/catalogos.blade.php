@extends('Usuario.layout')
@section('title')
    Catalogos
@endsection
@section('content')


<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
          
        <h1 class=""><b>Listado de libros por catalogos</b> </h1><br>
        <div class="row">
            <div class="col-md-8">
                    <label>Catalogo</label>
                    <select class=" form-control form-control-sm col-md-6" id="detalle" >
                            @foreach($Catalogos as $catalogo) 
                            <option value="{{$catalogo->id}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$catalogo->categoria}}</font></font></option>
                            @endforeach
                    </select>
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
            <th scope="col"><b>ISBN</b></th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Precio</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha de publicacion</th>
    </tr>
  </thead>

  <tbody id="bodytable">
  
  </tbody>
  
 
    </table>
    </div>
    </div>
    <script src="jsAdministrador/catalogo.js"></script>

@endsection