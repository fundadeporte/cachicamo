  <div>
  <h2>Formato OCP</h2>
  
  <table>
    <tr>
      <th>Quincena</th>
      <th>Cédula</th>
      <th>Nombre y Apellido</th>
      <th>Fecha de ingreso</th>
      <th>Cargo</th>
      <th>Unidad Funcional de Adscripción</th>
      <th>Tipo de Nómina</th>
      <th>Básico</th>
      <th>Asignaciones</th>
      <th>Deducciones</th>
      <th>Normal</th>
      <th>Integral</th>
    </tr>
    <?php $i=0; ?>
    <?php if($datos):foreach($datos as $empleado):?>
    <?php $i++; ?>
    <tr>
      <td><?php echo $empleado['quincena'];?></td>
      <td><?php echo $empleado['cedula'];?></td>
      <td><?php echo $empleado['nombre'];?></td>
      <td><?php echo $empleado['fecha_ingreso'];?></td>
      <td><?php echo $empleado['cargo'];?></td>
      <td><?php echo $empleado['actividad'];?></td>
      <td><?php echo $tipo[$empleado['cod_sede']-1];?></td>
      <td><?php echo number_format($empleado['basico'],2,',','.'); ?></td>
      <td><?php echo number_format($empleado['asignacion'],2,',','.'); ?></td>
      <td><?php echo number_format($empleado['deduccion'],2,',','.'); ?></td>
      <td><?php echo number_format($empleado['sueldo'],2,',','.'); ?></td>
      <td><?php echo number_format($empleado['integral'],2,',','.'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>

  </div>