<?php
//CHAMANDO MANUAIS
$PenU373 = "SELECT * FROM cadastro_373 WHERE Status='1' ORDER BY ID DESC";
$P373 = $PDO->prepare($PenU373);
$P373->execute();
?>
<table id="Reteste373" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
 <thead>
  <tr>
   <td width="5%">ID</td>
   <td width="20%">Modelo</td>
   <td width="30%">N&uacute;mero de S&eacute;rie</td>
   <td width="20%">Data de Cadastro</td>
   <td width="25%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($PU373 = $P373->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PU373["ID"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $PU373["Modelo"] . '</span></td>';
   echo '<td>' . $PU373["NumSerie"] . '</td>';
   echo '<td>' . $PU373["DataCadastro"] . '</td>';   
   echo '<td>';
    echo '<a class="btn btn-default btn-xs" href="javascript:abrir(';
    echo "'Acoes/373Detalhe.php?ID=" . $PU373['NumSerie'] . "');";
    echo '"><i class="fa fa-search"> Visualizar </i></a>&nbsp;';
    echo '<a class="btn btn-success btn-xs" href="javascript:abrir(';
    echo "'Acoes/373Libera.php?ID=" . $PU373['NumSerie'] . "');";
    echo '"><i class="fa fa-thumbs-up"> Liberar </i></a>&nbsp;';
    echo '<a class="btn btn-danger btn-xs" href="javascript:abrir(';
    echo "'Acoes/373Reprova.php?ID=" . $PU373['NumSerie'] . "');";
    echo '"><i class="fa fa-thumbs-down"> Reprovar </i></a>&nbsp;';
    echo "</td>";
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>