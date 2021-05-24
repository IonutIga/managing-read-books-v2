<?php session_start();

if (empty($_SESSION['email']))
	header('Location: loginfrontend.html');

require 'vendor/autoload.php';

header("Content-type:application/json");

$client = new EasyRdf\Sparql\Client('http://localhost:8080/rdf4j-server/repositories/grafexamen');
$deTrimis = array();

$interogare='PREFIX : <http://danielionut.ro#>

SELECT ?title ?author ?genre ?comment WHERE
{
    <'.$_SESSION['userID'].'> :likes <http://danielionut.ro#'.$_GET['id'].'>.
	<http://danielionut.ro#'.$_GET['id'].'> rdfs:label ?title;
    		:hasAuthor ?author;
    		:hasGenre ?genreID.
    ?genreID rdfs:label ?genre.
    <http://danielionut.ro#'.$_GET['id'].'> :hasComments ?z.
    ?z :userID <'.$_SESSION['userID'].'>;
    :comment ?comment.
}';

$rezultat = $client->query($interogare);

foreach($rezultat as $rez)
{
	$deTrimis = array(
	'id' =>''.$_GET['id'],
    'title'=>''.$rez->title,
	'author'=>''.$rez->author,
	'genre'=>''.$rez->genre,
	'comment'=>''.$rez->comment
);
}
echo json_encode($deTrimis);

?>