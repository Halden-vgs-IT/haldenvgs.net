<?php

	define('DB_NAME', 'haldenvg_greenScan');
	define('DB_USER', 'haldenvg_neo');
	define('DB_PASSWORD', 'eclodona-admin');
	define('DB_HOST', '31.220.21.90');

    error_reporting(E_ALL); 
	$errorTF = true;



	function checkIfProfileExists($userToCheck){
        global $conn;
	    $SQLCommand = "SELECT * FROM `haldenvg_greenScan`.PersonalData WHERE `Name` = '$userToCheck'";
	    $mediumThing = mysqli_query($conn,$SQLCommand);
	    $resultsFromDB = mysqli_fetch_assoc($mediumThing);
	    
	    try{
            
            return $resultsFromDB;
	    }catch(Exception $e){
	        
	        return false;
	    }
	}
		
	function getScans($userId){
        
        $userPath = "profileFolders/".$userId;
	    if(isdir($userPath)){
	        $lastScannedFile = fopen($userPath."/scanLog.GS",'r');
	        echo file_get_contents($userPath.'/scanLog.GS');
	        
	    }else{
	        echo "dosent exists";
	        mkdir($userPath);
	        $f = fopen($userPath.'/scanLog.GS','w');
	        $f.close();
	        return 0;
	    }
	    
	    
	}
		
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST["userPass"]) && isset($_POST["userName"])){
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
            $safeUserInput = mysqli_real_escape_string($conn,$_POST['userName']);
            $userExistData = checkIfProfileExists($safeUserInput);
            
            
            if($userExistData == false){
                $response = "noExist";
                
            }else{
                if($userExistData['PASS'] == $_POST["userPass"]){
                    unset($userExistData['PASS']);
                    if($userExistData['NumOfScans'] != 0)
                        $userExistData['lastScans'] = getAverageMiljo($userExistData['Id']);
                    else{
                        $userExistData['lastScans'] = 0;}
                    $response = $userExistData;
                }else{
                    $response = "Wrong Password";
                }
                
            }
            
        }
	}else{
		$errorTF = true;
		$response = "Fuck off yer wee cunt";
	}
    $conn = null;
	if(is_array($response)){
	    $loopCounter = 0;
    	foreach($response as $arrayValue){
    	    switch($loopCounter){
    	        case 0:
        	        echo "*";
                	echo json_encode($arrayValue);
                	echo "*";
                	$loopCounter -=- 1;
                	break;
        	    case 1:
        	        echo "^";
                	echo json_encode($arrayValue);
                	echo "^";
                	$loopCounter -=- 1;
        	        break;
        	    case 2:
        	        echo "%";
                	echo json_encode($arrayValue);
                	echo "%";
                	$loopCounter -=- 1;
                	break;
        	    case 3:
        	        echo "#";
                	echo json_encode($arrayValue);
                	echo "#";
                	$loopCounter -=- 1;
                	break;
                case 2:
        	        echo "=";
                	echo json_encode($arrayValue);
                	echo "=";
                	$loopCounter -=- 1;
                	break;
                	
    	        default:
    	            echo json_encode("Response array outloop out of CSV");
    	            break;
    	    }
    	}
	}else{
	    echo json_encode($response);
	}
?>