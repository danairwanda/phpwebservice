<?php 
	require 'ws_client.php';

	// call list propinsi WSC function
	$ws_data = call_ws_list_propinsi('',0,100);

	$n = $ws_data ['data_count'];
	$prop_data = $ws_data ['data'];
 ?>

<table border="1">
	<caption>Daftar Jumlah Penduduk Propinsi di Indonesia</caption>
		<tr>
			<th>ID</th>
			<th>KODE</th>
			<th>NAMA</th>
			<th>IBUKOTA</th>
			<th>JML PRIA</th>
			<th>JML WANITA</th>
			<th>JML PENDUDUK</th>
			<th>WEBSITE</th>
			<th>LATITUDE</th>
			<th>LONGITUDE</th>
		</tr>
	<tbody>
	<?php
		for($i = 0; $i < $n; $i ++) {
		$jml = ($prop_data [$i] ['prop_jml_penduduk_pria'] + $prop_data [$i]
		['prop_jml_penduduk_pria']);
	?>
	<tr>
		<td><?php echo $prop_data [$i] ['prop_id']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_kode']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_nama']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_ibukota']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_jml_penduduk_pria']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_jml_penduduk_wanita']; ?></td>
		<td><?php echo $jml; ?></td>
		<td><?php echo $prop_data [$i] ['prop_website']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_map_latitude']; ?></td>
		<td><?php echo $prop_data [$i] ['prop_map_longitude']; ?></td>
	</tr>
	<?php 
	}
	?>
	</tbody>
	</table>