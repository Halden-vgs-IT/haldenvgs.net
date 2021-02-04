<?php

	define('DB_NAME', 'haldenvg_greenScan');
	define('DB_USER', 'haldenvg_neo');
	define('DB_PASSWORD', 'eclodona-admin');
	define('DB_HOST', '31.220.21.90');

    error_reporting(E_ALL); 
	$errorTF = true;



	function checkIfExists($scanData){
        $con= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	    $SQLCommand = "SELECT * FROM `haldenvg_greenScan`.ScanData WHERE code = '$scanData'";
	    $mediumThing = mysqli_query($con,$SQLCommand);
	    $resultsFromDB = mysqli_fetch_assoc($mediumThing);
	    if($resultsFromDB['code'] != null){
	        $con = null;
	        return $resultsFromDB;
	    }else{
	        $con = null;
	        return false;
	    }   
	}
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST["scanCode"])){
            if(checkIfExists($_POST['scanCode']) != false){
                $response = checkIfExists($_POST['scanCode']);
            }else{
                $response = "noExist";
            }
        }
	}else{
		$errorTF = true;
		$response = "Failure";
	}

	if(is_array($response)){
        $loopCounter = 0;
    	foreach($response as $arrayValue){
    	    echo "£";
            echo json_encode($arrayValue);

            $loopCounter -=- 1;
    	}
	}else{
	    echo json_encode($response);
	}
?>