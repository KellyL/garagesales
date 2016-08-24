<?php
  require_once('config.php');
  require_once('googleFunctions.php');

  $city = $_POST['cityName'];
  $address = $_POST['address'];
  $date = $_POST['saleDate'];
  $comments = $_POST['comments'];

  $dbObj = new mysqli($db_server, $db_user, $db_password, $db_database);

  if(mysqli_connect_errno())
  {
  	header('HTTP:/1.1 500 Error: Could not connect to database!');
  	exit();
  }

  $geocodeAddress = addressToLatLng($address . ", " . $city . ", ON");
  $lat = $geocodeAddress['latitude'];
  $lng = $geocodeAddress['longitude'];
  
  $query = "INSERT INTO garageSales (city, address, saleDate, comments, lat, lng) VALUES ('" . $city . "', '" . $address . "', '" . $date . "', '" . $comments . "', '" . $lat . "', '" . $lng . "')";

  $result = $dbObj->query($query);

  if($result)
  {
    echo $dbObj->affected_rows . " member added<br />";
  }
  else
  {
    echo "Error: unable to insert member: " . $dbObj->error; // that's what she said
  }

  $dbObj->close();

  echo $lat . ", " . $lng;

?>
