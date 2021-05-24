<?php

require 'vendor/autoload.php';

header("Content-type:application/json");

$client = new EasyRdf\Sparql\Client('http://localhost:8080/rdf4j-server/repositories/grafexamen');
$deTrimis = array();

$interogare = 'PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
prefix : <http://danielionut.ro#>
prefix dbo: <http://dbpedia.org/ontology/>
SELECT ?id ?name WHERE
{
?id a dbo:literaryGenre;
    rdfs:label ?name.
}';

$rezultat = $client->query($interogare);

foreach($rezultat as $rez)
{
	array_push($deTrimis, array('id' => ''.$rez->id, 'name'=>''.$rez->name));
}
echo json_encode($deTrimis);

?>