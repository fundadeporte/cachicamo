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
      <th>sede</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Correo personal</th>
      <th>Edad</th>
      <th>Grado</th>
      <th>Paso</th>
      <th>Fecha ingreso</th>
      <th>Antiguedad</th>
      <th>Titulo</th>
      <th>Departamento</th>
      <th columns="3"></th>
    </tr>
    <?php $i = 0; ?>
    <?php if($empleados):foreach($empleados as $empleado):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $empleado['cod_sede']; ?></td>
      <td><?php echo $empleado['cedula']; ?></td>
      <td><?php echo $empleado['nombre_uno']; ?></td>
      <td><?php echo $empleado['apellido_uno']; ?></td>
      <td><?php echo $empleado['email'];?></td>
      <td><?php echo $empleado['edad'];?></td>
      <td><?php echo $empleado['grado'];?></td>
      <td><?php echo $empleado['paso'];?></td>
      <td><?php echo $empleado['fecha_ingreso'];?></td>
      <td><?php echo $empleado['antiguedad'];?></td>
      <td><?php echo $empleado['titulo'];?></td>
      <td><?php echo $empleado['departamento'];?></td>
      <td><?php //echo anchor('empleado/editar/' . $empleado['id'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php //echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('empleado/eliminar/' . $empleado['id'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  <h2>Personal sin información cargada sobre sus estudios</h2>
    <table>
    <tr>
      <th>#</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Correo personal</th>
      <th>Edad</th>
      <th>Grado</th>
      <th>Paso</th>
      <th>Fecha ingreso</th>
      <th>Antiguedad</th>
      <th>Titulo</th>
      <th>Departamento</th>
      <th columns="3"></th>
    </tr>
    <?php $i = 0; ?>
    <?php if($empleados_sin):foreach($empleados_sin as $empleado):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $empleado['cedula']; ?></td>
      <td><?php echo $empleado['nombre_uno']; ?></td>
      <td><?php echo $empleado['apellido_uno']; ?></td>
      <td><?php echo $empleado['email'];?></td>
      <td><?php echo $empleado['edad'];?></td>
      <td><?php echo $empleado['grado'];?></td>
      <td><?php echo $empleado['paso'];?></td>
      <td><?php echo $empleado['fecha_ingreso'];?></td>
      <td><?php echo $empleado['antiguedad'];?></td>
      <td><?php echo "Actualizar por sistema integra";?></td>
      <td><?php echo $empleado['departamento'];?></td>
      <td><?php //echo anchor('empleado/editar/' . $empleado['id'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php //echo anchor('empleado/ver/' . $empleado['id'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('empleado/eliminar/' . $empleado['id'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>