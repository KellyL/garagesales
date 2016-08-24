<?php
  require_once('config.php');

  $mysqli = new mysqli($db_server, $db_user, $db_password, $db_database);

  if(mysqli_connect_errno())
  {
  	header('HTTP:/1.1 500 Error: Could not connect to database!');
  	exit();
  }

  $query = "SELECT * FROM garageSales";

  $result = $mysqli->query($query);

  $output = "";

  if($result)
  {
    $numSales = $result->num_rows;

    for($i = 0; $i < $numSales; $i++)
    {
    	$row = $result->fetch_assoc();
    	$output = $output . "<tr><td>". $row['city'] . "</td><td>" . $row['address'] . "</td><td>". $row['date'];
    	$output = $output . "</td><td>" . $row['comments'] . "</td><td>" . $row['lat'] . "</td><td>" . $row['lng'] . "</td></tr>";
    }
  }
  else
  {
    echo "Error: unable to insert member: " . $dbObj->error; // that's what she said
  }

?>

<html>
  <head></head>
  <body>
  <?php echo "<table>" . $output . "</table>"; ?>
  </body>
</html>