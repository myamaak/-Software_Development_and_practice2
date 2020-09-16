<?php
   include"session.php";

?>
<html>

   <head>
      <title> Welcome </title>
      <h1>Welcome <?=$_SESSION['login_user']?></h1>

      <h2>user documents list</h2>
      <?php
      //all document of every user
      //document, fdate, userid, useremail
      //link to user document
      $newdb = new mysqli('localhost', 'root', '', 'proj');
      if ($newdb->connect_error) {
        die("Connection failed: " . $newdb->connect_error);
      }

      $doclist = mysqli_query($newdb, "SELECT contents, doctitle, userID, Fdate, email FROM userdocument");


      if ($doclist->num_rows > 0) {
        // output data of each row
        while($doc = $doclist->fetch_assoc()) {
        echo ($doc['doctitle']."|| ". $doc['contents'] ."|| ". $doc['userID'] ."|| ". $doc['Fdate'] ."|| ". $doc['email']."<br/>"."<br/>");
      }
    } else {
      echo "0 results"."</br>";
    }

    $pquery = $db->query("SELECT * FROM picture");
    echo<<<HTML
    <h2>Gallery</h2>
HTML;


    if($pquery->num_rows > 0){
        while($pprow = $pquery->fetch_assoc()){
            $imageURL = 'dir/'.$pprow["pname"];
            $userID = $pprow["userID"];
            $pinfo = $pprow["pinfo"];
            $pname = $pprow["pname"];
            $pdate = $pprow["pdate"];
            ?>
          </hr>
        </br>
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
                  <td><?=$pdate ?></td>
                  <td><img src="<?php echo $imageURL; ?>" alt="" width="300" /></td>
                </tr>
              </table>
            </form>
          <?php
          }
        }
          ?>

         <a href="document.php"> <button type="button"> modify documents </button> </a>
         <a href="picture.php"> <button type="button"> modify image info </button> </a>


      <h3><a href = "logout.php">Sign Out</a></h3>
      <?php
      	if (time() > $_SESSION['expire']) {
            echo "Your session has expired!";
            session_destroy();
               header("Location:login.php");
            }


      ?>


   </body>

</html>
