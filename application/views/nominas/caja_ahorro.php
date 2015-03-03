<?php
  $monto_caja = 0;
  foreach ($empleados as $key):
    //print $key['monto'];
    $monto_caja = $monto_caja + str_replace(".","",$key['monto']);
    # code...
  endforeach;
  foreach ($patronales as $key):
    //print $key['monto'];
    $monto_caja = $monto_caja + str_replace(".","",$key['monto']);
    # code...
  endforeach;
?>

  <div>
  <h2>Caja de ahorro en el mes</h2>
  
  <table>
    <tr>
      <th>A</th>
      <th>B</th>
      <th>C</th>
      <th>D</th>
      <th>E</th>
      <th>F</th>
      <th>G</th>
      <th>H</th>
    </tr>
    <tr>
      <td>FUNDADEPORTE<?php //echo count($empleado) ?></td>
      <td><?php echo count($empleados)+count($patronales); ?></td>
      <td><?php echo $monto_caja; ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php $i=0; ?>
    <?php if($empleados):foreach($empleados as $empleado):?>
    <?php $i++; ?>
    <tr>
      <td><?php echo str_replace("-", "", substr($empleado['fecha'], 0,-2));?></td>
      <td>1<?php //echo $i; ?></td>
      <td><?php echo $empleado['cedula'];?></td>
      <td><?php echo $empleado['ds_concepto'];?></td>
      <td><?php echo str_replace(".","",$empleado['monto']); ?></td>
      <td><?php echo str_replace("-", "", $empleado['fecha']);?></td>
      <td></td>
      <td></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
    <?php $i=0; ?>
    <?php if($patronales):foreach($patronales as $empleado):?>
    <?php $i++; ?>
    <tr>
      <td>r<?php echo str_replace("-", "", substr($empleado['fecha'], 0,-2));?></td>
      <td>1<?php //echo $i; ?></td>
      <td><?php echo $empleado['cedula'];?></td>
      <td><?php echo $empleado['ds_concepto'];?></td>
      <td><?php echo str_replace(".","",$empleado['monto']); ?></td>
      <td><?php echo str_replace("-", "", $empleado['fecha']);?></td>
      <td></td>
      <td></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>

  </div>