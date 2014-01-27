<?php

require(dirname(__FILE__) . '/Unirest/HttpMethod.php');
require(dirname(__FILE__) . '/Unirest/HttpResponse.php');
require(dirname(__FILE__) . '/Unirest/Unirest.php');

date_default_timezone_set('America/Chicago'); 

function main() {
	$year = 1999; 
	$month = 1; 
	$day = 1; 

	while($year<=2012) {
		while($month<12) { 
			while($day<30) {
				$date = date("Y-m-d",mktime(0,0,0,$month,$day,$year)); 
				$response = Unirest::get(
						"https://joss-open-exchange-rates.p.mashape.com/historical/".$date.".json", 
						array(
							"X-Mashape-Authorization" => "" // Your mashape auth key here 
							), 
						null
					); 
				$decoded = json_decode($response->raw_body); 
				print $date.": \t\033[0;31m".$decoded->{"rates"}->{"CNY"}."\033[0m \n \t\t\033[0;32m".$decoded->{"rates"}->{"MXN"}."\033[0m \n"; 

				$day += 15; 
			}
			
			$day = 1; 
			$month += 2; 
		}

		$month = 1; 
		$year += 1; 
	}
}

main(); 

?>