<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Kondite extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function upload_kondite()
	{
		$tahun = $this->input->post('tahun');
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './upload/'; //buat folder dengan nama assets di root folder
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file'))
			$this->upload->display_errors();

		$media = $this->upload->data('file');
		$inputFileName = './upload/' . $media['file_name'];
		$total = '';

		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		//hapus data dengan bulan dan tahun yang sama
		//$del = $this->db->query("delete from t_kondite where  tahun='$tahun'");

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);
			$noinduk		= $rowData[0][0];
			$karu 			= $rowData[0][5];
			$keterangan 	= $rowData[0][6];
			$kondite 		= $rowData[0][7];
			$stat 			= $rowData[0][4];

			if ($karu == '') {
				$karu = 'X';
			} else {
				$karu = $karu;
			}
			$seksi = $this->db->query("select a.nama,a.pabrik,b.nama as seksi from t_karyawan a
											left join t_seksi b on b.kode=a.seksi
											where a.noinduk='$noinduk'")->result_array();
			$nmseksi	= $seksi[0]['seksi'];
			$nama 		= $seksi[0]['nama'];
			$pabrik 	= $seksi[0]['pabrik'];

			$cek = $this->db->query("select * from t_kondite where noinduk = '$noinduk' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				if ($stat == "T") {
					$sql = "insert into t_kondite(noinduk,tahun,pabrik,seksi,nama,status,karu,keterangan,kondite)values('$noinduk','$tahun','$pabrik','$nmseksi','$nama','$stat','$karu','$keterangan','$kondite')";
					$insert = $this->db->query($sql);
				}
			} else {
				if ($stat == "T") {
					$sql = "update t_kondite set noinduk  ='$noinduk',
												 tahun	  = '$tahun',
												 pabrik	  = '$pabrik',
												 seksi    = '$nmseksi',
												 nama     = '$nama',
												 status   = '$stat',
												 karu     = '$karu',
												 keterangan = '$keterangan',
												 kondite   = '$kondite'
												 where noinduk = '$noinduk' and tahun='$tahun'";
					$update = $this->db->query($sql);
				}
			}
			delete_files($media['file_path']);
		}
	}

	function proses_deviasi()
	{
		$tahun = $this->input->post('tahun');
		$sql = "select * from t_kondite where tahun='$tahun' group by pabrik,seksi,karu,status order by seksi  ";

		//mencari kelompok per group pabrik,seksi,karu,status
		$dtsql = $this->db->query($sql)->result_array();
		foreach ($dtsql as $d) {
			//hapus table bantu t_a_kondite
			$this->db->query("truncate t_b_kondite");

			$pabrik 	= $d['pabrik'];
			$seksi 		= $d['seksi'];
			$karu 		= $d['karu'];
			$status 	= $d['status'];


			//mencari data berdasarkan pabrik,seksi,karu,status
			$kelompok = $this->db->query("select * from t_kondite where pabrik = '$pabrik' and seksi = '$seksi' and karu = '$karu' and status='$status' and tahun='$tahun'")->result_array();
			foreach ($kelompok as $b) {
				$noinduk 	= $b['noinduk'];
				$kondite 	= $b['kondite'];
				//masukkan ke table bantu t_b_kondite
				$this->db->query("insert into t_b_kondite(noinduk,kondite)values('$noinduk','$kondite')");
			}
			//hapus table sementara t_b_deviasi
			$this->db->query("truncate t_b_deviasi");

			//hitung deviasi
			$this->hitung_deviasi();

			//mendapatkan nila deviasi(A,B,C,D)
			$dev = $this->db->query("select * from t_b_deviasi order by kode desc")->result_array();
			$A = $dev[0]['param'];
			$B = $dev[1]['param'];
			$C = $dev[2]['param'];
			$D = $dev[3]['param'];

			foreach ($kelompok as $x) {
				$noinduk 	= $x['noinduk'];
				$kondite 	= $b['kondite'];
				if ($kondite >= $A) {
					$nilai = "A";
				} else if (($kondite >= $B) and ($kondite < $A)) {
					$nilai = "B";
				} else if (($kondite >= $C) and ($kondite < $B)) {
					$nilai = "C";
				} else if (($kondite >= $D) and ($kondite < $C)) {
					$nilai = "D";
				} else {
					$nilai = "E";
				}

				$this->db->query("insert into t_deviasi(noinduk,tahun,deviasi)values('$noinduk','$tahun','$nilai')");
			}
			$pesan['text'] = "Berhasil di masukkan";
		}
		echo json_encode($pesan);
	}

	function ambil_kondite()
	{
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->data_kondite($tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		//echo json_encode($data);
		$this->load->view('upah/kondite/view_kondite', $data);
	}

	function ambil_deviasi()
	{
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->data_deviasi($tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		//echo json_encode($data);
		$this->load->view('upah/kondite/view_deviasi', $data);
	}

	function hitung_deviasi()
	{
		$kon = $this->db->query('select avg(kondite) as avkon from t_b_kondite')->result_array();
		$avkondite = $kon[0]['avkon'];

		$arr = array();
		$arkon = $this->db->query("select kondite from t_b_kondite")->result_array();
		foreach ($arkon as $c) {
			$arr1 = $c['kondite'];
			array_push($arr, $arr1);
		}
		$avdev = $this->Stand_Deviation($arr);

		$k5	= $avkondite + (0.4 * $avdev) + (0.8 * $avdev) + 0.01;
		$k4	= $avkondite + (0.4 * $avdev) + 0.01;
		$k3	= $avkondite - (0.4 * $avdev);
		$k2	= ($avkondite - (0.4 * $avdev)) - (0.4 * $avdev);

		$sql1 = "insert into t_b_deviasi(kode,param)values('K5','$k5')";
		$sql2 = "insert into t_b_deviasi(kode,param)values('K4','$k4')";
		$sql3 = "insert into t_b_deviasi(kode,param)values('K3','$k3')";
		$sql4 = "insert into t_b_deviasi(kode,param)values('K2','$k2')";
		$this->db->query($sql1);
		$this->db->query($sql2);
		$this->db->query($sql3);
		$this->db->query($sql4);
	}

	function Stand_Deviation($arr)
	{
		$num_of_elements = count($arr);

		$variance = 0.0;

		// calculating mean using array_sum() method 
		$average = array_sum($arr) / $num_of_elements;

		foreach ($arr as $i) {
			// sum of squares of differences between 
			// all numbers and means. 
			$variance += pow(($i - $average), 2);
		}

		return (float)sqrt($variance / $num_of_elements);
	}

	function ambiliddev()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$tahun = $pecah[1];
		$deviasi = $pecah[2];
		//$data = $this->db->query("select * from t_deviasi where noinduk='$noinduk' and tahun='$tahun'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		$data = array(
			'noinduk' 	=> $noinduk,
			'tahun'   	=> $tahun,
			'deviasi'	=> $deviasi
		);
		echo json_encode($data);
	}

	function update_deviasi()
	{
		$noinduk 	= $this->input->post('noinduk');
		$tahun 		= $this->input->post('tahun');
		$deviasi 	= strtoupper($this->input->post('deviasi'));

		$update = $this->db->query("update t_deviasi set deviasi ='$deviasi' where noinduk='$noinduk' and tahun='$tahun'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}
}/* End of file kondite.php */
