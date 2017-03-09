
<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$app = new Silex\Application();
$app['debug'] = true;

$pdo = new PDO('mysql:dbname=video;host=localhost;charset=utf8', 'video_user', 'video_mdp', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


$app->get('/', function(){
	return new Response(json_encode("Hello world"), 200, array( 'Content-Type' => 'application/json' ));
	//return json_encode("Hello world");
});

$app->get('/typefilm/', function() use ($pdo){

	$sql = "SELECT * FROM typefilm";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);

	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');


	return $response;
});


$app->get('/films/', function(Request $request) use ($pdo){

	$codeTypeFilm = $request->get('type_film');

	$sql = "SELECT ID_FILM, TITRE_FILM, REF_IMAGE FROM film WHERE CODE_TYPE_FILM = :code ORDER BY annee_film ";

	$stmt = $pdo->prepare($sql);
	//$stmt->debugDumpParams();
	$stmt->bindParam(':code', $codeTypeFilm);
	$stmt->execute();

	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);

	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');

	return $response;
});

$app->get('/films/{id}', function($id) use($pdo){
	$sql = "SELECT * FROM film WHERE ID_FILM = :id";

	$stmt = $pdo->prepare($sql);
	//$stmt->debugDumpParams();
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);

	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');

	return $response;
});

$app->run();
