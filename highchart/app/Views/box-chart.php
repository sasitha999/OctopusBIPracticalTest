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
  <h2 style="text-align:center;">Box Chart </h2>
  <div class="panel panel-default">
    <div class="panel-heading">Box Chart</div>
    <div class="panel-body">
        <div id="container"></div>
    </div>
  </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>

<script>
    $(function(){

        ////////////////////////////////////////////////////////
       // Generate test data with continuous Y values.
    function getExperimentData() {
        var data = [],
            off = 0.3 + 0.2 * Math.random(),
            i;
        for (i = 0; i < 200; i++) {
            data.push(
                Math.round(1000 * (off + (Math.random() - 0.5) * (Math.random() - 0.5)))
            );
        }
        return data;
    }

    function getBoxPlotData(values) {
        var sorted = values.sort(function (a, b) {
            return a - b;
        });

        return {
            low: sorted[0],
            q1: sorted[Math.round(values.length * 0.25)],
            median: sorted[Math.round(values.length * 0.5)],
            q3: sorted[Math.round(values.length * 0.75)],
            high: sorted[sorted.length - 1]
        };
    }

    var experiments = [
        getExperimentData(),
        getExperimentData(),
        getExperimentData(),
        getExperimentData(),
        getExperimentData()
    ];

    var scatterData = experiments
        .reduce(function (acc, data, x) {
            return acc.concat(data.map(function (value) {
                return [x, value];
            }));
        }, []);

    var boxplotData = experiments
        .map(getBoxPlotData);
    console.log("FFFFFFFFFFFFFFFFFff");
    console.log(<?= $scatterData ?>);
    //.log(<?= $boxPlot ?>);

    console.log(scatterData);

    Highcharts.chart('container', {

        title: {
            text: 'Highcharts Box Plot and Jittered Scatter Plot'
        },

        legend: {
            enabled: false
        },

        xAxis: {
            categories: <?= $subejcts ?>,
            title: {
                text: 'Experiment No.'
            }
        },

        yAxis: {
            title: {
                text: 'Observations'
            }
        },

        series: [{
            type: 'boxplot',
            name: 'Summary',
            data: <?= $boxPlot ?>,
            tooltip: {
                headerFormat: '<em>Experiment No {point.key}</em><br/>'
            }
        }, {
            name: 'Observation',
            type: 'scatter',
            data: <?= $scatterData ?>,
            jitter: {
                x: 0.24 // Exact fit for box plot's groupPadding and pointPadding
            },
            marker: {
                radius: 1
            },
            color: 'rgba(100, 100, 100, 0.5)',
            tooltip: {
                pointFormat: 'Value: {point.y}'
            }
        }]
    });
        ////////////////////////////////////////////////////////

        
    });
</script>

</body>
</html>