<html>
<head>
<title>Administrator CMS IPLT-PPLP</title>
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
    alert("Anda belum mengisi Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisi Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body OnLoad="document.login.username.focus();">
<div id="header">
  <div id="content">
		<h2>LOGIN ADMINISTRATOR</h2>
        <img src="images/kabarinyong.jpg" width="130px"  hspace="10" align="left">
<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
<table>
<tr><td>Username</td><td> : <input type="text" name="username"></td></tr>
<tr><td>Password</td><td> : <input type="password" name="password"></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Login"></center></td></tr>
</table>
</form>
<p>&nbsp;</p>
  </div>
	<div id="footer">Copyright &copy; 2012 by IPLT - PPLP. All rights reserved.</div>
</div>
</body>
</html>
