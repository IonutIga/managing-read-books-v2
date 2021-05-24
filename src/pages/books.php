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
        <link rel="stylesheet" href="../css/insert.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <script>

            var actualCategory;

            function deleteBook(idBook){
                adresaDelete=`../../backend/deleteBook.php?delete=${idBook}`;    
                $.get(adresaDelete, procesareRaspunsDelete);
                // getBooksPerCategories(actualCategory);
            }

            function procesareRaspunsDelete(raspuns){
                if(raspuns==204){
                    getBooksPerCategories(actualCategory);
                }else{
                    alert("Not deleted!");
                }
            }

            //on CAtegory click
            function getCategories(){
                document.getElementById('categories').innerHTML='';
                adresaCategories = "../../backend/getGenres.php";
                $.get(adresaCategories, procesareRaspunsCategories);
            }

            function getBooksPerCategories(idCateg){
                document.getElementById('books-list').innerHTML='';
                actualCategory = idCateg;
                adresa=`../../backend/getBooksPerCategories.php?id=${idCateg}`;
                $.get(adresa, procesareRaspuns);
            }


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
                    var aDelete = document.createElement('p');

                    bookItem.setAttribute('class', 'book-item');
                    bookInfo.setAttribute('class', 'book-info');
                    bookButton.setAttribute('class', 'book-buttons');
                    titleLabel.setAttribute('id', 'title');
                    authorLabel.setAttribute('id', 'author');


                    const bookID = book.id.split('#');

                    aDetail.setAttribute('href', './book.php?id='+bookID[1]);
                    aDelete.onclick = function(){ deleteBook(bookID[1]); }
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
                   var aCateg = document.createElement('p');

                   aCateg.onclick = function(){getBooksPerCategories(category.id)};
                   aCateg.innerText = category.name;
                   liCateg.appendChild(aCateg);
                   allCategories.appendChild(liCateg);
               });
            }   
           


            //INSEERT
            function trimite(book){
                adresa="../../backend/insertBook.php";

                if(actualCategory){
                    document.getElementById('genre').value = actualCategory;
                    dateDeTrimis=$('#insert-content').serializeArray();
                    console.log(dateDeTrimis);
                    $.post(adresa, dateDeTrimis, procesareRaspunsInsert);
                }else{
                    alert("Click on Category button and choose a category before!");
                }

            }

            function procesareRaspunsInsert(raspuns){
                if(raspuns==204){
                    getBooksPerCategories(actualCategory);
                    document.getElementById('error-message').style = 'display:none;';
                    console.log(raspuns);                    	    
                }else{
                    document.getElementById('error-message').style = 'display:visible;';
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
            <div class="panel">
                <ul class="header-panel">
                    <li><span style="border-style: solid; border-color: white;" onclick="getCategories()">Category<span></li>
                </ul>
                <ul id="categories">
                    <!-- Example of category format -->
                    <!-- <li><p onclick='function(){getBooksPerCategories(category.id)}'>Drama</p></li> -->
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
                
            <div class="insert-form">
                <div class="insert-header">
                    <p id="ins">Add Book</p>
                </div>
                <form id="insert-content">
                    <input type="text" id="title" name="title" placeholder="Title">
                    <input type="text" id="author" name="author" placeholder="Author">
                    <input type="number" id="year" name="year" placeholder="Published year">
                    <textarea id="comment" name="comment" placeholder="Summary/Comments"></textarea>
                    <input type="checkbox" id="fav" name="favourite"><label style="color:white;">Favourite</label>
                    <input type="hidden" id="genre" name="genre" value="">
                </form>
                <div class="final-form">
                    <button type="submit" id="insert-submit" onmouseover="trimite()">Submit</button>
                    <p id="error-message" style="display:none;">The book couldn't be added!</p>
                </div>
            </div>
              
        </main>
    <script src=""></script>
    </body>
</html>