  <div>
    menu
    <ul>
      <li><?php echo anchor('welcome', 'Principal', 'title="Nueva gaceta"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Modificaciones en el a&#241;o</h2>
  
  <table>
    <tr>
      <th>Nro de modificaci&#243;n</th>
      <th>Concepto</th>
      <th>Fecha proceso</th>
      <th>Fecha aprobacion</th>
      <th>Estatus</th>
      <th columns="3">acciones</th>
    </tr>
    <?php if($datos):foreach($datos as $modificacion):?>
    <tr>
      <td><?php echo $modificacion['nro_modificacion'];?></td>
      <td><?php echo $modificacion['descripcion'];?></td>
      <td><?php echo $modificacion['fecha_documento'];?></td>
      <td><?php echo $modificacion['fecha_aprobacion'];?></td>
      <td><?php echo $modificacion['status_m'];?></td>
      <td><?php echo anchor('presupuesto/ver/' . $modificacion['cod_ano']. '/' . $modificacion['nro_modificacion'], 'Ver', 'title="Ver detalles"'); ?></td>
      <td><?php //echo anchor('presupuesto/modificaciones' . $anio->nro_modificacion, 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('presupuesto/modificaciones' . $anio->nro_modificacion, 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>