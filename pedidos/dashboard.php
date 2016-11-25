<?php
require("../restritos.php"); 
require_once '../init.php';
$cPed = "active";
$PDO = db_connect();
require '../QueryUser.php';
$ChPed = "SELECT * FROM pedido WHERE Status = 'P' ORDER BY DataCadastro DESC";
$Ped = $PDO->prepare($ChPed);
$Ped->execute();

$ChPed2 = "SELECT * FROM pedido WHERE Status = 'F' ORDER BY DataCadastro DESC";
$Ped2 = $PDO->prepare($ChPed2);
$Ped2->execute();
$dt = date("d/m/Y - H:i:s");

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
  <h1>PCP - Pedidos de Montagem<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
    <?php if ($PermAdm === "1") { ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#novoPed"">
      <span class="info-box-icon bg-purple">
       <i class="fa fa-plus"></i>
      </span>
     </a>
     <div class="info-box-content"><br /><h4>Nova Montagem</h4></div>
    </div>
   </div>
   <?php } else { } ?>
      <div class="col-md-12">
       <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
         <li class="active"><a href="#pendente" data-toggle="tab">PENDENTES</a></li>
         <li><a href="#final" data-toggle="tab">FINALIZADOS</a></li>
         <li class="pull-left header"><i class="fa fa-th"></i> Lista de Pedidos</li>
        </ul>
        <div class="tab-content">
         <div class="tab-pane active" id="pendente">
          <table id="tabFin" class="table table-hover table-responsive">
           <thead>
            <tr>
             <td>User</td>
             <td>Data pedido</td>
             <td>Prazo</td>
             <td>Modelo</td>
             <td>Quant</td>
             <td>Obs</td>
             <td></td>
            </tr>
           </thead>
           <tbody>
           <?php while ($p = $Ped->fetch(PDO::FETCH_ASSOC)): 
            echo '<tr>';
             echo '<td>' . $p["NomeUser"] . '</td>';
             echo '<td>' . $p["DataCadastro"] . '</td>';
             echo '<td>' . $p["DataPrazo"] . '</td>';
             echo '<td>' . $p["Modelo"] . '</td>';
             echo '<td>' . $p["Quantidade"] . '</td>';
             echo '<td class="texto">' . $p["Obs"] . '</td>';
             if ($PReteste === "1") {
            echo '<td><a class="btn btn-success btn-block btn-xs" href="';
            echo "javascript:abrir('Finaliza.php?ID=" . $p["id"] . "');";
            echo '"><i class="fa fa-thumbs-up"> </i></a></td>';           
            } else{
              echo '<td></td>';
            }
            echo '</tr>';
            endwhile;
             ?>

           </tbody>
          </table>
         </div>
         <div class="tab-pane" id="final">
          <table id="tabPen" class="table table-hover table-responsive">
           <thead>
            <tr>
             <td>User</td>
             <td>Data pedido</td>
             <td>Prazo</td>
             <td>Modelo</td>
             <td>Quant</td>
             <td>Obs</td>
            </tr>
           </thead>
           <tbody>
           <?php while ($p2 = $Ped2->fetch(PDO::FETCH_ASSOC)): 
            echo '<tr>';
             echo '<td>' . $p2["NomeUser"] . '</td>';
             echo '<td>' . $p2["DataCadastro"] . '</td>';
             echo '<td>' . $p2["DataPrazo"] . '</td>';
             echo '<td>' . $p2["Modelo"] . '</td>';
             echo '<td>' . $p2["Quantidade"] . '</td>';
             echo '<td class="texto">' . $p["Obs"] . '</td>';           
            echo '</tr>';
            endwhile;
             ?>

           </tbody>
          </table>
         </div>
        </div>
       </div>
      </div>

<!-- MODAL DE CADASTRO DE FIRMWARE DE LINHA -->
<div id="novoPed" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-purple">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Novo Pedido</h4>
   </div>
   <div class="modal-body">
    <form name="EdCad" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-xs-4">Data do Prazo
      <div class="input-group">
       <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
        <input type="text" name="Prazo" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
      </div>
     </div>
     <div class="col-md-4 col-xs-12">Modelo
      <input class="form-control" type="text" name="modelo" required="required">
     </div>
     <div class="col-md-4 col-xs-12">Quantidade
      <input class="form-control" type="number" name="qnt" required="required">
     </div>
     <div class="col-xs-12">Observações
      <textarea name="obs" cols="45" rows="3" class="form-control" id="obs"></textarea><hr>
     </div>
     <div class="pull-right">
      <input name="novoProduto" type="submit" class="btn bg-purple btn-flat" id="novoProduto" value="CADASTRAR PRODUTO"  /> 
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">FECHAR</button>
     </div>
    </form>
    <?php
    if(@$_POST["novoProduto"]){
     $prazo = $_POST["prazo"];
     $modelo = $_POST["modelo"];
     $qnt = $_POST["qnt"];
      $Obs = str_replace("\r\n", "<br/>", strip_tags($_POST["obs"]));

     // $qnt = data
      $Add = $PDO->query("INSERT INTO pedido (NomeUser, DataCadastro, DataPrazo, Obs, Modelo, Quantidade, Status) VALUES ('$NomeUserLogado', '$dt', '$prazo', '$Obs', '$modelo', '$qnt', 'P')");
        if ($Add) {
         echo '
              <script type="text/JavaScript">alert("Cadastrado com Sucesso!");
              location.href="dashboard.php"</script>';
        }
        else{
         echo '<script type="text/javascript">alert("Não foi possível. Erro: 0x03");</script>';
        }


      }

      ?>

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- FINAL DO MODAL DE CADASTRO DE FIRMWARE DE LINHA -->


  </div>
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php 
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
    $("#tabPen").DataTable();
    $("#tabFin").DataTable();
  });
</script>
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
