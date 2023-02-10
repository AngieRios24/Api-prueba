<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
require_once 'vendor/autoload.php';
 
$app = new \Slim\App();

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
$personas = [
    [
        "nombres" => "Paula Andres",
        "apellidos" => "Ramirez",
        "cedula" => "1236548",
        "correo" => "paula@gmail.com",
        "edad" => "26",
        "genero" => "Femenino",
        "ciudad" => "Medellin",
        "pais" => "Colombia"
    ],
    [
        "nombres" => "Santiago",
        "apellidos" => "Ramirez",
        "cedula" => "105697452",
        "correo" => "ramirez@gmail.com",
        "edad" => "20",
        "genero" => "Masculino",
        "ciudad" => "Cartagena",
        "pais" => "Colombia"
    ],
    [
        "nombres" => "Diana",
        "apellidos" => "Hernandez",
        "cedula" => "89546341",
        "correo" => "diana@gmail.com",
        "edad" => "23",
        "genero" => "Femenino",
        "ciudad" => "Cali",
        "pais" => "Colombia"
    ],
    [
        "nombres" => "Juan Esteban",
        "apellidos" => "Rivera",
        "cedula" => "1054689",
        "correo" => "juanes@gmail.com",
        "edad" => "25",
        "genero" => "Masculino",
        "ciudad" => "Manizales",
        "pais" => "Colombia"
    ],
    [
        "nombres" => "Mercedez",
        "apellidos" => "Diaz",
        "cedula" => "30356954",
        "correo" => "mercedez@gmail.com",
        "edad" => "30",
        "genero" => "Femenino",
        "ciudad" => "Pereira",
        "pais" => "Colombia"
    ],
    [
        "nombres" => "Andres",
        "apellidos" => "Rivera",
        "cedula" => "10545896",
        "correo" => "andres@gmail.com",
        "edad" => "24",
        "genero" => "Femenino",
        "ciudad" => "Manizales",
        "pais" => "Colombia"
    ]
];
$app->get('/personas', function (Request $request, Response $response) use($personas) {
    
    $data = Array("personas"=>$personas);
    return $response->withJson($data, 200);        

});

$app->get('/personas/{cedula}', function ($request, $response, $args) use ($personas) {
    $cedula = $args['cedula'];
    for($i=0;$i<count($personas); $i++){
        if($cedula == $personas[$i]['cedula']){
            $persona = $personas[$i];
            $data = Array("persona"=>$persona);
            $response->getBody()->write(json_encode($data));
        }
    }
   
    return $response->withHeader('Content-Type', 'application/json');
});

 
$app->run();
