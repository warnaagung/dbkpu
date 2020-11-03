<?php
require_once "clsdb.php";
 
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

//If json_decode failed, the JSON is invalid.
if(!is_array($isi)){
    throw new Exception('Received content contained invalid JSON!');
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$st=null;
try{

    $pdo->beginTransaction();

    $sth = $pdo->prepare("SELECT substr(max(id),9,4) AS lastid FROM formc1 where SUBSTR(id,1,8)='" . substr($isi["kodepet"],0,8) . "'");
    $hex="0000";
    if($sth->execute())
    {
    
        /* Fetch all of the remaining rows in the result set */
        print("Fetch all of the remaining rows in the result set:\n");
        
        $hsl = $sth->fetch(PDO::FETCH_ASSOC);
        //$hsl["lastid"]="0000000000";
        $hex = dechex(hexdec($hsl["lastid"])+1); // Increment the hex value.
        $hex = str_pad($hex, 4, "0", STR_PAD_LEFT); // Keep leading zeroes up to 2 digits.
    }

    $strSQL="INSERT INTO formc1 (id, idpetugas,  pilih1, " . 
                                "pilih2, tdksah, hptlk, hptpr, " . 
                                "hptblk, hptbpr, hpklk, hpkpr, " . 
                                "hpdislk, hpdispr, suararusak, dptlk, " . 
                                "dptpr, dptblk, dptbpr, dpklk, " . 
                                "dpkpr, dpdislk, dpdispr, suara) " .
                                "VALUES " .
                                "(:id, :idpet, :pil1," .
                                ":pil2, :tdksah, :hptlk, :hptpr," .
                                ":hptblk, :hptbpr, :hpklk, :hpkpr," .
                                ":hpdislk, :hpdispr, :suararusak, :dptlk, " . 
                                ":dptpr, :dptblk, :dptbpr, :dpklk, " . 
                                ":dpkpr, :dpdislk, :dpdispr, :suara);";

    $st=$pdo->prepare($strSQL);

    $arr=array();
    $nilai_id=substr($isi["kodepet"],0,8) . $hex;
    $st->bindParam(':id', $nilai_id, PDO::PARAM_STR, 10);
    $arr[":id"]= substr($isi["kodepet"],0,8).$hex;

    $st->bindParam(':idpet', $isi["kodepet"], PDO::PARAM_STR, 20);
    $arr[":idpet"]=$isi["kodepet"];

//    $st->bindParam(':idtps', $isi["kodetps"], PDO::PARAM_STR, 20);
//    $arr[":idtps"]=$isi["kodetps"];
    
    $st->bindParam(':pil1', $isi["pil1"], PDO::PARAM_INT );
    $arr[":pil1"]=$isi["pil1"];

    $st->bindParam(':pil2', $isi["pil2"], PDO::PARAM_INT );
    $arr[":pil2"]=$isi["pil2"];
    
    $st->bindParam(':tdksah', $isi["tdksah"], PDO::PARAM_INT );
    $arr[":tdksah"]=$isi["tdksah"];
    
    $st->bindParam(':hptlk', $isi["hptlk"], PDO::PARAM_INT );
    $arr[":hptlk"]=$isi["hptlk"];
    
    $st->bindParam(':hptpr', $isi["hptpr"], PDO::PARAM_INT );
    $arr[":hptpr"]=$isi["hptpr"];

    
    $st->bindParam(':hptblk', $isi["hptblk"], PDO::PARAM_INT );
    $arr[":hptblk"]=$isi["hptblk"];
    
    $st->bindParam(':hptbpr', $isi["hptbpr"], PDO::PARAM_INT );
    $arr[":hptbpr"]=$isi["hptbpr"];
    
    $st->bindParam(':hpklk', $isi["hpklk"], PDO::PARAM_INT );
    $arr[":hpklk"]=$isi["hpklk"];
    
    $st->bindParam(':hpkpr', $isi["hpkpr"], PDO::PARAM_INT );
    $arr[":hpkpr"]=$isi["hpkpr"];

    
    $st->bindParam(':hpdislk', $isi["hpdislk"], PDO::PARAM_INT );
    $arr[":hpdislk"]=$isi["hpdislk"];
    
    $st->bindParam(':hpdispr', $isi["hpdispr"], PDO::PARAM_INT );
    $arr[":hpdispr"]=$isi["hpdispr"];
    
    $st->bindParam(':suararusak', $isi["suararusak"], PDO::PARAM_INT );
    $arr[":suararusak"]=$isi["suararusak"];
    
    $st->bindParam(':dptlk', $isi["dptlk"], PDO::PARAM_INT );
    $arr[":dptlk"]=$isi["dptlk"];

    
    $st->bindParam(':dptpr', $isi["dptpr"], PDO::PARAM_INT );
    $arr[":dptpr"]=$isi["dptpr"];
    
    $st->bindParam(':dptblk', $isi["dptblk"], PDO::PARAM_INT );
    $arr[":dptblk"]=$isi["dptblk"];
    
    $st->bindParam(':dptbpr', $isi["dptbpr"], PDO::PARAM_INT );
    $arr[":dptbpr"]=$isi["dptbpr"];
    
    $st->bindParam(':dpklk', $isi["dpklk"], PDO::PARAM_INT );
    $arr[":dpklk"]=$isi["dpklk"];

    
    $st->bindParam(':dpkpr', $isi["dpkpr"], PDO::PARAM_INT );
    $arr[":dpkpr"]=$isi["dpkpr"];
    
    $st->bindParam(':dpdislk', $isi["dpdislk"], PDO::PARAM_INT );
    $arr[":dpdislk"]=$isi["dpdislk"];
    
    $st->bindParam(':dpdispr', $isi["dpdispr"], PDO::PARAM_INT );
    $arr[":dpdispr"]=$isi["dpdispr"];
    
    $st->bindParam(':suara', $isi["suara"], PDO::PARAM_STR );
    $arr[":suara"]=$isi["suara"];
    
    $st->execute();
    $pdo->commit();

}
catch(\Exception $e){
    $pdo->rollBack();
    throw $e;
}
finally{
    $st->debugDumpParams();
}

/*
$strSQL="INSERT INTO formc1 (id, idpetugas, idtps, pemilih_dpt, pemilih_dptb, pemilih_dpk, " .
        "hakpilih_dpt, hakpilih_dptb, hakpilih_dpk, pemilih_lk, pemilih_pr, disabil_datalk, disabil_datapr, " .
        "disabil_pilihlk, disabil_pilihpr, suararusak, suara) VALUES "
 . "(" . $isi["idpetugas"] . ","  
       . $isi["pemilih_dpt"] . ","  
       . $isi["pemilih_dptb"] . ","  
       . $isi["pemilih_dpk"] . ","  
       . $isi["hakpilih_dpt"] . ","  
       . $isi["hakpilih_dptb"] . ","  
       . $isi["hakpilih_dpk"] . ","  
       . "'" . $isi["suara"] . "',"  
       . $isi["pemilih_lk"] . ","  
       . $isi["pemilih_pr"] .  ")"; 
echo $strSQL;
$nrows = $pdo->exec($strSQL);
$rowid = $pdo->lastInsertId();
*/
//echo "The last inserted row id is: $rowid\n";
//$nrows = $pdo->exec("(id, idpetugas, pemilih_dpt, pemilih_dptb, pemilih_dpk, hakpilih_dpt, hakpilihdptb, hakpilihdpk, pemilih_lk, pemilih_pr, tdlupload, tglchain_go, tglchainend)");