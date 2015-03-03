<!DOCTYPE html>
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Prime</title>
  </head>
 
<body>
  <h2>This is my blog</h2>
  <?php //print_r($query); ?>
  <?php if($query):foreach($query as $post):?>
  <h4><?php echo $post->cod_institucion;?> (<?php echo $post->CODIGO_DEPARTAMENTO;?>)</h4>
  <?php echo $post->DEPARTAMENTO;?>
  <?php endforeach; else:?>
  <h4>No entry yet!</h4>
  <?php endif;?>
  </body>
  </html>