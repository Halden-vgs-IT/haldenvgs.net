<?php
    define('DB_NAME', 'haldenvg_greenScan');
	define('DB_USER', 'haldenvg_neo');
	define('DB_PASSWORD', 'eclodona-admin');
	define('DB_HOST', '31.220.21.90');

    error_reporting(E_ALL); 
	$errorTF = true;
    global $response;

	function InsertScanData($scanData, $produtName, $goodness){
        global $response;
        $con= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
		$stmt = "INSERT INTO `haldenvg_greenScan`.ScanData (`code`, `miljovenlighet`, `navn`) VALUES ('$scanData', '$goodness', '$produtName')";
		if($con->query($stmt)){
		    $con = null;
			return true;
		}else{
		    $response = mysqli_error($con);
            $con = null;
			return false;
		}
	}

	function incertNewScan($userId, $barCode){
        
        $userPath = "profileFolders/".$userId;
	    if(isdir($userPath)){
	        
	        $lastScannedFile = fopen($userPath."/scanLog.GS",'r');
	        fwrite($lastScannedFile, $barCode."\n");
	        $lastScannedFile.close();
	        
	    }else{
	        mkdir($userPath);
	        $f = fopen($userPath.'/scanLog.GS','w');
	        fwrite($f, $barCode."\n");
	        $f.close();
	    }
	    
	    
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST["scanCode"])){
                if(InsertScanData($_POST['scanCode'],$_POST["productName"], $_POST['miljovenlighet'])){
                    
                    incertNewScan($_POST['userId'],$_POST['scanCode']);
                    
                    $response = "Data Incerted";
                    
                }
        }else{
            $response = "ScanCode is emty";
        }
	}else{
		$errorTF = true;
		$response = "Failure";
	}

    echo json_encode($response);
    
?>