<?php echo  $this->uri->segment(1, 0); ?>
  <div>
    menu
    <ul>
      <li><?php echo anchor('/', 'Principal', 'title="Ir pagina principal"'); ?></li>

      
    </ul>

  </div>
  <div>
  <h2>Departamentos sede<?php //echo  $this->uri->segment(2, 0); ?></h2>
  
  <table>
    <tr>
      <th>#</th>
      <th>sede</th>
      <th>Codigo departamento</th>
      <th>nombre</th>
    </tr>
    <?php $i = 0; ?>
    
    <?php if($query):foreach($query as $departamento):?>
    <?php $i++; ?>
    
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $departamento['cod_sede']; ?></td>
      <td><?php echo $departamento['codigo_departamento']; ?></td>
      <td><?php echo anchor('departamento/ver/' . $departamento['codigo_departamento'] . '/' . $departamento['cod_sede'],$departamento['departamento'],'title="Ver empleados de este departamento"'); ?></td>
    </tr>
    <?php endforeach; else:?>
    <?php endif;?>
  </table>
  </div>