<?php 

include("functions.php");
$statistics = new Statistics();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>MySejahtera Statistics</title>
    <link rel="icon" href="assets/image/mysejahtera_logo.png">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/countries/my/my-all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>   
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>

    <style>
        #container {
            height: 500px;
            max-width: 1800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <!-- Page Content -->
    <div class="container" style="padding:50px;">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-covid-19-update" role="tab" aria-controls="pills-home" aria-selected="true">COVID-19 Update</a>
            </li>     
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-covid-19-states" role="tab" aria-controls="pills-profile" aria-selected="false">COVID-19 States</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-covid-19-update" role="tabpanel" aria-labelledby="pills-home-covid-19-update-tab">
                <?php include("includes/covid-19-update.php"); ?>
            </div>

            <div class="tab-pane fade" id="pills-covid-19-states" role="tabpanel" aria-labelledby="pills-covid-19-states-tab">
                <?php include("includes/covid-19-states.php"); ?>
            </div>
        </div>
    
    </div>
    <!-- /.container -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

     <!--Weekly Statistics-->
     <script>
        Highcharts.chart('chart_weekly_statistics', {
            chart: {
                type: 'area'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: 'Source: <a href="https://github.com/MoH-Malaysia/covid19-public">Ministry of Health Malaysia (MoH) </a>'
            },
            xAxis: {
                type: "datetime",
                labels: {
                    formatter: function() {
                        return Highcharts.dateFormat('%e/%m', this.value);
                    }
                }
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function () {
                        return this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            },
            tooltip: {
                pointFormat: '{series.name} <br><b>{point.y:,.0f}</b>'
            },
            series: [
                {
                    name: 'Kes Baharu (Confirmed Cases)',
                    data: [
                        <?php foreach($statistics->weeklyStatistics() as $weeklyStatistics) {
                            $year = date("Y", strtotime($weeklyStatistics["date"]));
                            $month = date("n", strtotime("-1 months", strtotime($weeklyStatistics["date"])));
                            $day = date("d", strtotime($weeklyStatistics["date"]));

                            $format_date = $year . "," . $month . "," . $day;
                        ?>
                            [Date.UTC(<?php echo $format_date; ?>), <?php echo intval($weeklyStatistics["confirmedCases"]); ?>],

                        <?php } ?>
                    ],
                    color: '#f5b942'
                }, 
                {
                    name: 'Sembuh (Recovered Cases)',
                    data:[
                        <?php foreach($statistics->weeklyStatistics() as $weeklyStatistics) {
                            $year = date("Y", strtotime($weeklyStatistics["date"]));
                            $month = date("n", strtotime("-1 months", strtotime($weeklyStatistics["date"])));
                            $day = date("d", strtotime($weeklyStatistics["date"]));

                            $format_date = $year . "," . $month . "," . $day;
                        ?>
                            [Date.UTC(<?php echo $format_date; ?>), <?php echo intval($weeklyStatistics["recoveredCases"]); ?>],
                        <?php } ?>
                    ],
                    color: '#87f571'
                },
            ]
        });
    </script>

    <!--Cases By States-->
    <script>
        Highcharts.chart('barchart-cases-by-states', {
            chart: {
                type: 'bar'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: 'Source: <a href="https://github.com/MoH-Malaysia/covid19-public">Ministry of Health Malaysia (MoH)</a>'
            },
            xAxis: {
                categories: [
                    <?php foreach($statistics->getCasesByStates() as $state => $casesByStates) { ?>
                        '<?php  echo $state; ?>', 
                    <?php } ?>
                ],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '',
                    align: 'high'
                },
            },
            tooltip: {
                valueSuffix: ' cases'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '',
                data: [
                    <?php foreach($statistics->getCasesByStates() as $state => $casesByStates) { ?>
                        <?php echo $casesByStates["totalCasesByState"];?>,
                    <?php } ?>
                ]
            }]
        });
    </script>

    <!--Malaysia Map Cases Overview-->
    <script>
       
        var data = [
                ['my-sa', <?php echo $statistics->getCasesByStates()["Sabah"]["latestCasesByState"]; ?>], 
                ['my-sk', <?php echo $statistics->getCasesByStates()["Sarawak"]["latestCasesByState"]; ?>], 
                ['my-la', <?php echo $statistics->getCasesByStates()["W.P. Labuan"]["latestCasesByState"]; ?>], 
                ['my-pg', <?php echo $statistics->getCasesByStates()["Pulau Pinang"]["latestCasesByState"]; ?>],
                ['my-kh', <?php echo $statistics->getCasesByStates()["Kedah"]["latestCasesByState"]; ?>], 
                ['my-sl', <?php echo $statistics->getCasesByStates()["Selangor"]["latestCasesByState"]; ?>], 
                ['my-ph', <?php echo $statistics->getCasesByStates()["Pahang"]["latestCasesByState"]; ?>], 
                ['my-kl', <?php echo $statistics->getCasesByStates()["W.P. Kuala Lumpur"]["latestCasesByState"]; ?>],
                ['my-pj', <?php echo $statistics->getCasesByStates()["W.P. Putrajaya"]["latestCasesByState"]; ?>], 
                ['my-pl', <?php echo $statistics->getCasesByStates()["Perlis"]["latestCasesByState"]; ?>], 
                ['my-jh', <?php echo $statistics->getCasesByStates()["Johor"]["latestCasesByState"]; ?>], 
                ['my-pk', <?php echo $statistics->getCasesByStates()["Perak"]["latestCasesByState"]; ?>],
                ['my-kn', <?php echo $statistics->getCasesByStates()["Kelantan"]["latestCasesByState"]; ?>], 
                ['my-me', <?php echo $statistics->getCasesByStates()["Melaka"]["latestCasesByState"]; ?>], 
                ['my-ns', <?php echo $statistics->getCasesByStates()["Negeri Sembilan"]["latestCasesByState"]; ?>], 
                ['my-te', <?php echo $statistics->getCasesByStates()["Terengganu"]["latestCasesByState"]; ?>]
        ];

        // Create the chart
        Highcharts.mapChart('container', {
            chart: {
                map: 'countries/my/my-all'
            },
            colors: ['rgba(19,64,117,0.05)', 'rgba(19,64,117,0.2)', 'rgba(19,64,117,0.4)',
                'rgba(19,64,117,0.5)', 'rgba(19,64,117,0.6)', 'rgba(19,64,117,0.8)', 'rgba(19,64,117,1)'],
            title: {
                text: ''
            },

            subtitle: {
                text: 'Source map: Malaysia'
            },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            colorAxis: {
                min: 1,
                type: 'logarithmic',
                minColor: '#fa7a6e',
                maxColor: '#fa4c3c',
                stops: [
                    [0, '#f5f5f1'],
                    [0.67, '#ff6557'],
                    [1, '#e50914']
                ]
            },

            series: [{
                data: data,
                name: 'Kes Baharu (New Cases)',
                states: {
                    hover: {
                        color: '#fc948b'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.value}'
                }
            }]
        });
    </script>
</body>
</html>