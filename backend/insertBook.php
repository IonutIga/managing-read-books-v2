<?php session_start();
if (empty($_SESSION['email']))
	header('Location: loginfrontend.html');

require 'vendor/autoload.php';

header("Content-type:text/plain");

$client = new EasyRdf\Sparql\Client('http://localhost:8080/rdf4j-server/repositories/grafexamen');
$clientUpdate = new EasyRdf\Sparql\Client('http://localhost:8080/rdf4j-server/repositories/grafexamen/statements');

$favourite = 'false';
if (!empty($_POST['favourite'])) $favourite = 'true';	

	// verifica daca s-a inserat deja cartea și daca a atașat un comentariu
	$interogare = 'prefix : <http://danielionut.ro#>
	ASK {?x rdfs:label "'.$_POST['title'].'" ;
	:hasAuthor "'.$_POST['author'].'";
	:hasGenre <'.$_POST['genre'].'>;
	:publishedYear '.$_POST['year'].';
	:hasComments ?z.
	?z :userID <'.$_SESSION['userID'].'>.}';
	$raspuns = $client->query($interogare);
	
	
if ($raspuns->getBoolean() == TRUE)
{
	print(404);
}
else{
	// verificare daca a fost deja inserata cartea, pt a nu avea duplicate
	$interogare = 'prefix : <http://danielionut.ro#>
	ASK {?x rdfs:label "'.$_POST['title'].'" ;
	:hasAuthor "'.$_POST['author'].'";
	:hasGenre <'.$_POST['genre'].'>;
	:publishedYear '.$_POST['year'].'}';
	$raspuns = $client->query($interogare);
	
	
if ($raspuns->getBoolean() == TRUE)
{
	// preluam ID carte 
	$bookID = '';
	$interogare = 'prefix : <http://danielionut.ro#> 
	SELECT ?bookID {?bookID rdfs:label "'.$_POST['title'].'" ; 
	:hasAuthor "'.$_POST['author'].'";
	:hasGenre <'.$_POST['genre'].'>;
	:publishedYear '.$_POST['year'].'}';
	$raspuns = $client->query($interogare);
	foreach($raspuns as $rez)
	{
		$bookID = $rez->bookID;
	}
	// inseram comentariu atasat cartii
	$interogareUpdate ='
prefix : <http://danielionut.ro#> 
							
INSERT DATA{
<'.$_SESSION['userID'].'> :likes <'.$bookID.'>.
   <'.$bookID.'> :hasComments [:userID <'.$_SESSION['userID'].'>;
				  :comment "'.$_POST['comment'].'";
				  :favourite '.$favourite.']
				}';

print $clientUpdate->update($interogareUpdate)->getStatus();

}
else
{	
// cream ID carte
$bookID = trim(str_replace(" ","",$_POST['title'])).bin2hex(random_bytes(2));
// inseram cartea si comentariu

$interogareUpdate ='
prefix : <http://danielionut.ro#> 
							
INSERT{
<'.$_SESSION['userID'].'> :likes ?bookID.
?bookID a :Book; 
	  rdfs:label "'.$_POST['title'].'";
    	  :hasAuthor "'.$_POST['author'].'";
       	  :hasGenre <'.$_POST['genre'].'>;
		  :publishedYear '.$_POST['year'].';
          :hasComments [:userID <'.$_SESSION['userID'].'>; :comment "'.$_POST['comment'].'"; :favourite '.$favourite.']
}
WHERE{
	BIND(IRI(CONCAT("http://danielionut.ro#'.$bookID.'")) AS ?bookID)
}';

print $clientUpdate->update($interogareUpdate)->getStatus();

}
}
?>