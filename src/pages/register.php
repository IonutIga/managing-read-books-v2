<?php
    require_once "../components/header-page.php"
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../assets/images/icon.png" type="image/x-icon"/>
        <title>Register</title>
        <link rel="stylesheet" href="../css/register.css">
        <link rel="stylesheet" href="../css/header-page.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
        <script>
        function trimite(user)
        {
            let username = document.getElementById('username').value;
            let email = document.getElementById('email').value;
            let pass = document.getElementById('password').value;

            if(username.length>0 && email.length>0 && pass.length>0){
                adresa="../../backend/register-back.php"
                dateDeTrimis=$('#register-content').serializeArray();
                $.post(adresa, dateDeTrimis, procesareRaspuns);
            }else{
                document.getElementById('error-message').style = 'display:visible; color:white; padding-bottom:1%';
            }
        }
        function procesareRaspuns(raspuns)
	    {
            if(raspuns==204){
                window.location.href = '../index.php';	    
            }else{
                console.log(raspuns);
            }
        }
        </script>   

        <header>
            <nav>
                <?=navbar() ?> 
            </nav>
        </header>

        <div class="intro">
            <p>This application is intended to manage the books you read.</p><br>
            <p>Step 1: Create an accoun in register.</p>
            <p>Step 2: Logged in to the created account.</p>
            <p>Step 3: Add a read book.</p>
        </div>
        <main>
            <div class="register-form">
                <div class="register-header">
                    <a href="../index.php" id="log">Login</a> | <a id="reg">Register</a>
                </div>
                <form id="register-content">
                    <input type="text" id="username" name="name" placeholder="Username" require>
                    <input type="email" id="email" name="email" placeholder="Email" require>
                    <input type="password" id="password" name="password" placeholder="Password" require>
                </form>
                <button type="submit" id="register-submit" onclick="trimite()">Submit</button>
                <p id="error-message" style="display:none;">Fill in all the fields!</p>
            </div>
        </main>

         <footer>
            <div class="copyright">
                <p>&#169;Copyright 2021 by Ionut and Daniel. All Rights Reserved.</p>
            </div>
        </footer>
    </body>
</html>