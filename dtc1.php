<?php
    require_once "clsdb.php";
    
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
    if($jml>0){
        $stmt = $pdo->prepare("SELECT * FROM formc1 limit :ofset, :jml");
        $stmt->bindParam(':ofset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':jml',  $jml, PDO::PARAM_INT);
        $stmt->execute();
    }
    else{
        $stmt = $pdo->prepare("SELECT * FROM formc1");
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
                $arbaris[$x]=$val;
                
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