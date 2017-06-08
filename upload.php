
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
				<li class="active"><a href="index.html">Home</a></li>
				<li><a href="phpsysinfo/index.php">Server Stats</a></li>
				<li><a href="filelibrary.php">File Library</a></li> 
				<li><a href="#">Page 3</a></li> 
			  </ul>
			</div>
		  </div>
		</nav>
		<?php
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// Check if image file is a actual image or different file.
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an accepted - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				echo "File is accepted, but may be a risky file. ";
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "File already exist and has been overwritten. ";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($fileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $fileType != "gif" || $fileType != "html" || $fileType != "php"
		|| $fileType != "css" || $fileType != "js" || $fileType != "txt"
		) {
			$uploadOk = 1;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}

		?>
		
		<button class="btn-primary">
			<a class="buttonstyle" href="filelibrary.php">
				View Files
			</a>
		</button>
		<button class="btn-primary">
			<a class="buttonstyle" href="index.html">
				Next <span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</button>
	</body>
<?php
function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

Zip('/var/www/html/uploads/', './compressed.zip');
?>
