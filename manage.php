<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
#container{
	background: white;
}
	  #paneladdauto{
	  	display: none;
	  	background: #E5E5E5;
	  	width: 40%;
	  	right: 15%;
	  	top:0px;
	  	position:absolute;
	  }
	  #panelfindauto{
	  	display: none;
	  	background: #E5E5E5;
	  	width: 40%;
	  	right: 15%;
	  	top:0px;
	  	position:absolute;
	  }
	</style>
	<script type="text/javascript">
		function show(id){
		document.getElementById("paneladdauto").style.display="none";
		document.getElementById("panelfindauto").style.display="none";
		var divObject=document.getElementById(id);
		divObject.style.display="block";
		}
		function hide(id){
		var divObject=document.getElementById(id);
		divObject.style.display="none";
		}
	</script>
</head>
<body>

<?php 
include "dbconnection.php";
include "RestClient.php";
session_start();
if(!empty($_SESSION['name'])) {
echo "Hoşgeldiniz ".$_SESSION['name']."<br>"; 
?>
		<div id="container">
			<div id="menu">
				<a name="addauto" onclick='javascript:show("paneladdauto")'>Araç Ekle</a></br>
				<a name="findauto" onclick='javascript:show("panelfindauto")'>Araç Ara</a></br>
				<a href="index.html">Ana Sayfaya Dön</a>
			</div>
			<div id="paneladdauto">
			<p>Araç Ekle</p><br>
			<form action="" method="post">
  <table width="39%" border="0">
    <tr>
      <td width="15%">Araç Plaka</td>
      <td width="5%">:</td>
      <td width="80%">
      <input type="text" name="plate" id="plate" /></td>
    </tr>
    <tr>
      <td>Nereden</td>
      <td>:</td>
      <td>
      <input type="text" name="departure" id="departure" /></td>
    </tr>
    <tr>
      <td>Nereye</td>
      <td>:</td>
      <td>
        <input type="text" name="destination" id="destination"></td>
    </tr>
    <tr>
      <td>Yük</td>
      <td>:</td>
      <td>
      <input type="text" name="carry" id="carry"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="ekle" id="ekle" value="Ekle" /></td>
      <td><input type="reset" name="temizle" id="temizle" value="Temizle" /></td>
    </tr>
  </table>
</form>
<a onclick='javascript:hide("paneladdauto")'>Gizle</a>
<?php 
if(isset($_POST['ekle'])){
	$plate=$_POST["plate"];
	$departure=$_POST["departure"];
	$destination=$_POST["destination"];
	$carry=$_POST["carry"];
	if(empty($plate)||empty($departure)||empty($destination)||empty($carry)){
		echo "<script> alert('Tüm alanların doldurulması gerekmektedir.'); </script>";
	}else{
		 $url ="http://localhost:8080/auto/add";
		$params = array(
			'plate'=> $_POST["plate"],
			'departurePoint'=> $_POST["departure"],
			'destinationPoint'=> $_POST["destination"],
			'carry'=> $_POST["carry"],
			);
		  $json = json_encode($params, 1);
          $result = RestClient::post($url, $json, null, null, 'application/json');
}
}
?>
			</div>
			<div id="panelfindauto">
			<p>Araç Bul</p><br>
			<form action="" method="post" name="findAuto">
				<table width="39%" border="0">
  					<tr>
    					<td width="14%">Plaka</td>
    					<td width="9%">:</td>
    					<td width="77%">
      					<input type="text" name = "findAutoByPlate">
  						</td>
  					</tr>
  					<tr>
    					<td colspan="3"><input type="submit" name="bul" id="bul" value="Bul" /></td>
    				</tr>
				</table>
				</form>
				<a onclick='javascript:hide("panelfindauto")'>Gizle</a>
				<?php 
					if(isset($_POST['bul'])){
					$searchingPlate=$_POST["findAutoByPlate"];
					if(empty($searchingPlate)){
						echo "<script> alert('Plaka boş geçilemez.'); </script>";
					}else{
						$url ="http://localhost:8080/auto/find";
						$params = array(
							'plate'=> $_POST["findAutoByPlate"],
							);
						$json = json_encode($params, 1);
				        $result = RestClient::post($url, $json, null, null, 'application/json');
						print_r($result);
						$data=json_decode($result);
						print_r($data);
						$response=$data=>[response:RestClient:private] ;
						print_r($response);
						/*?><table border="1" > <?php
							foreach ($data->response as $row) { ?>
							   <tr>
            						<td><?php echo $row->plate?></td>
            						<td><?php echo $row->departurePoint?></td>
            						<td><?php echo $row->destinationPoint?></td>
            						<td><?php echo $row->carry?></td>
       						 	</tr><?php
							}?>
							</table><?php*/
						}
				}
				?>
			</div>
					<div id="logout">
				<form name="form1" action="" method="post">
				<input type="submit" Value="Çıkış" name="cikis" />
				</form>
			</div>
	<?php 
	if(isset($_POST['cikis'])){
		session_destroy();
		header("Location:admin.php");
	}
	}else{echo "Yetkisiz erişim!Lütfen oturum açarak tekrar deneyiniz!"; } ?>

</body>
</html>