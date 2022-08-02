<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload an image</title>
</head>
<body>
    <h1>Upload an Image</h1>
    <form action ="" method = "POST" enctype="multipart/form-data">
        <p>
           <label for="img">Select image:</label>
           <input type="file" id="img" name="imagefile" accept="image/*">
        </p>
        <input type="submit" value="Post" name="submit1">
     </form>
     
     <?php 
        $establishCon = @mysqli_connect("cmslamp14","nearmiss", "cHz4n3armiss2022", "nearmiss");
        if(isset($_POST["submit1"])) {

            //$image = file_get_contents($_FILES['imagefile']['tmp_name']);
            $name = $_FILES['imagefile']['name'];

            $tmpName  = $_FILES['imagefile']['tmp_name'];  

            list($width,$height)=getimagesize($tmpName);

            if ($width>$height && $width>$maxwidth) {
                $newheight=($height/$width)*$maxwidth;
                $newwidth=$maxwidth;
                $imageResized = imagecreatetruecolor($newwidth, $newheight);
                $tmpName     = imagecreatefromjpeg ($tmpName);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                $tmpName=$imageResized;

                // My problem lies somewhere here ^^^^
            }

            // Read the file 
            $fp      = fopen($tmpName, 'r');
            $data = fread($fp, filesize($tmpName));
            $data = addslashes($data);
            fclose($fp);


        if(!$establishCon) {
            echo "<p>Failed to establish connection! Please try again</p>";
            exit();
            } else {
    
                if (!$tableExist) {
                    $createTableQuery =
                        "CREATE TABLE nearMissImages (imageID INT AUTO_INCREMENT PRIMARY KEY, imageFileName VARCHAR(100) NOT NULL, imageFiles longblob NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        
                    $createTableResult = mysqli_query($establishCon, $createTableQuery);
        
                    // Error message is shown if the table cannot be created else a success message is shown
                    if (!$createTableResult) {
                        echo "<p>An error has occured in the creating the table. Please try again.</p>";
                    } else {
                        echo "<p>The 'nearMissImages' table has been created successfully.</p>";
                    }
                }
    
            $insertData = "INSERT INTO `nearMissImages` (`imageFileName`, `imageFiles`) VALUES ('$name', '$data');";
            $initialiseInsert = mysqli_query($establishCon, $insertData);
            if(!$initialiseInsert) {
                echo "<p>There is an error with data insertion! Please try again</p>";
            } else {
                echo "<p>Image added to the database</p>";
            }
            }
            mysqli_close($establishCon);
    }

?>
</body>
</html>