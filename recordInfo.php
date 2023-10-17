<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
      <link rel="stylesheet" href="./styles/style.css">
      <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
      <title>The Near-miss form receipt</title>
      <link rel = "icon" type = "image/png" href = "./images/logo.png">
   </head>
   <body>
      <!-- Navbar -->
      <header>
         <!-- Navbar -->
         <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li>
                        <a href="index.html">
                           <div class="sub-menu">
                              <i class="bi bi-house-door"></i>
                              <p class="menu-title">Home</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="index.html#about-section">
                           <div class="sub-menu">
                              <i class="bi bi-info-square"></i>
                              <p class="menu-title">About</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="index.html#contact-section">
                           <div class="sub-menu">
                              <i class="bi bi-chat-left-text"></i>
                              <p class="menu-title">Contact</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="adminlogin.html">
                           <div class="sub-menu">
                              <i class="bi bi-person-circle"></i>
                              <p class="menu-title">Admin</p>
                           </div>
                        </a>
                     </li>
                     <li>
                        <a href="record.html">
                           <div class="sub-menu">
                              <i class="bi bi-pencil-square"></i>
                              <p class="menu-title">Record</p>
                           </div>
                        </a>
                     </li>
                  </ol>
               </nav>
            </div>
         </nav>
         <!-- Navbar -->
      </header>
      <!-- Navbar -->
      <div class="receipt-text">
      <br>
      <br>
      <br>
      <br>
      <h1>Near-miss Receipt</h1>
      <?php
         require('connectionInfo.php');
         // $dbConn = @mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

         // Set SSL cert and open connection to the MySQL server
         $dbConn = mysqli_init();
         $dbConn->ssl_set(NULL, NULL, $mysql_ssl, NULL, NULL);
         $dbConn->real_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
                  
         if(!$dbConn)
         {
             echo "<p>Connection with the database has failed</p>";
         }
         else
         {
             $formDataExist = @mysqli_query($dbConn, "SELECT * FROM nearMissFormData;"); //Data from database table saved into variable along with connection to database
             
             if(!$formDataExist) //Checks if there is data in the database table now stored in this variable
             { 
                 echo "<p>The table 'recordFormData' does not exist, creating table now.</p>";
                 
                 //Creates database table with the variables specifiying thier type, size and other aspects
                 $createFormDataTable = "CREATE TABLE nearMissFormData (nearMissID INT(20) AUTO_INCREMENT PRIMARY KEY, nmSiteLocation VARCHAR(255), nmRegionSubdiv VARCHAR(100), nmInSiteLocation VARCHAR(100), nmDesc VARCHAR(100), nmDateTime DATETIME,
                 imageFileName VARCHAR(100) NOT NULL, imageFiles longblob NOT NULL, caseStatus VARCHAR(15) DEFAULT 'Unresolved') ENGINE=InnoDB DEFAULT CHARSET=latin1;";
             
                 //Stores connection and collumn creation query variables as paramters in a result variable
                 $tableResult = mysqli_query($dbConn, $createFormDataTable);
         
                 if(!$tableResult) //Checks if the columns and database table is created and succesful
                 {
                     echo "<p>There was an issue creating the columns in the database table. Please try again</p>";
                 }
                 else
                 {
                     echo "<p>Successful query operation</p>";
                 }
             }
         
             //Gets Post data for these variables and stores it into a new variable
             $nmSiteLocation = $_POST["nmSiteLocation"];
             $nmRegionSubdiv = $_POST["nmRegionSubdiv"];
             $nmInSiteLocation = $_POST["nmInSiteLocation"];
             $nmDesc = $_POST["description"];
             $nmDateTime = $_POST["dateTime"];
         
             // Checks if post is clicked
             if (isset($_POST["submit"])) {
             // Checks if the uploaded image is valid
                 // If the image uploaded is valid, the following occurs
         
                 // Declare and store image file and file name into variables
                 $image = $_FILES["uploadedImageFile"]["tmp_name"];
                 $imageFileName = $_FILES["uploadedImageFile"]["name"];
                 $image = base64_encode(file_get_contents(addslashes($image)));
         
                 //Adds information into table collumns and stores it in a variable and assigns values
                 $insertFormDataQuery = "INSERT INTO nearMissFormData (nmSiteLocation, nmRegionSubdiv, nmInSiteLocation, nmDesc, nmDateTime, imageFileName, imageFiles) VALUES ('$nmSiteLocation', '$nmRegionSubdiv', '$nmInSiteLocation', '$nmDesc', '$nmDateTime', '$imageFileName', '$image');";
                 $insertFormDataResult = mysqli_query($dbConn, $insertFormDataQuery);
         
                 // If something is wrong with the inserting process and error message is shown
                 if (!$insertFormDataResult) {
                     echo "<p>There is an issue with adding information to the database. Try again.</p>";
                 } else {
                     echo "<p><strong>Congratulations!</strong> Your near-miss entry has been successfully submitted! Here is the details of your receipt:</p>";
                     $checkNearMissID = "SELECT * FROM `nearMissFormData` ORDER BY `nearMissID` DESC LIMIT 1";
                     $getNearMissID = mysqli_query($dbConn, $checkNearMissID);
                     
                     while($row = mysqli_fetch_assoc($getNearMissID))
                     {
                        //Echo statements that call the variables in the form to use to print out in the HTML form
                         echo "<p><strong>Near-miss Entry ID: </strong>".$row["nearMissID"]."</p>";
                         echo "<p><strong>Site Location: </strong>".$row["nmSiteLocation"]."</p>";
                         echo "<p><strong>Region: </strong>".$row["nmRegionSubdiv"]."</p>";
                         echo "<p><strong>In-Site location: </strong>".$row["nmInSiteLocation"]."</p>";
                         echo "<p><strong>Near-miss Description: </strong>".$row["nmDesc"]."</p>";
                         echo "<p><strong>Recorded Date and Time: </strong>".$row["nmDateTime"]."</p>";
                         echo "<p><strong>Filename of image uploaded: </strong>".$row["imageFileName"]."</p>";
         
                         //Stores text statements inside variables to use in the .txt file
                         $textHeader = "                                             *******************\n********************************************* Near-miss receipt **********************************************\n                                             *******************\n\n"; 
                         $recordedID = "--------------------------------------------------------------------------------------------------------------\nNear-miss Entry ID: ".$row["nearMissID"]. "\n";
                         $recordedSiteLocation = "--------------------------------------------------------------------------------------------------------------\nSite Location: ".$row["nmSiteLocation"]."\n";
                         $recordedRegion = "--------------------------------------------------------------------------------------------------------------\nRegion: ".$row["nmRegionSubdiv"]."\n";
                         $recordedInSiteLocation = "--------------------------------------------------------------------------------------------------------------\nIn-Site location: ".$row["nmInSiteLocation"]."\n";
                         $recordedDescription = "--------------------------------------------------------------------------------------------------------------\nNear-miss Description: ".$row["nmDesc"]."\n";
                         $recordedDateTime = "--------------------------------------------------------------------------------------------------------------\nRecorded Date and Time: ".$row["nmDateTime"]."\n";
                         $recordedImageFileName = "--------------------------------------------------------------------------------------------------------------\nFilename of image uploaded: ".$row["imageFileName"]."\n--------------------------------------------------------------------------------------------------------------\n";
                         $thankYouMessage = "\n--------------------------------------------------------------------------------------------------------------\nThank you for your Near-miss submission. We will work on deploying a solution as soon as possible.\nIf you have any queries please contact us on our email and include your near-miss entry ID.\nHave a good day.";
                         $textFileFooter = "\n--------------------------------------------------------------------------------------------------------------\n\n**************************************************************************************************************\n";
                         
                         //This will open up a .txt file and "write" the contents from the variables above and store it into the .txt file
                         $receiptFile = fopen("nearMissReceipt.txt", 'w');
                         fwrite($receiptFile, $textHeader);
                         fwrite($receiptFile, $recordedID);
                         fwrite($receiptFile, $recordedSiteLocation);
                         fwrite($receiptFile, $recordedRegion);
                         fwrite($receiptFile, $recordedInSiteLocation);
                         fwrite($receiptFile, $recordedDescription);
                         fwrite($receiptFile, $recordedDateTime);
                         fwrite($receiptFile, $recordedImageFileName);
                         fwrite($receiptFile, $thankYouMessage);
                         fwrite($receiptFile, $textFileFooter);
                         fclose($receiptFile);
                     }  
                 }
             }
         }
         mysqli_close($dbConn); 
         ?>
      <div>
      <br>
      <!--Buttons which are to allow the user to return to the record another miss, or download a receipt of their submission-->
      <button class = "receipt-button receiptRecordBtn" onclick="location.href='record.html';">Record Another Near-miss</button>
      <a class="receipt-button downloadReceiptBtn" download href="nearMissReceipt.txt">Download Receipt</a>
   </body>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
</html>