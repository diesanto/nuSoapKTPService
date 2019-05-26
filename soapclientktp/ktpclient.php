<?php
	require_once('./lib/nusoap.php');
	$client = new nusoap_client('http://localhost/webservis/soapserverktp/ktpserver.php');

	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	}
	
?>
<title>Form NuSOAP</title>
	<form action="ktpclient.php" method="POST">
		Ketik Sebuah Nama : <input type="text" name="teks" width="50px">
		<input type="submit" value="Kirim">
	</form>

<?php	
	if(!empty($_POST['teks']))
		$param = $_POST['teks'];
	else
		$param = '';
	
	$result = $client->call('kontak', array($param));

	if (!empty($result)) {
		echo '<a href="ktpclient_add.php">Tambah Penduduk</a>';
		echo '<title>NuSOAP dengan Database</title>';
		echo '<table border=1>';
		echo '<tr bgcolor="#cccccc">';
		echo '<th>Nim</th>';
		echo '<th>Nama</th>';
		echo '<th>Alamat</th>';
		echo '<th>Telpon</th>';
		echo '<th colspan="2">Pilihan</th>';
		echo '</tr>';
		foreach ($result as $item) {
			echo '<tr>';
			echo '<td>'.$item['nik'].'</td>';
			echo '<td>'.$item['nama'].'</td>';
			echo '<td>'.$item['alamat'].'</td>';
			echo '<td>'.$item['telepon'].'</td>';
			echo '<td><a href="ktpclient_edit.php?nik='.$item['nik'].'">Edit</a></td>
			<td><a href="ktpclient_del.php?nik='.$item['nik'].'">Hapus</a></td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	
	echo '<h2>Request</h2>';
	echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
	echo '<h2>Response</h2>';
	echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
?>
