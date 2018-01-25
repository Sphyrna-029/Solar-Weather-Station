<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo $page ?><div class="pull-right" class="align-middle">
            <img src="/images/battery.png" width="50" height="50">
            <span id="volts"><?php echo $bvolts[0];?>v</span>
           </div>
          </h1>

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
