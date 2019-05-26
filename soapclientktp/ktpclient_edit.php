<?php
	require_once('./lib/nusoap.php');
	$client = new nusoap_client('http://localhost/webservis/soapserverktp/ktpserver.php');

	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	}

if (!empty($_GET['nik'])){	
	$result = $client->call('cariNik',array($_GET['nik']));
}
?>

	<title>Form Edit NuSOAP</title>
	<h2>Edit Data</h2>
	<form action='ktpclient_edit.php' method='post'>
		<input type='hidden' name='edit' value='edit'>
		<table>
		<tr><td>NIM : </td><td><input type='text' name='nim' value='<?php echo $result['nik']; ?>' width='50px'></td></tr>
		<tr><td>Nama Lengkap : </td><td><input type='text' name='nama' value='<?php echo $result['nama']; ?>' width='50px'></td></tr>
		<tr><td>Alamat : </td><td><input type='text' name='alamat' value='<?php echo $result['alamat']; ?>' width='50px'></td></tr>
		<tr><td>Telpon : </td><td><input type='text' name='telpon' value='<?php echo $result['telepon']; ?>' width='50px'></td></tr>
		
		<tr><td></td><td><input type='submit' value='Kirim'></td></tr>
		</table>
	</form>
<?php

	if(!empty($_POST['nama']))
		$nama = $_POST['nama'];
	else
		$nama = "";
	
	if(!empty($_POST['nim']))
		$nim = $_POST['nim'];
	else
		$nim = "";
	
	if(!empty($_POST['alamat']))
		$alamat = $_POST['alamat'];
	else
		$alamat = "";
	
	if(!empty($_POST['telpon']))
		$telpon = $_POST['telpon'];
	else
		$telpon = "";
		
	if(isset($_POST['edit']))
	{
		if($nama<>'' && $alamat<>'' && $telpon<>'' && $nim<>'')
		{
			if ($result = $client->call('update', array($nim, $nama, $alamat, $telpon))){
				header('Location: ktpclient.php');
				exit;
			}
		}	
	}	
	
	
	echo '<h2>Request</h2>';
	echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
	echo '<h2>Response</h2>';
	echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
?>
