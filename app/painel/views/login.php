<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lustres e Cia - Painel Administrativo</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        	folder instead of downloading all of them to reduce the load. -->
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/skins/_all-skins.min.css">
        	<!-- Morris chart -->
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/morris.js/morris.css">
        	<!-- jvectormap -->
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
        	<!-- Date Picker -->
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        	<!-- Daterange picker -->
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        	<!-- bootstrap wysihtml5 - text editor -->
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
        	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css">
        	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>



<div style="width: 80%; margin: 0 auto; padding: 80px;">
	<div style="width: 100%; margin: 0 auto;">
		<div class="col-lg-4 col-lg-offset-4" style="background-color: #fff; border-radius: 4px; padding: 10px;">
			<form method="POST">
				<div class="page-header">
					<h1>Login</h1>
				</div>

				<?php if (isset($mensagem) && !empty($mensagem)): ?>
					<div class="alert alert-danger"><h2><?php echo $mensagem; ?></h2></div><br>
				<?php endif ?>

				<div class="form-group">
					<label for="user">Nome de Usuário</label><br>
					<input class="form-control" type="text" name="user" placeholder="Digite o nome do usuário..." required>
				</div>

				<div class="form-group">
					<label for="password">Senha</label><br>
					<input class="form-control" type="password" name="password" placeholder="Digite sua senha..." required><br><br>
				</div>

				<div class="form-group">
					<input class="btn btn-primary center-block" type="submit" value="Acessar">
				</div>

			</form>

		</div>
	</div>
</div>




<script src="<?php echo BASE_URL; ?>/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo BASE_URL; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo BASE_URL; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo BASE_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo BASE_URL; ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>assets/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="<?php echo BASE_URL; ?>tinymce/tinymce.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
<script>
	tinymce.init({
		selector: '#editor',
	});
</script>
</body>
</html>