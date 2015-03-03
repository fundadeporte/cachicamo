<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='. $aniomes .'-caja_ahorro.csv');

  $monto_caja = 0;
  //En esta función se van a sumar todo los monto de los conceptos de los empleados
  foreach ($empleados as $key):
    //print $key['monto'];
    $monto_caja = $monto_caja + str_replace(".","",$key['monto']);
    # code...
  endforeach;
  //En este ciclo continuamos sumando los conceptos
  foreach ($patronales as $key):
    //print $key['monto'];
    $monto_caja = $monto_caja + str_replace(".","",$key['monto']);
    # code...
  endforeach;
  //Aqui comenzamos a mostrar todos los datos que se van a ver en el archivo
  $empl = count($empleados)+count($patronales);
  $cabecera = array('FUNDADEPORTE',$empl,$monto_caja);

  echo rtrim(implode(",",$cabecera), ',')."\n";
    
  if($empleados):foreach($empleados as $empleado):
  $data = str_replace("-", "", substr($empleado['fecha'], 0,-2)) . ",1," . $empleado['cedula'].",".$empleado['ds_concepto'].",".str_replace(".","",$empleado['monto']).','.str_replace("-", "", $empleado['fecha']);
  echo  "$data\n";
  endforeach; else:
  endif;
  if($patronales):foreach($patronales as $empleado):
  $data = str_replace("-", "", substr($empleado['fecha'], 0,-2)) . ",1," . $empleado['cedula'].",".$empleado['ds_concepto'].",".str_replace(".","",$empleado['monto']).','.str_replace("-", "", $empleado['fecha']);
  echo  "$data\n";
  endforeach; else:
  endif;

?>