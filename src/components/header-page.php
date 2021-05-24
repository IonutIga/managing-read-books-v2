<?php
    session_start();
    function navbar(){
        echo <<<EOT
            <ul class="logo-content">
                <li class="logo"><a href="../../backend/logout.php"><img src="../assets/images/logo.png" alt="book-logo"></a></li>
            </ul>
            <ul>
EOT;
        if (empty($_SESSION['email'])){
            echo <<<EOT
                <li><a href="../index.php" class="push-left">Account</a></li>
EOT;
        }

        if (!empty($_SESSION['email'])){
            echo <<<EOT
                <li><a href="./books.php">My Books</a></li>
EOT;
        }
            echo <<<EOT
                <li><a href="./insert.php">Add Book</a></li>
EOT;
        if (!empty($_SESSION['email'])){
            echo <<<EOT
                <li id="logout"><a href="../../backend/logout.php">Logout</a></li>
EOT;
        }

        echo <<<EOT
            </ul>
EOT;
    }
?>