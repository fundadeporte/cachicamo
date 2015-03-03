<?php
  //print_r($nomina);
  //$carga_familiar = $nomina['carga_familiar'];
?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('nominas/index', 'Principal', 'title="Empleado principal"'); ?></li>
      <li><?php echo anchor('nominas/caja_ahorro/' . $this->uri->segment(3, 0) . '/' . $this->uri->segment(4, 0), 'Caja de ahorro', 'title="Empleado principal"'); ?></li>
      <li><?php echo anchor('nominas/formato_ocp/'. $this->uri->segment(3, 0) . '/' . $this->uri->segment(4, 0), 'Formato OCP', 'title="Empleado principal"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Nominas realizadas en el mes</h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Nro control</th>
      <th>Mes</th>
      <th>Sede</th>
      <th>Asignaciones</th>
      <th>Retenciones</th>
      <th>Monto </th>
      <th>Movimientos</th>
      <th>Fecha cierre </th>
      <th>Condicion nomina </th>
      <th columns="2">acciones</th>
    </tr>
    <?php $i=0; ?>
    <?php if($query):foreach($query as $nomina):?>
    <?php $i++; ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $nomina['nro_control'];?></td>
      <td><?php echo $nomina['mes'];?></td>
      <td><?php echo $nomina['cod_sede'];?></td>
      <td><?php echo number_format($nomina['asignaciones'],3,',','.'); ?></td>
      <td><?php echo number_format($nomina['retenciones'],3,',','.'); ?></td>
      <td><?php echo number_format($nomina['monto'],3,',','.'); ?></td>
      <td><?php echo $nomina['movimientos'];?></td>
      <td><?php echo $nomina['ultimo_cierre'];?></td>
      <td><?php echo $nomina['condicion_nomina'];?></td>
      <td><?php echo anchor('nominas/detalle_nomina/' . $nomina['nro_control'] . '/' . $nomina['cod_sede'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php echo anchor('empleados/eliminar/' . $nomina['nro_control'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>

  </div>