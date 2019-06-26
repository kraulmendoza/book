
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Libro Movil | Login</title>
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
  <link rel="shortcut icon" href="estiloUsuario/images/icono.png" type="image/x-icon">
    <link rel="icon" href="estiloUsuario/images/icono.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

 
</head>

<body>
  <div class="container-scroller">
  <div class="header-logo">
     

  
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                {!!Form::open(['route' => ['logueo'], 'method'=>'POST', 'id'=>'form-login']) !!}
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="label">Usuario</label>
                  <div class="input-group">
                    <input name="usuario" id="usuario" type="text" class="form-control" placeholder="Nombre de Usuario">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Contraseña</label>
                  <div class="input-group">
                    <input name="password" id="password" type="password" class="form-control" placeholder="*********">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <a style="color:white;" id="btnEntrar" class="btn btn-primary btn-block">Entrar</a>
                </div>
                <div class="form-group">
                <div style="display: none;" id="alert" class="alert form-control"></div>
              </div>                
              {!!Form::close() !!}
                        </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Condiciones</a>
              </li>
              <li>
                <a href="#">Ayuda</a>
              </li>
              <li>
                <a href="#">Terminos</a>
              </li>
            </ul>
            <p class="footer-text text-center">Universidad Popular de cesar - Libro Movil</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="estiloAdministrador/vendors/js/vendor.bundle.base.js"></script>
  <script src="estiloAdministrador/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="estiloAdministrador/js/off-canvas.js"></script>
  <script src="estiloAdministrador/js/misc.js"></script>
  <script src="jsUsuario/login.js"></script>
  <!-- endinject -->
</body>

</html>