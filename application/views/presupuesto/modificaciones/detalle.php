  <div>
  <h2>Detalles</h2>
  
  <table>
    <tr>
      <th>Proyecto o Accion Centraliza</th>
      <th>Accion Especifica</th>
      <th>Part</th>
      <th>Gen</th>
      <th>Esp</th>
      <th>sub-esp</th>
      <th>Ordinal</th>
      <th>DENOMINACION</th>
      <th>Bolivares</th>
    </tr>
    <?php if($detalles):foreach($detalles as $detalle):?>
    <tr>
      <td><?php echo $detalle['programa'];?></td>
      <td><?php echo $detalle['accion_especifica'];?></td>
      <td><?php echo substr($detalle['cuenta'], 0,3);?></td>
      <td><?php echo substr($detalle['cuenta'], 3,-4);?></td>
      <td><?php echo substr($detalle['cuenta'], 5,-2);?></td>
      <td><?php echo substr($detalle['cuenta'], 7);?></td>
      <td><?php echo $detalle['ordinal'];?></td>
      <td><?php echo $detalle['denominacion'];?></td>
      <td><?php 
          if ($detalle['signo'] == "+"):
            echo $detalle['monto'];
          else:
            echo "(".$detalle['monto'].")";
          endif;

      ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>