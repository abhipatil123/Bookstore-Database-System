<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?
$search = $_GET["search"];
?>

<?
    session_start();
    $user = 'root';
    $password = 'root';
    $db = 'bookstore';
    $host = 'localhost';
    $port = 3306;

    $conn = mysqli_connect(
        $host, 
        $user, 
        $password, 
        $db,
        $port
    );
    

    if (!$conn){

        echo "Connection failed!";
        exit;

    }

    $username= $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM user WHERE Username = '$username' AND Password = '$pass'";

    $result = mysqli_query($conn, $sql);    

    if(!$result){
        echo "Error";
    }

    if($row = mysqli_fetch_array($result)){
        header("location: books.php");
        $_SESSION['username'] = $_POST["username"];
    }else{
        echo "login Failed";
        header("location: login.html");
    }

    mysqli_close();
        
?>


</body>
</html>