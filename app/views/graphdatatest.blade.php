@extends('layout')

@section('content')

<?php
include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';
    $con = connectToDB();

    $result = getTimeSeries(12, 'Robarts Library', '1', 0, $con);
    echo "['Active Connections, 'Time'],<br>";
    echo $results[lengths][num_rows];
    /*
    for($i = 0; $i < $result[lengths][num_rows]; $i++){
        $row = $result->fetch_row();
        echo "[$row[0], '$row[1]'],<br>";
    }
*/

?>
@stop
