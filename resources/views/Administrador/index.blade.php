@extends('Administrador.layout')
@section('title')
    Panel Inicial
@endsection
@section('content')
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Total de capital</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">$1000000</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-location text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Clientes</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">@php
                  echo $totalUsuarios;
              @endphp</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Ultimo registro ayer </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Ventas</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">@php
                  echo $totalVentas;
              @endphp</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Ultima venta: @php
              echo $ultimaVenta['fecha'];
          @endphp </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-book text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Libros</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">@php
                  echo $totalLibros;
              @endphp</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> @php
              echo $totalProvedores;
          @endphp proveedores registrado </p>
      </div>
    </div>
  </div>
</div>

        </div>
      </div>
    
    </div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
 

@endsection


</html>