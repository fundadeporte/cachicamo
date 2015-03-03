<?php
  //print_r($empleado);
  $carga_familiar = $empleado['carga_familiar'];
?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('empleado/index', 'Principal', 'title="Empleado principal"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Datos del empleado</h2>
  
  <table>
    <tr>
      <th>id</th>
      <th>Cedula</th>
      <th>nombre</th>
      <th>apellido</th>
      <th>correo personal</th>
      <th>correo institucional</th>
      <th>Fecha ingreso </th>
      <th>Dirección del empleado </th>
      <th>Sueldo </th>
      <th columns="2">acciones</th>
    </tr>
    <?php if($empleado):foreach($empleado['empleado'] as $empleado):?>
    <?php //print_r($empleado); ?>
    <tr>
      <td><?php echo $empleado['id'];?></td>
      <td><?php echo $empleado['CEDULA'];?></td>
      <td><?php echo $empleado['NOMBRE_UNO'];?></td>
      <td><?php echo $empleado['APELLIDO_UNO'];?></td>
      <td><?php echo $empleado['EMAIL'];?></td>
      <td><?php echo strtolower ($empleado['NOMBRE_UNO'][0] .''.$empleado['APELLIDO_UNO']);?>@fundadeporte.gob.ve</td>
      <td><?php echo $empleado['FECHA_INGRESO'];?></td>
      <td><?php echo $empleado['DIR_EMPLEADO'];?></td>
      <td><?php echo $empleado['SUELDO'];?></td>
      <td><?php echo anchor('empleados/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php echo anchor('empleados/eliminar/' . $empleado['id'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>

  <h2>Carga Familiar</h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Nombres</th>
      <th>Fecha nacimiento</th>
      <th>Edad</th>
      
      <th columns="3">acciones</th>
    </tr>
    <?php //print_r($carga_familiar); ?>
    <?php $i=0; ?>
    <?php if($carga_familiar):foreach($carga_familiar as $empleado):?>
    <?php $i++; ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $empleado['CED_FAMILIAR'];?></td>
      <td><?php echo $empleado['nombre'];?></td>
      <td><?php echo $empleado['fecha_nacimiento'];?></td>
      <td><?php echo $empleado['edad'];?></td>
      <td><?php echo anchor('gaceta/editar/' . $empleado['cedula'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('empleados/ver/' . $empleado['cedula'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php echo anchor('empleados/eliminar/' . $empleado['cedula'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>