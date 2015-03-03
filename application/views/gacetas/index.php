  <div>
    menu
    <ul>
      <li><?php echo anchor('gaceta/crear', 'Gacetas->crear', 'title="Nueva gaceta"'); ?></li>
      <li><a href="#">Buscar</a></li>
    </ul>

  </div>
  <div>
  <h2>Maestro gacetas</h2>
  
  <table>
    <tr>
      <th>id</th>
      <th>nombre</th>
      <th>descripcion</th>
      <th>creado</th>
      <th>actualizado</th>
      <th columns="3">acciones</th>
    </tr>
    <?php if($query):foreach($query as $gaceta):?>
    <tr>
      <td><?php echo $gaceta->id;?></td>
      <td><?php echo $gaceta->nombre;?></td>
      <td><?php echo $gaceta->descripcion;?></td>
      <td><?php echo $gaceta->creado;?></td>
      <td><?php echo $gaceta->actualizado;?></td>
      <td><?php echo anchor('gaceta/editar/' . $gaceta->id, 'Editar', 'title="Editar gaceta"'); ?></td>
      <td><?php echo anchor('gaceta/ver/' . $gaceta->id, 'Ver', 'title="Ver gaceta"'); ?></td>
      <td><?php echo anchor('gaceta/eliminar/' . $gaceta->id, 'Editar', 'title="Eliminar gaceta"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>