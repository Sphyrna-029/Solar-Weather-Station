<?php include("sql.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Simple Weather Station v1.0</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

          .placeholder{
            /*text-align: center;*/
          }

          .outer_circle {
            margin: 0 auto;
            width: 200px;
            height: 200px;
            background-color: #428bca;
            border-radius: 100%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
          }

          .inner_circle{
            font-size: 90px;
            color: white;
          }

          .inner_pcircle{
             font-size: 45px;
             color: white;
          }



     </style>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Solar Weather Station</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="index.php">Overview <span class="sr-only">(current)</span></a></li>
            <?php
                         while($nodeids = $nodes->fetchArray(SQLITE3_ASSOC) ) {
                            echo '<li><a href="/index.php?node=' . $nodeids['nodeid'] . '">' . $nodeids['nodeid'] . '</a></li>';
                         }

            ?>
            <li><a href="/reports.php">Reports</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard<div class="pull-right" class="align-middle"><img src="/images/battery.png" width="50" height="50"><span id="volts"><?php echo $bvolts[0];?>v</span></div></h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <div class="outer_circle">
                <div class="inner_circle"><?php echo $temprow[0];?>c</div>
              </div>
              <h4>Temperature</h4>
              <span class="text-muted">Celcius</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <div class="outer_circle">
                <div class="inner_circle"><?php echo $strikesrow[0];?></div>
              </div>
              <h4>Lightning Strikes</h4>
              <span class="text-muted">Past 24 Hours</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <div class="outer_circle">
                 <div class="inner_circle"><?php echo $humiditypercent[0];?>%</div>
            </div>
              <h4>Humidity</h4>
              <span class="text-muted">Percentage</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <div class="outer_circle">
                  <div class="inner_pcircle"><?php echo $pressurepascals[0];?>hPa</div>
              </div>
              <h4>Pressure</h4>
              <span class="text-muted">hectopascals</span>
            </div>
          </div>

          <h2 class="sub-header">Lightning Strikes  <img src="/images/stormy.png" width="50" height="50"></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Distance Km</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                         while($strikeTable = $strikeD->fetchArray(SQLITE3_ASSOC) ) {
                            echo "<tr>";
                            echo "<td>". $strikeTable['tdate'] . "</td>";
                            echo "<td>". $strikeTable['distance'] . "</td>";
                            echo "</tr>";
                         }
                         $db->close();
                   ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script>
        var colorThreshold = document.getElementById("volts");
        var voltage = "<?php echo $bvolts[0];?>";

        function changeColor(val) {
            var color = "green";

            if (val > 11 && val < 12) {
                color = "yellow";
            } else if (val <= 11) {
                color = "red";
            }

            colorThreshold.style.color = color;
            console.log(colorThreshold)
            console.log(voltage)
            console.log(color)
        }

        changeColor(voltage);
    </script>
  </body>
</html>
