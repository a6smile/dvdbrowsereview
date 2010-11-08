<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
<title></title>
<link rel='stylesheet' href='admin-design/login.css' />
<?php runTweak('login-head'); ?>
</head>
<body>
<div id="wrapper">
<div id="thelogin">
<table border="0" width="250">
<form action='?' method='post' accept-charset='utf-8'>
<tr><td><?php _lt('Admin Login'); ?></td></tr>
<tr><td><?php _lt('Username'); ?></td><td><input type='text' name='user'></td><tr><td><?php _lt('Password'); ?></td><td><input type='password' name='pass'></td></tr><tr><td></td><td align="right"><input type='submit' value='<?php _lt('Login'); ?>'></td></tr></form>
</table>
</div>
</div>
<?php runTweak('login-footer'); ?>
</body>
</html>