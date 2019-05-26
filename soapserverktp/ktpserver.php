<?php
	require_once('./lib/nusoap.php');	

	$server = new nusoap_server();

	$server->register('kontak');
	$server->register('cariNik');
	$server->register('tambah');
	$server->register('update');

	function kontak($param = null) {
		require_once('connect.php');
				
		$query  = "SELECT * FROM penduduk WHERE nama LIKE '%".$param."%'";
		if ($result = $mysqli->query($query)){
			$data = array();
			while ($row = $result->fetch_object())
		    {
		    	$data[] = array(
							'nik'	  => $row->nik,
							'nama'	  => $row->nama,
							'alamat'  => $row->alamat,
							'telepon' => $row->telepon
							);
		    }
		    $result->close();
		}	
		$mysqli->close();

		return $data;
	}	

	function cariNik($nik) 
	{
		require_once('connect.php');		
		$query  = "select * from penduduk where nik ='".$nik."'";
		if ($result = $mysqli->query($query)){
			$data = array();
			$row  = $result->fetch_object();
	    	$data = array(
						'nik'	  => $row->nik,
						'nama'	  => $row->nama,
						'alamat'  => $row->alamat,
						'telepon' => $row->telepon
						);
	    
		    $result->close();
		}	
		$mysqli->close();
		return $data;
	}

	function tambah($nik,$nama,$alamat,$telepon) 
	{
		
		require_once('connect.php');
		$data = FALSE;
		$query  = "INSERT INTO penduduk (nik,nama,alamat,telepon) VALUES ('$nik', '$nama', '$alamat', '$telepon')";
		if ($result = $mysqli->query($query)){
			$data = TRUE;
		}
		return $data;
	}
	
	function update($nik,$nama,$alamat,$telepon) 
	{		
		require_once('connect.php');
		$data = FALSE;
		$query  = "UPDATE penduduk SET nama = '$nama',alamat = '$alamat', telepon = '$telepon' WHERE nik ='$nik'";
		if ($result = $mysqli->query($query)){
			$data = TRUE;
		}
		return $data;
	}

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : 'Gagal';
	
	$server->service($HTTP_RAW_POST_DATA);

?>
