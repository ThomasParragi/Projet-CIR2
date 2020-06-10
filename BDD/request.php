<?php
    require_once('database.php');

    // Database connexion.
    $db = dbConnect();
    if (!$db)
    {
      header ('HTTP/1.1 503 Service Unavailable');
      exit;
    }

    // Check the request.
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $requestRessource = array_shift($request);

    // Check the id associated to the request.
    $id = array_shift($request);
    if ($id == '')
        $id = NULL;
    $data = false;

    $depAirport = 'YYW';
    $arrAirport = 'YYE';
    $jour = 7;

    // Routes request.
    if ($requestRessource == 'vols')
    {
        $routesOk = dbRequestRoutes($db, $depAirport, $arrAirport, $jour); //return ID, nbPlaces

        /*
        foreach ($routesOk as $value) {
            $volOk =+ dbRequestFly($db, $routesOk[$value]);
            echo $routesOk[$value];
        }
        */

        echo $routesOk['ID'][0];
        //echo $volOk;
        //$data = json_encode($routesOk);
        //echo $data['ID'];
    }



    // Send data to the client.
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('HTTP/1.1 200 OK');
    //echo json_encode($data);
    echo $data;
    exit;
?>
