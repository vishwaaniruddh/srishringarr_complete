<? include('../config.php'); ?>
<html>
    <head>
        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

    </head>
    <body>


<?
// data: [
        //     ['Shanghai', 24.2],
        //     ['Beijing', 20.8],
        //     ['Karachi', 14.9],
        //     ['Shenzhen', 13.7],
        //     ['Guangzhou', 13.1],
        //     ['Istanbul', 12.7],
        //     ['Mumbai', 12.4],
        //     ['Moscow', 12.2],
        //     ['São Paulo', 12.0],
        //     ['Delhi', 11.7],
        //     ['Kinshasa', 11.5],
        //     ['Tianjin', 11.2],
        //     ['Lahore', 11.1],
        //     ['Jakarta', 10.6],
        //     ['Dongguan', 10.6],
        //     ['Lagos', 10.6],
        //     ['Bengaluru', 10.3],
        //     ['Seoul', 9.8],
        //     ['Foshan', 9.3],
        //     ['Tokyo', 9.3]
        // ],
$visit_count = mysqli_query($con,"SELECT CAST(created_at as date) as date, count(*) as count FROM `mis_newvisit` group by CAST(created_at as date) order by CAST(created_at as date) desc limit 10");
while($visit_count_result = mysqli_fetch_assoc($visit_count)){
    $date = $visit_count_result['date'];
    $count = $visit_count_result['count'];
    $visitdata[] = [$date,$count];
}

$json = json_encode($visitdata);
$json = str_replace('"',"'",$json);
echo $json; 


?>

<figure class="highcharts-figure">
    <div id="container"></div>
</figure>

<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'World\'s largest cities per 2017'
    },
    subtitle: {
        text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: <? echo $json; ?>,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>        
    </body>
</html>
