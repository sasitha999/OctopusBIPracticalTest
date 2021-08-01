<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bar Chart in CodeIgniter 4 - Online Web Tutor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 style="text-align:center;">Bar Chart in CodeIgniter 4 - Online Web Tutor</h2>
  <div class="panel panel-default">
    <div class="panel-heading">Student</div>
    <div class="panel-body">
        <div id="container"></div>
    </div>
  </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    $(function(){
        Highcharts.chart('container', {

            title: {
                text: 'Solar Employment Growth by Sector, 2010-2016'
            },

            subtitle: {
                text: 'Source: thesolarfoundation.com'
            },

            yAxis: {
                title: {
                    text: 'Number of Employees'
                }
            },

            xAxis: {
                categories :<?= $years ?>,
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },


            // series: [{
            //     name: 'Installation',
            //     data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
            // }, {
            //     name: 'Manufacturing',
            //     data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
            // }, {
            //     name: 'Sales & Distribution',
            //     data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
            // }, {
            //     name: 'Project Development',
            //     data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
            // }, {
            //     name: 'Other',
            //     data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
            // }],


            series: <?= $subjectData ?>,

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
    });
</script>

</body>
</html>