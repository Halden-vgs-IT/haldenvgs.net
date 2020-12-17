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

	function checkIfProfileExists($userToCheck,$userPassToCheck){
        global $conn;
	    $SQLCommand = "SELECT * FROM `haldenvg_greenScan`.PersonalData WHERE `Name` = '$userToCheck'";
	    $mediumThing = mysqli_query($conn,$SQLCommand);
	    $resultsFromDB = mysqli_fetch_assoc($mediumThing);
	    if ($resultsFromDB == null){
	        return false;
	    }
	    try{
	        if ($resultsFromDB['PASS'] == $userPassToCheck){
	            unset($resultsFromDB['PASS']);
	            unset($resultsFromDB['Id']);

                return $resultsFromDB;
	        }else{
	            return "Wrong";
	        }
	    }catch(Exception $e){
	        return false;
	    }
	}
	
    function checkIfProductExists($scanData){
        global $conn;
	    $SQLCommand = "SELECT * FROM `haldenvg_greenScan`.ScanData WHERE code = '$scanData'";
	    $mediumThing = mysqli_query($conn,$SQLCommand);
	    $resultsFromDB = mysqli_fetch_assoc($mediumThing);
	    if($resultsFromDB['code'] != null){
	        $con = null;
	        return $resultsFromDB;
	    }else{
	        $con = null;
	        return false;
	    }   
	}
	
	
	function createNewAccount($userName,$userPass){
	    global $conn;
	    $SQLCommand = "INSERT INTO `haldenvg_greenScan`.PersonalData (`Name`, `PASS`) VALUES ('$userName','$userPass')";
	    $TFBool = mysqli_query($conn,$SQLCommand);
	    return $TFBool;
	    
	}
	
    function updateProfileScans($userName,$barCode, $miljo){
        global $conn;

        $SQLCommand = "SELECT * FROM `haldenvg_greenScan`.PersonalData WHERE (`Name`) = ('$userName')";
        
        $medium = mysqli_query($conn,$SQLCommand);
        $IFDB = mysqli_fetch_assoc($medium);
        
        $NumOfScans = $IFDB['NumOfScans'];
        
        $userId = $IFDB['Id'];
        $AvrMiljo = $IFDB['AvrMiljo'];
        $AvrMiljo = $AvrMiljo + $miljo;
        $NumOfScans = $NumOfScans +1;
        
        
        $SQLCommand = "UPDATE `PersonalData` SET `NumOfScans` = '$NumOfScans', `AvrMiljo` = '$AvrMiljo' WHERE `PersonalData`.`id` = '$userId'";
        
        $medium = mysqli_query($conn,$SQLCommand);
        
        return true;
        
    }




	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST["TODO"])){
            global $conn;
            $conn= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
            switch($_POST['TODO']){
                case "newScan":
                    if(InsertScanData($_POST['scanCode'],$_POST["productName"], $_POST['miljovenlighet'])){
                        
                        incertNewScan($_POST['userId'],$_POST['scanCode']);
                        
                        $response = "Data Incerted";    
                    }else{
                        $response = "Incert Error";
                    }
                    break;
                
                case "checkIfScanExists":
                    if(isset($_POST["scanCode"])){
                        if(checkIfExists($_POST['scanCode']) != false){
                            $response = checkIfProductExists($_POST['scanCode']);
                        }else{
                            $response = "noExist";
                        }
                    }
                    
                case "checkUser":
                    $safePostUserName = mysqli_real_escape_string($conn, $_POST['userName']);
                    
                    $safePostUserPass = mysqli_real_escape_string($conn,$_POST['userPass']);
                    
                    $resultsFromDB = checkIfProfileExists($safePostUserName, $safePostUserPass);

                    if($resultsFromDB == false){
                        $response = "noExist";
                    }else{
                        
                        $response = $resultsFromDB;
                    }
                    break;
                
                case "createNewAccount":
                    if(isset($_POST['userName'])){
                        $safeUserName = mysqli_real_escape_string($conn, $_POST['userName']);
                        $safeUserPass = mysqli_real_escape_string($conn,$_POST['userPass']);
                        
                        createNewAccount($safeUserName,$safeUserPass);
                        
                        $response = "Created";
                        break;
                        
                        
                    }
                case "updateScannedData":
                    if(isset($_POST["barCode"])){
                        
                        $userName = mysqli_real_escape_string($conn,$_POST['userName']);
                        $barCode = mysqli_real_escape_string($conn, $_POST['barCode']);
                        
                        updateProfileScans($userName, $barCode, $_POST['miljoVerdi']);
                        
                    }
                    break;
                    
                case "getAvrMiljo":
                    if(isset($_POST['userName'])){
                        $userName = mysqli_real_escape_string($conn, $_POST['userName']);
                        
                        $SQLCommand = "SELECT * FROM `haldenvg_greenScan`.PersonalData WHERE (`Name`) = ('$userName')";
        
                        $medium = mysqli_query($conn,$SQLCommand);

                        if($medium){
                            $IFDB = mysqli_fetch_assoc($medium);
                        }
                        
                        
                        $response[0] = $IFDB['AvrMiljo'];
                        $response[1] = $IFDB['NumOfScans'];
                    }
                    break;
                    
                default:
                    $response = "Nothing todo";
                    break;
            }
            
            
                
        }else{
            $response = "emty...";
        }
	}else{
		$errorTF = true;
		$response = "Failure";
	}
    
	if(is_array($response)){
	    $loopCounter = 0;
    	foreach($response as $arrayValue){
            echo json_encode($arrayValue);
            echo "£";
            $loopCounter -=- 1;
    	    
    	}
	}else{
	    echo json_encode($response);
	}
    
?>