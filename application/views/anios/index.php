  <div>
    menu
    <ul>
      <li><?php echo anchor('welcome', 'Principal', 'title="Nueva gaceta"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Maestro años</h2>
  
  <table>
    <tr>
      <th>año</th>
      <th>inicia el</th>
      <th>culmina el</th>
      <th>status</th>
      <th>meses abiertos</th>
      <th columns="3">acciones</th>
    </tr>
    <?php if($query):foreach($query as $anio):?>
    <tr>
      <td><?php echo $anio->cod_ano;?></td>
      <td><?php echo $anio->fecha_inicio;?></td>
      <td><?php echo $anio->fecha_final;?></td>
      <td><?php echo $anio->status_ano;?></td>
      <td><?php echo $anio->meses_abiertos;?></td>
      <td><?php //echo anchor('gaceta/editar/' . $anio->cod_ano, 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('anios/ver/' . $anio->cod_ano, 'Ver', 'title="Ver año"'); ?></td>
      <td><?php echo anchor('gaceta/eliminar/' . $anio->cod_ano, 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>