<?php

header("content-type:application/json");
include "clsdb.php";

$content = trim(file_get_contents("php://input"));

$isi = json_decode($content, true);

echo json_encode(getDummyC1($pdo, substr($isi["uname"], 0,12) ));