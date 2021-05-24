<?php session_start();

if (empty($_SESSION['email']))
	header('Location: loginfrontend.html');

require 'vendor/autoload.php';

header("Content-type:application/json");

$client = new EasyRdf\Sparql\Client('http://localhost:8080/rdf4j-server/repositories/grafexamen');
$deTrimis = array();

$interogare='PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
prefix : <http://danielionut.ro#>
prefix dbo: <http://dbpedia.org/ontology/>
SELECT DISTINCT ?genre ?categTitle WHERE {
  <'.$_SESSION['userID'].'> :likes ?book.
  ?book a :Book;
    :hasGenre ?genre.
    ?genre rdfs:label ?categTitle.}';
$rezultat = $client->query($interogare);

foreach($rezultat as $rez)
{
	array_push($deTrimis, array(
    'id' => ''.$rez->genre,
	'title'=>''.$rez->categTitle
	));
}
echo json_encode($deTrimis);

?>