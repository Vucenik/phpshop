<?php
/*
Response.class.php
Shop
Vlatko Vučenik
Last Modified:27.04.2023 12:30
*/ 
final class Response
{
    public function ispisi_json(array $data=[])
    {
        header("HTTP/1.0 200 OK");
        header("Content-Type:application/json;charset=utf-8");
        echo(json_encode(['data'=>$data], true));
    }
    public function ok(string $tekst)
    {
        header("HTTP/1.0 200 OK");
        header("Content-Type:text/plain;charset=utf-8");
        echo $tekst;
    }
    public function bad(string $tekst)
    {
        header("HTTP/1.1 404 Not Found");
        header("Content-Type:text/plain;charset=utf-8");
        echo $tekst;
    }

public function show(string $name, array $podaci =['title'=>'Prognoze-POU','script'=>'','model'=>[]])
{
    $path = TEMPLATE_DIR
    .$name.'_template.php';
    header("HTTP/1.1 200 OK");
    header("Content-Type:text/html;charset=utf-8");
    //header("X-Frame-Options:DENY");//prevent click jacking


    if (!file_exists($path)) {
        echo "greska";
        include APP_ROOT.'/src/pages/greska.html';
        exit;
    };
    include $path;
}
public function redirect(string $location,int $code=302):void{
    http_response_code($code);
    header('Location:'.$location);
}
}

?>