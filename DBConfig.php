<?
// Connect to DB
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "Metiri";
  
  $ms = mysqli_connect($host, $user, $pass, $db);
  if ( !$ms )
  {
    echo "Error connecting to database.\n";
  }

  // Then you need to make sure the database you want
  // is selected.
  mysql_select_db($db);
?>