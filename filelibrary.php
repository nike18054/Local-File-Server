
<head>
		<title>Local PHP Sever</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<script src="js/bootsrap.js"></script>
		<script src="js/jquery-3.2.1.js"></script>
		
		<style>
			.bg1{
				background-color: #ccc;
				height: 500px;
				width: 100%;
			}
			.bg2{
				background-color: #ccc;
			}
			.navbar{
				border-radius: 0px;
			}
			.buttonstyle{
				color: #fff;
				text-decoration: none;
			}
			.buttonstyle:hover {
				color: #fff;
				text-decoration: none;
			}
		
		</style>
	</head>
    <body>
		
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			  </button>
			  <a class="navbar-brand" href="#">LOCAL FILE SERVER</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav">
				<li><a href="index.html">Home</a></li>
				<li><a href="phpsysinfo/index.php">Server Stats</a></li>
				<li class="active"><a href="filelibrary.php">File Library</a></li> 
				<li><a href="#">Page 3</a></li> 
			  </ul>
			</div>
		  </div>
		</nav>
<table class="collapse" border="1">
<thead>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Last Modified</th></tr>
</thead>
<tbody>
<?PHP
  $dirlist = "/var/www/html/uploads/";
  
  if (is_dir($dirlist)){
	if ($dh = opendir($dirlist)){
		while(($file = readdir($dh)) !== false){
			echo "filename: " . $file . "<br>";
		}
		closedir($dh);
	}
  }
?>
<button class="btn-primary">
	<a class="buttonstyle" href="compressed.zip" download="filelibrary">
		Download this directory.
	</a>
</button>
</tbody>
</table>
</body>
