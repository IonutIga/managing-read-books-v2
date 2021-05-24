<?php session_start();

if (empty($_SESSION['email']))
	header('Location: loginfrontend.html');

require 'vendor/autoload.php';

header("Content-type:application/json");

$client = new EasyRdf\Sparql\Client('http://localhost:8080/rdf4j-server/repositories/grafexamen');
$deTrimis = array();

$interogare='PREFIX : <http://danielionut.ro#>

SELECT ?opera ?title ?author WHERE
{
    <'.$_SESSION['userID'].'> :likes ?opera.
	?opera rdfs:label ?title;
    		:hasAuthor ?author;
            :hasGenre <'.$_GET['id'].'>.
}';
$rezultat = $client->query($interogare);

foreach($rezultat as $rez)
{
	array_push($deTrimis, array(
    'id' => ''.$rez->opera,
	'title'=>''.$rez->title,
	'author'=>''.$rez->author
	));
}
echo json_encode($deTrimis);

?>