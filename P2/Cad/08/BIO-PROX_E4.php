<?php
require("../../../restritos.php");
require_once '../../../init.php';
$PDO = db_connect();
include_once '../../../QueryUser.php';

   $Valida = $_GET['Sec'];
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
    <section class="content-header">
     <ol class="breadcrumb">
      <li>DIXI IDNOX LT-BIO-PROX</li>
      <li><code>PROXIMIDADE</code></li>
     </ol>
    </section>
    <?php
    if ($Valida <> '19') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 5: </strong>FINALIZAR CADASTRO</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<div class="alert alert-danger alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      echo '<h4><i class="icon fa fa-ban"></i> Erro! =(</h4>';
      echo '<h3>Você não seguiu os passos corretos para Cadastro do equipamento. Feche a tela e refaça novamente. ;D </h3><br />';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</section>';
    }
    elseif ($Valida == '19') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 4: </strong>FINALIZANDO CADASTRO</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      ?>
     </div>
     <div class="box-body">
      <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
       <div class="col-xs-5">PREFIXO (MODELO)
        <input class="form-control" disabled="disabled" TYPE="text" VALUE="0003800216">
       </div>
       <div class="col-xs-7">NÚMERO DE SÉRIE
        <input name="numREP" type="text" class="form-control" minlength="7" maxlength="7" required="required"/>
       </div>
       <div class="col-xs-12">HOS
        <input class="form-control" type="text" id="hos" name="hos">
       </div>
       <div class="col-xs-6">PROXIMIDADE
        <select class="form-control" name="proximidade" required="required">
         <option value="" checked="checked"> >>SELECIONE<<</option>
         <option value="01"> WIE - WIEGAND</option>
         <option value="02"> ABA - ABATRACK</option>
         <option value="03"> IND - INDALA</option>
         <option value="04"> HID </option>
         <option value="05"> ACU - Acura</option>
         <option value="06"> PHID </option>
        </select>
       </div>
       <div class="col-xs-6">BIOMETRIA
        <select class="form-control" name="biometria" id="biometria" required="required">
         <option value="" checked="checked"> >>SELECIONE<<</option>
         <option value="01"> (512K) - 0300 Digitais<code> SUPREMA </code></option>
         <option value="02"> (4MB) - 9600 Digitais<code> SUPREMA </code></option>
         <option value="03"> (8MB) - 15000 Digitais<code> SUPREMA </code></option>
         <option value="04"> (1MB) - 1.900 Digitais<code> CAPACITIVA </code></option>
         <option value="05"> (4MB) - 9.600 Digitais<code> CAPACITIVA </code></option>
         <option value="06"> (4MB) - 9.600 Digitais<code> DEDO VIVO </code></option>
        </select>
       </div>
       <div class="col-xs-12">Observações
        <textarea name="descricao" cols="45" rows="3" class="form-control" id="descricao"></textarea>
       </div>
       <div class="col-xs-12"><br />
        <input name="enviar" type="submit" class="btn btn-success btn-block" id="enviar" value="Cadastrar"  />
       </div>
      </form>
      <?php
      if(@$_POST["enviar"])
      {
       $prefixoREP = "0003800216";
       $numREP = $_POST["numREP"];
       $numFabrica = $prefixoREP . $numREP;
       $HOS = $_POST["hos"];
       $prox = $_POST["proximidade"];
       $bio = $_POST["biometria"];
        $data = date("Y/m/d");
        $hora = date("H:i:s");
       $Obseracao = str_replace("\r\n", "<br/>", strip_tags($_POST["descricao"]));
        //GRAVANDO NO BANCO DE DADOS
       $executa = $PDO->query("INSERT INTO cadastro_1510 (Modelo, NumREP, DataCadastro, HoraCadastro, Status, Observa, UserCadastro, HOS, LProx, LBio) VALUES ('IDNOX LT-BIO PROX', '$numFabrica', '$data', '$hora', '1', '$Obseracao', '$Nick', '$HOS', '$prox', '$bio')");
        if($executa)
        {
           echo '<script type="text/javascript">alert("Equipamento Cadastrado");</script>';
           echo '<script type="text/javascript">window.close();</script>';
          }
         else{
          echo $M005;
         }
       }
     ?>
     </div>
     </div>
    </section>
  </div>
 </div>
<?php
}
include_once '../../../footer.php'; ?>
</div>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../../dist/js/app.min.js"></script>
</body>
</html>
