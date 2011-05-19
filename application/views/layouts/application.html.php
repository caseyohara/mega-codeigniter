<!DOCTYPE html>
<html lang="en">
<head>
	<title>CodeIgniter | Bare Install | Casey O'Hara</title>
	<link rel="stylesheet" href="/css/application.master.css" type="text/css" />
</head>
<body>
	
	<?= $this->load->view('/shared/header.html.php') ?>
	
	<div id="content" class="autoclear">
		<div id="main">	
			<?= $this->load->view($view) ?>
		</div>
	</div>

</body>
</html>