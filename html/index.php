<?php
        if(isset($_GET['node'])){ ;
                $nurlid = $_GET['node'];
        } else {
                $nurlid = "overview";
        }

        include("sql.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SolarWeatherStationv0.2</title>

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
           <a class="navbar-brand" href="#">SolarWeatherStationv0.2</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <div style="padding-top: 5px;">
               <a class="btn btn-primary btn" href="/index.php?page=nodes" role="button">New node</a>
            </div>
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
                         debug_to_console( "105" );

                         while($nodeids = $nodes->fetchArray(SQLITE3_ASSOC) ) {
                            echo '<li><a href="/index.php?node=' . $nodeids['nodeid'] . '">' . $nodeids['nodeid'] . '</a></li>';
                         }

            ?>
            <li><a href="/reports.php">Reports</a></li>
          </ul>
        </div>
        <?php

            $page = $_GET["page"];


            switch ($page) {
                case 'home':
                    include 'home.php';
                    break;
                case 'nodes':
                    include 'nodes.php';
                    break;
                case 'reports':
                    include 'reports.php';
                    break;
                default:
                    include 'home.php';

            }
        ?>
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
