<?php

function paint_table($data){
	date_default_timezone_set( 'America/Boa_Vista' );
	$now = gmdate('Y-m-d');

	$data1 = new DateTime($data);
	$data2 = new DateTime($now);
	$select =0;
	$cor ='';
	if($data1 >= $data2){
		$interval = $data1->diff($data2);
		$dias = $interval->days;
		if($dias > 10){
			$select =1;
		}
		elseif(($dias <= 10) && ($dias >= 0) ){
			$select = 2;
		}
	}
	elseif ($data1 < $data2){
		$interval = $data1->diff($data2);
		$dias = $interval->days;
		$select = 3;
	}

	switch ($select) {
		case 1:
			# code...
			$cor= 'green';
			break;
		case 2:
			# code...
			$cor= 'orange';
			break;
		case 3:
			# code...
			$cor= 'red';
			break;	
	}


	return $cor;
}

?>
