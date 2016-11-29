<?php
require("../../../restritos.php");
require_once '../../../init.php';
$PDO = db_connect();
include_once '../../../QueryUser.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LiberaREP - Henry Equipamentos e Sistemas</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
      <span class="logo-lg"><img src="../../../dist/img/logo/henry-top.png" width="200"></span>
     </div>
     <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Olá, <?php echo $Nick; ?></span></a>
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
      <div class="box-header with-border">
       <h2 class="box-title">CADASTRANDO EQUIPAMENTO</h2>
     </div>
     <div class="box-body">
      <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
       <div class="col-xs-6">NÚMERO DE SÉRIE
        <input name="numREP" type="text" class="form-control" minlength="6" maxlength="8" required="required"/>
       </div>
       <div class="col-xs-6">EQUIPAMENTO
        <select class="form-control" name="modelo" required="required">
         <option value="" checked="checked"> >>SELECIONE<<</option>
         <option value="Novo Vigia"> Novo Viga</option>
         <option value="Vigia RFID"> Vigia RFID</option>
        </select>
       </div>   
       <div class="col-xs-12">Observações
        <textarea name="desc" cols="45" rows="3" class="form-control"></textarea>
       </div>
       <div class="col-xs-12"><br />
        <input name="enviar" type="submit" class="btn btn-success btn-block" id="enviar" value="Cadastrar"  />
       </div>
      </form>
      <?php
      if(@$_POST["enviar"])
      {
       $NumSerie = $_POST['numREP'];           //NUMERO DE SÉRIE DO EQUIPAMENTO
       $Modelo = $_POST['modelo'];             //MODELO DO EQUIPAMENTO
       $Obs = str_replace("\r\n", "<br/>", strip_tags($_POST["desc"]));  //DESCRIÇÃO DE OBSERVAÇÕES
       $data = date("Y/m/d");
       $hora = date("H:i:s");
        //QUERY DE INSERÇÃO NO BANCO
       $Insere = $PDO->query("INSERT INTO cadastro_acesso (Modelo, NumSerie, DataCadastro, HoraCadastro, Status, UserCadastro, Observa) VALUES ('$Modelo', '$NumSerie', '$data', '$hora', '1', '$Nick', '$Obs')");
        if ($Insere) 
        {
         echo '<script type="text/javascript">alert("Equipamento Cadastrado!");</script>';
         echo '<script type="text/javascript">window.close();</script>';
        }
        else
        {
         echo '<script type="text/javascript">alert("Não foi possível Gravar!");</script>';
         echo '<script type="text/javascript">window.close();</script>';
        }
      }
      ?>
     </div>
     </div>
    </section>
  </div>
 </div>
<?php
include_once '../../../footer.php'; ?>
</div>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../../dist/js/app.min.js"></script>
</body>
</html>
