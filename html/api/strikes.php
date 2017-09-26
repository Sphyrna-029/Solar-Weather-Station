<?PHP
  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('/home/pi/WeatherDashboard/weatherdatabase.db');
    }
  }

  $db = new MyDB();
  if(!$db) {
    echo $db->lastErrorMsg();
  } else {
     echo "Opened database successfully";
     echo "<br>";
  }

  $sql =<<<EOF
    SELECT * from strikes;
EOF;

  $ret = $db->query($sql);
  while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    echo "Date = ". $row['tdate'] . "\n";
    echo "Distance (Km) = ". $row['distance'] . "\n";
    echo "<br>";
  }
  echo "Operation Completed Successfully\n";
  $db->close();
?>
