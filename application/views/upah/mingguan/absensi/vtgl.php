<?php 
	$periode_akhir = date('Y-m-d', strtotime('+13 days', strtotime($tgl_awal)));
	echo $periode_akhir;
 ?>
