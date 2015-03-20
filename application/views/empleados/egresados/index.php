<?php echo  $this->uri->segment(1, 0); ?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('/', 'Principal', 'title="Pagina principal"'); ?></li>
    </ul>

  </div>
  <div>
  <h2>Nomina </h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>A&ntilde;o</th>
      <th>Egresados</th>
      <th columns="3">acciones</th>
    </tr>
    <?php $i = 0; ?>
    <?php if($anios):foreach($anios as $anio):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $anio['anio']; ?></td>
      <td><?php echo $anio['egresados']; ?></td>
      <td><?php echo anchor('empleado/lista_egrasados/' . $anio['anio'], 'Ver', 'title="Constancia"'); ?></td>
      <td><?php //echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('empleado/eliminar/' . $empleado['id'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>