
<div class="row" style="margin-top:70px;">
    
    <div class="col-12 text-center">
        <h5>Kes Mengikut Negeri (Cases by States)</h5>
        <span>setakat <?php echo date("d F Y" . " 23:59 ", strtotime($statistics->getCasesByStates()["Perak"]["latestCasesByStateDate"])); ?></span>

        <figure class="highcharts-figure">
            <div id="barchart-cases-by-states"></div>
        </figure>
    </div>

    <hr class="border">

    <div class="col-12 text-center">
        <h5>Kes Malaysia (Malaysia Case)</h5>
        <span>setakat <?php echo date("d F Y" . " 23:59 ", strtotime($statistics->getCasesByStates()["Perak"]["latestCasesByStateDate"])); ?></span>
        <div id="container"></div>    
    </div>
    
</div>