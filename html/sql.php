<?PHP
        include ("debug.php");



        if ($nurlid == 'overview'){
                $db = new SQLite3('/home/kickinwing/Solar-Weather-Station/backend/weatherdatabase.db');
                $temp = $db->query('SELECT temperature, max(tdate) FROM multisensor;');
                $strikes = $db->query('SELECT COUNT(*) FROM strikes WHERE tdate >= datetime(\'now\', \'-1 day\');');
                $strikeD = $db->query('SELECT * FROM strikes LIMIT 15 OFFSET (SELECT COUNT(*) FROM strikes)-15;');
                $humidity = $db->query('SELECT humidity, max(tdate) from multisensor;');
                $pressure = $db->query('SELECT pressure, max(tdate) FROM multisensor;');
                $volts = $db->query('SELECT bvolts, max(tdate) from power;');
                $nodes = $db->query('SELECT * FROM nodes;');
                debug_to_console( "overview nodes hit" );
                $bvolts = $volts->fetchArray();
                $pressurepascals = $pressure->fetchArray();
                $humiditypercent = $humidity->fetchArray();
                $strikesrow = $strikes->fetchArray();
                $temprow = $temp->fetchArray();

        } else {
                $db = new SQLite3('/home/kickinwing/Solar-Weather-Station/backend/weatherdatabase.db');
                $temp = $db->query('SELECT temperature, max(tdate) FROM multisensor WHERE nodeid = $nurlid;');
                $strikes = $db->query('SELECT COUNT(*) FROM strikes WHERE tdate >= datetime(\'now\', \'-1 day\') AND  nodeid = $nurlid;');
                $strikeD = $db->query('SELECT * FROM strikes WHERE nodeid = $nurlid LIMIT 15 OFFSET (SELECT COUNT(*) FROM strikes)-15;');
                $humidity = $db->query('SELECT humidity, max(tdate) FROM multisensor WHERE nodeid = $nurlid;');
                $pressure = $db->query('SELECT pressure, max(tdate) FROM multisensor WHERE nodeid = $nurlid;');
                $volts = $db->query('SELECT bvolts, max(tdate) FROM power WHERE nodeid = $nurlid;');
                $nodes = $db->query('SELECT * FROM nodes;');
                debug_to_console( "nodeid nodes hit" );
                $bvolts = $volts->fetchArray();
                $pressurepascals = $pressure->fetchArray();
                $humiditypercent = $humidity->fetchArray();
                $strikesrow = $strikes->fetchArray();
                $temprow = $temp->fetchArray();

        }

?>
