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
  <h2 style="text-align:center;">Student Perfroamce In All Subject</h2>
  <div class="panel panel-default">
    <div class="panel-heading">Student : - </div>
    <div class="panel-heading">
        <select id ="select-user" class="js-example-basic">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <select id ="select-subject">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    
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
                text: 'StudentName\'s Performace  in 2000 - 2019 Semeter Wise'
            },

            yAxis: {
                title: {
                    text: 'Avarage Marks For Subject',
                    
                },
                max:100
            },

            xAxis: {
                title: {
                    text: 'Semester wise Year',
                    
                },
                categories :<?= $years ?>,
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            series: <?= $subjectData ?>,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 1500   
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