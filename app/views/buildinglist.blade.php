@extends('layout')

@section('content')

<?php
include '/home7/kevincvl/public_html/spacefinder/library/findBusyness.php';


$curIndex = busynessIndex('Robarts Library');


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
    
	echo "        <div class='venue'>
        <div class='large-12 columns panel'>
        
        
        	<div class='row'>
        		<div class='small-8 medium-8 large-8 columns'>";
        		
 			echo '<h4>Robarts Library<br></h4>';

	
		echo "	<p>
							<a href=";echo asset("/floors");

                            echo ">See All Floors</a> <br>
							
						</p>
				</div>

				<div class='small-1 medium-2 large-2 columns' align='right'>
				</div>

				<div class='small-4 medium-2 large-2 columns' >
					<h5>
					
					<div data-alert class='alert-box "; 
					// Insert Tag Here
                    echo $tag;
					echo" radius'>";
                    echo $word;	 
			echo"</div>
			
					</h5>
				</div>
				
           </div>
            
    	
        </div>

        </div>"; 


     
?>


@stop
