<?php
session_start();
$idUsuario=$_SESSION['IdUsuario'];
if (!isset($_SESSION['NombreUsuario'])) {
  header("location: login.php?Error=401");
  //este cambio no es valido
}
//este cambio no es valido
else {
  include "assets/Databases/conection.php";
  $IdUsers = $_SESSION['IdUsuario'];
  $sql = "select * from Users where idUsers=" . $IdUsers;
  $result = $cn->query($sql);
  $userImage = $result->fetch(PDO::FETCH_OBJ);
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>Ayudemos Teziutlán</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top navbar-expand-lg" color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="#">
          Apoyemos Teziutlán </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a href="javascript:;" class="nav-link">
              Vacantes
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:;" class="btn btn-rose btn-raised btn-fab btn-round" data-toggle="dropdown">
              <i class="material-icons">email</i>
            </a>
          </li>
          <li class="dropdown nav-item">
            <a href="javascript:;" class="profile-photo dropdown-toggle nav-link" data-toggle="dropdown">
              <div class="profile-photo-small">
                <img src="assets/Databases/getImage.php?IdUsers=<?php echo $userImage->idUsers ?>" alt="Circle Image" class="rounded-circle img-fluid">
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <h6 class="dropdown-header">Perfil</h6>
              <a href="javascript:;" class="dropdown-item">Datos</a>
              <a href="assets/Databases/logout.php" class="dropdown-item">Cerrar Sesión</a>
            </div>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('assets/Databases/img/teziutlan.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1 class="title text-center">Apoyemos Teziutlán</h1>
            <h3 class="brand text-center">Encontremos un trabajo para ti</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
        <div class="section section-white">
          <div class="container">
            <!--                 nav pills -->
            <div id="navigation-pills">

              <div class="row">

                <div class="col-lg-12 col-md-12">
                  <div class="row">
                    <div class="col-md-3">
                      <ul class="nav nav-pills nav-pills-icons flex-column" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" href="#dashboard-1" role="tab" data-toggle="tab">
                            <i class="material-icons">dashboard</i>
                            Vacantes
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#schedule-3" role="tab" data-toggle="tab">
                            <i class="material-icons">schedule</i>
                            Favoritos
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-8">
                      <div class="tab-content">
                        <div class="tab-pane active" id="dashboard-1">
                          <div class="row">

                          <?php
                          include "assets/Databases/conection.php";
                          $sql = "SELECT b.idBanner, b.Title, b.Description, b.Salary, e.idUsers, u.Name from Banner as b inner join Enterprise as e on b.idEnterprise=e.idEnterprise inner join Users as u on e.idUsers=u.idUsers";
                          $resultado=$cn->query($sql);
                          $banner=$resultado->fetchAll(PDO::FETCH_OBJ);
                          foreach($banner as $banner){
                            echo '<div class="col-md-6">';
                            echo ' <div class="card">';
                            echo ' <div class="card-header">';
                            echo "<h4 class='card-title'>".$banner->Name."<h4>";
                            echo "<h4><p class='category'>".$banner->Title."</p></h4>";
                            echo "<p class='category'>".$banner->Description."</p>";
                            
                            echo '</div>';
                            echo ' <div class="card-body">';
                            echo "<p class='category'>Salario: ".$banner->Salary."</p>";
                            echo '  </div>';
                           echo "<a href='assets/Databases/agregarfavorito.php?Idbanner=".$banner->idBanner."' class='btn btn-primary btn-round' id='btnEditar'>Agregar a Favoritos </a>";
                            echo '</div>';
                            echo '</div>';
                          }
                           ?>

                           
                          </div>
                        </div>
                        <div class="tab-pane" id="schedule-3">
                          <div class="tab-pane active" id="dashboard-2">
                          <div class="row">

                          <?php
                          include "assets/Databases/conection.php";
                          $sql = "SELECT b.Title, b.Description, b.Salary, e.idUsers, u.Name from Banner as b inner join Enterprise as e on b.idEnterprise=e.idEnterprise inner join Users as u on e.idUsers=u.idUsers inner join Favorites as f where f.idUsers='".$idUsuario."' and b.idBanner=f.idBanner";
                          $resultado=$cn->query($sql);
                          $banner=$resultado->fetchAll(PDO::FETCH_OBJ);
                          foreach($banner as $banner){
                            echo '<div class="col-md-6">';
                            echo ' <div class="card">';
                            echo ' <div class="card-header">';
                            echo "<h4 class='card-title'>".$banner->Name."<h4>";
                            echo "<h4><p class='category'>".$banner->Title."</p></h4>";
                            echo "<p class='category'>".$banner->Description."</p>";
                            
                            echo '</div>';
                            echo ' <div class="card-body">';
                            echo "<p class='category'>Salario: ".$banner->Salary."</p>";
                            echo '  </div>';
                           echo "<a href='login.php?IdUser=".$banner->idUsers."' class='btn btn-primary btn-round' id='btnEditar'>Agregar a Favoritos </a>";
                            echo '</div>';
                            echo '</div>';
                          }
                           ?>

                           
                          </div>

                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--                 end nav pills -->
          </div>
          <!--                 end nav pills -->
        </div>
      </div>
    </div>
  </div>
  </div>



















  <footer class="footer footer-default">
    <div class="container">

      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made by
        <a href="https://www.facebook.com/martin.gonzalezmiranda/" target="blank">Martín González Miranda</a>.
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>