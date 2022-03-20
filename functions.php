<?php 


class Statistics {

    function getTotalCovidCases() {

        $csvData = array_map("str_getcsv", file("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csvData);

        foreach($csvData as $i=>$values) {
            $csvData[$i] = array_combine($keys, $values);
        }

        $totalCovidCases = array();
        $totalNumberCovidCases = 0;
        foreach($csvData as $csvRow) {
            $totalCovidCases[] = array(
                "totalNumberCovidCases" => $totalNumberCovidCases += $csvRow["cases_new"],
                "latestConfirmedCases" => $csvRow["cases_new"], 
                "latestConfirmedCasesDate" => $csvRow["date"]
            );
        }
        
        return end($totalCovidCases);
    }

    function getTotalRecoveredCases() {

        $csvData = array_map("str_getcsv", file("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csvData);

        foreach($csvData as $i=>$values) {
            $csvData[$i] = array_combine($keys, $values);
        }

        $totalRecoveredCases = array();
        $totalNumberRecoveredCases = 0;
        foreach($csvData as $csvRow) {
            $totalCovidCases[] = array(
                "totalNumberRecoveredCases" => $totalNumberRecoveredCases += $csvRow["cases_recovered"],
                "latestRecoveredCases" => $csvRow["cases_recovered"], 
                "latestRecoveredCasesDate" => $csvRow["date"]
            );
        }
        
        return end($totalCovidCases);
    }

    function getTotalDeathsCases() {

        $csvData = array_map("str_getcsv", file("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_malaysia.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csvData);

        foreach($csvData as $i=>$values) {
            $csvData[$i] = array_combine($keys, $values);
        }

        $totalDeathsCases = array();
        $totalNumberDeathsCases = 0;
        foreach($csvData as $csvRow) {
            $totalDeathsCases[] = array(
                "totalNumberDeathsCases" => $totalNumberDeathsCases += $csvRow["deaths_new"],
                "latestDeathsCases" => $csvRow["deaths_new"], 
                "latestDeathsCasesDate" => $csvRow["date"],
            );
        }
        
        return end($totalDeathsCases);
    }

    
    function weeklyStatistics() {

        $csvData = array_map("str_getcsv", file("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csvData);

        
        foreach($csvData as $i=>$values) {
            $csvData[$i] = array_combine($keys, $values);
        }
        
        $weeklyStatistics = array();
        foreach($csvData as $data) {
            $weeklyStatistics[] = array(
                "date" => $data["date"],
                "confirmedCases" => $data["cases_new"],
                "recoveredCases" => $data["cases_recovered"],
            );
        }

        return array_slice($weeklyStatistics,-7);
    }

    function getCasesByStates() {

        $csvData = array_map("str_getcsv", file("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csvData);

        foreach($csvData as $i=>$values) {
            $csvData[$i] = array_combine($keys, $values);
        }

        $casesByStates = array();
        $totalCasesByStates = 0;
        foreach($csvData as $csvRow) {
            $state = $csvRow["state"];

            if(!array_key_exists($state, $casesByStates)) {
                $casesByStates[$state] = array(
                    "totalCasesByState" => $totalCasesByStates,
                    "latestCasesByState" => $csvRow["cases_new"],
                    "latestCasesByStateDate" => $csvRow["date"],
                );
            } else {
                $casesByStates[$state]["totalCasesByState"] += $csvRow["cases_new"];
                $casesByStates[$state]["latestCasesByState"] = $csvRow["cases_new"];
                $casesByStates[$state]["latestCasesByStateDate"] = $csvRow["date"];
                
            }
        }

        return $casesByStates;
    }    


   


}






?>