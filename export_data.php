<?php
include "common.php";		
$dbh = Db::db_conn();
$company="parallel";
$data= exportData::makeExcel($dbh, $company);	

if(isset($_POST["ExportType"]))
{
    switch($_POST["ExportType"])
    {
        case "export-to-excel" :
       		$filename = $_POST["ExportType"] . ".xls";		 
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		ExportFile($data);
		break;
	case "export-to-csv" :
            // Submission from
		$filename = $_POST["ExportType"] . ".csv";		 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Expires: 0");
		ExportCSVFile($data);
                break;
        default :
            die("Unknown action : ".$_POST["action"]);
            break;
    }
}

function ExportCSVFile($records) {
	// create a file pointer connected to the output stream
	$fh = fopen( 'php://output', 'w' );
	$heading = false;
		if(!empty($records))
		  foreach($records as $row) {
			if(!$heading) {
			  // output the column headings
			  fputcsv($fh, array_keys($row));
			  $heading = true;
			}
			// loop over the rows, outputting them
			 fputcsv($fh, array_values($row));
		  }
		  fclose($fh);
}

function ExportFile($records) {
	$heading = false;
		if(!empty($records))
		  foreach($records as $row) {
			if(!$heading) {
			  echo implode("\t", array_keys($row)) . "\n";
			  $heading = true;
			}
			echo implode("\t", array_values($row)) . "\n";
		  }
		exit;
}

?>
