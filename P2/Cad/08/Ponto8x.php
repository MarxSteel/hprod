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
    <section class="content-header">
     <ol class="breadcrumb">
      <li>CADASTRO DE EQUIPAMENTO: PRIMME PONTO 8x</li>
     </ol>
    </section>
    <section class="content">
     <div class="box box-default">
      <div class="box-body">
      <h3 class="page-title">Cadastrando Equipamento</h3>
      <div class="col-xs-12">
      <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
         <div class="col-xs-4">Modelo
          <input class="form-control" disabled="disabled" TYPE="text" VALUE="Primme Ponto 8x">
         </div>
         <div class="col-xs-4">NÚMERO DE SÉRIE
          <input name="numREP" type="text" class="form-control" id="numREP" minlength="6" maxlength="9" required="required"/>
         </div>
         <div class="col-xs-4">Display
          <select class="form-control" name="display" id="display" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="01"> ALFANUMÉRICO 16X02</option>
           <option value="02"> GRÁFICO</option>
           <option value="03"> TFT COLORIDO</option>
          </select>
         </div>
         <div class="col-xs-4">HOS
          <input class="form-control" type="text" id="hos" name="hos">
         </div>
         <div class="col-xs-4">Firmware
          <input class="form-control" type="text" id="fw" name="fw" required="required">
         </div>
         <div class="col-xs-4">BIOMETRIA
          <select class="form-control" name="biometria" id="biometria" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="99">NENHUMA</option>
           <option value="01">(512K) - 0300 Digitais<code> SUPREMA </code></option>
           <option value="02">(4MB) - 9600 Digitais<code> SUPREMA </code></option>
           <option value="03">(8MB) - 15000 Digitais<code> SUPREMA </code></option>
           <option value="04">(1MB) - 1.900 Digitais<code> CAPACITIVA </code></option>
           <option value="05">(4MB) - 9.600 Digitais<code> CAPACITIVA </code></option>
           <option value="06">(4MB) - 9.600 Digitais DEDO VIVO<code> </code></option>
           <option value="07">1.000 Digitais<code> FS (FINCHOS) </code></option>
           <option value="08">LUM - Lumidigm</option>
           <option value="09">900 Digitais<code> ROMA (Henry) </code></option>
          </select>
         </div>
         <div class="col-xs-4">PROXIMIDADE
          <select class="form-control" name="proximidade" id="proximidade" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="99">NENHUMA</option>
           <option value="01"> WIE - WIEGAND</option>
           <option value="02"> ABA - ABATRACK</option>
           <option value="03"> IND - INDALA</option>
           <option value="04"> HID </option>
           <option value="05"> ACU - Acura</option>
           <option value="06"> PHID </option>
          </select>
         </div>
         <div class="col-xs-4">SmartCard
          <select class="form-control" name="smart" id="smart" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="01"> SIM</option>
           <option value="02"> NÃO</option>
          </select>
         </div>
         <div class="col-xs-4">Barras
          <select class="form-control" name="barras" id="barras" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="01"> SIM</option>
           <option value="02"> NÃO</option>
          </select>
         </div>
         <div class="col-xs-12">Observações
           <textarea name="descricao" cols="45" rows="3" class="form-control" id="descricao"></textarea>
         </div>
         <div class="col-xs-12"><br />
           <input name="enviar" type="submit" class="btn btn-success btn-block" id="enviar" value="Cadastrar"  />
         </div>
        </tr>
      </form>
      <?php
      if(@$_POST["enviar"]){
       $NumREP = $_POST["numREP"];
       $HOS = $_POST["hos"];
       $Firmware = $_POST["fw"];
       $Display = $_POST["display"];

       $Bio = $_POST["biometria"];
       $Prox = $_POST["proximidade"];
       $Barras = $_POST["barras"];
       $Smart = $_POST["barras"];
        $data = date("Y/m/d");
        $hora = date("H:i:s");
       $Observacao = str_replace("\r\n", "<br/>", strip_tags($_POST["descricao"]));
        //GRAVANDO NO BANCO DE DADOS
       $executa = $PDO->query("INSERT INTO cadastro_373 (Modelo, NumSerie, DataCadastro, HoraCadastro, Status, UserCadastro, LeiMifare, LeiProx, LeiBarras, LeiBio, Firmware, Display, Observa) VALUES ('Primme Ponto 8x', '$NumREP', '$data', '$hora', '1', '$Nick', '$Smart', '$Prox', '$Barras', '$Bio', '$Firmware', '$Display', '$Observacao')");
        if($executa)
        {
         echo '<script type="text/javascript">alert("Cadastrado com Sucesso");</script>';
         echo '<script type="text/javascript">window.close();</script>';
        }
        else
        {
         echo $M005;
        }
       }
     ?>
      </div>
       </div>
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
