<?php
    function navbar(){
        echo <<<EOT
            <ul class="logo-content">
                <li class="logo"><a href="./index.php"><img src="./assets/images/logo.png" alt="book-logo"></a></li>
            </ul>
            <ul>
                <li><a href="#">Account</a></li>
                <li><a href="./index.php">Add Book</a></li>
            </ul>
EOT;
    }
?>