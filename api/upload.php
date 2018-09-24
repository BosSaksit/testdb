<?php
header('Access-Control-Allow-Origin: *');
include 'system/connect.php';
function GeraHash($qtd){ 
$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789abcdefghjklimnopqrstuvwxyz'; 
$QuantidadeCaracteres = strlen($Caracteres); 
$QuantidadeCaracteres--; 

$Hash=NULL; 
    for($x=1;$x<=$qtd;$x++){ 
        $Posicao = rand(0,$QuantidadeCaracteres); 
        $Hash .= substr($Caracteres,$Posicao,1); 
    } 

return $Hash; 
} 
 

$target_path = "uploads/";
$picture=$_FILES['file']['name'];
$shortname =$picture;
$images =$_FILES['file']['tmp_name'];
$Str_file = explode(".",$_FILES['file']['name']); 
$new_images =  GeraHash(40).'.'.$Str_file['1'];
$target_path = $target_path . basename($new_images);

if (move_uploaded_file($images, $target_path)) {
    echo "Upload and move success";
}		

isset($_POST["mim"]) ? $mim = $_POST["mim"] : $mim = '';
isset($_POST["sid"]) ? $sid = $_POST["sid"] : $sid = '';
$sql = "insert into tb_review(imgre,member_id,cycling_id) values('$new_images',$mim,$sid)";
$Query = mysql_query($sql);

if ($Query) {
    echo "Upload success";
} else {
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}
?>