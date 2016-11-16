<?php
//CHAMANDO MANUAIS
$ListaU1510 = "SELECT * FROM cadastro_1510 WHERE UserCadastro='$NomeUserLogado' ORDER BY ID DESC";
$RU1510 = $PDO->prepare($ListaU1510);
$RU1510->execute();
?>
<table id="RU1510" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
 <thead>
  <tr>
   <td width="5%">ID</td>
   <td width="20%">Modelo</td>
   <td width="30%">N&uacute;mero de S&eacute;rie</td>
   <td width="25%">Data de Cadastro</td>
   <td width="20%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($R1510 = $RU1510->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $R1510["ID"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $R1510["Modelo"] . '</span></td>';
   echo '<td>' . $R1510["NumREP"] . '</td>';
   echo '<td>' . $R1510["DataCadastro"] . '</td>';   
   echo '<td>';
    echo '<a class="btn btn-info btn-xs btn-block" href="javascript:abrir(';
    echo "'Acoes/1510Detalhe.php?ID=" . $R1510['NumREP'] . "');";
    echo '"><i class="fa fa-search"> VISUALIZAR </i></a>&nbsp;';
    echo "</td>";
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>