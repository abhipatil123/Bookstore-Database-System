<html>

<body>
    <!-- Use method post for sensitive information -->
    <form action="http://localhost/logout.php" method="POST">
      
      <?php
        session_start();

        if(!isset($_SESSION['username']) || !isset($_SESSION['email']) || !isset($_SESSION['password'])) 
        {
          header("Location: login.html");
          exit();
        }
        else 
        {
          echo "Welcome " . $_SESSION["username"] . "<br/>";
        }
      ?>

      <table border="0">
        <tr>
            <td colspan="2" align="center"><input type="submit" value="logout"/></td>
        </tr>
      </table>
    </form>
</body>

</html>