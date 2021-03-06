<?php
header("content-type:application/json");
require_once "clsdb.php";
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 
//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}
 
//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$isi = json_decode($content, true);

$stmt = $pdo->prepare("SELECT * FROM pengguna where idpetugas=? and password=?");
$stmt->execute([$isi["uname"], $isi["upass"]]); 
//$data = $stmt->fetchAll();
if($baris=$stmt->fetch()){
    session_start();
    $_SESSION["idpetugas"]=$baris["idpetugas"];
    $_SESSION["nama"]=$baris["nama"];
    setcookie("idpetugas", $_SESSION["idpetugas"], time() + (86400 * 30), "/");
    setcookie("nama", $_SESSION["nama"], time() + (86400 * 30), "/");
    setcookies("session_id", session_id(), time() + (86400 * 30), "/");
    
    $stmt2 = $pdo->prepare("SELECT * FROM calon");
    $stmt2->execute();
    $alldata=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    $calon=array();
    foreach ($alldata as $dt)
    {
        $presiden=array();
        foreach($dt as $k=>$v)
            if($k != "gambar"){
                $presiden[$k]=(is_int($v))?intval($v):$v;
                //print_r($presiden);
            }
        array_push($calon, $presiden);
    }
    echo json_encode(["calon" => $calon, "haksurat" => json_encode(getDummyC1($pdo, substr($_SESSION["idpetugas"], 0,12) )) ]);
}
else{
    $stmt->debugDumpParams();
}
?>