<?php echo  $this->uri->segment(1, 0); ?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('/nominas', 'Principal', 'title="Pagina nominas"'); ?></li>
    </ul>

  </div>
  <div>
  <h2><?php echo  $this->uri->segment(1, 0); ?></h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Empleado</th>
      <th>Sueldo</th>
      <th>Movimientos</th>
      <th>Asignaciones</th>
      <th>Deducciones</th>
      <th>Departamento</th>
      <th>Cargo</th>
      <th columns="2">acciones</th>
    </tr>
    <?php $i = 0; ?>
    
    <?php if($datos):foreach($datos as $nomina):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo number_format($nomina['cedula'],0,',','.'); ?></td>
      <td><?php echo $nomina['empleado']; ?></td>
      <td><?php echo number_format($nomina['sueldo'],2,',','.'); ?></td>
      <td><?php echo number_format($nomina['movimientos'],0,',','.'); ?></td>
      <td><?php echo number_format($nomina['asignacion'],2,',','.'); ?></td>
      <td><?php echo number_format($nomina['deduccion'],2,',','.'); ?></td>
      <td><?php echo $nomina['cargo']; ?></td>
      <td><?php echo $nomina['departamento']; ?></td>
      <td><?php echo anchor('nominas/recibo/' . $nro_control.'/'.$nomina['cedula'], 'Ver Recibo', 'title="Ver detalles"'); ?></td>
      <td><?php echo anchor('#', 'Enviar a su email', 'title="Proximamente en desarrollo"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>