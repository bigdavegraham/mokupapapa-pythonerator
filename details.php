<?php
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
require '../includes/mpp_dbconn.php';
$variable = $_GET["id"];
$sql = "";
$label = "Observation";
        
if($variable == "rain"){
    $sql = "SELECT precipitation, observationdate, createdate ";
    $sql .= "FROM rain ORDER BY observationdate desc";
    $label = "Precipitation";
}

if($variable == "rflow"){
    $sql = "SELECT flowrate, observationdate, createdate ";
    $sql .= "FROM river ORDER BY observationdate desc";
    $label = "Flow Rate";
}

if($variable == "rheight"){
    $sql = "SELECT height, observationdate, createdate ";
    $sql .= "FROM river ORDER BY observationdate desc";
    $label = "River Height";
}

if($variable == "turbid"){
    $sql = "SELECT turbidity, observationdate, createdate ";
    $sql .= "FROM turbidity ORDER BY observationdate desc";
    $label = "Turbidity";
}

if($variable == "salinity"){
    $sql = "SELECT salinity, observationdate, createdate ";
    $sql .= "FROM turbidity ORDER BY observationdate desc";
    $label = "Salinity";
}

if($variable == "waves"){
    $sql = "SELECT height, observationdate, createdate ";
    $sql .= "FROM waves ORDER BY observationdate desc";
    $label = "Wave Height";
}

if($variable == "wavep"){
    $sql = "SELECT period, observationdate, createdate ";
    $sql .= "FROM waves ORDER BY observationdate desc";
    $label = "Wave Period";
}

if($variable == "wind"){
    $sql = "SELECT speed, observationdate, createdate ";
    $sql .= "FROM wind ORDER BY observationdate desc";
    $label = "Wind Speed";
}
$result = pg_query($db, $sql);
if (!$result) {
    die("Error in SQL query: " . pg_last_error());
}
$results = array(array());
while ($row = pg_fetch_array($result)) {
    $results[] = $row;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<style type="text/css" title="currentStyle">
@import "datatables/css/jquery.dataTables.css"; @import "datatables/css/jquery.dataTables.css";
@import "datatables/css/demo_table_jui.css"; @import "datatables/css/demo_table.css";
</style>
<style>
th,td{font-family:"Arial";}
</style>
<script src="datatables/js/jquery.js" type="text/javascript"></script>
<script src="datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
                        $(document).ready(function() {
                                $('#dat').dataTable( {
"aaSorting": [[0,"desc"]],
"bPaginate": true,
"bLengthChange": true,
"bFilter": true,
"bSort": true,
"bInfo": false,
"bAutoWidth": true
} );
                        } );
                </script>
</head>
<body>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="dat">
<thead>
<th>Observation Date</th><th><?php echo $label ?></th><th>Date Created</th>
</thead>
<tbody>
<?php
     for ($i=1; $i<count($results); $i++) {
        echo "<tr><td align=\"right\">" . $results[$i][1] . "</td><td align=\"right\">" . $results[$i][0] . "</td><td align=\"right\">" . $results[$i][2] . "</td></tr>";
    }
    ?>
</tbody>
</table>
</div>
</body>
</html>
