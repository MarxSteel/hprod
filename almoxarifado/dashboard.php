<?php
require("restritos.php"); 
require_once 'init.php';
$cHome = "active";
$PDO = db_connect();
require 'QueryUser.php';
  $ChamaLaudo = "SELECT * FROM laudo ORDER BY id DESC";
  $L1 = $PDO->prepare($ChamaLaudo);
  $L1->execute();
  $ChamaLaudo2 = "SELECT * FROM laudo WHERE Status='2' ORDER BY id DESC";
  $L12 = $PDO->prepare($ChamaLaudo2);
  $L12->execute();
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo $titulo; ?></title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
 <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
 <header class="main-header">
  <nav class="navbar navbar-static-top">
   <div class="container">
    <div class="navbar-header">
     <a href="" class="navbar-brand"><img src="dist/img/logo/logoWhite.png" width="140"/></a>
    </div>
    <div class="navbar-custom-menu">
     <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs"><?php echo $NomeUserLogado; ?></span>
       </a>
      </li>
      <li class="dropdown user user-menu">
       <a href="logout.php" class="btn btn-danger btn-flat">SAIR</a>
      </li>
     </ul>
    </div>
   </div>
  </nav>
 </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>Almoxarifado - Controle de Laudos de Teste</h1>
      </section>
      <section class="content">
      <?php
      if ($CadastraPeca === "1") { ?>
       <div class="row">
        <div class="col-md-4 col-xs-12">
         <div class="info-box">
          <a data-toggle="modal" data-target="#novoLaudo"">
           <span class="info-box-icon btn-danger"><i class="fa fa-plus"></i></span>
          </a>
          <div class="info-box-content"><br /><h4>Cadastrar Nova nota</h4></div>
         </div>
        </div>
       </div>
       <?php } else{ } 
      if (isset($_GET["mensagem"])) 
      {
       echo '<div class="alert alert-warning alert-dismissible">';
       echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
       echo '<h4><i class="icon fa fa-exclamation"></i> Atenção!</h4>';
       echo $_GET["mensagem"]; 
       echo '</div>';
      }
      ?>

      <div class="box box-default">
       <div class="box-header with-border">
        <h3 class="box-title">LISTA DE PEDIDOS DE LAUDO DE TESTE</h3>
       </div>
       <div class="box-body">
        <table id="laudos" class="table table-bordered table-striped">
         <thead>
          <tr>
           <th width="5%">#</th>
           <th width="15%">Data</th>
           <th width="50%">Item</th>
           <th width="10%">Status</th>
           <th width="8%"></th>
           <th width="12%"></th>
          </tr>
         </thead>
         <tbody>
          <?php 
            while ($L = $L1->fetch(PDO::FETCH_ASSOC)): 
             echo '<tr>';
              echo '<td>' . $L['id'] . '</td>';
              echo '<td>' . $L['dataCadastro'] . '</td>';
              echo '<td>' . $L['Item'] . '</td>';
              $Status = $L['Status'];
              if ($Status === "1") 
              {
               echo '<td>';
               echo '<button class="btn bg-orange btn-block btn-xs disabled">ENVIADO</button>';
               echo '</td>';
                if ($RecebePeca === "1") 
                {
                 echo '<td><a class="btn bg-olive btn-block btn-xs" href="';
                 echo "javascript:abrir('Recebe.php?ID=" . $L['id'] . "');";
                 echo '"><i class="fa fa-plus"> RECEBER</i></a></td>';
                }
                else{
                  echo "<td></td>";
                }
              }
              elseif ($Status === "2") 
              {
               echo '<td>';
               echo '<button class="btn btn-info btn-block btn-xs disabled">AGUARDANDO REVISÃO</button>';
               echo '</td>';
               echo '<td><a class="btn bg-navy btn-block btn-xs" href="';
                echo "javascript:abrir('Preencher.php?ID=" . $L['id'] . "');";
                echo '"><i class="fa fa-plus">LAUDO</i></a></td>';
              }
              elseif ($Status === "3") 
              {
               echo '<td>';
                echo '<button class="btn btn-success btn-block btn-xs disabled">APROVADO</button>';
               echo '</td>';
               $LkL = $L['Laudo'];
               echo '<td>';
                if ($RecebePeca === "1") 
                {
                 echo '<a href="laudos/' . $LkL . ' " target="_blank" class="btn btn-default btn-xs"><i class="fa fa-download"></i>BAIXAR </a>';
                }
                else { }
                 echo '</td>';
                }
                elseif ($Status === "4") 
                {
                 echo '<td>';
                  echo '<button class="btn btn-danger btn-block btn-xs disabled">REPROVADO</button>';
                 echo '</td>';
                if ($RecebePeca === "1") 
                {
                 echo '<td><a class="btn bg-olive btn-block btn-xs" href="';
                 echo "javascript:abrir('Preencher.php?ID=" . $L['id'] . "');";
                 echo '"><i class="fa fa-plus"> RECEBER</i></a></td>';
                }
                else{
                  echo "<td></td>";
                }
              }
              echo '<td><a class="btn btn-warning btn-xs" href="';
              echo "javascript:abrir('vProduto.php?ID=" . $L['id'] . "');";
              echo '"><i class="fa fa-search"> </i> VISUALIZAR</a>&nbsp;';
              if ($Deletar === "1") {
              echo '<a class="btn btn-danger btn-xs" href="';
              echo "javascript:abrir('deleta.php?ID=" . $L['id'] . "');";
              echo '"><i class="fa fa-close"> </i></a></td>';
              }

             echo '</tr>';
             endwhile;
          ?>
          </tbody>
        </table>
       </div>
      </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
<?php 
include_once 'ModalAlmox.php';
include_once 'footer.php'; ?>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $('#laudos').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script language="JavaScript">
function abrir(URL) { 
  var width = 1200;
  var height = 650;
  var left = 99;
  var top = 99;
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}
</script>
</html>
