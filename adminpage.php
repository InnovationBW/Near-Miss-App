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
      <title>Admin Page</title>
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
                        <a href="#">
                           <div class="sub-menu">
                              <i class="bi bi-person-circle"></i>
                              <p class="menu-title">Login</p>
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
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <?php
         $accesscode = "admin";
         
         session_start();
         
         if(isset($_SESSION['accesscode'])) {
            echo"<html>";
            echo"<head>";
            echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'/>";
            echo"<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' rel='stylesheet'/>";
            echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css' rel='stylesheet'/>";
            echo"</head>";
            echo"<body>";
             echo"<h1 class='text-center'> Welcome Admin</h1> ";
             echo"<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js'></script>";
             echo"</body>";
             echo"</html>";
         ?>
      <!-- Button trigger modal -->
      <!-- Tabs navs -->
      <ul class="nav nav-tabs mb-2 justify-content-center" id="ex1" role="tablist">
         <li class="nav-item" role="presentation">
            <a
               class="nav-link active"
               id="ex1-tab-1"
               data-mdb-toggle="tab"
               href="#ex1-tabs-1"
               role="tab"
               aria-controls="ex1-tabs-1"
               aria-selected="true"
               >View Unresolved Cases</a
               >
         </li>
         <li class="nav-item" role="presentation">
            <a
               class="nav-link"
               id="ex1-tab-2"
               data-mdb-toggle="tab"
               href="#ex1-tabs-2"
               role="tab"
               aria-controls="ex1-tabs-2"
               aria-selected="false"
               >View Resolved Cases</a
               >
         </li>
      </ul>
      <!-- Tabs navs -->
      <?php
         $establishCon = @mysqli_connect("cmslamp14","nearmiss", "cHz4n3armiss2022", "nearmiss");
         
         if(!$establishCon) {
            echo "Failed to establish connection!";
            exit();
         } else {
            $displayQueryUnresolved = "SELECT * FROM `nearMissFormData` WHERE `caseStatus` = 'Unresolved'";
            $selectDataUnresolved = mysqli_query($establishCon, $displayQueryUnresolved);
         
            $displayQueryResolved = "SELECT * FROM `nearMissFormData` WHERE `caseStatus` = 'Resolved'";
            $selectDataResolved = mysqli_query($establishCon, $displayQueryResolved);
         
         ?>
      <div class="tab-content" id="ex1-content">
         <div
            class="tab-pane fade show active"
            id="ex1-tabs-1"
            role="tabpanel"
            aria-labelledby="ex1-tab-1"
            >
            <?php
               echo"<html>";
               echo"<head>";
               echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'/>";
               echo"<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' rel='stylesheet'/>";
               echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css' rel='stylesheet'/>";
               echo"</head>";
               echo"<body>";
               
               echo "<div class='table-responsive'>";
               echo "<table class='table'>";
               echo "<thead>";
               echo "<tr>";
               echo "<th scope='col'>Case ID</th>";
               echo "<th scope='col'>Site Location</th>";
               echo "<th scope='col'>Insite Location</th>";
               echo "<th scope='col'>Description</th>";
               echo "<th scope='col'>Date and Time</th>";
               echo "<th scope='col'>Priority</th>";
               echo "<th scope='col'>Case Image</th>";
               echo "<th scope='col'>Status</th>";
               echo "</tr>";
               echo "</thead>";
               echo "<tbody>";
               while ($row = mysqli_fetch_assoc($selectDataUnresolved)){
                  echo "<tr>";
                  echo "<td>",$row["nearMissID"],"</td>";
                  echo "<td>",$row["nmSiteLocation"],"</td>";
                  echo "<td>",$row["nmInSiteLocation"],"</td>";
                  echo "<td>",$row["nmDesc"],"</td>";
                  echo "<td>",$row["nmDateTime"],"</td>";
                  echo "<td>",$row["nmPriority"],"</td>";
                  echo "<td><button type='button' class='btn btn-primary' data-mdb-toggle='modal' data-mdb-target='#","case",$row["nearMissID"],"'>View Image</button></td>";
                  echo "<div class='modal fade' id='","case",$row["nearMissID"],"' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                  echo "<div class='modal-dialog'>";
                  echo "<div class='modal-content'>";
                  echo "<div class='modal-header'>";
                  echo "<h5 class='modal-title' id='exampleModalLabel'>","Case ID: ",$row["nearMissID"],"</h5>";
                  echo "<button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>";
                  echo "</div>";
                  echo "<div class='modal-body'>";
                  echo '<img height="250px" width="250px" src=data:image;base64,' .$row['imageFiles']. ' />';
                  echo "</div>";
                  echo "<div class='modal-footer'>";
                  echo "<button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>Close</button>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  //echo "<td>",'<img height="250px" width="250px" src=data:image;base64,' .$row['imageFiles']. ' />',"</td>";
                  echo "<td>",$row["caseStatus"],"</td>";
                  echo "</tr>";
               }
               echo "</tbody>";
               echo "</table>";
               echo "</div>";
               echo"<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js'></script>";
               echo"</body>";
               echo"</html>";
               // Frees up the memory, after using the result pointer
               mysqli_free_result($selectDataUnresolved);
               ?>
         </div>
         <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            <?php
               echo"<html>";
               echo"<head>";
               echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'/>";
               echo"<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' rel='stylesheet'/>";
               echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css' rel='stylesheet'/>";
               echo"</head>";
               echo"<body>";
               
               echo "<div class='table-responsive'>";
               echo "<table class='table'>";
               echo "<thead>";
               echo "<tr>";
               echo "<th scope='col'>Case ID</th>";
               echo "<th scope='col'>Site Location</th>";
               echo "<th scope='col'>Insite Location</th>";
               echo "<th scope='col'>Description</th>";
               echo "<th scope='col'>Date and Time</th>";
               echo "<th scope='col'>Priority</th>";
               echo "<th scope='col'>Case Image</th>";
               echo "<th scope='col'>Status</th>";
               echo "</tr>";
               echo "</thead>";
               echo "<tbody>";
               while ($row = mysqli_fetch_assoc($selectDataResolved)){
                  echo "<tr>";
                  echo "<td>",$row["nearMissID"],"</td>";
                  echo "<td>",$row["nmSiteLocation"],"</td>";
                  echo "<td>",$row["nmInSiteLocation"],"</td>";
                  echo "<td>",$row["nmDesc"],"</td>";
                  echo "<td>",$row["nmDateTime"],"</td>";
                  echo "<td>",$row["nmPriority"],"</td>";
                  echo "<td><button type='button' class='btn btn-primary' data-mdb-toggle='modal' data-mdb-target='#","case",$row["nearMissID"],"'>View Image</button></td>";
                  echo "<div class='modal fade' id='","case",$row["nearMissID"],"' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                  echo "<div class='modal-dialog'>";
                  echo "<div class='modal-content'>";
                  echo "<div class='modal-header'>";
                  echo "<h5 class='modal-title' id='exampleModalLabel'>","Case ID: ",$row["nearMissID"],"</h5>";
                  echo "<button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>";
                  echo "</div>";
                  echo "<div class='modal-body'>";
                  echo '<img height="250px" width="250px" src=data:image;base64,' .$row['imageFiles']. ' />';
                  echo "</div>";
                  echo "<div class='modal-footer'>";
                  echo "<button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>Close</button>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  //echo "<td>",'<img height="250px" width="250px" src=data:image;base64,' .$row['imageFiles']. ' />',"</td>";
                  echo "<td>",$row["caseStatus"],"</td>";
                  echo "</tr>";
               }
               echo "</tbody>";
               echo "</table>";
               echo "</div>";
               echo"<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js'></script>";
               echo"</body>";
               echo"</html>";
               // Frees up the memory, after using the result pointer
               mysqli_free_result($selectDataResolved);
               ?>
         </div>
      </div>
      <?php
         echo"<html>";
         echo"<head>";
         echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'/>";
         echo"<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' rel='stylesheet'/>";
         echo"<link href='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css' rel='stylesheet'/>";
         echo"</head>";
         echo"<body>";
         echo "<div class='text-center'>";
         echo "<a href='adminlogout.php' class='text-center'><button type='button' class='btn btn-primary text-center'>Logout</button></a>";
         echo "</div>";
          echo"<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js'></script>";
          echo"</body>";
          echo"</html>";
         
         }
         
         } else {
         if($_POST['accesscode'] == $accesscode) {
          $_SESSION['accesscode'] = $accesscode;
         
          echo "<script>location.href='adminpage.php'</script>";
         } else {
          echo "<script>alert('Access code is incorrect! Please try again')</script>";
          echo "<script>location.href='adminlogin.html'</script>";
         }
         }
         
         ?>
   </body>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
</html>