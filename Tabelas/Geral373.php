<?php
//CHAMANDO MANUAIS
$PenU373 = "SELECT * FROM cadastro_373 ORDER BY ID DESC";
$P373 = $PDO->prepare($PenU373);
$P373->execute();
?>
<table id="Geral373" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
 <thead>
  <tr>
   <td>ID</td>
   <td>MODELO</td>
   <td>STATUS</td>
   <td>N&Uacute;MERO DE S&Eacute;RIE</td>
   <td>DATA DE CADASTRO</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($PU373 = $P373->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PU373["ID"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $PU373["Modelo"] . '</span></td>';
    $StatusModelo = $PU373["Status"];
    if ($StatusModelo === "1") 
    {
     echo '<td><span class="badge bg-orange">EM RETESTE</span></td>';
    }
    elseif ($StatusModelo === "2") 
    {
     echo '<td><span class="badge bg-red">REPROVADO</span></td>';
    }
    elseif ($StatusModelo === "3") 
    {
     echo '<td><span class="badge bg-green">FINALIZADO</span></td>';
    }
    else { }
   echo '<td>' . $PU373["NumSerie"] . '</td>';
   echo '<td>' . $PU373["DataCadastro"] . '</td>';   
   echo '<td>';
    echo '<a class="btn btn-info btn-xs" href="javascript:abrir(';
    echo "'Acoes/373Detalhe.php?ID=" . $PU373['NumSerie'] . "');";
    echo '"><i class="fa fa-search"> VISUALIZAR </i></a>';
    echo "</td>";
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>