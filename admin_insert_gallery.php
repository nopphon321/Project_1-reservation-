

<?php 
require 'mysql/config.php';
$rmtype=$_POST['rmtype'];


//อัพโหลด 
if(isset($_POST['submit'])){
$file = $_FILES['image'];

$filename = $_FILES['image']['name'];
$filetmpname = $_FILES['image']['tmp_name'];
$filesize = $_FILES['image']['size'];
$fileerror = $_FILES['image']['error'];
$filetype = $_FILES['image']['type'];

$fileext = explode('.' , $filename);
$fileactualext = strtolower(end($fileext));

$allowed = array('jpg', 'jpeg' , 'png' , 'pdf');

if(in_array($fileactualext, $allowed)){
  if($fileerror == 0){
    if($filesize < 1000000){
      $filenamenew = uniqid('', true).".".$fileactualext;
        $filedestination = 'img/' .$filenamenew;
        move_uploaded_file($filetmpname, $filedestination);
        
          
$sql = "INSERT INTO gallery (rmtype, src_image ) 
VALUE ('$rmtype', '$filenamenew') ";
 $last_insert =mysqli_query($conn, $sql) or die(mysqli_error($conn));
 if($last_insert){
   $pay_id=mysqli_insert_id($conn); 

   $v1=1;
  }else{    
    echo "<script language=\"JavaScript\">";
    echo "alert('บันทึกข้อมูลไม่ได้ครับ');";
    echo "location='admin_gallery.php' ";
    echo "</script>";
  }
  
      }else{
        echo "<script language=\"JavaScript\">";
        echo "alert('ขนาดไฟล์ ใหญ่เกินไป !');";
        echo "location='admin_gallery.php' ";
        echo "</script>";
  
    
      }
  }else{
    echo "<script language=\"JavaScript\">";
    echo "alert('การอัพโหลดผิดพลาด โปรดลองใหม่ !');";
    echo "location='admin_gallery.php' ";
    echo "</script>";
}}} 


?>

 <script>
var v1=<?php echo $v1;?>;
var vurl="admin_gallery.php";
if(v1==1){
 alert("ดำเนินการเสร็จสิ้น");
}else{
 alert("ดำเนินการผิดพลาด");
}
window.location.replace(vurl);
</script>
