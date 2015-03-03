  <div>
    menu
    <ul>
      <li><?php echo anchor('welcome', 'Principal', 'title="Nueva gaceta"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Modificaciones en el año</h2>
  
  <table>
    <tr>
      <th>Nro de modificación</th>
      <th>Concepto</th>
      <th>Fecha proceso</th>
      <th>Hora proceso</th>
      <th>Estatus</th>
      <th columns="3">acciones</th>
    </tr>
    <?php if($query):foreach($query as $anio):?>
    <tr>
      <td><?php echo $anio->nro_modificacion;?></td>
      <td><?php echo $anio->concepto;?></td>
      <td><?php echo $anio->fecha_proceso;?></td>
      <td><?php echo $anio->hora_proceso;?></td>
      <td><?php echo $anio->status_m;?></td>
      <td><?php echo anchor('presupuesto/modificaciones/' . $anio->nro_modificacion, 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('presupuesto/modificaciones' . $anio->nro_modificacion, 'Ver', 'title="Ver año"'); ?></td>
      <td><?php echo anchor('presupuesto/modificaciones' . $anio->nro_modificacion, 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>