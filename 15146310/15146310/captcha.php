<?php
$code=rand(1000,9999);
setcookie("val",$code);
 ?>

<html>
<head>
<title>captchaaaaa</title>
</head>
<body>
<?php


$im = imagecreatetruecolor(50, 24);
$bg = imagecolorallocate($im, 22, 86, 165); //background color blue
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");

ob_start();
imagepng($im);
$png = ob_get_clean();
$uri = "data:image/png;base64," . base64_encode($png);
imagedestroy($im);

echo<<<HTML
<form action="" method="post">
Enter the number displayed in the image below</br>
<input type="text" name="captcha" id="captcha"><br>
<img src=$uri /><br>
<input type="submit"  name="validate" value="validate" id="validate">
</form>
HTML;


if(isset($_POST["validate"])&&isset($_POST["captcha"])&&$_COOKIE["val"]==$_POST["captcha"])
{
echo "<script> alert('validate success!'); </script>";
}
else if(isset($_POST["validate"])&&isset($_POST["captcha"])&&$_COOKIE["val"]!=$_POST["captcha"])
{
die("Wrong Code Entered");

}


?>



</body>
</html>
