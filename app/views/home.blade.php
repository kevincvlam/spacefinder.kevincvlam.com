@extends('layout')

@section('content')

<?php
include '/home7/kevincvl/public_html/spacefinder/library/findBusyness.php';


$busynessIndex = getBusyIndex(); 
$row = $busynessIndex->fetch_array();
$curIndex = 100*$row[2];

?>



<dl class="sub-nav">
  <dt>Jump to Floor:</dt>
  <dd><a href="#1">1</a></dd>
  <dd><a href="#2">2</a></dd>
  <dd><a href="#3">3</a></dd>
  <dd><a href="#4">4</a></dd>
</dl>

<?php
for ($i = 1; $i <= 14; $i++) {

    // Determine Words Here
    $row = $busynessIndex->fetch_array();
    $curIndex = 100*$row[2];
//    echo $curIndex;


	if ($curIndex > CROWDED_THRESHOLD){
           $word = "Very Crowded";
           $tag = "alert";
	}elseif ($curIndex > BUSY_THRESHOLD
    && $curIndex <= CROWDED_THRESHOLD){
           $word = "Crowded";
           $tag = "alert";
	}elseif ($curIndex > HASSPACE_THRESHOLD
    && $curIndex <=  BUSY_THRESHOLD){
           $word = "Busy";
           $tag = "warning";
	}elseif ($curIndex > EMPTY_THRESHOLD 
    && $curIndex <= HASSPACE_THRESHOLD){
           $word = "Has Space";
           $tag = "success";
	}else{
        $word = "Empty";
        $tag = "info";
	}
    
    if($i != 6 && $i !=7 && $i != 14){ //Skip these floors no study area
	echo "        <div class='venue'>
        <div class='large-12 columns panel'>
        
        
        	<div class='row'>
        		<div class='small-8 medium-8 large-8 columns'>";
        		
    	if($i != 0){
			echo '<a id=#'.$i.'><h4>Robarts Floor: '. $i . "<br></a></h4>";
		}
		else{
			echo '<h4>Robarts Building:<br></h4>';
		}
	
		echo "	<p>
							<a href=";echo asset("/floor/$i");

                            echo ">More Info</a> <br> <a href=";
							echo asset("/mapdata/$i");
							echo ">See Floor Map</a>
							
						</p>
				</div>

				<div class='small-1 medium-2 large-2 columns' align='right'>
				</div>

				<div class='small-4 medium-2 large-2 columns' >
					<h5>
					
					<div data-alert class='alert-box "; 
					// Insert Tag Here
                    echo $tag;
	//				findBusynessTag('Robarts Library', $i, 0);
					echo" radius'>";
                    echo $word;
				//findBusyness('Robarts Library', $i, 0);	 
			echo"</div>
			
					</h5>
				</div>
				
           </div>
            
    	
        </div>

        </div>"; 


        }
    }
?>


@stop
