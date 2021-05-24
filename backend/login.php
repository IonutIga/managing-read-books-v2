<?php
session_start();

require 'vendor/autoload.php';

$client= new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");

// verificare existenta utilizator pe baza de email si parola
$interogare="prefix : <http://danielionut.ro#> ASK {?x :hasEmail '".$_POST['email']."'; :hasPassword '".md5($_POST['password'])."'}";
$raspuns = $client->query($interogare);
if ($raspuns->getBoolean() == TRUE)
{
	$interogare = 'prefix : <http://danielionut.ro#> SELECT ?nume ?id ?email WHERE {?id :hasEmail "'.$_POST['email'].'"; rdfs:label ?nume.}';
    $rezultat = $client->query($interogare);
foreach ($rezultat as $property)
{
	// salvare in sesiune a id utilizator logat
	$_SESSION['name'] = $property->nume;
	$_SESSION['userID'] = $property->id.'';
	$_SESSION['email'] = $_POST['email'];

}
	session_regenerate_id();
	$_SESSION['loggedin'] = TRUE;
	print(200);
	
}
else
{
	header("Content-type:text/plain");
	print(404);
}

?>