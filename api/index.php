<?php
include 'config.php';
include 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


$app->post('/getdetailpatient','getdetailpatient');
$app->post('/getmypatient','getmypatient');
$app->post('/login','login');
$app->post('/getActivity','getActivity');

$app->post('/getAccountPatient','getAccountPatient');
$app->post('/addActivity','addActivity');
$app->post('/getAccountDoctor','getAccountDoctor');
$app->post('/addpatient','addpatient');
$app->post('/getpatient','getpatient');
$app->post('/gettravel','gettravel');
$app->post('/getpopular','getpopular');
$app->post('/getnear','getnear');
$app->post('/getimg','getimg');
$app->post('/register','register');
$app->post('/getmyprofile','getmyprofile');
$app->post('/getprovence','getprovence');

$app->post('/getpicture','getpicture');
$app->post('/AddComment','AddComment');
$app->post('/Comment','Comment');
$app->post('/rating','rating');
$app->post('/myrating','myrating');
$app->run();

/************************* USER LOGIN *************************************/
/* ### User login ### */
function getAccountPatient() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_patient=$data->id_patient;
   
    try { 
          $userData = array();         
        $sql_query = "SELECT * from patient where id_patient=$id_patient";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
       
             $userData = json_encode($userData);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }
function getActivity() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_patient=$data->id_patient;
   
    try { 
          $userData = array();         
        $sql_query = "SELECT * from datapatient where id_patient=$id_patient";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
       
             $userData = json_encode($userData);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }
function addActivity() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
     $list1=$data->one;
     $list2=$data->two;
     $list3=$data->tree;
     $id_patient=$data->id_patient;
     if ($list1==true || $list1==""){
         $list1=1;
     }else{
        $list1=0;
     }
     if ($list2==true || $list2==""){
         $list2=1;
     }else{
        $list2=0;
     }
     if ($list3==true || $list3==""){
         $list3=1;
     }else{
        $list3=0;
     }
   
    try { 
             $db=getDB();
          $sql = "SELECT * from datapatient WHERE id_patient=:id_patient";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_patient", $id_patient,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                $db=getDB();
                $sql1="INSERT INTO datapatient(list1, list2, list3, id_patient)VALUES(:list1,:list2,:list3,:id_patient)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("list1", $list1,PDO::PARAM_STR);
                $stmt1->bindParam("list2", $list2,PDO::PARAM_STR);
                $stmt1->bindParam("list3", $list3,PDO::PARAM_STR);
                $stmt1->bindParam("id_patient", $id_patient,PDO::PARAM_STR);
                $stmt1->execute();

            }else{


                  $sql = "UPDATE datapatient SET list1=list1+1, list2=list2+1, list3=list3+1 where id_patient=$id_patient";

                  $conn = getDB();
                  $stmt = $conn->prepare($sql);
               
                  $stmt->execute();
            }
        
       
             $userData = json_encode($id_patient);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }
function getAccountDoctor() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_doctor=$data->id_doctor;
   
    try { 
          $userData = array();         
        $sql_query = "SELECT * from doctor where id_doctor=$id_doctor";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
       
             $userData = json_encode($userData);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }
function getdetailpatient() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_patient=$data->id_patient;
   
    try { 
          $userData = array();         
        $sql_query = "SELECT datapatient.day_data, datapatient.list1, datapatient.list2, datapatient.list3, datapatient.id_patient,patient.id_patient, patient.name_patient, patient.tai_patient from patient,datapatient where patient.id_patient=datapatient.id_patient and   patient.id_patient=$id_patient";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
       
             $userData = json_encode($userData);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }
function getmypatient() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_doctor=$data->id_doctor;
   
    try { 
          $userData = array();         
        $sql_query = "SELECT * from patient where id_patient in (select id_patient from my_doc_pat where id_doctor=$id_doctor)";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
       
             $userData = json_encode($userData);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }
function addpatient() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
   // $title=$data->title;
  
    $id_doctor=$data->id_doctor;
    $id_patient=$data->id_patient;
    
   
    try {
       
                /*Inserting user values*/
                $db=getDB();
                $sql1="INSERT INTO my_doc_pat(id_doctor, id_patient)VALUES(:id_doctor,:id_patient)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("id_doctor", $id_doctor,PDO::PARAM_STR);
                $stmt1->bindParam("id_patient", $id_patient,PDO::PARAM_STR);
                  
                $stmt1->execute();
                $db=null;
                $sql_query = "SELECT * from patient where id_patient not in (select id_patient from my_doc_pat where id_doctor=$id_doctor)";
                $conn = getDB();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rst =$conn->query($sql_query);
                $userData= $rst->fetchAll(PDO::FETCH_OBJ);
               
            
            
               $userdata = json_encode($userData);
                echo '{"pattient": ' .$userdata . '}';
            
       
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function getpatient() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_doctor=$data->id_doctor;
   
    try { 
          $userData = array();         
        $sql_query = "SELECT * from patient where id_patient not in (select id_patient from my_doc_pat where id_doctor=$id_doctor)";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
       
             $userData = json_encode($userData);
                echo '{"pattient": ' .$userData . '}';
        
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }

function register() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
   // $title=$data->title;
  
    $user_doctor=$data->username;
    $pass_doctor=$data->password;
    $name_doctor=$data->name;
    $tel_doctor=$data->phone;
    $status=$data->status;
   
    try {
        $db=getDB();
        $sql = "SELECT * from doctor WHERE user_doctor=:user_doctor";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam("user_doctor", $user_doctor,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();

         $sql = "SELECT * from patient WHERE user_patient=:user_patient";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("user_patient", $user_doctor,PDO::PARAM_STR);
            $stmt->execute();
            $mainCountpatient=$stmt->rowCount();
            $created=time();
            if($mainCount==0 and $mainCountpatient==0 and $status=="doctor")
            {
                /*Inserting user values*/
                $sql1="INSERT INTO doctor(user_doctor, pass_doctor, name_doctor, tel_doctor)VALUES(:user_doctor,:pass_doctor,:name_doctor,:tel_doctor)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("user_doctor", $user_doctor,PDO::PARAM_STR);
                $stmt1->bindParam("pass_doctor", $pass_doctor,PDO::PARAM_STR);
                $stmt1->bindParam("name_doctor", $name_doctor,PDO::PARAM_STR); 
                $stmt1->bindParam("tel_doctor", $tel_doctor,PDO::PARAM_STR);           
                $stmt1->execute();
                $db=null;
                $sql_query = "SELECT user_doctor FROM doctor WHERE user_doctor='$user_doctor'";
                $conn = getDB();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rst =$conn->query($sql_query);
                $userData= $rst->fetchAll(PDO::FETCH_OBJ);
               
            }else if($mainCount==0 and $mainCountpatient==0 and $status=="patient"){

               $sql1="INSERT INTO patient(user_patient, pass_patient, name_patient, tai_patient)VALUES(:user_patient,:pass_patient,:name_patient,:tai_patient)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("user_patient", $user_doctor,PDO::PARAM_STR);
                $stmt1->bindParam("pass_patient", $pass_doctor,PDO::PARAM_STR);
                $stmt1->bindParam("name_patient", $name_doctor,PDO::PARAM_STR); 
                $stmt1->bindParam("tai_patient", $tel_doctor,PDO::PARAM_STR);           
                $stmt1->execute();
                $db=null;
                $sql_query = "SELECT user_patient FROM patient WHERE user_patient='$user_doctor'";
                $conn = getDB();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rst =$conn->query($sql_query);
                $userData= $rst->fetchAll(PDO::FETCH_OBJ);

            }
            
            
               $userdata = json_encode($userData);
                echo '{"userData": ' .$userdata . '}';
            
       
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function login() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $pass_doctor=$data->password;
    $user_doctor=$data->username;
    
    try { 
          $userData = array();         
        $sql_query = "SELECT * from doctor where user_doctor='$user_doctor' and pass_doctor='$pass_doctor'";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);    
        
         if(!empty($userData)){
             $userData = json_encode($userData);
                echo '{"Doctor": ' .$userData . '}';
        }else{

             $sql_query = "SELECT * from patient where user_patient='$user_doctor' and pass_patient='$pass_doctor'";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        
         
        if(!empty($userData)){
            $userData = json_encode($userData);
                echo '{"patient": ' .$userData . '}';
        }else{

        $userData = json_encode($user_doctor);
                  echo '{"Notmath": ' .$userData . '}';
        }
    }
          
    }
    
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        }

function myrating() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $id_facebook=$data->member_id;
   
    $travel_id=$data->travel_id;
    try { 
              
                
                $sql_query = "SELECT * from tb_review where id_facebook=$id_facebook and travel_id=$travel_id and score>0";
      

        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
         $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
          
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function rating() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $travel_id=$data->travel_id;
    $score=$data->star_value;
    $id_facebook=$data->member_id;
    $db=getDB();
    try {
        $sql1="INSERT INTO tb_review(score, travel_id, id_facebook)VALUES(:score,:travel_id,:id_facebook)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("score", $score,PDO::PARAM_STR);
                $stmt1->bindParam("travel_id", $travel_id,PDO::PARAM_STR);
                $stmt1->bindParam("id_facebook", $id_facebook,PDO::PARAM_STR);           
                $stmt1->execute();
        $userData ='';
        $sql_query = "SELECT tb_review.review_id, tb_review.review_date, tb_review.comment, tb_review.score, tb_review.travel_id, facebook.name FROM tb_review,facebook WHERE tb_review.id_facebook=facebook.id_facebook and tb_review.travel_id=$travel_id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                //echo '{"userData": ''}';
            } 
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function AddComment() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $travel_id=$data->travel_id;
    $comment=$data->comment;
    $id_facebook=$data->id_facebook;
    $db=getDB();
    try {
        $sql1="INSERT INTO tb_review(comment, travel_id, id_facebook)VALUES(:comment,:travel_id,:id_facebook)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("comment", $comment,PDO::PARAM_STR);
                $stmt1->bindParam("travel_id", $travel_id,PDO::PARAM_STR);
                $stmt1->bindParam("id_facebook", $id_facebook,PDO::PARAM_STR);           
                $stmt1->execute();
        $userData ='';
        $sql_query = "SELECT tb_review.review_id, tb_review.review_date, tb_review.comment, tb_review.score, tb_review.travel_id, facebook.name FROM tb_review,facebook WHERE tb_review.id_facebook=facebook.id_facebook and (tb_review.travel_id=$travel_id and tb_review.comment!='')";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                //echo '{"userData": ''}';
            } 
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function Comment() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $travel_id=$data->travel_id;
    try {
        $userData ='';
        $sql_query = "SELECT tb_review.review_id, tb_review.review_date, tb_review.comment, tb_review.score, tb_review.travel_id, facebook.name FROM tb_review,facebook WHERE tb_review.id_facebook=facebook.id_facebook and tb_review.travel_id=$travel_id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                //echo '{"userData": ''}';
            } 
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getpicture() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $travel_id=$data->travel_id;
    try {
        $userData ='';
        $sql_query = "SELECT * from tb_imgtravel where travel_id=$travel_id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                echo '{"error":{"text":"Bad request wrong username and password"}}';
            } 
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function getprovence() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $province_id=$data->province_id;
    try {
        $userData ='';
        $sql_query = "SELECT * from tb_province where province_id=$province_id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                echo '{"error":{"text":"Bad request wrong username and password"}}';
            } 
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



function getimg() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $travel_id=$data->travelid;
    try {
        $userData ='';
        $sql_query = "SELECT * from tb_imgtravel where cycling_id=$cycling_id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                echo '{"error":{"text":"Bad request wrong username and password"}}';
            } 
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function gettravel() {
    
     $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
 
    try {
        $userData ='';
        $sql_query = "SELECT * FROM tb_travel";
        
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                echo '{"error":{"text":"Bad request wrong username and password"}}';
            }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
///////////////////////////////////////////
function getpopular() {
    
     $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
 
    try {
        $userData ='';
        $sql_query = "SELECT  tb_travel.travel_id, tb_travel.travel_name, tb_travel.travel_detail, tb_travel.address, tb_travel.lat, tb_travel.lng, tb_travel.picture_t,sum(tb_review.score)/count(tb_travel.travel_id) as score,tb_province.province_id,tb_province.province_name FROM tb_travel,tb_review,tb_province where tb_review.travel_id=tb_travel.travel_id and  tb_travel.province_id=tb_province.province_id GROUP BY tb_travel.travel_id ORDER BY score  DESC ";
        
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                echo '{"error":{"text":"Bad request wrong username and password"}}';
            }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function getmyprofile() {
    
     $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
     $email=$data->email;
    try {
        $userData ='';
        $sql_query = "SELECT * FROM facebook where email='$email'";
        
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $userData= $rst->fetchAll(PDO::FETCH_OBJ);
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            }else {
                echo '{"error":{"text":"Bad request wrong username and password"}}';
            }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
/////////////////////////////////////
function getnear() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $lat=$data->lat;
    $lnt=$data->lnt;
  
    try {
        $userData ='';
        $sql_query = "SELECT tb_travel.travel_id, tb_travel.travel_name, tb_travel.travel_detail, tb_travel.address, tb_travel.lat, tb_travel.lng, tb_travel.picture_t,tb_province.province_id,tb_province.province_name  from tb_travel,tb_province where tb_travel.province_id=tb_province.province_id";
        $conn = getDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rst =$conn->query($sql_query);
        $users= $rst->fetchAll(PDO::FETCH_OBJ);
    $usersdata=array();
    foreach ($users as $key => $value) {
   
        $travel_id=$value->travel_id;
        $travel_name=$value->travel_name;
       
        $travel_detail= $value->travel_detail;
        $address= $value->address;
        $cycling_lat= $value->lat;
        $cycling_long= $value->lng;
        $picture_t= $value->picture_t;
        $province_id= $value->province_id;
        $province_name=$value->province_name;

        
  $lat1=number_format($lat, 6, '.', '');
$lnt1=number_format($lnt, 6, '.', '');
$chklat2=number_format($cycling_lat, 6, '.', '');
$chklnt2=number_format($cycling_long, 6, '.', '');
$theta = $lnt1 - $chklnt2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($chklat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($chklat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $d=$miles * 1.609344;
  $howfar=number_format($d, 1, '.', ''); 
 
      $array=array('travel_id'=>$travel_id,'travel_name'=>$travel_name,'travel_detail'=>$travel_detail,'address'=>$address,'lat'=>$chklat2,'lng'=>$chklnt2,'picture_t'=>$picture_t,'province_id'=>$province_id,'province_name'=>$province_name,'distance'=>$howfar);
      $usersdata[]=$array;
      //  array_multisort($kiomate,  SORT_ASC, $users;*/
    }
      foreach ($usersdata as $key => $value) {
        $distance[$key] = $value['distance'];
    }

    array_multisort($distance,SORT_ASC,$usersdata);

    echo '{"userData": ' . json_encode($usersdata) . '}';
} 
catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
}    
$conn = null;
}

?>