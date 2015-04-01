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
      <th>monto</th>
      <th>Fecha aprobacion</th>
      <th>Estatus</th>
      <th columns="3">acciones</th>
    </tr>
    <?php if($datos):foreach($datos as $detalles):?>
    <tr>
      <td><?php echo $detalles['concepto'];?></td>
      <td><?php echo $detalles['descripcion'];?></td>
      <td><?php echo $detalles['monto'];?></td>
      <td><?php echo $detalles['fecha_aprobacion'];?></td>
      <td><?php echo $detalles['status_m'];?></td>
      <td><?php //echo anchor('presupuesto/modificaciones/' . $modificacion['nro_modificacion'], 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('presupuesto/modificaciones' . $detalles['nro_modificacion'], 'Ver', 'title="Ver año"'); ?></td>
      <td><?php //echo anchor('presupuesto/modificaciones' . $modificacion['nro_modificacion'], 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>