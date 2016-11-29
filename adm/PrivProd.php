<?php
 require("../restritos.php"); 
 require_once '../init.php';
 $PDO = db_connect();
require_once '../QueryUser.php';

   $id = $_GET['ID'];
   $dFor = $PDO->prepare("SELECT * FROM login WHERE codLogin='$id'");
   $dFor->execute();
    $campo = $dFor->fetch();
    $Nome = $campo['Nome'];
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $Titulo; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style type="text/css">
.texto {
word-wrap: break-word;
}
</style>
</head>
<body class="hold-transition <?php echo $cor; ?> layout-top-nav">
<div class="wrapper">
 <header class="main-header">
  <nav class="navbar navbar-static-top">
   <div class="container">
    <div class="navbar-header">
     <img src="../dist/img/logo/logoWhite.png" width="150" />
    </div>
    <div class="navbar-custom-menu">
     <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Olá, <?php echo $NomeUserLogado; ?></span>
       </a>
      </li>
     </ul>
    </div>
   </div>
  </nav>
 </header>
 <div class="content-wrapper">
  <div class="container">
   <section class="content">
    <div class="box box-default">
     <div class="box-body">
      <div class="col-xs-6">
       <li class="list-group-item">
        <b>Nome do Usuário:</b>
         <a class="pull-right"><?php echo $Nome; ?></a>
       </li>
      </div>
      <div class="col-xs-6">
       <li class="list-group-item"> 
        <b>Login Usuário:</b>
         <a class="pull-right"><?php echo $Nome; ?></a>
       </li>
      </div>
      <div class="col-xs-12">
       <form name="recebeItem" id="name" method="post" action="" enctype="multipart/form-data">
        <div class="col-xs-12"><h3> Dados de Cartão</h3></div>
        <div class="col-xs-3">Wiegand
         <input name="wiegand" type="text" class="form-control" id="wiegand" minlength="8" maxlength="20" required="required"/>
        </div>
        <div class="col-xs-3">Abatrack
         <input name="aba" type="text" class="form-control" id="aba" minlength="8" maxlength="20" required="required"/>
        </div>
        <div class="col-xs-3">SmartCard
         <input name="mifare" type="text" class="form-control" id="mifare" minlength="8" maxlength="20" required="required"/>
        </div>
        <div class="col-xs-3">IP
         <input name="ip" type="text" class="form-control" id="ip" minlength="13" maxlength="15" required="required"/>
        </div>
        <div class="col-xs-12">Privilégios</div>
        <div class="col-xs-4">Montagem
         <select class="form-control" name="montagem" id="montagem" required="required">
          <option value="" checked="checked"> >>SELECIONE<<</option>
          <option value="1"> Pode montar relógios</option>
          <option value="0"> Não pode montar</option>
         </select>
        </div>
        <div class="col-xs-4">Reteste
         <select class="form-control" name="reteste" id="reteste" required="required">
          <option value="" checked="checked"> >>SELECIONE<<</option>
          <option value="1"> Pode Retestar relógios</option>
          <option value="0"> Não pode Retestar</option>
         </select>
        </div>
        <div class="col-xs-4">Catracas
         <select class="form-control" name="cat" id="cat" required="required">
          <option value="" checked="checked"> >>SELECIONE<<</option>
          <option value="1"> Cadastra Catracas</option>
          <option value="0"> Não pode Cadastrar</option>
         </select>
        </div>
        <div class="col-xs-12"><br /><br /><br />
         <input name="recebeItem" type="submit" class="btn bg-olive btn-flat btn-block btn-lg" id="recebeItem" value="ATUALIZAR DADOS DO USUÁRIO"  /> 

       </form>
       <?php
        if(@$_POST["recebeItem"])
        {
         $cat = $_POST["cat"];            //PRIVILEGIOS PARA CADASTRAR CATRACA
         $montagem = $_POST["montagem"];  // P2M - PRIVILEGIO DE MONTAGEM
         $reteste = $_POST["reteste"];    // P2R - PRIVILEGIO DE RETESTE
         $wiegand = $_POST["wiegand"];    // CARTÃO WIEGAND DO USUÁRIO
         $aba = $_POST["aba"];            // CARTÃO ABATRACK DO USUARIO
         $mifare = $_POST["mifare"];      // CARTÃO MIFARE DO USUÁRIO
         $ip = $_POST["ip"];              // IP DE TRABALHO DO USUÁRIO 
         $DataRecebe = date('d/m/Y - H:i:s');
         $Recebe = $PDO->query("UPDATE login SET P2Mon='$montagem', P2Ret='$reteste', P2Cat='$cat', P2IP='$ip', CartaoWiegand='$wiegand', CartaoAba='$aba', CartaoSmart='$mifare' WHERE codLogin='$id'");
         if ($Recebe)
          {
          $Ev = "Atualizado Dados do Usuário";
        $InsLog = $PDO->query("INSERT INTO loglaudo (Evento, UserEvento, EventoID, DataCadastro) VALUES ('$Ev', '$NomeUserLogado', '6', '$DataRecebe')"); 
        if ($InsLog) 
        {
         echo '<script type="text/JavaScript">alert("Atualizado com Sucesso");</script>';
         echo '<script type="text/javascript">window.close();</script>';
        }
        else
        {
         echo '<script type="text/javascript">alert("Erro ao salvar Log");</script>';
        }
       }
        }
       ?>


      </div>
     </div>
    </section>
   </div>
  </div>
<?php include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>