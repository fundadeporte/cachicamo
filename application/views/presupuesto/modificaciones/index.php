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
      <th>Nro </th>
      <th>Fecha</th>
      <th>Clase</th>
      <th>Reserva</th>
      <th>Aprobada</th>
      <th>Anulada</th>
      <th>Monto</th>
    </tr>
    <?php $i = 0; ?>
    <?php if($datos):foreach($datos as $modificacion):?>
    <tr>
      <td><?php echo $modificacion['nro_modificacion'];?></td>
      <td><?php echo $modificacion['fecha'];?></td>
      <td><?php echo $modificacion['clase'];?></td>
      <td><?php 
        if ($modificacion['aprobada']):
          echo "Si"; 
        else:
          echo "No";
        endif;

      ?></td>
      <td><?php echo $modificacion['fecha_aprobacion'];?></td>
      <td><?php echo $modificacion['fecha_anulacion'];?></td>
      <td><?php echo $modificacion['monto'];?></td>
      <?php $i=$i+$modificacion['monto']; ?>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>