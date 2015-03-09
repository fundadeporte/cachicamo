<div id="container">
	<h1>Seleccion informaci&#243;n a consultar haciendo click sobre ella</h1>
	
	<?php 
	$this->load->helper('url');
	
	?>
	<?php echo anchor('relacion_contratos', 'Relaci&#243;n de Contratos', 'title="Ir pagina principal"'); ?>
	<?php echo anchor('administracion/ordenes_compra', 'Ordenes de compra', 'title="Ir pagina principal"'); ?>
	<?php echo anchor('administracion/ordenes_servicio', 'Ordenes de servicio', 'title="Ir pagina principal"'); ?>
	<?php echo anchor('ordenes_pago', 'Ordenes de pago', 'title="Ir consultas para adminitracion"'); ?>
	<div id="body">
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>