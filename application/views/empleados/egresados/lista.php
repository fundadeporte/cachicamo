<?php echo  $this->uri->segment(1, 0); ?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('/', 'Principal', 'title="Pagina principal"'); ?></li>
      <li><?php echo anchor('empleado', 'Administrativo', 'title="Empleado principal"'); ?></li>
      <li><?php echo anchor('empleado/alto_nivel', 'Alto Nivel', 'title="Empleados Alto nivel"'); ?></li>
      <li><?php echo anchor('empleado/obrero', 'Obrero', 'title="Empleados Alto nivel"'); ?></li>
      <li><?php echo anchor('empleado/agente', 'Agente', 'title="Empleados Alto nivel"'); ?></li>
      <li><?php echo anchor('empleado/contratado', 'Contratado', 'title="Empleados Alto nivel"'); ?></li>
      <li><?php echo anchor('empleado/lista', 'Lista', 'title="Empleado lista"'); ?></li>
      
    </ul>

  </div>
  <div>
  <h2>Nomina <?php echo  $this->uri->segment(2, 0); ?></h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Fecha ingreso</th>
      <th columns="3">Ver</th>
    </tr>
    <?php $i = 0; ?>
    <?php if($empleados):foreach($empleados as $empleado):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $empleado['cedula']; ?></td>
      <td><?php echo $empleado['nombre_uno']; ?></td>
      <td><?php echo $empleado['apellido_uno']; ?></td>
      <td><?php echo $empleado['fecha_egreso'];?></td>
      <td><?php echo anchor('empleado/constancia_egresado/' . $empleado['cedula'], 'Constancia egresado', 'title="Editar gaceta"'); ?></td>
      <td><?php //echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('empleado/eliminar/' . $empleado['id'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  
  </div>