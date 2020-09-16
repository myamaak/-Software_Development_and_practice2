<?php
include"session.php";
// Include the database configuration file
 $db = new mysqli('localhost', 'root', '', 'proj');
 if ($db->connect_error) {
   die("Connection failed: " . $db->connect_error);
 }
 $user=$_SESSION['login_user'];
 $statusMsg ='';
 $uploadOk = 1;

 ?>

<html>
<head>
<title>image management</title>
</head>
<body>

<form action="picture.php" enctype="multipart/form-data" method="post">
Select image :<input type="file" name="file" id="file"><br/>
<input type="text" name="userID" value=<?=$user?> id="userID"><br/>
<input type="text" name="pinfo" id="pinfo"><br/>
<input type="submit" value="Upload" name="upload"> <br/>
</form>

<?php

$day = date('Y-m-d');

if(isset($_POST["upload"]) && !empty($_FILES["file"]["name"])){
  $image_dir= 'dir/';
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $image_dir . $fileName;
  $where = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

  if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  if ($_FILES["file"]["error"] > 0)
   {
   echo "Error: " . $_FILES["file"]["error"] . "<br>";
   }
   // Allow certain file formats
   $allowTypes = array('jpg','png','jpeg','gif','pdf');
   if(in_array($fileType, $allowTypes)){
     if($where)
      {
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . "<br>";
        echo "Stored in: " .$targetFilePath."<br>";
        echo "<img src=".$targetFilePath." width=300/>"."<br>";
        $info=$_POST['pinfo'];
        $insert = $db->query("INSERT INTO picture(userID, pname, pdir,
          pinfo, pdate) VALUES ('$user', '$fileName', 'dir\\.$fileName', '$info',
          '$day')");
          if($insert){
            $statusMsg = "The file ".$fileName. " has been uploaded successfully."."<br>"."<br>"."<br>";
          }if (!$insert){
            $statusMsg = "update failed:".$insert."</br>".$db->error."File upload failed, please try again.";
           }
       }else{
           echo $where;
           $statusMsg = "Sorry, there was an error uploading your file.";
       }
   }else{
       $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
   }

}else{
     $statusMsg = 'Please select a file to upload.'."</br>"."</br>"."<br>"."<br>";
 }

// Display status message
echo $statusMsg;

$pquery = $db->query("SELECT * FROM picture");

if($pquery->num_rows > 0){
    while($pprow = $pquery->fetch_assoc()){
        $imageURL = 'dir/'.$pprow["pname"];
        $userID = $pprow["userID"];
        $pinfo = $pprow["pinfo"];
        $pname = $pprow["pname"];
        $pdate = $pprow["pdate"];
        $id=$pprow["pn"];
?>
  <form action="picture.php" method="get">
    <table>
      <tr>
        <td>UserID:</td>
        <td><?=$userID?></td>
      </tr>
      <tr>
        <td>Picture information:</td>
        <td><?=$pinfo?></td>
      </tr>
      <tr>
        <td>picture name :</td>
        <td><?=$pname ?></td>
      </tr>
      <tr>
        <td>saved at : <br> <?=$pdate ?></td>
        <td><img src="<?php echo $imageURL; ?>" alt="" width="300" /></td>
      </tr>
    </table>
    <input type="hidden" value="<?=$id?>" name="num">
    <input type="submit" value="delete" name="delete">
    <input type="submit" value="modify" name="modify">
  </form>
<?php
}}else{
  ?>
    <p>No image(s) found...</p>
<?php
}

if (isset($_GET["delete"])&&isset($_GET["num"]))
{
  $del=$_GET["num"];
  $deq = "DELETE FROM picture WHERE pn='$del'";
  $dere = $db->query($deq);
  header("location: picture.php");
  if (!$dere) echo " DELETE failed: $deq<br>" .$db->error . "<br><br>";
}

if (isset($_GET["modify"])&&isset($_GET["num"]))
{
  $mod=$_GET["num"];
  $mq = $db->query("SELECT pinfo FROM picture WHERE pn='$mod'");
  $mrow = $mq->fetch_assoc();
  $modinfo = $mrow["pinfo"];
  echo<<<HTML
  <form action="picture.php" method="get">
  <input type="text" placeholder="$modinfo" id="minfo" name="minfo" width="800">
  <input type="hidden" value="$mod" id="m" name="m">
  <input type="submit" value="done" name="done">
</form>
HTML;
}
////////dkkdkkdkkddk아아아아 수정만 하면 되는데ㅠㅠㅠ
  if(isset($_GET["done"])&&isset($_GET["minfo"])){

    $ndb = new mysqli('localhost', 'root', '', 'proj');
    if ($ndb->connect_error) {
      die("Connection failed: " . $ndb->connect_error);
    }

    $info_after = $ndb->real_escape_string($_GET['minfo']);
    $m_after = $ndb->real_escape_string($_GET['m']);
    echo $info_after;
    $modq = "UPDATE picture SET pinfo='$info_after' WHERE pn='$m_after'";
    $modre = $ndb->query($modq);
    header("location: picture.php");
    if (!$modre) echo " UPDATE failed: $modre<br>" .$ndb->error . "<br><br>";
  }

 ?>



</body>
</html>
