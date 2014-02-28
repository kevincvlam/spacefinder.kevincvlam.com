@extends('layout')

@section('content')

<?php
include '/home7/kevincvl/public_html/spacefinder/library/spaceFunctions.php';
    $con = connectToDB();

    $result = getTimeSeries(12, 'Robarts Library', '1', 0, $con);
    while($row = $result->fetch_row()){
        echo "['Active Connections, 'Time'],<br>";
        echo "[$row[0], '$row[1]'],<br>";
    }


?>
@stop
