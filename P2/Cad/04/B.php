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
      <li>CADASTRO DE EQUIPAMENTO: COMPACTO S-B</li>
      <li><code>BIOMETRIA</code></li>
     </ol>
    </section>
    <section class="content">
     <div class="box box-default">
      <div class="box-header with-border">
       <h2 class="box-title">CADASTRANDO EQUIPAMENTO</h2>
     </div>
     <div class="box-body">
      <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
       <table width="400" border="0" align="center">
        <tr>
         <div class="col-xs-5">PREFIXO (MODELO)
          <input class="form-control" disabled="disabled" TYPE="text" VALUE="0000400385">
         </div>
         <div class="col-xs-7">NÚMERO DE SÉRIE
          <input name="numREP" type="text" class="form-control" id="numREP" minlength="7" maxlength="7" required="required"/>
         </div>
        </tr>
        <tr>
         <div class="col-xs-12">HOS
          <input class="form-control" type="text" id="hos" name="hos">
         </div>
        </tr>
        <tr>
         <div class="col-xs-12">BIOMETRIA
          <select class="form-control" name="biometria" id="biometria" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="04"> (1MB) - 1.900 Digitais<code> CAPACITIVA </code></option>
           <option value="05"> (4MB) - 9.600 Digitais<code> CAPACITIVA </code></option>
          </select>
         </div>
        </tr>
        <tr>
         <div class="col-xs-12">Observações
           <textarea name="descricao" cols="45" rows="3" class="form-control" id="descricao"></textarea>
         </div>
        </tr>
        <tr>
         <div class="col-xs-12"><br />
           <input name="enviar" type="submit" class="btn btn-success btn-block" id="enviar" value="Cadastrar"  />
         </div>
        </tr>
       </table>
      </form>
      <?php
      if(@$_POST["enviar"]){
       $prefixoREP = "0000400385";
       $numREP = $_POST["numREP"];
       $numFabrica = $prefixoREP . $numREP;
       $HOS = $_POST["hos"];
       $Bio = $_POST["biometria"];
        $data = date("Y/m/d");
        $hora = date("H:i:s");
       $Obseracao = str_replace("\r\n", "<br/>", strip_tags($_POST["descricao"]));
        //GRAVANDO NO BANCO DE DADOS
       $executa = $PDO->query("INSERT INTO cadastro_1510 (Modelo, NumREP, DataCadastro, HoraCadastro, Status, Observa, UserCadastro, HOS, LBio) VALUES ('Compacto S-B', '$numFabrica', '$data', '$hora', '1', '$Obseracao', '$Nick', '$HOS', '$Bio')");
        if($executa)
        {
         echo '<script type="text/javascript">alert("Equipamento Cadastrado com Sucesso");</script>';
         $executa2 = $PDO->query("UPDATE login SET MetaRealizada='$NovaMeta', MontOK='$NovaMontagem' WHERE login='$login'");
          if ($executa2) {
           echo '<script type="text/javascript">alert("Metas Atualizadas com sucesso");</script>';
           echo '<script type="text/javascript">window.close();</script>';
          }
          else{
           echo '<script type="text/javascript">alert("NÃO FOI POSSÍVEL ATUALIZAR METAS");</script>';
          }
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
include_once '../../../footer.php'; ?>
</div>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../../dist/js/app.min.js"></script>
</body>
</html>
