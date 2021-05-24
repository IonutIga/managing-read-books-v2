<?php
    require_once "../components/header-page.php"
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../assets/images/icon.png" type="image/x-icon"/>
        <title>My Books</title>
        <link rel="stylesheet" href="../css/books.css">
        <link rel="stylesheet" href="../css/header-page.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <script>

                //for delete book
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const idCateg = urlParams.get('id')

                if(idCateg){
                    adresaDelete=`../../backend/deleteBook.php?delete=${idCateg}`;    
                    $.get(adresaDelete);
                }
                else{
                    console.log('Error delete');
                }

            //on load page
            $(document).ready(function() {
                adresa="../../backend/getBooks.php";
                adresaCategories = "../../backend/getCategories.php";
                $.get(adresa, procesareRaspuns);
                $.get(adresaCategories, procesareRaspunsCategories);
            });
    

            function procesareRaspuns(raspuns)
	        {    
                var allBooks = document.getElementById('books-list');
                raspuns.forEach(function callbackFn(book) { 
                    var bookItem = document.createElement('div');
                    var bookInfo = document.createElement('div');
                    var bookButton = document.createElement('div');
                    var detailsButton = document.createElement('button');
                    var deleteButton = document.createElement('button');
                    var titleLabel = document.createElement('label');
                    var authorLabel = document.createElement('label');
                    var aDetail = document.createElement('a');
                    var aDelete = document.createElement('a');

                    bookItem.setAttribute('class', 'book-item');
                    bookInfo.setAttribute('class', 'book-info');
                    bookButton.setAttribute('class', 'book-buttons');
                    titleLabel.setAttribute('id', 'title');
                    authorLabel.setAttribute('id', 'author');


                    const bookID = book.id.split('#');

                    aDetail.setAttribute('href', './book.php?id='+bookID[1]);
                    aDelete.setAttribute('href', './books.php?id='+bookID[1]);
                    detailsButton.setAttribute('type', 'button');
                    deleteButton.setAttribute('type', 'button');                    


                    titleLabel.innerText = book.title;
                    authorLabel.innerText = book.author;
                    aDetail.innerText = 'Details';
                    aDelete.innerText = 'Delete';
                

                    allBooks.appendChild(bookItem);
                    bookInfo.appendChild(titleLabel);
                    bookInfo.appendChild(authorLabel);
                    bookButton.appendChild(detailsButton);
                    bookButton.appendChild(deleteButton);
                    bookItem.appendChild(bookInfo);
                    bookItem.appendChild(bookButton);
                    detailsButton.appendChild(aDetail);
                    deleteButton.appendChild(aDelete);
                });
            }

            function procesareRaspunsCategories(raspuns) {
               
               var allCategories = document.getElementById('categories');
              
               raspuns.forEach(function callbackFn(category) { 
                 
                   var liCateg = document.createElement('li');
                   var aCateg = document.createElement('a');

                   aCateg.setAttribute('href', `./booksCategories?id=${category.id}`);
                   aCateg.innerText = category.title;
                   liCateg.appendChild(aCateg);
                   allCategories.appendChild(liCateg);
               });
           }   
           
        </script>
        <header>
            <nav>
                <?=navbar() ?> 
            </nav>
        </header>
        <main>
            <div class="panel">
                <ul class="header-panel">
                    <li><span>Category<span></li>
                </ul>
                <ul id="categories">
                    <!-- Example of category format -->
                    <!-- <li><a href="./booksCategories?id=...">Drama</a></li> -->
                </ul>
            </div> 
            <div class="books-list" id="books-list">
                
                <!-- Structura unei carti create mai sus in JavaScript este de forma: -->
                <!-- <div class="book-item">
                        <div class="book-info">
                            <label id="title">Title</label>
                            <label id="author">Author</label>
                        </div>
                        <div class="book-buttons">
                            <button type="button"><a href="./book.php?id=...">Detail</a></button>
                            <button type="button">Delete</button>
                        </div>
                    </div>  -->

            </div> 
              
        </main>
    <script src=""></script>
    </body>
</html>