<?php

function selectData($sql,$conn,$array){
    try {
        $stmt=$conn->prepare($sql);
        $stmt->execute($array);
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmt->fetch();       
        $stmt=null;
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function selectAllData($sql,$conn,$array){
    try {
        $stmt=$conn->prepare($sql);
        $stmt->execute($array);
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmt->fetchAll();       
        $stmt=null;
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function insertData($sql,$conn,$array){
    try {
        $stmt=$conn->prepare($sql);
        $stmt->execute($array);
        $stmt=null;
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
function checkEmail($conn,$email){
    $sql="SELECT user_id FROM user WHERE email=?";
    $array=[$email];
    $result=selectData($sql,$conn,$array);
    if($result!=null){
        return true;
    }else {
        return false;   
    }

}


// function get_craft_type($a)
// {
//     if($a == "video"){
//         return "Video";
//     }else if($a == "audio"){
//         return "Audio";
//     }else if($a == "image"){
//         return "Image";
//     }else
//     {
//         return "Decline";
//     }
// }
function get_content_type($a)
{
    if($a == "video"){
        return "Video";
    }else if($a == "audio"){
        return "Audio";
    }else if($a == "image"){
        return "Image";
    }else
    {
        return "Decline";
    }
}
function getArtists($conn,$search)
{
    if ($search=="all") {
        $sql="SELECT user_id,first_name,last_name, description,profile_photo FROM user WHERE user_type=?";
        $array=array("Artist");
        $result=selectAllData($sql,$conn,$array);
        return $result; 
    }else {
        $sql="SELECT user.user_id,user.first_name,user.last_name, user.description,user.profile_photo FROM user NATURAL JOIN artist WHERE user.user_type=? AND artist.talent LIKE ? OR user.description LIKE ?";
        $query="%$search%";
        $array=array("Artist",$query,$query);
        $result=selectAllData($sql,$conn,$array);
        return $result; 
    }
}



 function getCraftsUploaded($conn,$user_id){
    $sql="SELECT art_id,art_type,art_caption,art_path FROM art WHERE user_id=?";
    $array=array($user_id);
    $result=selectAllData($sql,$conn,$array);
    return $result; 
 }

function getEvents($conn,$search)
{
    if ($search=="all") {
        $sql="SELECT * FROM event";
        $array=array();
        $result=selectAllData($sql,$conn,$array);
        return $result; 
    }else {
        $sql="SELECT event_name, event_description, event_upload_path FROM event WHERE event_name LIKE ? OR event_description LIKE ?";
        $query="%$search%";
        $array=array($query, $query);
        $result=selectAllData($sql,$conn,$array);
        return $result; 
    }
}

function getGigs($conn,$search)
{
    if ($search=="all") {
        $sql="SELECT * FROM gig";
        $array=array();
        $result=selectAllData($sql,$conn,$array);
        return $result; 
    }else {
        $sql="SELECT gig_name, gig_description, gig_upload_path, gig_status FROM gig WHERE gig_name LIKE ?  OR gig_description LIKE ?";
        $query="%$search%";
        $array=array($query, $query);
        $result=selectAllData($sql,$conn,$array);
        return $result; 
    }
}

function getGigsEvents($conn, $search){
    $result = getEvents($conn, $search);
    $result1 = getGigs($conn, $search);
    $allResults = array_merge($result, $result1);
    return $allResults;
}


?>