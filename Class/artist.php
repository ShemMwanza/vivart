<?php
require ("user.php");
class Artist extends User  
{
    protected $talent;
    public function __construct($user_id=false,$conn=false){
        Parent::__construct($user_id,$conn);
        if ($conn!=false && $user_id!=false) {
            $sql2="SELECT talent FROM artist WHERE user_id=?";
            $array2=[$user_id];
            $result2= selectData($sql2,$conn,$array2);
            // print_r($result2);
            if ($result2!=null) {
                $this->talent=$result2["talent"];
            }
            
        }
      
    }
    public function getTalent(){
        return $this->talent;
    }
    public function setTalent($talent){
         $this->talent=$talent;
    }
    public function updateProfile($conn,$profile_photo,$id){
        try {
            $sql="UPDATE user SET first_name=?,last_name=?,email=?,description=? WHERE user_id=?";
            $array=array($this->first_name,$this->last_name,$this->email,$this->description,$id);
            insertData($sql,$conn,$array);
            $sql5= "SELECT talent FROM artist WHERE user_id=?";
            $array5=array($id);
            $result5=selectData($sql5,$conn,$array5);
            if(!empty($result5['talent'])){
                $sql4="UPDATE artist SET talent=? WHERE user_id=?";
                $array4= array($this->talent,$id);
                insertData($sql4,$conn,$array4);
            }else {
                $sql6="INSERT INTO artist (user_id,talent) VALUES(?,?)";
                $array6= array($id,$this->talent);
                insertData($sql6,$conn,$array6);
            }
           
            $sql2="SELECT profile_photo FROM user WHERE user_id=?";
            $array2=array($id);
            $result=selectData($sql2,$conn,$array2);
            $event_upload_path=$result['profile_photo'];
            if ($profile_photo!=null) {
                if (!empty($event_upload_path)) {
                    $upload_path="../".$event_upload_path;
                    move_uploaded_file($profile_photo['tmp_name'],$upload_path);
                }else {
                    $imageFileType = strtolower(pathinfo($profile_photo['name'],PATHINFO_EXTENSION));
                    $event_upload_path="Image/profile".$id.".".$imageFileType;
                    $sql3="UPDATE user SET profile_photo=? WHERE user_id=?";
                    $array3=array($event_upload_path,$id);
                    insertData($sql3,$conn,$array3);
                    $upload_path="../".$event_upload_path;
                    move_uploaded_file($profile_photo['tmp_name'],$upload_path);
                }
               
            }
            echo "Successful";
        }catch (Exception  $th) {
            throw $th;
        }

    }

}

?>