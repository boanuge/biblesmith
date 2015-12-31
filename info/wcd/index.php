<?php
$data_desc = array();
$data_wcd = array();

//Declaring variables for WCD data
$data_wcd_country = array();
$data_wcd_population = array();
$data_wcd_adult_rate = array();
$data_wcd_birth_rate = array();
$data_wcd_death_rate = array();
$data_wcd_infant_mortality = array();
$data_wcd_literacy_rate = array();
$data_wcd_economy_gdp_per_capita = array();
$data_wcd_internet_user_rate = array();
$data_wcd_water_access_rate = array();
$data_wcd_hiv_adults_rate = array();
$data_wcd_number_of_christians = array();
$data_wcd_number_of_agnostics = array();
$data_wcd_number_of_atheists = array();
$data_wcd_number_of_buddhists = array();
$data_wcd_number_of_hindus = array();
$data_wcd_number_of_jews = array();
$data_wcd_number_of_muslims = array();

//Get CSV file content
$file_pointer = fopen("wcd.csv", "r");

//Get field description (First line)
$data_desc = fgetcsv($file_pointer, ",");

while ($file_line = fgetcsv($file_pointer, ",")) {
	array_push($data_wcd_country, $file_line[0]);
	array_push($data_wcd_population, $file_line[1]);
	array_push($data_wcd_adult_rate, $file_line[2]);
	array_push($data_wcd_birth_rate, $file_line[3]);
	array_push($data_wcd_death_rate, $file_line[4]);
	array_push($data_wcd_infant_mortality, $file_line[5]);
	array_push($data_wcd_literacy_rate, $file_line[6]);
	array_push($data_wcd_economy_gdp_per_capita, $file_line[7]);
	array_push($data_wcd_internet_user_rate, $file_line[8]);
	array_push($data_wcd_water_access_rate, $file_line[9]);
	array_push($data_wcd_hiv_adults_rate, $file_line[10]);
	array_push($data_wcd_number_of_christians, $file_line[11]);
	array_push($data_wcd_number_of_agnostics, $file_line[12]);
	array_push($data_wcd_number_of_atheists, $file_line[13]);
	array_push($data_wcd_number_of_buddhists, $file_line[14]);
	array_push($data_wcd_number_of_hindus, $file_line[15]);
	array_push($data_wcd_number_of_jews, $file_line[16]);
	array_push($data_wcd_number_of_muslims, $file_line[17]);
}

fclose($file_pointer);

//Assigning WCD data into the memory structure
$data_wcd = array("country" => $data_wcd_country, "population" => $data_wcd_population, "adult_rate" => $data_wcd_adult_rate
, "birth_rate" => $data_wcd_birth_rate, "death_rate" => $data_wcd_death_rate, "infant_mortality" => $data_wcd_infant_mortality
, "literacy_rate" => $data_wcd_literacy_rate, "economy_gdp_per_capita" => $data_wcd_economy_gdp_per_capita, "internet_user_rate" => $data_wcd_internet_user_rate
, "water_access_rate" => $data_wcd_water_access_rate, "hiv_adults_rate" => $data_wcd_hiv_adults_rate, "number_of_christians" => $data_wcd_number_of_christians
, "number_of_agnostics" => $data_wcd_number_of_agnostics, "number_of_atheists" => $data_wcd_number_of_atheists, "number_of_buddhists" => $data_wcd_number_of_buddhists
, "number_of_hindus" => $data_wcd_number_of_hindus, "number_of_jews" => $data_wcd_number_of_jews, "number_of_muslims" => $data_wcd_number_of_muslims);
?>

<?php
$table_data = array();

for ($i = 0; $i < count($data_wcd["country"]); $i++) { //Loop for number of elements in array
	//$html_country_name = urlencode($data_wcd["country"][$i]); //Need to replace &(ampersand) to &amp(HTML entity)
	$table_temp = array("<span class='tableCount'></span>"
						, $data_wcd["country"][$i], $data_wcd["population"][$i], sprintf("%2.2f", 100 * $data_wcd["adult_rate"][$i])
						, sprintf("%2.2f", 100 * $data_wcd["birth_rate"][$i]), sprintf("%2.2f", 100 * $data_wcd["death_rate"][$i]), $data_wcd["infant_mortality"][$i]
						, sprintf("%2.2f", 100 * $data_wcd["literacy_rate"][$i]), $data_wcd["economy_gdp_per_capita"][$i], sprintf("%2.2f", 100 * $data_wcd["internet_user_rate"][$i])
						, sprintf("%2.2f", 100 * $data_wcd["water_access_rate"][$i]), $data_wcd["hiv_adults_rate"][$i], $data_wcd["number_of_christians"][$i]
						, $data_wcd["number_of_agnostics"][$i], $data_wcd["number_of_atheists"][$i], $data_wcd["number_of_buddhists"][$i]
						, $data_wcd["number_of_hindus"][$i], $data_wcd["number_of_jews"][$i], $data_wcd["number_of_muslims"][$i]);
	array_push($table_data, $table_temp);
}

$table_json = json_encode($table_data);
?>

<?php
echo <<<ECHO4HTML
<html>
    <head>
	    <meta charset='utf-8' />
	    <meta name='viewport' content='width=device-width, initial-scale=1.0' />

        <title>WCD</title>
        <script src='jquery.min.js'></script>
        <script src='datatables.min.js'></script>
		<script type='text/javascript'>
			$(function() {
				$('#data4table').dataTable( {
					'aaSorting': [[ 2, 'desc' ]],
					'aLengthMenu': [10,100,234],
					'iDisplayLength': 234,
					'bProcessing': true,
					'aaData': ${table_json}
				});
			});
		</script>
		<style type='text/css'>
			@import 'datatables.demo.css';
		</style>

		<style type='text/css'>
			body { counter-reset: tableCount; } /* Set the counter to 0 */
			.tableCount:before {
				counter-increment: tableCount; /* Increment the counter */
				content: counter(tableCount) "."; /* Display the counter */
			}
		</style>
    </head>
    <body bgcolor='white'>

	  <div align='center'><div align='left' style='width:100%;'>
		<table class='display' id='data4table'>
			<thead>
				<tr>
					<th></th>
					<th width='10%' nowrap><font title="${data_desc[0]}">Country<font></th>
					<th width='10%' nowrap><font title="${data_desc[1]}">Population<font></th>
					<th width='10%' nowrap><font title="${data_desc[2]}">Adult rate (%)<font></th>
					<th width='10%' nowrap><font title="${data_desc[3]}">Birth rate (%) per year<font></th>
        			<th width='10%' nowrap><font title="${data_desc[4]}">Death rate (%) per year<font></th>
        			<th width='10%' nowrap><font title="${data_desc[5]}">Infant mortality (n/1000) per year<font></th>
        			<th width='10%' nowrap><font title="${data_desc[6]}">Literacy rate (%)<font></th>
        			<th width='10%' nowrap><font title="${data_desc[7]}">Economy - GDP per capita ($)<font></th>
        			<th width='10%' nowrap><font title="${data_desc[8]}">Internet user rate (%)<font></th>
        			<th width='10%' nowrap><font title="${data_desc[9]}">Water access rate (%)<font></th>
        			<th width='10%' nowrap><font title="${data_desc[10]}">HIV adults rate (n/1000)<font></th>
        			<th width='10%' nowrap><font title="${data_desc[11]}">Number of Christians<font></th>
        			<th width='10%' nowrap><font title="${data_desc[12]}">Number of Agnostics<font></th>
        			<th width='10%' nowrap><font title="${data_desc[13]}">Number of Atheists<font></th>
        			<th width='10%' nowrap><font title="${data_desc[14]}">Number of Buddhists<font></th>
        			<th width='10%' nowrap><font title="${data_desc[15]}">Number of Hindus<font></th>
        			<th width='10%' nowrap><font title="${data_desc[16]}">Number of Jews<font></th>
        			<th width='10%' nowrap><font title="${data_desc[17]}">Number of Muslims<font></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th><font title="${data_desc[0]}">Country<font></th>
					<th><font title="${data_desc[1]}">Population<font></th>
					<th><font title="${data_desc[2]}">Adult rate (%)<font></th>
					<th><font title="${data_desc[3]}">Birth rate (%) per year<font></th>
        			<th><font title="${data_desc[4]}">Death rate (%) per year<font></th>
        			<th><font title="${data_desc[5]}">Infant mortality (n/1000) per year<font></th>
        			<th><font title="${data_desc[6]}">Literacy rate (%)<font></th>
        			<th><font title="${data_desc[7]}">Economy - GDP per capita ($)<font></th>
        			<th><font title="${data_desc[8]}">Internet user rate (%)<font></th>
        			<th><font title="${data_desc[9]}">Water access rate (%)<font></th>
        			<th><font title="${data_desc[10]}">HIV adults rate (n/1000)<font></th>
        			<th><font title="${data_desc[11]}">Number of Christians<font></th>
        			<th><font title="${data_desc[12]}">Number of Agnostics<font></th>
        			<th><font title="${data_desc[13]}">Number of Atheists<font></th>
        			<th><font title="${data_desc[14]}">Number of Buddhists<font></th>
        			<th><font title="${data_desc[15]}">Number of Hindus<font></th>
        			<th><font title="${data_desc[16]}">Number of Jews<font></th>
        			<th><font title="${data_desc[17]}">Number of Muslims<font></th>
				</tr>
			</tfoot>
		</table>
	  </div></div>

	</body>
</html>
ECHO4HTML;
?>
