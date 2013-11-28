<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<? echo $this->Html->url("/css/bootstrap.min.css") ?>" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('jumbtron');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<? echo $this->Html->url("/") ?>js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="<? echo $this->Html->url("/a/revisoes") ?>">Revisões</a></li>
          <li><a href="<? echo $this->Html->url("/a/revisoes/nova") ?>">Nova revisão</a></li>
        </ul>
        <h3 class="text-muted">Revisão sistemática</h3>
      </div>

      
	
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>

      

      <div class="footer">
        <p>&copy; Desenvolvido por: Tulio Faria EACH <? echo date("Y") ?></p>
      </div>

    </div> <!-- /container -->
    

	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
