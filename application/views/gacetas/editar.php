<a href="../gaceta/index"><=Volver</a>
<h2>Crear nueva gaceta</h2>

<?php echo validation_errors(); ?>
<?php print_r($data); ?>
<?php echo form_open('gaceta/editar') ?>
<?php echo $gaceta->id; ?>
	<label for="nombre">Nombre</label>
	<input type="text" id="hide" name="id" value="<?php echo $gaceta->id; ?>" />
	<input type="text" name="nombre" value="<?php echo $gaceta->id; ?>" ><br />

	<label for="text">Descripcion</label>
	<textarea name="descripcion"></textarea><br />

	<input type="submit" name="submit" value="Crear nueva gaceta" />

</form>
