 <div>
  <h2>Detalles</h2>
  <?php /*echo "<pre>";
  print_r($arbol);
echo "</pre>";*/  ?>
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
    <?php if($arbol):foreach($arbol as $arbol):?>
    <tr>
      <td><?php echo $arbol['proyecto'];?></td>
      <td><?php echo $arbol['accion_especifica'];?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo $arbol['denominacion'];?></td>
      <td align="right"><?php 
          if ($arbol['signo'] == "+"):
            echo number_format($arbol['monto'],2,',','.');
          else:
            echo "(".number_format($arbol['monto'],2,',','.').")";
          endif;

      ?></td>
    </tr>
	<tr>
      <td></td>
      <td></td>
      <td><?php echo $arbol['hijo']['part'];?></td>
      <td><?php echo $arbol['hijo']['gen'];?></td>
      <td><?php echo $arbol['hijo']['esp'];?></td>
      <td><?php echo $arbol['hijo']['sub_esp'];?></td>
	  <td></td>
	  <td><?php echo $arbol['hijo']['denominacion'];?></td>
      <td align="right"><?php 
          if ($arbol['hijo']['signo'] == "+"):
            echo number_format($arbol['hijo']['monto'],2,',','.');
          else:
            echo "(". number_format($arbol['hijo']['monto'],2,',','.').")";
          endif;

      ?></td>
    </tr>
	<tr>
      <td></td>
      <td></td>
      <td><?php echo $arbol['nieto']['part'];?></td>
      <td><?php echo $arbol['nieto']['gen'];?></td>
      <td><?php echo $arbol['nieto']['esp'];?></td>
      <td><?php echo $arbol['nieto']['sub_esp'];?></td>
	  <td></td>
	  <td><?php echo $arbol['nieto']['denominacion'];?></td>
      <td align="right"><?php 
          if ($arbol['nieto']['signo'] == "+"):
            echo number_format($arbol['nieto']['monto'],2,',','.');
          else:
            echo "(".number_format($arbol['nieto']['monto'],2,',','.').")";
          endif;

      ?></td>
    </tr>
	<?php foreach($arbol['bisnieto'] as $bisnieto): ?>
	<tr>
      <td></td>
	  <td></td>
      <td><?php echo $bisnieto['part'];?></td>
      <td><?php echo $bisnieto['gen'];?></td>
      <td><?php echo $bisnieto['esp'];?></td>
      <td><?php echo $bisnieto['sub_esp'];?></td>
	  <td><?php echo $bisnieto['ordinal'];?></td>
	  <td><?php echo $bisnieto['denominacion'];?></td>
      <td align="right"><?php 
          if ($bisnieto['signo'] == "+"):
            echo number_format($bisnieto['monto'],2,',','.');
          else:
            echo "(".number_format($bisnieto['monto'],2,',','.').")";
          endif;

      ?></td>
    </tr>
	<?php endforeach; ?>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>