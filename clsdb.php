<?php
$namadb = "dbmasuk";
$dsn = "mysql:host=localhost;dbname=dbmasuk";
$user = "warnaagung";
$passwd = "cahyono";

$pdo = new PDO($dsn, $user, $passwd);

function getDummyC1($kon, $pTps){
    $strSQL = "SELECT p.idpetugas, p.nama, t.kode, t.namatps, " . 
            "dummy_hakdpt_lk, dummy_hakdpt_pr, dummy_hakdptb_lk, dummy_hakdptb_pr, dummy_hakdpk_lk, dummy_hakdpk_pr, " .
            "dummy_disab_hak_lk, dummy_disab_hak_pr, " .
            "(dummy_hakdpt_lk+dummy_hakdpt_pr+dummy_hakdptb_lk+dummy_hakdptb_pr+dummy_hakdpk_lk+dummy_hakdpk_pr+dummy_disab_hak_lk+dummy_disab_hak_pr) AS totsurat " .
            "FROM tps t INNER JOIN pengguna p ON LEFT(p.idpetugas,12)=t.kode";
    $stmt = $kon->prepare($strSQL . " where t.kode=? ");
    $stmt->execute([$pTps]); 
    if($baris=$stmt->fetch(PDO::FETCH_ASSOC)){
        return $baris;
    }
    else{
        $stmt->debugDumpParams();
    }
}