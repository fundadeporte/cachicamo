<?php

?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('departamento/index', 'Principal', 'title="Empleado principal"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Datos del departamento</h2>
  
  <table>
    <tr>
      <th>Sede</th>
      <th>Codigo Departamento</th>
      <th>Departamento</th>
      <th>Empleados</th>
    </tr>
    <?php if($departamento):foreach($departamento as $departamento):?>
    <?php //print_r($empleado); ?>
    <tr>
      <td><?php echo $departamento['cod_sede'];?></td>
      <td><?php echo $departamento['codigo_departamento'];?></td>
      <td><?php echo $departamento['departamento'];?></td>
      <td><?php echo (count($empleados)+count($empleados_vacaciones));?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>

  <h2>Empleados del Departamento</h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Nombres</th>
      <th>Fecha nacimiento</th>
      <th>Sueldo</th>
      
      <th columns="3">Acciones</th>
    </tr>
    <?php //print_r($carga_familiar); ?>
    <?php $i=0; ?>
    <?php if($empleados):foreach($empleados as $empleado):?>
    <?php $i++; ?>
    <tr>
      <td><?php echo $i .'/' . count($empleados);?></td>
      <td><?php echo $empleado['cedula'];?></td>
      <td><?php echo $empleado['nombre_uno'];?></td>
      <td><?php echo $empleado['apellido_uno'];?></td>
      <td><?php echo $empleado['sueldo'];?></td>
      <td><?php //echo anchor('gaceta/editar/' . $empleado['cedula'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('empleados/eliminar/' . $empleado['cedula'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php $i = 0; ?>
    <?php endif;?>
  </table>
    <h2>Empleados del Departamento en vacaciones</h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Nombres</th>
      <th>Fecha nacimiento</th>
      <th>Sueldo</th>
      
      <th columns="3">Acciones</th>
    </tr>
    <?php //print_r($carga_familiar); ?>
    <?php $i=0; ?>
    <?php if($empleados_vacaciones):foreach($empleados_vacaciones as $empleado):?>
    <?php $i++; ?>
    <tr>
      <td><?php echo $i .'/' . count($empleados_vacaciones);?></td>
      <td><?php echo $empleado['cedula'];?></td>
      <td><?php echo $empleado['nombre_uno'];?></td>
      <td><?php echo $empleado['apellido_uno'];?></td>
      <td><?php echo $empleado['sueldo'];?></td>
      <td><?php //echo anchor('gaceta/editar/' . $empleado['cedula'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('empleados/eliminar/' . $empleado['cedula'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>