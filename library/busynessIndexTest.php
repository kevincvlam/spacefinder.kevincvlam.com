<h1> THIS IS A TEST OF THE BUSYNESS INDEX FUNCTION </h1>
<br>
<h2> Robarts Library Index: </h2>
<br>
<?php
include 'spaceFunctions.php';

echo busynessIndex('Robarts Library');
?>
<br>
<h2> Floor Five Index: </h2>
<br>
<?php
include 'spaceFunctions.php';
echo busynessIndex('Robarts Library', 5);
?>
<br>
<h2> Area One Index: </h2>
<?php
include 'spaceFunctions.php';
echo busynessIndex('Robarts Library', 5, 1);
?>