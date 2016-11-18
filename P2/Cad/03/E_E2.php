<?php
require("../../../restritos.php");
require_once '../../../init.php';
$PDO = db_connect();
include_once '../../../QueryUser.php';
$Valida = $_GET['Sec'];
  //DECLARANDO A LINHA DE PROTOCOLO COM EMPREGADOR
  $empregador = "01+EE+00+1]01245055000124]]TESTE DE FABRICA]LOCAL DE TESTE";
   $ProtocoloData = date('d/m/y');
   $ProtocoloHora = date('H:i:s');
  //COMPONDO LINHA DE ENVIO DE DATA/HORA
  $enviaHora = "05+EH+000+" . $ProtocoloData . " " . $ProtocoloHora . "]00/00/00]00/00/00";
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
      <li>CADASTRO DE EQUIPAMENTO: PRISMA E</li>
      <li><code>D. ALFANUMÉRICO 16X2 | BIOMETRIA/BARRAS</code></li>
     </ol>
    </section>
    <?php
    if ($Valida <> '14457') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 2: </strong>CADASTRO DE EMPREGADOR E DATA/HORA</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<div class="alert alert-danger alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      echo '<h4><i class="icon fa fa-ban"></i> Erro!</h4>';
      echo '<h3>Você não seguiu os passos corretos para Cadastro do equipamento. Feche a tela e refaça novamente. </h3><br />';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</section>';
    }
    elseif ($Valida == '14457') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 2: </strong>CADASTRO DE EMPREGADOR E DATA/HORA</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<h3 class="page-title">Cadastro de Empregador</h3>';
      echo 'NOME DA EMPRESA: <code>TESTE DE FABRICA</code></br >';
      echo 'LOCAL DA EMPRESA: <code> LOCAL DE TESTE</code></br >';
      echo 'CNPJ: <code>01.245.055/0001-24</code><br /><br />';
      echo '<form name="envia_hora" id="name" method="post" action="" enctype="multipart/form-data">';
      echo '<div class="col-xs-12">';
      echo '<input name="enviar_hora" type="submit" class="btn bg-orange btn-block btn-flat" id="enviar_hora" value="Enviar Data e Hora" />';
      echo '</div>';
      echo '</form>';
      if(@$_POST["enviar_hora"]){
       $cod_msg = $enviaHora;
       $cod_asc = gerar($cod_msg);
       $gera_asc = str_replace(" ","",$cod_asc);
       $port    = 3000;

       $msg = hex2str($gera_asc);
       $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));

       $result = socket_connect($socket, $MeuIP, $port) or die($ErroEnvioDataHora);
        socket_write($socket, $msg, strlen($msg)) or die("Could not send data to server\n");
       $msg1 = socket_read($socket,8192);
       socket_close($socket);

       if ($msg1 == "05+EH+000") {
        echo '<br /><div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
          Data e Hora enviada, Resposta do Relógio:<strong> ' . $msg1 . '</strong></div>';
        }
       else {
        echo '<br /><div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
          Data e Hora enviada, Resposta do Relógio:<strong> ' . $msg1 . '</strong></div>';
        }
      }
       echo '<br /><br /><br /><br /><br />';
       echo '<form name="empregador" id="empregador" method="post" action="" enctype="multipart/form-data">';
       echo '<div class="col-xs-12">';
       echo '<input name="enviaEmpregador" type="submit" class="btn btn-success btn-block" id="enviaEmpregador" value="Enviar EMPREGADOR" />';
       echo '</div>';
       echo '</form>';

      if(@$_POST["enviaEmpregador"]){
       $cod_msg = $empregador;
       $cod_asc = gerar($cod_msg);
       $gera_asc = str_replace(" ","",$cod_asc);
       $port    = 3000;
       $msg = hex2str($gera_asc);
       $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));

       $result = socket_connect($socket, $MeuIP, $port) or die($M001);
        socket_write($socket, $msg, strlen($msg)) or die($M002);
       $msg1 = socket_read($socket,8192);
       socket_close($socket);

       if ($msg1 == "01+EE+00") {
        echo '<div class="alert alert-success-dismissable">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
        echo 'EMPREGADOR ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
        echo '<a class="btn btn-success btn-block" href="E_E3.php?Sec=1357"><iclass="icon-ok icon-white" >Próximo passo</a> <br /><br />';
        echo '</div>';
       } else if ($msg1 <> "01+EE+00") {
        echo '<div class="alert alert-success-dismissable">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
        echo 'EMPREGADOR ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
        echo '<a class="btn btn-success btn-block" href="E_E3.php?Sec=1357"><iclass="icon-ok icon-white" >Próximo passo</a> <br /><br />';
        echo '</div>';
       }
     }
   }
   else{

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
