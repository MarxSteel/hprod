<!-- MODAL DE MODELO -->
<div id="UserDiaModelo" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-orange">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Relatório de dia único por usuário</h4>
   </div>
   <div class="modal-body">
    <?php
	 $Chamauser = "SELECT * FROM login";
      $P2 = $PDO->prepare($Chamauser);
      $P2->execute();
  	?>
    <form name="UserDiaModelo" action="UserDiaModelo.php" target="_blank">
     <div class="col-md-6">Usuário
      <div class="form-group">
       <select class="form-control select2" name="usuario" style="width: 100%;">
        <option value="" selected="selected">SELECIONE</option>
        <?php while ($p2 = $P2->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?php echo $p2['Nome'] ?>"><?php echo $p2['Nome'] ?></option>
        <?php endwhile; ?>
       </select>
      </div>
     </div>
     <div class="col-xs-6">Data
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
       </div>
        <input type="text" name="dtInicio" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
      </div>
     </div>
     <div class="col-xs-12"><br />
      <input name="UserDiaModelo" type="submit" class="btn btn-warning btn-block btn-lg" value="Visualizar"  /> 
     </div>
    </form>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE MODELO -->

<!-- MODAL DE MODELO -->
<div id="modelo" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-green">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Cadastro de Firmware de Linha</h4>
   </div>
   <div class="modal-body">

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE MODELO -->




