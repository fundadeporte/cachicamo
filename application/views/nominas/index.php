<?php echo  $this->uri->segment(1, 0); ?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('/', 'Principal', 'title="Pagina principal"'); ?></li>
    </ul>

  </div>
  <div>
  <h2><?php echo  $this->uri->segment(1, 0); ?></h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>A&#241;o</th>
      <th>Mes</th>
      <th>Monto</th>
      <th>Asignaciones</th>
      <th>Retenciones</th>
      <th>Movimientos</th>
      <th>Ultimo cierre</th>
      <th columns="1">acciones</th>
    </tr>
    <?php $i = 0; ?>
    
    <?php if($datos):foreach($datos as $nomina):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $nomina['anio']; ?></td>
      <td><?php echo $nomina['mes']; ?></td>
      <td><?php echo number_format($nomina['monto'],3,',','.'); ?></td>
      <td><?php echo number_format($nomina['asignaciones'],3,',','.'); ?></td>
      <td><?php echo number_format($nomina['retenciones'],3,',','.'); ?></td>
      <td><?php echo number_format($nomina['movimientos'],0,',','.'); ?></td>
      <td><?php echo $nomina['ultimo_cierre'];?></td>
      <td><?php echo anchor('nominas/ver/' . $nomina['anio'].'/'.$nomina['mes'], 'Ver', 'title="Ver nominas"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>