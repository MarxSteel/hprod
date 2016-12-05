<?php
require("../restritos.php"); 
require_once '../init.php';
$cUsers = "active";
$PDO = db_connect();
require '../QueryUser.php';

$Chamauser = "SELECT * FROM login";
$QryUser = $PDO->prepare($Chamauser);
$QryUser->execute();
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
  <h1>Controle de Usuário<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
  <?php if ($PermAdm === "1") { ?>
     <div class="col-md-8">
      <div class="info-box">
        <table id="laudos" class="table table-bordered table-striped">
        <thead>
         <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Usuário</th>
          <th>IP</th>
          <th></th>
         </tr> 
        </thead>
        <tbody>
        <?php while ($User = $QryUser->fetch(PDO::FETCH_ASSOC)): 
         echo '<tr>';
         echo '<td>' . $User['codLogin'] .'</td>';
         echo '<td>' . $User['Nome'] . '</td>';
         echo '<td>' . $User['login'] . '</td>';
         echo '<td>' . $User['P2IP'] . '</td>';
         echo '<td>';
          echo '<a class="btn btn-danger btn-xs" href="javascript:abrir(';
          echo "'DeletaUser.php?ID=" . $User['codLogin'] . "');";
          echo '"><i class="fa fa-remove"></i></a>&nbsp;';
          echo '<a class="btn btn-primary btn-xs" href="javascript:abrir(';
          echo "'TrocaSenha.php?ID=" . $User['codLogin'] . "');";
          echo '"><i class="fa fa-lock"></i> Trocar Senha</a>&nbsp;';
          echo '<div class="btn-group">
                 <button type="button" class="btn btn-default btn-xs">
                  <i class="fa fa-refresh"></i> Trocar Privilégios
                 </button>';
          echo '<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
             <span class="caret"></span><span class="sr-only"></span></button>';
          echo '<ul class="dropdown-menu" role="menu">';
          echo '<li><a href="javascript:abrir(';
          echo "'PrivProd.php?ID=" . $User['codLogin'] . "');";
          echo '">Produção</a></li>';
          echo '<li><a href="javascript:abrir(';
          echo "'PrivAlmox.php?ID=" . $User['codLogin'] . "');";
          echo '">Almoxarifado</a></li>
                </ul>
                </div>
              </td>
             </tr>';
             endwhile;
        ?>
        </tbody>
        </table>  
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#NovoProd"">
       <span class="info-box-icon bg-yellow">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><br /><h4>Novo Usuário Produção</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#NovoAlmox"">
       <span class="info-box-icon bg-olive">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><br /><h4>Novo Usuário Almoxarifado</h4></div>
     </div>
    </div>
  <?php include_once 'ModalUser.php';  } else{ ?>
   <div class="col-md-12 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red">
      <i class="fa fa-exclamation-triangle"></i>
      </span>
      <div class="info-box-content">
       <h4><strong><i>Atenção!</i></strong></h4>
       <h4>Você não possui privilégios suficientes para abrir esta página. Contate o Administrador!</h4>
      </div>
     </div>
    </div>
    <?php } ?>
  </div>
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php include_once '../footer.php'; ?>
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
<script>
  $(function () {
    $("#laudo").DataTable();
  });
</script>
<script language="JavaScript">
function abrir(URL) {
 
  var width = 1000;
  var height = 500;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
</body>
</html>
