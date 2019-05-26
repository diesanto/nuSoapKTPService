<?php

function kontak($param = null) 
{
	require_once('connect.php');

	$query  = "SELECT * FROM penduduk WHERE nama 
	LIKE '%".$param."%'";
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
//print_r(kontak());
//exit;
echo json_encode(kontak());
?>