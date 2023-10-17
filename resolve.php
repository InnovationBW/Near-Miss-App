<?php
   if(!$_GET['id']) {
       echo "error";
   } else {
       $id = $_GET['id'];
       require_once('connectionInfo.php');
    //    $establishCon = @mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
       
        $establishCon = mysqli_init();
        $establishCon->ssl_set(NULL, NULL, $mysql_ssl, NULL, NULL);
        $establishCon->real_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
   
       $updateQuery = "UPDATE `nearMissFormData` SET `caseStatus` = 'Resolved' WHERE `nearMissID` = '$id'";
       $updateData = mysqli_query($establishCon, $updateQuery);
       
       if($updateData) {
           echo "<script>alert('You have successfully resolved this near-miss case!')</script>";
           echo "<script>location.href='adminpage.php'</script>";
           //header("location:adminpage.php"); 
       } else {
           echo "error";
       }
   }
   ?>