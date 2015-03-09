<div id="container">
	<h1>Seleccion informaci&#243;n a consultar haciendo click sobre ella</h1>
	
	<?php 
	$this->load->helper('url');
	
	?>
	<?php echo anchor('administracion/contratos', 'Relaci&#243;n de Contratos', 'title="Ir pagina principal"'); ?>
	<?php echo anchor('administracion/ordenes_compra', 'Ordenes de compra', 'title="Ir pagina principal"'); ?>
	<?php echo anchor('/administracion/ordenes_servicio', 'Ordenes de servicio', 'title="Ir pagina principal"'); ?>
	<?php echo anchor('ordenes_pago', 'Ordenes de pago', 'title="Ir consultas para adminitracion"'); ?>
	<div id="body">
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
  <div>
   <h2>Compras-><?php echo  str_replace("_", " de ", $this->uri->segment(2, 0)) . " "; ?>en Sistema</h2>
  
  <table>
    <tr>
      <th>A&#241;o </th>
      <th>Cantidad</th>
      <th>Monto</th>
      <th>Accion</th>
    </tr>
    <?php $i = 0; ?>
    <?php if($datos):foreach($datos as $orden):?>
    <tr>
      <td><?php echo $orden['anio'];?></td>
      <td><?php echo $orden['ordenes'];?></td>
      <td><?php echo number_format($orden['monto'],2,',','.');?></td>
      <td><?php echo anchor('administracion/ver_' . $this->uri->segment(2, 0) . '_anio/' . $orden['anio'], 'Ver detalles', 'title="Ir consultas para adminitracion"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>