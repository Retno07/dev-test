<!DOCTYPE html>  
<html>  
<head>  
    <title>HighChart</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>  
    <script src="https://code.highcharts.com/highcharts.js"></script>  
</head>  
<body>  
    
<script type="text/javascript">
    
$(function () {   
    
    var chart = <?php echo $chart; ?>;  
    
    $('#container').highcharts({  
        chart: {  
            type: 'column'  
        },  
        title: {  
            text: 'Chart'  
        },  
        xAxis: {  
            categories: ['DKI Jakarta','Jawa Barat','Kalimantan', 'Jawa Tengah', 'Bali']  
        },  
        yAxis: {  
            title: {  
                text: 'Percent &'  
            },
            min: 0,
            max: 100  
        },  
        series: [{  
            name: 'Nilai',  
            data: chart  
        }]  
    });  
});  
    
</script>  
    
<div class="container">  
    <br/>  
    <h2 class="text-center"> Highcharts in Codeigniter MYSQL JSON </h2>  
    <div class="row">  
        <div class="col-md-10 col-md-offset-1">  
            <div class="panel panel-default">  
                <div class="panel-heading">Dashboard</div>  
                <div class="panel-body">  
                    <div id="container"></div>  
                </div>  
            </div>  
        </div>  
    </div>  
</div>  

<table border="1" style="margin-left:auto;margin-right:auto;">
<thead>
    <tr>
        <th>Brand</th>
        <th>DKI Jakarta</th>
        <th>Jawa Barat</th>
        <th>Kalimantan</th>
        <th>Jawa Tengah</th>
        <th>Bali</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($grid as $row) { ?>
        <tr>
            <td><?php echo $row->brand_name ?></td>
            <td><?php echo $row->jakarta ?>%</td>
            <td><?php echo $row->jabar ?>%</td>
            <td><?php echo $row->kalimantan ?>%</td>
            <td><?php echo $row->jateng ?>%</td>
            <td><?php echo $row->bali ?>%</td>
        </tr>
    <?php } ?>
</tbody>
</table>

</body>  
</html> 