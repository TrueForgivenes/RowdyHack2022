<?php
    $con = mysqli_connect('rh2022-db.csxnoto2wlv9.us-east-1.rds.amazonaws.com', 'admin', 'C!dNOBEMU6yD', 'rh2022','3306');
    echo "Found";
    //http://localhost/rh2022/register.php
    if(mysqli_connect_errno()){

        echo "1";
        exit();
    }
    //THESE NEED TO BE PASSED IN by either unity or the website
    
    $request =  $_POST["request"];

    switch($request){
        //Create table
        case 0:
            break;
        //Creating Account
        case 1:
            $userName = $_POST["username"];
            $password = $_POST["password"];
            break;
        // Log in
        case 2:
            $userName = $_POST["username"];
            $password = $_POST["password"];
            break;
        //Set modelCode
        case 3:
            $userName = $_POST["username"];
            $modelCode = $_POST["modelcode"];
            break;
        //Get modelCode
        case 4:
            $userName = $_POST["username"];
            break;
    }

    //$userName = $_POST["username"];
    //$password = $_POST["password"];
    //$modelCode = $_POST["modelcode"];
    


    switch($request){
        case 0:
            // ------ Creates Table for playerAccounts--------
            //Use this when starting
            $query = "CREATE TABLE IF NOT EXISTS playerAccounts(id int(11) AUTO_INCREMENT, username varchar(255) NOT NULL, password varchar(255) NOT NULL, modelCode varchar(255) DEFAULT NULL, PRIMARY KEY (id) )";
            mysqli_query($con, $query);
            break;
            //---------------------------------------------
        case 1:
            // ----- This is a test: Create account -------
            //Use this for registration
            $query = "SELECT * FROM playerAccounts WHERE username = '$userName'"; //$json->username'";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) > 0)
            {
                //return 'USERNAME_EXISTS';
                echo "USERNAME_EXISTS";
                echo "\n";
            }
            else
            {
                $query = "INSERT INTO playerAccounts(username, password) VALUES('$userName','$password')"; //values will change to what we pass in from unity
                mysqli_query($con, $query);
                //return 'ACCOUNT_CREATED';
                echo "ACCOUNT_CREATED";
                echo "\n";
            }
            break;
            //---------------------------------------------
        case 2:
            // ---- This is a test: Get account info ------
            //Use this for displaying page of log in, you can disregard password if it returns that
            $query = "SELECT * FROM playerAccounts WHERE username = '$userName' and password = '$password'";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) == 1)
            {
                $info = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $info["username"] = $row['username'];
                    $info["password"] = $row['password'];
                    $info["modelCode"] = $row['modelCode'];
                }
                echo "LOG_IN_SUCCESS";
            }
            else
            {
                echo 'LOG_IN_FAILED';
            }
            break;
            /////////////////////////////////////////////
        case 3:
            // ----- This is to add the Model Code -------
            //use this for when inputing the model code or URL
            $query = "SELECT * FROM playerAccounts WHERE username = '$userName'"; //$json->username'";
            $result = mysqli_query($con, $query);
            
            $query = "UPDATE playerAccounts SET modelCode = '$modelCode' WHERE username = '$userName'"; //values will change to what we pass in from unity

            if(mysqli_query($con, $query)){
                echo "Records were updated successfully.";
                echo "\n";
            }
            else{
                echo "FAILURE";
                echo "\n";
            }
            break;
            //return 'MODELCODE_ADDED';
        case 4:
            // ----- This is to retrieve Model Code -------
            //use this in unity for when trying to get the model code
            $query = "SELECT modelCode FROM playerAccounts WHERE username = '$userName'"; //$json->username'";
            $result = mysqli_query($con, $query);
            $row = $result->fetch_assoc();
            $codeFectched = $row['modelCode'];
            echo "ModelCode: ";
            echo $codeFectched;
            //echo "\n AYO \n";
            //return 'MODELCODE_ADDED';
            break;
    }
    $con->close();
?>