<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/theme-yeti.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
	<script src='https://www.google.com/recaptcha/api.js'></script>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

	<!-- Custom css for this site -->
	<?php if ($css_files?? false): ?>
		<?php foreach ($css_files as $key => $css_file): ?>
			<link rel="stylesheet" href="<?php echo base_url('assets/css/' . $css_file) ?>">
		<?php endforeach ?>
	<?php endif ?>
	
	<title>Teste</title>
</head>
