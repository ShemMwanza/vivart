<?php
session_start();
require "../DBconnect.php";
require "../functions.php";
require "../Class/recruiter.php";
require "../Class/event.php";
require "../Class/craft.php";
require "../Class/gig.php";
if(isset($_POST['type'])){
    $type=$_POST['type'];
    switch ($type) {
        case 'r_addEvent':
            $event_name=$_POST['event_name'];
            $photo=$_FILES['event_file'];
            $description=$_POST['description'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($event_name)&&!empty($photo['name'])&&!empty($description)){
                $user= new Recruiter($_SESSION['user_id'],$conn);
                $user->addEvent($conn,$event_name,$description,$photo);
                
            }else {
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'r_addGig':
            $gig_name = $_POST['gig_name'];
            $gig_file = $_FILES['gig_file'];
            $description = $_POST['description'];
            $dbConnect = new DBconnect();
            $conn = $dbConnect->getConnection();
            if(!empty($gig_name) && !empty($gig_file) && !empty($description)){
                $recruiter = new Recruiter($_SESSION['user_id'], $conn);
                $recruiter->addGig($conn, $gig_name, $description, $gig_file);
            }else{
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'updateProfile':
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $profile_photo=$_FILES['profile_photo'];
            $description=$_POST['description'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            if(!empty($first_name)&&!empty($description)&&!empty($last_name)&&!empty($email)){
                if(empty($profile_photo['name'])){
                    $profile_photo=null;
                }
                $user= new Recruiter();
                $user->setFirstName($first_name);
                $user->setLastName($last_name);
                $user->setEmail($email);
                $user->setDescription($description);
                $user->updateProfile($conn,$profile_photo,$_SESSION['user_id']);
                
            }else {
                echo "All fields are required";
            }
            $dbConnect->closeConnection();
            break;
        case 'logout':
            $user = new User();
            $user->logout();
            echo "logged out";
            break;
        case 'getEventData':
            $event_id=$_POST['event_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $event= new Event($conn,$event_id);
            $eventArray = array
            (
            'event_name' => $event->getEventName(),
            'event_description' => $event->getEventDescription(),
            'event_upload_path' => $event->getEventUploadPath()
             ); 
             echo (json_encode($eventArray));
             $dbConnect->closeConnection();
             break;
        case 'approveGigApplication':
            $applicantId=$_POST['applicantId'];
            $gigId=$_POST['gigId'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $recruiter= new Recruiter($_SESSION["user_id"],$conn);
            $result= $recruiter->approveGigApplication($conn,$applicantId,$gigId);
            echo $result;
            $dbConnect->closeConnection();
            break;
        case 'declineGigApplication':
            $applicantId=$_POST['applicantId'];
            $gigId=$_POST['gigId'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $recruiter= new Recruiter($_SESSION["user_id"],$conn);
            $result= $recruiter->declineGigApplication($conn,$applicantId,$gigId);
            echo $result;
            $dbConnect->closeConnection();
            break;
        case 'getGigData':
            $gig_id=$_POST['gig_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $gig= new Gig($conn,$gig_id);
            $gigArray = array
            (
            'gig_name' => $gig->getGigName(),
            'gig_description' => $gig->getGigDescription(),
            'gig_upload_path' => $gig->getGigUploadPath()
             ); 
             echo (json_encode($gigArray));
             $dbConnect->closeConnection();
            break;
        case 'updateEvent':
            $event_id=$_POST['event_id'];
            $event_name=$_POST['event_name'];
            $event_description=$_POST['event_description'];
            $event_file=$_FILES['event_file'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $event= new Event($conn,$event_id);
            $event->setEventName($event_name);
            $event->setEventDescription($event_description);
            $event->updateEvent($conn,$event_file);
            $dbConnect->closeConnection();
            break;
        case 'updateGig':
            $gig_id=$_POST['gig_id'];
            $gig_name=$_POST['gig_name'];
            $gig_description=$_POST['gig_description'];
            $gig_file=$_FILES['gig_file'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $gig= new Gig($conn,$gig_id);
            $gig->setGigName($gig_name);
            $gig->setGigDescription($gig_description);
            $gig->updateGig($conn,$gig_file);
            $dbConnect->closeConnection();
            break;
        case 'deleteGig':
            $gig_id=$_POST['gig_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $gig= new Gig($conn,$gig_id);
            $gig->deleteGig($conn);
            $dbConnect->closeConnection();
            break;
        case 'deleteEvent':
            $event_id=$_POST['event_id'];
            $dbConnect= new DBconnect();
            $conn= $dbConnect->getConnection();
            $event= new Event($conn,$event_id);
            $event->deleteEvent($conn);
            $dbConnect->closeConnection();
            break;
        default:
            echo "Not executed";
            break;
    }
}else {
    echo "No type";
}


?>