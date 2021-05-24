<?php
    require_once "../components/header-page.php"
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="icon" href="../assets/images/icon.png" type="image/x-icon"/>
        <title>Book Details</title>
        <link rel="stylesheet" href="../css/book.css">
        <link rel="stylesheet" href="../css/header-page.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const idBook = urlParams.get('id');

            $(document).ready(function() {
                adresa=`../../backend/getBook.php?id=${idBook}`;
                $.get(adresa, procesareRaspuns);
            });

            function procesareRaspuns(raspuns) {
                document.getElementById('det').innerText = raspuns.title;
                document.getElementById('author').innerText = raspuns.author;
                document.getElementById('year').innerText = raspuns.year;
                document.getElementById('category').innerText = raspuns.genre;
                if(raspuns.favourite == "true"){
                    document.getElementById('isFavourite').innerText = 'Yes';
                    console.log(raspuns.favourite); 
                }else{
                    document.getElementById('isFavourite').innerText = 'No';
                    console.log(raspuns.favourite);
                }

                document.getElementById('comment').innerText = raspuns.comment;
                
                var idBookHidden = document.getElementById('hidden-id');
                idBookHidden.setAttribute('value', raspuns.id);
            }


            //update
            function trimite(comment){
                adresa="../../backend/updateBook.php";
                dateDeTrimis=$('#update-form').serializeArray();
                // console.log(dateDeTrimis);
                $.post(adresa, dateDeTrimis, procesareRaspunsUpdate);
            }

            function procesareRaspunsUpdate(raspuns){
                if(raspuns==204 || raspuns==200){
                    // window.location.href = './books.php';
                    document.getElementById('succes-update').style = 'display:visible;';
                    console.log(raspuns);                    	    
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
        <main>
            <div class="details">
                <div class="details-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-book" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                    <span id="det"> </span>
                </div>
                <div class="details-content">
                    <div class="info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg> Author:          
                        <span id="author"> </span>
                    </div>
                    <div class="info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg> Published year:          
                        <span id="year"></span>
                    </div><br>
                    <div class="info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-bookmark" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                        </svg> Book category:          
                        <span id="category"></span>
                    </div><br>
                    <div class="info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                    </svg> Is one of favourites books: 
                        <span id="isFavourite"></span>   
                    </div>
                    <div class="info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg> Your comment/summary:          
                    </div>
                    <form id="update-form">
                        <input type="text" style="display:none;" name="id" id="hidden-id">
                        <textarea placeholder="No comment/summary" name="comment" id="comment">Acțiune începe cu Ghiță, Ana și mama Anei care stau și discută dacă să ia în arendă Moara cu Noroc. În final se decid să o ia deoarece nu mai voiau să trăiască o viață de cârpaci.</textarea>
                    </form>
                    <button type="button" id="update-button" onclick="trimite()">Update</button>
                    <p id="succes-update" style="display:none">Update succesfully!</p>
                </div>
            </div>
        </main>
        <footer>
            <div class="copyright">
                <p>&#169;Copyright 2021 by Ionut and Daniel. All Rights Reserved.</p>
            </div>
        </footer>
    </body>
</html>