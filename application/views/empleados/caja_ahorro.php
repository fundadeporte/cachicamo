<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='. date('Y-m-d') .'-caja_ahorro.csv');



  //Aqui comenzamos a mostrar todos los datos que se van a ver en el archivo

  $cuenta = array("1"=>"Ahorro","2"=>"Corriente");

    
  if($empleados):foreach($empleados as $empleado):
  //echo $cuenta[]  
  $data = $empleado['nombre'] . "," . $empleado['apellido'] . "," . $empleado['cedula'] . "," . $empleado['numero_cuenta'] . ',' . $cuenta[$empleado['tipo_cuenta']] .",Venezuela";
  echo  "$data\n";
  endforeach; else:
  endif;


?>