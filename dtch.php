<?php
    require_once "clsdbinidbchain.php";
    require_once "clsdb.php";
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $jml=0;
    $offset=0;

    if(isset($_GET["jml"]) && isset($_GET["offset"])){
        $jml=$_GET["jml"];
        $offset=$_GET["offset"];
    }
    else if(isset($_GET["jml"])){
        $jml=$_GET["jml"];
    }
    else if(isset($_GET["offset"])){
        $offset=$_GET["offset"];
    }
    $stmt=null;
    $tabel="chain" . ((isset($_GET["nonce"]))?$_GET["nonce"]:"0");
    if($jml>0){
        $stmt = $pdo->prepare("SELECT * FROM " . $tabel . " limit :ofset, :jml");
        $stmt->bindParam(':ofset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':jml',  $jml, PDO::PARAM_INT);
        $stmt->execute();
    }
    else{
        $stmt = $pdo->prepare("SELECT * FROM " . $tabel);
        $stmt->execute();
    }
    
    if($stmt!=null){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //die("halo" . count($data));
        $jsarr=array();
        $imsk=0;
        foreach($data as $baris){ 
            $arbaris=array();
            foreach($baris as $x => $val){
                if($x=="konten")
                    $arbaris[$x]=json_decode($val);
                else
                    $arbaris[$x]=(is_int($val))?intval($val):$val;
                
            }
            if($imsk==0){
                $jsarr[0]=$arbaris;
                $imsk=1;
            }
            else
                $jsarr[$imsk++]=$arbaris;
        }
        echo json_encode($jsarr);
    }
?>