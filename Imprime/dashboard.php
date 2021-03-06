<?php
require("../restritos.php"); 
require_once '../init.php';
$cMont = "active";
$PDO = db_connect();
require '../QueryUser.php';
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo $titulo; ?></title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
<div class="wrapper">
 <header class="main-header">
  <a href="#" class="logo">
   <span class="logo-mini"><img src="../dist/img/logo/logoWhite.png" width="50"/></span>
   <span class="logo-lg"><img src="../dist/img/logo/logoWhite.png" width="180" /></span>
  </a>
  <nav class="navbar navbar-static-top">
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Minizar Navegação</span>
   </a>
   <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
     <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
       <span class="hidden-xs"><?php echo $NomeUserLogado; ?></span>
      </a>
      <ul class="dropdown-menu">
       <li class="user-header">
        <p><?php echo $NomeUserLogado; ?></p>
       </li>
       <li class="user-footer">
        <div class="pull-left">
         <a href="../user/perfil.php" class="btn btn-info">Dados de Perfil</a>
        </div>
        <div class="pull-right">
         <a href="../logout.php" class="btn btn-danger">Sair</a>
        </div>
       </li>
      </ul>
     </li>
     <li>
       <a href="../logout.php" class="btn btn-danger btn-flat">Sair</a>
     </li>
    </ul>
    </div>
    </nav>
  </header>
  <aside class="main-sidebar">
   <section class="sidebar">
    <?php include_once '../menuLateral.php'; ?>
    </section>
  </aside>
<div class="content-wrapper">
 <section class="content-header">
  <h1>Montagem de Equipamentos<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
   <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#P1510">
       <span class="info-box-icon bg-aqua">
        <i class="fa fa-wrench"></i>
       </span>
     </a>
     <div class="info-box-content"><h4> Ponto 1510</h4></div>
    </div>
   </div>
   <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#P373">
       <span class="info-box-icon bg-aqua">
        <i class="fa fa-wrench"></i>
       </span>
     </a>
     <div class="info-box-content"><h4> Ponto 373</h4></div>
    </div>
   </div>
   <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#PAcc">
       <span class="info-box-icon bg-aqua">
        <i class="fa fa-wrench"></i>
       </span>
     </a>
     <div class="info-box-content"><h4>Acesso</h4></div>
    </div>
   </div>
   <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#Carto">
       <span class="info-box-icon bg-aqua">
        <i class="fa fa-wrench"></i>
       </span>
     </a>
     <div class="info-box-content"><h4>Cartográficos</h4></div>
    </div>
   </div>
  </div>
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php 
include_once 'Modal.php';
include_once '../footer.php'; 
?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>
<script language="JavaScript">
function abrir(URL) {
 
  var width = 950;
  var height = 650;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
</body>
</html>
