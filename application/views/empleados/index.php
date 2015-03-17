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
      <li><?php echo anchor('empleado/caja_ahorro', 'Empleados afiliados a la Caja ahorro', 'title="Empleado caja ahorro"'); ?></li>
    </ul>

  </div>
  <div>
  <h2>Nomina </h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Correo personal</th>
      <th>Correo institucional</th>
      <th>Edad</th>
      <th>Grado</th>
      <th>Paso</th>
      <th>Fecha nacimiento</th>
      <th columns="3">acciones</th>
    </tr>
    <?php $i = 0; ?>
    
    <?php if($query):foreach($query as $empleado):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $empleado['cedula']; ?></td>
      <td><?php echo $empleado['nombre_uno']; ?></td>
      <td><?php echo $empleado['apellido_uno']; ?></td>
      <td><?php echo $empleado['email'];?></td>
      <td><?php echo strtolower ($empleado['nombre_uno'][0] .''.$empleado['apellido_uno']);?>@fundadeporte.gob.ve</td>
      <td><?php echo $empleado['edad'];?></td>
      <td><?php echo $empleado['grado'];?></td>
      <td><?php echo $empleado['paso'];?></td>
      <td><?php echo $empleado['fecha_nacimiento'];?></td>
      <td><?php echo anchor('empleado/editar/' . $empleado['id'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php echo anchor('empleado/eliminar/' . $empleado['id'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>