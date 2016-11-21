<?php
require("../restritos.php"); 
require_once '../init.php';
$cReteste = "active";
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

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
  <h1>Controle de Reteste<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
   <div class="col-xs-12">
    <div class="nav-tabs-custom">    
     <ul class="nav nav-tabs pull-right">
      <li class="active"><a href="#1510" data-toggle="tab">Ponto 1510/INMETRO</a></li>
      <li><a href="#373" data-toggle="tab">Ponto 373</a></li>
      <li><a href="#acesso" data-toggle="tab">Acesso</a></li>
      <li class="pull-left header">
        <i class="fa fa-exclamation-triangle"></i> Lista de Equipamentos
      </li>
     </ul>
     <div class="tab-content no-padding">
      <div class="chart tab-pane active" id="1510">
      <?php include_once 'tabelas/Reteste1510.php'; ?>
      </div>
      <div class="chart tab-pane" id="373" >
      <?php include_once 'tabelas/Reteste373.php'; ?>
      </div>
      <div class="chart tab-pane" id="acesso">
      <?php include_once 'tabelas/RetesteAcesso.php'; ?>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php 
include_once 'ModalRelogios.php';
include_once '../footer.php'; 

?>
</div>
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="../dist/js/demo.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script>
  $(function () {
    $("#Reteste373").DataTable();
    $("#Reteste1510").DataTable();
    $("#RetesteAcesso").DataTable();
  });
</script>
<script language="JavaScript">
function abrir(URL) {
 
  var width = 1000;
  var height = 650;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
</body>
</html>
