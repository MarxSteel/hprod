<?php
require("../../../restritos.php");
require_once '../../../init.php';
$PDO = db_connect();
include_once '../../../QueryUser.php';
$Valida = $_GET['Sec'];

  // PROTOCOLO                           
  $empregador = "01+EE+000+1]10278563000108]]TESTE FABRICA]SAO PAULO";
   date_default_timezone_set('America/Sao_Paulo');
   $ProtocoloData = date('d/m/y');
   $ProtocoloHora = date('H:i:s');
  
  $enviaHora = "05+EH+000+" . $ProtocoloData . " " . $ProtocoloHora . "]00/00/00]00/00/00";
  $EnviaLogin = "07+EC+000+SENHA_MENU[987654";

   $ErroEnvioEmpregador = ' <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
    Não foi possível enviar o empregador, o relógio não está na rede.</div>';

   $ErroEnvioDataHora = ' <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
    Não foi possível enviar o empregador, o relógio não está na rede.</div>';
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
   <?php
    if ($Valida <> '44543') {
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
    else{
   ?>
    <section class="content-header">
     <div class="box box-default">
      <div class="box-header with-border"><h3 class="box-title">Passo 2: Enviar Empregador</h3></div>
       <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
          Antes de enviar o Empregador, coloque papel na impressora.</div>
         <div class="box-body">
          <div class="span12">
           <h3 class="page-title">Cadastrar Empregador</h3>
            NOME DA EMPRESA: <code>TESTE FABRICA</code></br >
            LOCAL DA EMPRESA: <code> SAO PAULO</code></br >
            CNPJ: <code>10.278.563/0001-08</code><br /><br />
            <div class="col-xs-4">
            <form onsubmit="return valida_form();" name="envia_hora" id="name" method="post" action="" enctype="multipart/form-data">
               <td align="left" valign="middle"><input name="enviar_hora" type="submit" class="btn bg-olive btn-block btn-flat" id="enviar_hora" value="Enviar Data e Hora" /></td>
            </form><br /></div>
            <?php 
            if(@$_POST["enviar_hora"])
            {
            $cod_msg = $enviaHora;
            $cod_asc = gerar($cod_msg);
            $gera_asc = str_replace(" ","",$cod_asc);
            $port    = 3000;
             $msg = hex2str($gera_asc);
             $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Não foi possível criar\n");
              socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
              socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));

             $result = socket_connect($socket, $MeuIP, $port) or die($ErroEnvioDataHora);
              socket_write($socket, $msg, strlen($msg)) or die("Could not send data to server\n");
              $msg1 = socket_read($socket,$port);
              socket_close($socket);
              if ($msg1 == "01+EE+00") 
              {
               echo '<div class="alert alert-success-dismissable">';
               echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
               echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
               echo 'HORARIO ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
               echo '</div>';
              } 
              else 
              {
               echo '<div class="alert alert-success-dismissable">';
               echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
               echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
               echo 'HORARIO ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
               echo '</div>';
              }
            }
            ?>
            <div class="row-fluid">
            <div class="col-xs-4">
             <div class="span12">
              <form onsubmit="return valida_form();" name="envia_login" id="name" method="post" action="" enctype="multipart/form-data">
              <input name="enviar_login" type="submit" class="btn bg-maroon btn-block btn-flat" id="enviar_login" value="Trocar o Login / Senha" />
              </form>
             </div>
             </div>
             <?php 
             if(@$_POST["enviar_login"])
             {
              $cod_msg = $EnviaLogin;
              $cod_asc = gerar($cod_msg);
              $gera_asc = str_replace(" ","",$cod_asc);
              $port=3000;
              $msg = hex2str($gera_asc);
              $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Não foi possível criar\n");
               socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
               socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
              $result = socket_connect($socket, $MeuIP, $port) or die($ErroEnvioDataHora);
               socket_write($socket, $msg, strlen($msg)) or die("Could not send data to server\n");
              $msg1 = socket_read($socket,$port);
               socket_close($socket);
              if ($msg1 == "01+EE+00") 
              {
               echo '<div class="alert alert-success-dismissable">';
               echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
               echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
               echo 'LOGIN ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
               echo '</div>';
              } 
              else 
              {
               echo '<div class="alert alert-success-dismissable">';
               echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
               echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
               echo 'LOGIN ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
               echo '</div>';
              }
             }
             ?>
            <div class="col-xs-4">
             <form onsubmit="return valida_form();" name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
              <input name="enviar" type="submit" class="btn bg-navy btn-block btn-flat" id="enviar" value="Enviar dados de Empregador" />
             </form>
            </div>
            <?php 
            if(@$_POST["enviar"])
            {
             $cod_msg = $empregador;
             $cod_asc = gerar($cod_msg);
             $gera_asc = str_replace(" ","",$cod_asc);
             $port    = 3000;
             $msg = hex2str($gera_asc);
              $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Não foi possível criar\n");
               socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
               socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
              $result = socket_connect($socket, $MeuIP, $port) or die($ErroEnvioDataHora);
               socket_write($socket, $msg, strlen($msg)) or die("Could not send data to server\n");
              $msg1 = socket_read($socket,$port);
               socket_close($socket);
             if ($msg1 == "01+EE+00") 
             {
              echo '<div class="alert alert-success-dismissable">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
              echo 'EMPREGADOR ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
              echo '<a class="btn btn-success btn-block btn-flat" href="LT-PROX_E3.php?Sec=45232"><iclass="icon-ok icon-white" >Próximo passo</a> <br /><br />';
              echo '</div>';
             }
             else if ($msg1 <> "01+EE+00") 
             {
              echo '<div class="alert alert-success-dismissable">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              echo '<h4><i class="icon fa fa-ban"></i> Atenção!</h4>';
              echo 'EMPREGADOR ENVIADO, RESPOSTA DO RELÓGIO:<strong>' . $msg1 . '</strong>.';
              echo '<a class="btn btn-success btn-block btn-flat" href="LT-PROX_E3.php?Sec=45232"><iclass="icon-ok icon-white" >Próximo passo</a> <br /><br />';
              echo '</div>';
             } 
            }
            ?>
          </div>
         </div><!-- /.box-body -->
        </div>
       </section><?php } ?>
      </div><!-- /.container -->
     </div><!-- /.content-wrapper -->
     <footer class="main-footer"><?php include_once '../../../footer.php'; ?></footer>
   </div><!-- ./wrapper -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../../../plugins/fastclick/fastclick.min.js"></script>
    <script src="../../../dist/js/app.min.js"></script>
    <script src="../../../dist/js/demo.js"></script>
  </body>
</html>