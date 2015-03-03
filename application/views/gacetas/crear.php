<a href="../gaceta/index"><=Volver</a>
<h2>Crear nueva gaceta</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('gaceta/crear') ?>

	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" /><br />

	<label for="text">Descripcion</label>
	<textarea name="descripcion"></textarea><br />

	<input type="submit" name="submit" value="Crear nueva gaceta" />

</form>
