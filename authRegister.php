<?php
    $fullName = $_POST["fullName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //RECEIVED USER INPUT

        //VERIFY PASSWORD AND CONFIRMPASS TO BE MATCH
        if(trim($password) == trim($confirmPassword))
        {
            
         //CONNECT DATABASE
        
        
         
            $host = "localhost";
            $database = "ecommerce";
            $dbuserame = "root";
            $dbpassword = "";
            
            $dsn = "mysql: host=$host;dbname=$database;";
            try {
                $conn = new PDO($dsn, $dbuserame, $dbpassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //p_fullName,$fullName
                $stmt = $conn->prepare("INSERT INTO users (fullName,username,password,created_at,updated_at) VALUES (:p_fullName,:p_username,:p_password,NOW(),NOW())");
                $stmt->bindParam(':p_fullName', $fullName);
                $stmt->bindParam(':p_username', $username);
                $stmt->bindParam(':p_password', $password);


                $password = password_hash(trim($password),PASSWORD_BCRYPT);
               
                if($stmt->execute()){
                    header("location: /registration.php?success=Registration successful");
                    exit;
                  
                }else{
                    header("location: /registration.php?error=Insert Error");
                    exit;
                }

            } catch (Exception $e){
                header("location: /registration.php?error=Username Already Existing");
            }
        }
            else
            {
                header("location: /registration.php?error=Password Mismatch");
                exit;
            }
                  
       
        //INSERT RECORD
        }
    ?>
    