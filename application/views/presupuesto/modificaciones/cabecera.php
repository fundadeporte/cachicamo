  <div>
    menu
    <ul>
      <li><?php echo anchor('welcome', 'Principal', 'title="Nueva gaceta"'); ?></li>
	  <li><?php echo anchor('/presupuesto/formato_seplan/'.$enla['anio']."/".$enla['nro_modificacion']."/".$enla['tipo'], 'Formato Seplan consolidada', 'title="Nueva gaceta"'); ?></li>
	  <li><?php echo anchor('/presupuesto/formato_seplan/'.$enla['anio']."/".$enla['nro_modificacion']."/".$enla['tipo'], 'Formato Seplan por unidad ejecutora', 'title="Nueva gaceta"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Modificaciones en el a&#241;o</h2>
  
  <table>
    <tr>
      <th>Nro de modificaci&#243;n</th>
      <th>Fecha</th>
      <th>Clase</th>
      <th>Reserva</th>
      <th>Concepto</th>
      <th>Monto</th>
    </tr>
    <?php if($cabecera):foreach($cabecera as $detalles):?>
    <tr>
      <td><?php echo $detalles['nro_modificacion'];?></td>
      <td><?php echo $detalles['fecha'];?></td>
      <td><?php echo $detalles['clase'];?></td>
      <td><?php echo $detalles['reserva'];?></td>
      <td><?php echo $detalles['concepto'];?></td>
      <td><?php echo str_replace(".", ",",$detalles['monto']);?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>