<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Reports</h1>
          <style>
            #container {
                min-width: 310px;
                max-width: 800px;
                height: 400px;
                margin: 0 auto
            }
          </style>
          <div id="graphcontainer"></div>
        </div>
        </div>
      </div>
    </div>
    <script>
      Highcharts.chart('graphcontainer', {

      title: {
          text: 'System Voltage'
      },

    yAxis: {
        title: {
            text: 'Volts'
        }
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    series: [{
        name: 'Battery',
        data: [11.8, 12, 12.9, 13.2, 13, 12.5, 12.1, 11.7]
    },],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
