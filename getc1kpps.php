<?php
    require_once "clsdb.php";
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if(!isset($_GET['idpetugas'])){
        throw new Exception('Request harus dalam method GET dg field idpetugas');
    }
    $stmt = $pdo->prepare("SELECT * FROM formc1 where idpetugas=?");
    $stmt->execute([$_GET['idpetugas']]); 

    if($baris=$stmt->fetch(PDO::FETCH_ASSOC)){

        $c1=array();
        foreach ($baris as $k => $v)
        {
            $c1[$k]=(is_int($v))?intval($v):$v;
        }
        echo json_encode($c1);
    }
    else{
        $stmt->debugDumpParams();
    }
?>