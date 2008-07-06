<?php
  # Handles logging in and registering... then sends 'em to the index page

  $features=array('database','theme','security');
  require "main.inc";

  $_GET['page']
    or $_GET['page'] = 'login';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title><?= $cameralife->GetPref('sitename') ?></title>
  <?php if($cameralife->Theme->cssURL()) {
    echo '  <link rel="stylesheet" href="'.$cameralife->Theme->cssURL()."\">\n";
  } ?>
  <?php if($location){echo "<meta http-equiv='refresh' content='1;url=$location'>";} ?>
  <meta http-equiv="Content-Type" content="text/html; charset= ISO-8859-1">
</head>
<body>
<form method="post" action="login_controller.php">

<?php
  $menu = array();
  $menu[] = $cameralife->GetSmallIcon();
  $menu[] = array("name"=>"Powered by Camera Life",
                  "href"=>"http://fdcl.sourceforge.net");

  $cameralife->Theme->TitleBar("Login / Register",
                                'login',
                                FALSE,
                                $menu);

  $sections[] = array('name'=>'Login',
                      'page_name'=>'login',
                      'image'=>'small-login');
  $sections[] = array('name'=>'Register',
                      'page_name'=>'register',
                      'image'=>'small-login');

  $cameralife->Theme->MultiSection($sections);

?>
<table>
  <tr><td>Username:<td><input type="text" name="param1" value="<?= $_POST["username"]?>">
  <tr><td>Password:<td><input type="password" name="param2" value="">
<?php
  if ($_GET['page'] == 'register')
    echo '<tr><td>E-Mail (optional):<td><input type="text" name="param3" value="'.$_POST["email"].'">';
?>
</table>

<input type="hidden" name="target" value="<?= $cameralife->base_url.'/index.php' ?>">
<input type="submit" name="action" value="<?= ucwords($_GET['page']) ?>">

</form>
</body>
</html>

