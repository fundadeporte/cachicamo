  <div><h2>Padres</h2>
    <?php echo count($padres); ?>
    <table>
    <tr>
      <th>Proyecto o Accion Centraliza</th>
      <th>Accion Especifica</th>
      <th>Descripcion</th>
      <th>Monto</th>
    </tr>
    <?php if($padres):foreach($padres as $padre):?>
    <tr>
      <td><?php echo $padre['cod_programa'];?></td>
      <td><?php echo $padre['cod_act_obra'];?></td>
      <td><?php echo $padre['descripcion'];?></td>
      <td><?php 
          if ($padre['signo'] == "+"):
            echo number_format($padre['monto'],2,',','.');
          else:
            echo "(".number_format($padre['monto'],2,',','.').")";
          endif;

      ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>
  <div><h2>Hijos</h2>
    <?php echo count($hijos); ?>
        <table>
    <tr>
      <th>Proyecto o Accion Centraliza</th>
      <th>Accion Especifica</th>
      <th>Cuenta</th>
      <th>Hija</th>
      <th>Descripcion</th>
      <th>Monto</th>
    </tr>
    <?php if($hijos):foreach($hijos as $hijo):?>
    <tr>
      <td><?php echo $hijo['cod_programa'];?></td>
      <td><?php echo $hijo['cod_act_obra'];?></td>
      <td><?php echo $hijo['cuenta'];?></td>
      <td><?php echo $hijo['hija'];?></td>
      <td><?php echo $hijo['descripcion'];?></td>
      <td><?php 
          if ($hijo['signo'] == "+"):
            echo number_format($hijo['monto'],2,',','.');
          else:
            echo "(".number_format($hijo['monto'],2,',','.').")";
          endif;

      ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>
  <div>
  <h2>Nietos</h2>
  <?php echo count($detalles) ?>
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
  