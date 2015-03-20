<img src="<?php echo base_url('images/cabecera.png'); ?>">
<?php
  $mes = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre')
?>
<div align="center"><br><br><br><br><h1><u>CONSTANCIA</h1></u></div>
<div><?php //print_r($empleado)?><br><br>
<p>El (La) suscrito (a) Director (a) de Recursos Humanos hace constar por medio de la presente que el ciudadano (a)</p>
<p>  <br>
  <br>  <br>
  <br> <table style="width:50%">
  <tr>
    <td>Apellidos</td>
    <td><?php echo $empleado[0]['apellidos']; ?></td>
  </tr>
  <tr>
    <td>Nombres</td>
    <td><?php echo $empleado[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td>Cedula de Identidad</td>
    <td><?php echo $empleado[0]['cedula']; ?></td>
  </tr>
</table>
</p>
  <br>
  <br>  <br>
  <br>
<p>Prest&oacute; servicios en esta Fundaci&oacute;n desemplea&ntilde;ando funciones como <?php echo $empleado[0]['cargo']; ?>, ingresando el <?php echo $empleado[0]['fecha_ingreso']; ?> hasta el <?php echo $empleado[0]['fecha_egreso']; ?>. Devengado un sueldo mensual de <?php echo $empleado[0]['sueldo_en_letras'] .' '.$empleado[0]['centimos'] ; ?>  (Bs. <?php echo number_format($empleado[0]['ultimo_sueldo'],2,',','.'); ?>)</p>
  <br>
  <br>  <br>
  <br>
<p> De acuerdo a lo revisado en archivo, doy f&eacute; de su autenticidad.<br>Constancia que se expide a solicitud de la parte interesada, en Valencia a los <?php echo date('d'); ?> del mes de <?php echo $mes[date('m')-1];?> del <?php echo date('Y') ?></p>
<p>Atentamente; 
  <br>
  <br>
  <b>Lcda. Sonia Zavala
  Directora de Recursos Humanos</b>
</p>
  </div>
<div align="right"><img src="<?php echo base_url('images/pie.jpg'); ?>" width="500"></div>