<?php
session_start();
require_once "database.php";
?>
<?php
$message = array();
if(isset($_POST['login'])){ 

    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM Login INNER JOIN CLIENT ON Login.ID_Client = CLIENT.ID_Client WHERE username='$username' AND PASSWORD='$password'";
    $result = $conn->query($sql);  
   if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        $_SESSION['ID_Client'] = $row['ID_Client'];
        switch ($row['role']) {
            case 'Customer':
                header("Location: client/client.php");
                break;
            case 'Admin':
                header("Location: admin/admin.php");
                break;
        }
    } else {
        $message[] = 'incorrect username or password!';
        
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-form {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: rgba(255, 255, 255, 0.6); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding-bottom: 3%;
        }
        button {
            width: 100%;
            margin-top: 10px;
            opacity: 0.7;
        }
        h2{
            text-align: center;
            margin-bottom: 20px;
            color: rgb(85, 85, 61);
        }
        span {
            font-weight: 500;
            text-decoration: underline;
        }
        label {
            font-weight: 500;
        }
        .alert {
            position: relative;
        }
        .close-btn {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.5rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            if(!empty($message)){
                echo '<div class="alert alert-danger">';
                foreach($message as $msg){
                    echo $msg;
                }
                echo '<span class="close-btn" onclick="hideAlert(this)">x</span></div>';
            }
        ?>
        <div class="login-form">
            <h2 class="mb-4"><span>V</span>olt<span>W</span>ise</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" value ="login" class="btn btn-warning">Login</button> 
            </form>  
        </div>
    </div>
    <!-- bootstrap links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function hideAlert(element) {
            element.parentElement.style.display = 'none';
        }
    </script>
</body>
</html>
