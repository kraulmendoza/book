@if (Session::get('usuario') == null or Session::get('rol')!="1")
<script> location.href="Login"</script>
@endif
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title','default')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="estiloAdministrador/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="estiloAdministrador/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="estiloAdministrador/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="estiloAdministrador/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="estiloAdministrador/logomini.jpg">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <link rel="icon" href="estiloUsuario/images/icono.png" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
     #colorarriba{
        background: linear-gradient(120deg, #ef0606, #007bff);
     } 
  </style>
<script>
 $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
     }
 }); 
</script>
<style>

</style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav id="colorarriba" class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <img id="imglogo" src="estiloAdministrador/logo.png" alt="logo" class="float-left"> 
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img id="imglogomini" src="estiloAdministrador/logomini.png" alt="logo">
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        
        <ul class="navbar-nav navbar-nav-right">
                  
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hola, {{Session::get('nombre','no existe')}} {{Session::get('apellido','no existe')}}!</span>
              <img class="img-xs rounded-circle" src="estiloAdministrador/images/faces/admin.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a href="CerrarSesion" class="dropdown-item"> Salir </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="estiloAdministrador/images/faces/admin.png" alt="profile image">

                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Session::get('nombre','no existe')}} {{Session::get('apellido','no existe')}}</p>
                  <div>
                    <small class="designation text-muted">En linea</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              
              <a href="Abastecimientos" class="btn btn-success btn-block">+ Nueva compra<i class="mdi "></i></a>
              </button>
              
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="MiPerfil">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Mi perfil</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="CatalogosLibreria">
              <i class="menu-icon mdi mdi-book-multiple"></i>
              <span class="menu-title">Catalogos</span>
            </a>
          </li>
          <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="menu-icon mdi mdi-trending-up"></i>
                  <span class="menu-title">Mis compras</span>
                </a>
              </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
           

         @yield('content','')

        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Universidad Popular del cesar</span>
           
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="estiloAdministrador/vendors/js/vendor.bundle.base.js"></script>
  <script src="estiloAdministrador/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="estiloAdministrador/js/off-canvas.js"></script>
  <script src="estiloAdministrador/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="estiloAdministrador/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>