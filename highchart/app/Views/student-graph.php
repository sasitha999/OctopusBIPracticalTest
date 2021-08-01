<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bar Chart in CodeIgniter 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>  
<div class="container">
  <h2 style="text-align:center;">Student Performance In All Subject</h2>
  <div class="panel panel-default">
    <div class="panel-heading">
        <div class="">
            <div><h4>Select Student</h4></div>
            <select id ="select-user" class=" form-control search">
                <?php foreach ($studentNames as $key => $studentName) { ?>
                    <option value="<?=$studentName?>"><?=$studentName?></option>
                <?php } ?>
            </select>
            <div><h4>Select Subjects</h4></div>
            <select id ="select-subject" class=" form-control search" multiple="multiple">
                <?php foreach ($subjectNames as $key => $subjectName) { ?>
                    <option value="<?=$subjectName?>"<?php echo ($key == 0) ? "selected":"";?> ><?=$subjectName?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="panel-body">
        <div id="container"></div>
    </div>
  </div>
</div>
<script>


    $(document).ready(function() {
        $('#select-user').trigger('change');
    });
    function renderChart(years, subejctData){
        var charOption ={
            chart: {
                type: 'spline',
                scrollablePlotArea: {
                    minWidth: 600,
                    scrollPositionX: 1
                }
            },
            title: {
                text: 'Student Performace  in 2000 - 2009'
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
                categories : years,
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            series: subejctData,
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
        };

        Highcharts.chart('container', charOption);
    }
    $('.search').select2({});

    $('.search').on('change', function() {

        var selectedUser = $('#select-user').select2('data').map(function(elem){ return elem.text });
        var subjects = $('#select-subject').select2('data').map(function(elem){ return elem.text });
        if(subjects.length > 0){
            $.ajax({
                url: '<?php echo base_url('/student-graph');?>',
                type:'post',
                dataType:'json',
                data: {
                    student:selectedUser,
                    subjects:subjects
                },
                success: function(data) {
                    renderChart(data.years,data.subjectData      )
                }
            });
        } else {
            alert("Select Subject Please")
        }
        
  });       
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
</body>
</html>