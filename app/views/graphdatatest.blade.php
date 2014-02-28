@extends('layout')

@section('content')

<?php
include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';
    $con = connectToDB();

    $result = getTimeSeries(12, 'Robarts Library', '1', 0, $con);
    echo "['Active Connections, 'Time'],<br>";
    for($i = 0; $i < $result->num_rows; $i++){
        $row = $result->fetch_row();
	if($i != $result->num_rows-1){
        	echo "[$row[0], '$row[1]'],<br>";
	}
	else{
        	echo "[$row[0], '$row[1]']<br>";
	}
    }

?>
@stop
