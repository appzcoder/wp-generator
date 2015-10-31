<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WP Generator</title>
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			padding-top: 70px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	    <div class="container">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="#">WP Generator</a>
	        </div>
	    </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		<form class="form-horizontal" method="post" action="process.php">
			<div class="form-group">
				<label for="plugin_name" class="col-md-4 control-label">Plugin Name:</label>
				<div class="col-md-4">
					<input type="text" name="plugin_name" class="form-control" id="plugin_name" placeholder="Plugin Name" required />
				</div>
			</div>
			<div class="form-group">
				<label for="plugin_url" class="col-md-4 control-label">Plugin URL:</label>
				<div class="col-md-4">
					<input type="text" name="plugin_url" class="form-control" id="plugin_url" placeholder="http://www.appzcoder.com" required />
				</div>
			</div>
			<div class="form-group">
				<label for="plugin_description" class="col-md-4 control-label">Plugin Description:</label>
				<div class="col-md-4">
					<input type="text" name="plugin_description" class="form-control" id="plugin_description" placeholder="A sample plugin." required />
				</div>
			</div>
			<div class="form-group">
				<label for="plugin_version" class="col-md-4 control-label">Plugin Version:</label>
				<div class="col-md-4">
					<input type="text" name="plugin_version" class="form-control" id="plugin_version" placeholder="1.0" required />
				</div>
			</div>
			<div class="form-group">
				<label for="plugin_author" class="col-md-4 control-label">Plugin Author:</label>
				<div class="col-md-4">
					<input type="text" name="plugin_author" class="form-control" id="plugin_author" placeholder="Sohel Amin" required />
				</div>
			</div>
			<div class="form-group">
				<label for="plugin_author_url" class="col-md-4 control-label">Plugin Author URL:</label>
				<div class="col-md-4">
					<input type="text" name="plugin_author_url" class="form-control" id="plugin_author_url" placeholder="http://www.sohelamin.com" required />
				</div>
			</div>
			<div class="form-group">
				<label for="crud_singular" class="col-md-4 control-label">Crud Name:</label>
				<div class="col-md-4">
					<input type="text" name="crud_singular" class="form-control" id="crud_singular" placeholder="customer" required />
				</div>
			</div>
			<div class="form-group">
				<label for="textdomain" class="col-md-4 control-label">Textdomain:</label>
				<div class="col-md-4">
					<input type="text" name="textdomain" class="form-control" id="textdomain" placeholder="appzcoder" required />
				</div>
			</div>
			<div class="form-group">
				<label for="prefix" class="col-md-4 control-label">Prefix:</label>
				<div class="col-md-4">
					<input type="text" name="prefix" class="form-control" id="prefix" placeholder="ac" required />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-md-4">
					<button type="submit" class="btn btn-default" name="generate">Generate Crud Plugin</button>
				</div>
			</div>
		</form>
	</div>

	<hr/>

	<div class="container">
	    &copy; <?php echo date('Y');?>. Created by <a href="http://www.appzcoder.com">AppzCoder</a>
	    <br/>
	</div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>