<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php
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
    $book_id = $_GET["id"];
    $username = $_SESSION['username']; 
    
    //Check if book is already added
    $checkBookAddedQuery = "SELECT * FROM shoppingcart WHERE BookID = '$book_id' AND UserName = '$username' LIMIT 1";
    $bookAddedResult = mysqli_query($conn, $checkBookAddedQuery);
    $num_rows = mysqli_num_rows($bookAddedResult);
    if($num_rows == 0){
        $q = "SELECT * FROM book WHERE BookID = '$book_id'";
        $r = mysqli_query($conn, $q);
        $row = mysqli_fetch_array($r);
        $price  = $row["CurrentPrice"];
    }

    if($num_rows == 0){

        $query = "INSERT INTO shoppingcart ( UserName, BookID, Price) VALUES ('$username', '$book_id', '$price')";
            
        $result = mysqli_query($conn, $query);
        
        if($result){

            echo '<table align="left"
            cellspacing="5" cellpadding="8" class="table table-striped">

            <tr><td align="left"><b>Book Title</b></td>
            <td align="left"><b>Current Price</b></td>
            </tr>';

            $sql1 = "SELECT * FROM shoppingcart WHERE UserName = '$username' ";
            $result1 = mysqli_query($conn, $sql1);
            $totalprice = 0;
            while($row = mysqli_fetch_array($result1)){
                $bookid = $row["BookID"];
                $sql2 = "SELECT * FROM Book WHERE BookID = '$bookid' ";
                $result2 = mysqli_query($conn, $sql2);
               
                while($row = mysqli_fetch_array($result2)){
                    echo '<tr><td align="left">' . 
                    $row["BookTitle"] . '</td><td>' .  $row["CurrentPrice"] . '</td></tr>' ;
                    $totalprice  = $totalprice + $row["CurrentPrice"];
                }
            }
            echo '<tr><td><b>Cart Total</b></td> <td> '.$totalprice . '</td></tr>';
            echo '</table>';
        }else {
            echo "Couldn't issue database query<br />";
            echo mysqli_error($conn);
        }
    }else{
        echo "Book Already Added <br/";
    }

    echo '<tr><td><a href="books.php"> Contiue Shooping </a></td></tr> <br/>';
    echo '<a href = "logout.php"> Logout </a>';
    mysqli_close();

?>
</body>
</html>