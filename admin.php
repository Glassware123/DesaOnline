<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Başlıksız Belge</title>
<style>
h1{
	color:#900;
	}
	.buton{
    background:#d21b00;
    background: -moz-linear-gradient(top, #d21b00, #8e0700);
    background: -webkit-gradient(linear, left top, left bottom, from(#d21b00), to(#8e0700));
    padding:5px 8px;
    text-decoration:none;
    color:#fff;
    font:bold 20px Arial, Helvetica, sans-serif;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.75);

    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.75);
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.75);
}
.buton:hover{
    background: -moz-linear-gradient(top, #8e0700, #d21b00);
    background: -webkit-gradient(linear, left top, left bottom, from(#8e0700), to(#d21b00));
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.75);
    box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.75);
    -webkit-box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.75);
}
input.text{
	-moz-border-radius: 7px;
    -webkit-border-radius: 7px;
	border-radius=7px;
	}
	input.text:hover{
		background-color:#0FF;
	}
		input.text:focus{
		background-color:#0FF;
	}
</style>
</head>
<body>
<?php
include "dbconnection.php";
    session_start();
      if(!empty($_SESSION['name'])){
     header("Location:manage.php");
} else{ ?>
 <div id="login">
<form name="form1" method="post" action="admin.php">
<table width="27%" border="0" align="center">
  <tr>
    <td align="center" colspan="2"><h1>DESA Kurumsal Yönetim Sistemine Hoşgeldiniz!</br>Lütfen Giriş Yapınız!</h1></td>
    </tr>
  <tr>
    <td width="47%">Kullanıcı Adı</td>
    <td width="53%"><label for="name"></label>
      <input class="text" type="text" name="name" id="name" /></td>
  </tr>
  <tr>
    <td>Şifre</td>
    <td><label for="pass"></label>
      <input class="text" type="password" name="pass" id="pass" /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><p>&nbsp;</p>
      <p><input type="submit" class="buton" value="Giriş" name="giris" />
      </p><?php
if(!empty($_GET['hata'])){
      $hata=$_GET['hata'];
        echo $hata;
      }
       ?>
      </td>
    </tr>
</table>
</form>
</div>
<?php if(isset($_POST['giris'])){
    $name=$_POST['name'];
    $pass=$_POST['pass'];
    $query=mysql_query("SELECT * FROM users WHERE USERNAME='". $name."' and PASSWORD='".$pass."'");
  if(mysql_num_rows($query)>0){
    echo "sorgu çalıştı"."<br>";
    session_start();
    $_SESSION['name']=$name;
    header("Location:manage.php");
    }else{
      header("Location:admin.php?hata=Hatalı Giriş!");
      }
    }
  }
 ?>
</div>
</body>
</html>