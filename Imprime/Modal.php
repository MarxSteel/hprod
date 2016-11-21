<!-- IMPRIMIR 1510 -->
<div class="modal fade " id="P1510" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPRIMIR PONTO 1510</h4>
      </div>
      <div class="modal-body">
       <form name="p373" id="name" method="post" action="" enctype="multipart/form-data">
         <div class="col-xs-6">NÚMERO DE SÉRIE (COMPLETO)
          <input name="numREP" type="text" class="form-control" id="num1510" minlength="6" maxlength="6" required="required"/>
         </div>
         <div class="col-xs-6">MODELO
          <input class="form-control" type="text" id="hos" name="hos">
         </div>
         <div class="col-xs-6">BIOMETRIA
          <select class="form-control" name="bio373" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="01"> (512K) - 0300 Digitais<code> SUPREMA </code></option>
           <option value="02"> (4MB) - 9600 Digitais<code> SUPREMA </code></option>
           <option value="03"> (8MB) - 15000 Digitais<code> SUPREMA </code></option>
           <option value="04"> (1MB) - 1.900 Digitais<code> CAPACITIVA </code></option>
           <option value="05"> (4MB) - 9.600 Digitais<code> CAPACITIVA </code></option>
           <option value="06"> (4MB) - 9.600 Digitais<code> DEDO VIVO </code></option>
          </select>
         </div>
         <div class="col-xs-6">PROXIMIDADE
          <select class="form-control" name="prox373" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="01"> WIE - WIEGAND</option>
           <option value="02"> ABA - ABATRACK</option>
           <option value="03"> IND - INDALA</option>
           <option value="04"> HID </option>
           <option value="05"> ACU - Acura</option>
           <option value="06"> PHID </option>
          </select>
         </div>
         <div class="col-xs-6">SMART CARD
          <select class="form-control" name="smart373" iequired="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="9"> SIM</option>
           <option value="5"> NÃO</option>
          </select>
         </div>
         <div class="col-xs-6">BARRAS
          <select class="form-control" name="barras373" required="required">
           <option value="" checked="checked"> >>SELECIONE<<</option>
           <option value="9"> SIM</option>
           <option value="5"> NÃO</option>
          </select>
         </div>
         <div class="col-xs-12"><br />
           <input name="p373" type="submit" class="btn btn-success btn-block" id="enviar" value="Cadastrar"  />
         </div>
       </form>
       <?php
       if(@$_POST["p373"]){
        $Bio373 = $_POST["bio373"];
        $prox373 = $_POST["prox373"];
        $smart373 = $_POST["smart373"];
        $barras373 = $_POST["barras373"];

        $Data373 = date("d/m/Y");
        
        $PrintIP = "192.168.12.44";
        $MsgPritn = "C[4";
                $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));

       $result = socket_connect($socket, $PrintIP, $port) or die($ErroEnvioDataHora);
        socket_write($socket, $MsgPritn, strlen($MsgPritn)) or die("Could not send data to server\n");
       $msg1 = socket_read($socket,8192);
       socket_close($socket);
         echo '<script type="text/javascript">alert("Equipamento Cadastrado!");</script>';


       }
     ?>



      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- IMPRIMIR 1510 -->
<!-- IMPRIMIR 373 -->
<div class="modal fade " id="P373" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title" id="myModalLabel">IMPRIMIR PONTO 373</h4>
   </div>
   <div class="modal-body">
    teste
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- IMPRIMIR 373 -->
