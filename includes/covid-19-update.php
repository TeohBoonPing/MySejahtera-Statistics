<div class="row">
    <div class="card col-12 text-center text-white bg-danger" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Jumlah Kes Keseluruhan (Total Confirmed Cases)</h5>
            <span>setakat <?php echo date("d F Y" . " 23:59 ", strtotime($statistics->getTotalCovidCases()["latestConfirmedCasesDate"])); ?></span>
            <div style="padding:20px; font-size:30px;">
                <p class="card-text">
                    <?php echo number_format($statistics->getTotalCovidCases()["totalNumberCovidCases"], 0, ',', ','); ?>
                </p>
            </div>  
            <span class="btn btn-block bg-white" style="color:#dc3545; font-weight:500;">
                <?php echo number_format($statistics->getTotalCovidCases()["latestConfirmedCases"], 0, ',', ','); ?> Hari Ini (Today)
            </span>
        </div>
    </div>

    <hr class="border">

    <div class="card col-12 text-center text-white bg-success" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Jumlah Kes Sembuh (Total Recovered)</h5>
            <span>setakat <?php echo date("d F Y" . " 23:59 ", strtotime($statistics->getTotalRecoveredCases()["latestRecoveredCasesDate"])); ?></span>
            <div style="padding:20px; font-size:30px;">
                <p class="card-text">
                    <?php echo number_format($statistics->getTotalRecoveredCases()["totalNumberRecoveredCases"], 0, ',', ','); ?>
                </p>
            </div>  
            <span class="btn btn-block bg-white text-success" style="font-weight:500;">
                <?php echo number_format($statistics->getTotalRecoveredCases()["latestRecoveredCases"], 0, ',', ','); ?> Hari Ini (Today)
            </span>
        </div>
    </div>

    <hr class="border">

    <div class="card col-12 text-center text-white bg-dark" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Jumlah Kematian (Total Death)</h5>
            <span>setakat <?php echo date("d F Y" . " 23:59 ", strtotime($statistics->getTotalDeathsCases()["latestDeathsCasesDate"])); ?></span>
            <div style="padding:20px; font-size:30px;">
                <p class="card-text">
                    <?php echo number_format($statistics->getTotalDeathsCases()["totalNumberDeathsCases"], 0, ',', ','); ?>
                </p>
            </div>  
            <span class="btn btn-block bg-white" style="color:#dc3545; font-weight:500;">
                <?php echo number_format($statistics->getTotalDeathsCases()["latestDeathsCases"], 0, ',', ','); ?> Hari Ini (Today)
            </span>
        </div>
    </div>

    <hr class="border">

    <div class="col-12 text-center">
        <h5>Statistik Mingguan (Weekly Statistics)</h5>
        <span>setakat <?php echo date("d F Y" . " 23:59 ", strtotime($statistics->getTotalCovidCases()["latestConfirmedCasesDate"])); ?></span>
        <figure class="highcharts-figure">
            <div id="chart_weekly_statistics"></div>
            <pre id="csv" style="display:none">4/13/2018,16564
4/18/2018,16239
4/25/2018,14127
5/2/2018,14967
5/9/2018,15499</pre>

            
        </figure>
        <!-- <div id="chart_weekly_statistics"></div>     -->
    </div>

</div>