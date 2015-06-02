<?php
$conn=mysql_connect("localhost","root","1") or die ("Veritabanı bağlantı hatası!!!".mysql_error());
$db=mysql_select_db("desa",$conn);
mysql_query("SET NAMES utf8");
header("Content-Type: text/html; charset='utf-8'");  
?>