<?php
    session_start();
    echo 'You have been logged out <br/>';
    echo '<a href = "login.php"> Login Again </a>';
    session_destroy();
?>