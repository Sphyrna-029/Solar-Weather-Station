<?PHP 
  $db = new SQLite3('/home/pi/WeatherDashboard/weatherdatabase.db');
  $temp = $db->query('SELECT temperature, max(tdate) FROM multisensor;');
  $strikes = $db->query('SELECT COUNT(*) FROM strikes WHERE tdate >= datetime(\'now\', \'-1 day\');');
  $strikeD = $db->query('SELECT * FROM strikes LIMIT 15 OFFSET (SELECT COUNT(*) FROM strikes)-15;');
  $humidity = $db->query('SELECT humidity, max(tdate) from multisensor;');
  $pressure = $db->query('SELECT pressure, max(tdate) FROM multisensor;');
  $volts = $db->query('SELECT bvolts, max(tdate) from power;');
  $bvolts = $volts->fetchArray();
  $pressurepascals = $pressure->fetchArray();
  $humiditypercent = $humidity->fetchArray();
  $strikesrow = $strikes->fetchArray();
  $temprow = $temp->fetchArray();
  /*$db->close();*/
?>
