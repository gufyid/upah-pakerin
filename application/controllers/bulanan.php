<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Bulanan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function ambil_absen_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_absen_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
			'bulan' => $bulan
		);
		//echo json_encode($data);
		$this->load->view('upah/bulanan/absensi/view', $data);
	}

	function ambil_lt_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_lt_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/bulanan/lt/view', $data);
	}

	function ambil_gaji_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_gaji_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/bulanan/proses/view', $data);
	}

	function jumlah_absen_bulanan()
	{

		$data = $this->mymodel->jumlah_absen_bulanan('t_absen_bulanan')->num_rows();
		echo json_encode($data);
	}

	function ambil_premi_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_premi_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/bulanan/premi/view', $data);
	}


	function ambil_koperasi_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$hasil = $this->mymodel->jumlah_koperasi_bulanan($bulan, $tahun)->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/bulanan/koperasi/view', $data);
	}

	function ambilidabsen()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$bulan = $pecah[1];
		$tahun = $pecah[2];
		$data = $this->db->query("select * from t_absen_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambil_rekap_upah_bulanan()
	{
		$bulan 	= $this->input->post('bulan');
		$tahun 	= $this->input->post('tahun');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		$hasil = $this->db->query("select * from t_rekap_upah_bulanan where  bulan='$bulan' and tahun='$tahun' and status='$status'")->result_array();

		$data = array(
			'data' 		=> $hasil,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'status' 	=> $status,
			'pabrik' 	=> $pabrik
		);

		$this->load->view('upah/bulanan/laporan/view/view_rekap_upah_bulanan', $data);

		/*if($status == "T" && $hasil)
		{
			$this->load->view('upah/bulanan/laporan/tetap/view/view_rekap_upah_bulanan',$data);
		}else if($status == "K" && $hasil){
			$this->load->view('upah/bulanan/laporan/kontrak/view/view_rekap_upah_bulanan',$data);
		}else if($status == "H" && $hasil){
			$this->load->view('upah/bulanan/laporan/honor/view/view_rekap_upah_bulanan',$data);
		}*/
	}

	function print_rekap_upah_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');

		$hasil = $this->db->query("select * from t_rekap_upah_bulanan where  bulan='$bulan' and tahun='$tahun' and status='$status'")->result_array();

		$data = array(
			'data' => $hasil,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'status' => $status
		);
		echo json_encode($hasil);
		//$this->load->view('upah/bulanan/laporan/cetak/print_rekap_upah_bulanan',$data);

	}

	function ambil_rekap_lembur_bulanan()
	{
		$bulan 	= $this->input->post('bulan');
		$tahun 	= $this->input->post('tahun');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		$hasil = $this->db->query("select * from t_rekap_lembur_bulanan where  bulan='$bulan' and tahun='$tahun' and status='$status'")->result_array();
		$data = array(
			'data' 		=> $hasil,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'status' 	=> $status,
			'pabrik' 	=> $pabrik
		);


		$this->load->view('upah/bulanan/laporan/view/view_rekap_lembur', $data);
	}

	function ambil_rekap_spl_bulanan()
	{
		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');
		$status 	= $this->input->post('status');
		$seksi 		= $this->input->post('seksi');
		$proyek 	= $this->input->post('proyek');
		$susulan 	= $this->input->post('susulan');
		$pabrik 	= $this->input->post('pabrik');

		$hasil = $this->db->query("select * from t_rekap_spl_bulanan where jam != 0 and status='$status' and proyek='$proyek' and susulan='$susulan' and seksi='$seksi'")->result_array();
		$data = array(
			'data' 		=> $hasil,
			'bulan'	 	=> $bulan,
			'tahun' 	=> $tahun,
			'status' 	=> $status,
			'seksi'	 	=> $seksi,
			'proyek' 	=> $proyek,
			'susulan' 	=> $susulan,
			'pabrik' 	=> $pabrik
		);


		$this->load->view('upah/bulanan/laporan/view/view_rekap_spl', $data);
	}

	function ambil_rekap_upah_bulanan_sby()
	{
		$bulan 	= $this->input->post('bulan');
		$tahun 	= $this->input->post('tahun');
		$status = $this->input->post('status');
		$tahun 	= $this->input->post('tahun');
		$pabrik 	= $this->input->post('pabrik');

		$hasil = $this->db->query("select * from t_rekap_upah_bulanan_sby where  bulan='$bulan' and tahun='$tahun' and status='$status'")->result_array();
		$data = array(
			'data' 		=> $hasil,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'status' 	=> $status,
			'pabrik' 	=> $pabrik
		);

		$this->load->view('upah/bulanan/laporan/view/view_rekap_upah_bulanan_sby', $data);
	}

	function ambil_rekap_upah_bulanan_sby_org()
	{
		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');
		$status 	= $this->input->post('status');
		$pabrik 	= $this->input->post('pabrik');

		// $hasil = $this->db->query("select * from t_rekap_upah_bulanan_sby_org where  bulan='$bulan' and tahun='$tahun' and status='$status'")->result_array();	
		$hasil = $this->db->query("select distinct a.seksi,b.nama from t_rekap_upah_bulanan_sby_org a
									left join t_seksi b on b.kode=a.seksi where a.status='$status' order by b.bagian,b.nama")->result_array();

		$data = array(
			'data' 		=> $hasil,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'status' 	=> $status,
			'pabrik' 	=> $pabrik
		);

		$this->load->view('upah/bulanan/laporan/view/view_rekap_upah_bulanan_sby_org', $data);
	}

	function ambilidpremi()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$bulan = $pecah[1];
		$tahun = $pecah[2];
		$data = $this->db->query("select * from t_premi_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidlt()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$bulan = $pecah[1];
		$tahun = $pecah[2];
		//$data = $this->db->query("select * from t_lt_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result();
		$data = $this->db->query("select * from t_lt_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidkop()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noac = $pecah[0];
		$bulan = $pecah[1];
		$tahun = $pecah[2];
		$data = $this->db->query("select * from t_koperasi_bulanan where noac='$noac' and bulan='$bulan' and tahun='$tahun'")->result();
		//$data = $this->db->query("select * from t_absen_bulanan where noinduk='$id'")->result();
		echo json_encode($data);
	}

	function ambilidspl()
	{
		$id = $this->input->post('id');
		$pecah = explode(",", $id);
		$noinduk = $pecah[0];
		$bulan = $pecah[1];
		$tahun = $pecah[2];
		$proyek = $pecah[3];
		$status = $pecah[4];
		/*if($proyek == '0')
		{*/
		$dataspl = $this->db->query("select * from t_spl_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' and proyek='$proyek' and status ='$status'")->result();
		/*}else{
			$dataspl = $this->db->query("select * from t_spl_bulanan_proyek where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' ")->result();
		}*/

		echo json_encode($dataspl);
	}

	function ambillt()
	{
		$noinduk = $this->input->post('noinduk');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$datalt = $this->db->query("select * from t_lt_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result();

		echo json_encode($datalt);
	}

	function ambil_karyawan_seksi()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$seksi = $this->input->post('seksi');
		$proyek = $this->input->post('proyek');
		$status = $this->input->post('status');

		$result = $this->db->query("select * from t_karyawan where seksi='$seksi' and upah='Y' and tkaryawan='bulanan' and saktif='1'")->result_array();

		$data = array(
			'data' => $result,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'proyek' => $proyek,
			'status' => $status
		);
		// echo json_encode($data);
		$this->load->view('upah/bulanan/spl/view', $data);
	}

	function ambil_karyawan_seksi_adjustment()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$seksi = $this->input->post('seksi');
		$komponen = $this->input->post('komponen');
		/*		$proyek = $this->input->post('proyek');
		$status = $this->input->post('status');
*/
		$result = $this->db->query("select * from t_karyawan where seksi='$seksi' and upah='Y' and tkaryawan='bulanan' and saktif='1'")->result_array();

		$data = array(
			'data' 		=> $result,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'komponen'	=> $komponen
			/*			'proyek' => $proyek,
			'status' => $status
*/
		);
		$this->load->view('upah/bulanan/adjustment/view', $data);
	}

	function ambiladjustment()
	{
		$id 		= $this->input->post('z');
		$pecah 		= explode(",", $id);
		$noinduk 	= $pecah[0];
		$bulan 		= $pecah[1];
		$tahun 		= $pecah[2];
		$komponen	= $pecah[3];
		$data = $this->db->query("select * from t_adjustment_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' and status='$komponen'")->result();

		echo json_encode($data);
	}

	function pecahdata()
	{
		$id 		= $this->input->post('y');
		$pecah 		= explode(",", $id);
		$noinduk 	= $pecah[0];
		$bulan 		= $pecah[1];
		$tahun 		= $pecah[2];
		$komponen 	= $pecah[3];

		$data = array(
			'noinduk' 	=> $noinduk,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'komponen'  => $komponen
		);

		echo json_encode($data);
	}

	function update_absen_bulanan()
	{
		$noinduk = $this->input->post('noinduk');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$jum_absen = $this->input->post('jum_absen');
		$jum_cuti = $this->input->post('jum_cuti');
		$update = $this->db->query("update t_absen_bulanan set jum_absen='$jum_absen',jum_cuti='$jum_cuti' where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_premi_bulanan()
	{
		$noinduk = $this->input->post('noinduk');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$jumpremi = $this->input->post('jumpremi');
		$update = $this->db->query("update t_premi_bulanan set jumpremi='$jumpremi' where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_lt_bulanan()
	{
		$noinduk = $this->input->post('noinduk');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$jumlt = $this->input->post('jumlt');
		$update = $this->db->query("update t_lt_bulanan set jumlt='$jumlt' where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_koperasi_bulanan()
	{
		$noac = $this->input->post('noac');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$jumkoperasi = $this->input->post('jumkoperasi');
		$update = $this->db->query("update t_koperasi_bulanan set jumkoperasi='$jumkoperasi' where noac='$noac' and bulan='$bulan' and tahun='$tahun'");
		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function simpan_spl()
	{
		$noinduk = $this->input->post('noinduk');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$proyek = $this->input->post('proyek');
		$seksi = $this->input->post('seksi');
		$status = $this->input->post('status');
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$tgl3 = $this->input->post('tgl3');
		$tgl4 = $this->input->post('tgl4');
		$tgl5 = $this->input->post('tgl5');
		$tgl6 = $this->input->post('tgl6');
		$tgl7 = $this->input->post('tgl7');
		$tgl8 = $this->input->post('tgl8');
		$tgl9 = $this->input->post('tgl9');
		$tgl10 = $this->input->post('tgl10');
		$tgl11 = $this->input->post('tgl11');
		$tgl12 = $this->input->post('tgl12');
		$tgl13 = $this->input->post('tgl13');
		$tgl14 = $this->input->post('tgl14');
		$tgl15 = $this->input->post('tgl15');
		$tgl16 = $this->input->post('tgl16');
		$tgl17 = $this->input->post('tgl17');
		$tgl18 = $this->input->post('tgl18');
		$tgl19 = $this->input->post('tgl19');
		$tgl20 = $this->input->post('tgl20');
		$tgl21 = $this->input->post('tgl21');
		$tgl22 = $this->input->post('tgl22');
		$tgl23 = $this->input->post('tgl23');
		$tgl24 = $this->input->post('tgl24');
		$tgl25 = $this->input->post('tgl25');
		$tgl26 = $this->input->post('tgl26');
		$tgl27 = $this->input->post('tgl27');
		$tgl28 = $this->input->post('tgl28');
		$tgl29 = $this->input->post('tgl29');
		$tgl30 = $this->input->post('tgl30');
		$tgl31 = $this->input->post('tgl31');

		//jika bukan proyek
		//if($proyek == 0)
		//{
		$cek = $this->db->query("select * from t_spl_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' and proyek='$proyek' and status='$status'")->num_rows();
		if ($cek > 0) {
			$act = $this->db->query("update t_spl_bulanan set tgl1='$tgl1',
																	 tgl2='$tgl2',
																	 tgl3='$tgl3',
																	 tgl4='$tgl4',
																	 tgl5='$tgl5',
																	 tgl6='$tgl6',
																	 tgl7='$tgl7',
																	 tgl8='$tgl8',
																	 tgl9='$tgl9',
																	 tgl10='$tgl10',
																	 tgl11='$tgl11',
																	 tgl12='$tgl12',
																	 tgl13='$tgl13',
																	 tgl14='$tgl14',
																	 tgl15='$tgl15',
																	 tgl16='$tgl16',
																	 tgl17='$tgl17',
																	 tgl18='$tgl18',
																	 tgl19='$tgl19',
																	 tgl20='$tgl20',
																	 tgl21='$tgl21',
																	 tgl22='$tgl22',
																	 tgl23='$tgl23',
																	 tgl24='$tgl24',
																	 tgl25='$tgl25',
																	 tgl26='$tgl26',
																	 tgl27='$tgl27',
																	 tgl28='$tgl28',
																	 tgl29='$tgl29',
																	 tgl30='$tgl30',
																	 tgl31='$tgl31' where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'");
		} else {
			$act = $this->db->query("insert into t_spl_bulanan(noinduk,seksi,bulan,tahun,tgl1,tgl2,tgl3,tgl4,tgl5,tgl6,tgl7,tgl8,tgl9,tgl10,tgl11,tgl12,tgl13,tgl14,tgl15,tgl16,tgl17,tgl18,tgl19,tgl20,tgl21,tgl22,tgl23,tgl24,tgl25,tgl26,tgl27,tgl28,tgl29,tgl30,tgl31,proyek,status)values('$noinduk','$seksi','$bulan','$tahun','$tgl1','$tgl2','$tgl3','$tgl4','$tgl5','$tgl6','$tgl7','$tgl8','$tgl9','$tgl10','$tgl11','$tgl12','$tgl13','$tgl14','$tgl15','$tgl16','$tgl17','$tgl18','$tgl19','$tgl20','$tgl21','$tgl22','$tgl23','$tgl24','$tgl25','$tgl26','$tgl27','$tgl28','$tgl29','$tgl30','$tgl31','$proyek','$status')");
		}
		/*}else{
			$cek = $this->db->query("select * from t_spl_bulanan_proyek where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->num_rows();
			if($cek > 0)
			{
				$act = $this->db->query("update t_spl_bulanan_proyek set tgl1='$tgl1',
																	tgl2='$tgl2',
																	 tgl3='$tgl3',
																	 tgl4='$tgl4',
																	 tgl5='$tgl5',
																	 tgl6='$tgl6',
																	 tgl7='$tgl7',
																	 tgl8='$tgl8',
																	 tgl9='$tgl9',
																	 tgl10='$tgl10',
																	 tgl11='$tgl11',
																	 tgl12='$tgl12',
																	 tgl13='$tgl13',
																	 tgl14='$tgl14',
																	 tgl15='$tgl15',
																	 tgl16='$tgl16',
																	 tgl17='$tgl17',
																	 tgl18='$tgl18',
																	 tgl19='$tgl19',
																	 tgl20='$tgl20',
																	 tgl21='$tgl21',
																	 tgl22='$tgl22',
																	 tgl23='$tgl23',
																	 tgl24='$tgl24',
																	 tgl25='$tgl25',
																	 tgl26='$tgl26',
																	 tgl27='$tgl27',
																	 tgl28='$tgl28',
																	 tgl29='$tgl29',
																	 tgl30='$tgl30',
																	 tgl31='$tgl31' where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'");	
			}else{
					$act = $this->db->query("insert into t_spl_bulanan_proyek(noinduk,seksi,bulan,tahun,tgl1,tgl2,tgl3,tgl4,tgl5,tgl6,tgl7,tgl8,tgl9,tgl10,tgl11,tgl12,tgl13,tgl14,tgl15,tgl16,tgl17,tgl18,tgl19,tgl20,tgl21,tgl22,tgl23,tgl24,tgl25,tgl26,tgl27,tgl28,tgl29,tgl30,tgl31)values('$noinduk','$seksi','$bulan','$tahun','$tgl1','$tgl2','$tgl3','$tgl4','$tgl5','$tgl6','$tgl7','$tgl8','$tgl9','$tgl10','$tgl11','$tgl12','$tgl13','$tgl14','$tgl15','$tgl16','$tgl17','$tgl18','$tgl19','$tgl20','$tgl21','$tgl22','$tgl23','$tgl24','$tgl25','$tgl26','$tgl27','$tgl28','$tgl29','$tgl30','$tgl31')");
			}*/
		//}
		echo json_encode($act);
	}

	function simpan_adjustment()
	{
		$noinduk 		= $this->input->post('noinduk');
		$bulan 			= $this->input->post('bulan');
		$tahun			= $this->input->post('tahun');
		$adjustment     = $this->input->post('adjustment');
		$komponen       = $this->input->post('komponen');

		$cek = $this->db->query("select * from t_adjustment_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' and status='$komponen'")->num_rows();
		if ($cek > 0) {
			$act = $this->db->query("update t_adjustment_bulanan set adjustment='$adjustment'
																    where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' and status='$komponen'");
		} else {
			$act = $this->db->query("insert into t_adjustment_bulanan(noinduk,bulan,tahun,adjustment,status)values('$noinduk','$bulan','$tahun','$adjustment','$komponen')");
		}
		echo json_encode($act);
	}

	function upload_absensi_bulanan()
	{
		$bulan = $this->input->post('bulan');
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
		$del = $this->db->query("delete from t_absen_bulanan where bulan ='$bulan' and tahun='$tahun'");

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk	= $rowData[0][0];
			$jumabsen 	= $rowData[0][9];
			$jumcuti 	= $rowData[0][11];
			$cek = $this->db->query("select * from t_absen_bulanan where noinduk = '$noinduk' and bulan ='$bulan' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_absen_bulanan(noinduk,bulan,tahun,jum_absen,jum_cuti)values('$noinduk','$bulan','$tahun','$jumabsen','$jumcuti')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function upload_lt_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './upload/';
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
		$del = $this->db->query("delete from t_lt_bulanan where bulan ='$bulan' and tahun='$tahun'");

		for ($row = 5; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk	= $rowData[0][0];
			$jumlt 		= $rowData[0][36];
			$jumcol		= $highestColumn;
			$jumrow      = $highestRow;
			$cek = $this->db->query("select * from t_lt_bulanan where noinduk = '$noinduk' and bulan ='$bulan' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_lt_bulanan(noinduk,bulan,tahun,jumlt)values('$noinduk','$bulan','$tahun','$jumlt')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function upload_premi_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './upload/';
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
		$del = $this->db->query("delete from t_premi_bulanan where bulan ='$bulan' and tahun='$tahun'");

		for ($row = 5; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noinduk		= $rowData[0][0];
			$jumpremi 		= $rowData[0][5];
			// $jumpremi 	= $rowData[0][36];
			$cek = $this->db->query("select * from t_premi_bulanan where noinduk = '$noinduk' and bulan ='$bulan' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_premi_bulanan(noinduk,bulan,tahun,jumpremi)values('$noinduk','$bulan','$tahun','$jumpremi')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function upload_koperasi_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './upload/';
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
		$del = $this->db->query("delete from t_koperasi_bulanan where bulan ='$bulan' and tahun='$tahun'");

		for ($row = 2; $row <= $highestRow; $row++) {   //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			$noac		= $rowData[0][0];
			$jumkoperasi = $rowData[0][2];
			$cicilan 	= $rowData[0][3];

			$cek = $this->db->query("select * from t_koperasi_bulanan where noac = '$noinduk' and bulan ='$bulan' and tahun='$tahun'")->num_rows();
			if ($cek <= 0) {
				$sql = "insert into t_koperasi_bulanan(noac,bulan,tahun,jumkoperasi,cicilan)values('$noac','$bulan','$tahun','$jumkoperasi','$cicilan')";
			}
			$insert = $this->db->query($sql);

			delete_files($media['file_path']);
			$total += $total;
		}
	}

	function proses_gaji()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		//ambil komponen gaji sama (umk,tmakan,spsi)
		$komp_gaji_tetap = $this->db->query("select * from t_komp_gaji_sama")->result_array();
		$umk = $komp_gaji_tetap[0]['ump'];

		$tmakan = $komp_gaji_tetap[0]['t_makan'];
		$spsi = $komp_gaji_tetap[0]['spsi'];

		//hapus data jika sudah ada
		$this->db->query("delete from t_gaji_bulanan where bulan ='$bulan' and tahun='$tahun'");

		//ambil semua karyawan bulanan yang akhit
		$kary = $this->db->query("select * from t_karyawan where tkaryawan='bulanan' and saktif='1' and upah='Y'")->result_array();
		foreach ($kary as $d) {
			//perhitungan semua komponen gaji
			$noinduk = $d['noinduk'];
			$noac = $d['nokop'];
			$nospsi = $d['spsi'];
			$komp_gaji = $this->db->query("select * from t_komp_gaji where noinduk='$noinduk'")->result_array();


			//mencari jumlah absen dan jumlah cuti
			$absen = $this->db->query("select jum_absen,jum_cuti from t_absen_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result_array();

			//mencari jumlah pinjaman koperasi
			$koperasi = $this->db->query("select jumkoperasi from t_koperasi_bulanan where noac='$noac' and bulan='$bulan' and tahun='$tahun'")->result_array();

			//mencari jumlah lt
			$lt = $this->db->query("select jumlt from t_lt_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result_array();
			//mencari jumlah SPL
			$sql = "select (tgl1 + tgl2 + tgl3 + tgl4 + tgl5 + tgl6 + tgl7 + tgl8 + tgl9 + tgl10 + tgl11 + tgl12 + tgl13 + tgl14 + tgl15 + tgl16 + tgl17 + tgl18 + tgl19 + tgl20 + tgl21 + tgl22 + tgl23 + tgl24 + tgl25 + tgl26 + tgl27 + tgl28 + tgl29 + tgl30 + tgl31) as jumspl from t_spl_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'";
			$spl = $this->db->query($sql)->result_array();

			//mencari jumlah premi
			$premi = $this->db->query("select jumpremi from t_premi_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result_array();

			//mencari jumlah adjustment
			$adj = $this->db->query("select adjustment from t_adjustment_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result_array();
			$jumadj = $adj[0]['adjustment'];

			if ($absen) {
				$jumabsen = $absen[0]['jum_absen'];
				$jumcuti = $absen[0]['jum_cuti'];
			} else {
				$jumabsen = 0;
				$jumcuti = 0;
			}
			if ($koperasi) {
				$jumkop = $koperasi[0]['jumkoperasi'];
			} else {
				$jumkop = 0;
			}
			if ($lt) {
				$jumlt = $lt[0]['jumlt'];
			} else {
				$jumlt = 0;
			}

			if ($spl) {
				$jumspl = $spl[0]['jumspl'];
			} else {
				$jumspl = 0;
			}

			if ($premi) {
				$jumpremi = $premi[0]['jumpremi'];
			} else {
				$jumpremi = 0;
			}

			$gp = $komp_gaji[0]['gp'];
			$tjab = $komp_gaji[0]['tjab'];
			$t3m = $komp_gaji[0]['t3m'];
			$t3e = $komp_gaji[0]['t3e'];
			$komp_jam_lembur = ($gp + $tjab + $tmakan) / 173;

			//komponen penambahan
			$upah = $gp + $tjab + $tmakan;
			$premi = ($upah * $jumpremi) / 100; //(upah x % premi)-->round
			$lt = $komp_jam_lembur * $jumlt; // (komp_jam_lembur x jam lt)
			$spl = $komp_jam_lembur * $jumspl; //(komp_jam_lembur x jam spl)

			//komponen pemotong
			if ($d['skerja'] == 'T') //jika karyawan tetap
			{
				$jht = ($upah * 2) / 100; //jht,jkn dan jkk ,jika karyawan tetap (upah x 2%)-->round
				$pensiun = ($upah * 1) / 100; //jika karyawan tetap (upah x 1%)-->round
			} else {
				$jht = 0;
				$pensiun = 0;
			}

			if ($d['potbpjs'] == '1') {
				$bpjs_kes = ($umk * 1) / 100; // jika ada kartu (umk x 1%) --> round				
			} else {
				$bpjs_kes = 0;
			}

			$pot_t3m = (($t3m + $t3e) / 30) * $jumcuti; //(t3m + t3e)/30 x jumlah CH/IA ---> cuti haid/ijin alpha
			$pot_absen = ((($gp + $t3m + $t3e) * 4) / 100) * $jumabsen; //(gp + t3m + t3e) x 4% x jumlah absen

			$koperasi = $jumkop;

			if ($d['spsi'] == '1') {
				$spsi     = $spsi;
			} else {
				$spsi = 0;
			}

			//total gaji diterima
			$thp = ($upah + $t3m + $t3e + $premi + $lt + $spl) - ($jht + $pensiun + $bpjs_kes + $pot_t3m + $pot_absen + $koperasi + $spsi) + $jumadj;

			$this->db->query("insert into t_gaji_bulanan(bulan,tahun,noinduk,gp,tjab,tmakan,t3m,t3e,jht,pensiun,bpjs_kes,premi,lt,lembur,pot_t3m,pot_absen,koperasi,spsi,thp)values('$bulan','$tahun','$noinduk','$gp','$tjab','$tmakan','$t3m','$t3e','$jht','$pensiun','$bpjs_kes','$premi','$lt','$spl','$pot_t3m','$pot_absen','$koperasi','$spsi','$thp')");
		}
		$pesan[] = "data berhasil di simpan";
		echo json_encode($pesan);
	}

	function proses_lap_upah_bulanan()
	{
		$bulan  = $this->input->post('bulan');
		$tahun  = $this->input->post('tahun');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		//hapus data di table t_rekap_lembur_bulanan
		$this->db->query("truncate t_rekap_upah_bulanan");

		//ambil seksi dari tabel karyawan
		$sql = "select distinct seksi from t_karyawan where tkaryawan='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$dataseksi = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($dataseksi as $d) {
			$seksi = $d['seksi'];
			$upah1 = '';
			$premi1 = '';
			$absensi1 = '';
			$bpjs_tk1 = '';
			$bpjs_kes1 = '';
			$pot_t3m1 	= '';
			$spsi1 = '';
			$koperasi1 = '';
			$sql = "select * from t_karyawan where seksi = '$seksi' and tkaryawan ='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
			$karyawan = $this->db->query($sql)->result_array();
			foreach ($karyawan as $b) {
				$noinduk = $b['noinduk'];

				//mencari adjustment
				$sqladj = "select * from t_adjustment_bulanan where bulan ='$bulan' and tahun='$tahun' and noinduk='$noinduk'";
				$adj 	= $this->db->query($sqladj)->result_array();

				//mencari jumlah lembur per karyawan dari table t_gaji_bulanan
				$sql = "select (gp + tjab + tmakan + t3m) as upah,premi,pot_absen,(jht + pensiun) as bpjs_tk,bpjs_kes,pot_t3m,spsi,koperasi from t_gaji_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'";
				$jumlah 	= $this->db->query($sql)->result_array();

				$upah 		= $jumlah[0]['upah'];
				$premi 		= $jumlah[0]['premi'];
				$absensi 	= $jumlah[0]['pot_absen'];
				$bpjs_tk 	= $jumlah[0]['bpjs_tk'];
				$bpjs_kes 	= $jumlah[0]['bpjs_kes'];
				$pot_t3m 	= $jumlah[0]['pot_t3m'];
				$spsi 		= $jumlah[0]['spsi'];
				$koperasi 	= $jumlah[0]['koperasi'];

				$upah1 		+= $upah;
				$premi1 	+= $premi;
				$absensi1 	+= $absensi;
				$bpjs_tk1 	+= $bpjs_tk;
				$bpjs_kes1	+= $bpjs_kes;
				$pot_t3m1  	+= $pot_t3m;
				$spsi1		+= $spsi;
				$koperasi1	+= $koperasi;
				// $this->db->query("insert into t_rekap_upah_bulanan(bulan,tahun,seksi,upah)values('$bulan','$tahun','$noinduk','$upah')");
			}

			$insert = $this->db->query("insert into t_rekap_upah_bulanan(bulan,tahun,seksi,upah,premi,pot_lain,absensi,bpjs_tk,bpjs_kes,spsi,koperasi,status)values('$bulan','$tahun','$seksi','$upah1','$premi1','$pot_t3m1','$absensi1','$bpjs_tk1','$bpjs_kes1','$spsi1','$koperasi1','$status')");

			$hasil['pesan'] = 'Data berhasil disimpan';
		}
		echo json_encode($hasil);
	}

	function proses_lap_lembur_bulanan()
	{
		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');
		$status 	= $this->input->post('status');
		$pabrik 	= $this->input->post('pabrik');

		//hapus data di table t_rekap_lembur_bulanan
		$this->db->query("truncate t_rekap_lembur_bulanan");

		//ambil seksi dari tabel karyawan
		$sql = "select distinct seksi from t_karyawan where tkaryawan='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$dataseksi = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($dataseksi as $d) {
			$seksi 		= $d['seksi'];
			$lembur1 	= '';
			$spl1		= '';
			$lt1		= '';

			$sql = "select * from t_karyawan where seksi = '$seksi' and tkaryawan ='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
			$karyawan = $this->db->query($sql)->result_array();
			foreach ($karyawan as $b) {
				$noinduk = $b['noinduk'];

				//mencari jumlah lembur per karyawan dari table t_gaji_bulanan
				$sql = "select (lt + lembur) as lembur from t_gaji_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'";
				$jumlembur = $this->db->query($sql)->result_array();
				$lembur = $jumlembur[0]['lembur'];
				$lembur1 += $lembur;

				//mencari spl
				$spl = "select (tgl1+tgl2+tgl3+tgl4+tgl5+tgl6+tgl7+tgl8+tgl9+tgl10
						+tgl11+tgl12+tgl13+tgl14+tgl15+tgl16+tgl17+tgl18+tgl19+tgl20+tgl21+tgl22+tgl23+tgl24
						+tgl25+tgl26+tgl27+tgl28+tgl29+tgl30+tgl31) as jumspl  from t_spl_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'";
				$jumspl = $this->db->query($spl)->result_array();
				$spl = $jumspl[0]['jumspl'];
				$spl1 += $spl;

				$lt = "select jumlt from t_lt_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'";
				$jumlt = $this->db->query($lt)->result_array();
				$lt = $jumlt[0]['jumlt'];
				$lt1  += $lt;
			}

			$insert = $this->db->query("insert into t_rekap_lembur_bulanan(bulan,tahun,seksi,lembur,spl,lt,status)values('$bulan','$tahun','$seksi','$lembur1','$spl1','$lt1','$status')");

			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_lap_spl_bulanan()
	{
		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');
		$seksi 		= $this->input->post('seksi');
		$proyek 	= $this->input->post('proyek');
		$status 	= $this->input->post('status'); //status tetap,kontrak dll
		$susulan 	= $this->input->post('susulan'); //spl susulan apa bukan susulan
		$pabrik 	= $this->input->post('pabrik');
		//hapus data di table t_rekap_lembur_bulanan
		$this->db->query("truncate t_rekap_spl_bulanan");

		//ambil komponen gaji sama (umk,tmakan,spsi)
		$komp_gaji_tetap = $this->db->query("select * from t_komp_gaji_sama")->result_array();
		$tmakan = $komp_gaji_tetap[0]['t_makan'];

		//mencari karyawan sesuai status,seksi
		$sql = "select * from t_karyawan where seksi='$seksi' and tkaryawan ='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$karyawan = $this->db->query($sql)->result_array();

		//mencari data spl
		foreach ($karyawan as $d) {
			$noinduk = $d['noinduk'];

			$sql1 = "select * from t_spl_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun' and seksi='$seksi' and proyek='$proyek' and status='$susulan'";

			$dtspl = $this->db->query($sql1)->result_array();

			//mencari jumlah lt per noinduk
			$dtlt = $this->db->query("select * from t_lt_bulanan where noinduk='$noinduk' and bulan='$bulan' and tahun='$tahun'")->result_array();
			$lt = $dtlt[0]['jumlt'];

			//mencari komponen gaji untuk hitung rupiah lembur per jam
			$komp_gaji = $this->db->query("select * from t_komp_gaji where noinduk='$noinduk'")->result_array();
			$gp = $komp_gaji[0]['gp'];
			$tjab = $komp_gaji[0]['tjab'];
			$lembur_jam = ($gp + $tjab + $tmakan) / 173;


			//foreach($dtspl as $b)
			//{
			$tgl1 	= $dtspl[0]['tgl1'];
			$tgl2 	= $dtspl[0]['tgl2'];
			$tgl3 	= $dtspl[0]['tgl3'];
			$tgl4 	= $dtspl[0]['tgl4'];
			$tgl5 	= $dtspl[0]['tgl5'];
			$tgl6 	= $dtspl[0]['tgl6'];
			$tgl7 	= $dtspl[0]['tgl7'];
			$tgl8 	= $dtspl[0]['tgl8'];
			$tgl9 	= $dtspl[0]['tgl9'];
			$tgl10 	= $dtspl[0]['tgl10'];
			$tgl11 	= $dtspl[0]['tgl11'];
			$tgl12 	= $dtspl[0]['tgl12'];
			$tgl13 	= $dtspl[0]['tgl13'];
			$tgl14 	= $dtspl[0]['tgl14'];
			$tgl15 	= $dtspl[0]['tgl15'];
			$tgl16 	= $dtspl[0]['tgl16'];
			$tgl17 	= $dtspl[0]['tgl17'];
			$tgl18 	= $dtspl[0]['tgl18'];
			$tgl19 	= $dtspl[0]['tgl19'];
			$tgl20 	= $dtspl[0]['tgl20'];
			$tgl21 	= $dtspl[0]['tgl21'];
			$tgl22 	= $dtspl[0]['tgl22'];
			$tgl23 	= $dtspl[0]['tgl23'];
			$tgl24 	= $dtspl[0]['tgl24'];
			$tgl25 	= $dtspl[0]['tgl25'];
			$tgl26 	= $dtspl[0]['tgl26'];
			$tgl27 	= $dtspl[0]['tgl27'];
			$tgl28 	= $dtspl[0]['tgl28'];
			$tgl29 	= $dtspl[0]['tgl29'];
			$tgl30 	= $dtspl[0]['tgl30'];
			$tgl31 	= $dtspl[0]['tgl31'];
			$jumjam = $tgl1 + $tgl2 + $tgl3 + $tgl4 + $tgl5 + $tgl6 + $tgl7 + $tgl8 + $tgl9 + $tgl10 + $tgl11 + $tgl12 + $tgl13 + $tgl14 + $tgl15 + $tgl16 + $tgl17 + $tgl18 + $tgl19 + $tgl20 + $tgl21 + $tgl22 + $tgl23 + $tgl24 + $tgl25 + $tgl26 + $tgl27 + $tgl28 + $tgl29 + $tgl30 + $tgl31;

			$total_lembur = $jumjam * $lembur_jam;


			$act = $this->db->query("insert into t_rekap_spl_bulanan(noinduk,seksi,bulan,tahun,tgl1,tgl2,tgl3,tgl4,tgl5,tgl6,tgl7,tgl8,tgl9,tgl10,tgl11,tgl12,tgl13,tgl14,tgl15,tgl16,tgl17,tgl18,tgl19,tgl20,tgl21,tgl22,tgl23,tgl24,tgl25,tgl26,tgl27,tgl28,tgl29,tgl30,tgl31,lt,jam,l_jam,jumlah,status,susulan,proyek)values('$noinduk','$seksi','$bulan','$tahun','$tgl1','$tgl2','$tgl3','$tgl4','$tgl5','$tgl6','$tgl7','$tgl8','$tgl9','$tgl10','$tgl11','$tgl12','$tgl13','$tgl14','$tgl15','$tgl16','$tgl17','$tgl18','$tgl19','$tgl20','$tgl21','$tgl22','$tgl23','$tgl24','$tgl25','$tgl26','$tgl27','$tgl28','$tgl29','$tgl30','$tgl31','$lt','$jumjam','$lembur_jam','$total_lembur','$status','$susulan','$proyek')");

			/*$act = $this->db->query("insert into t_rekap_spl_bulanan(noinduk,seksi,bulan,tahun,tgl1)values('$noinduk','$seksi','$bulan','$tahun','$tgl1')");*/

			//}
			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}


	function proses_lap_upah_bulanan_sby()
	{
		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');
		$status 	= $this->input->post('status');
		$pabrik 	= $this->input->post('pabrik');

		//hapus data di table t_rekap_upah_bulanan_sby
		$this->db->query("truncate t_rekap_upah_bulanan_sby");

		//ambil seksi dari tabel karyawan
		$sql = "select distinct seksi from t_karyawan where tkaryawan='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$dataseksi = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($dataseksi as $d) {
			$seksi = $d['seksi'];
			$thp1 = '';
			$jum_orang = 0;
			$sql = "select * from t_karyawan where seksi = '$seksi' and tkaryawan ='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
			$karyawan = $this->db->query($sql)->result_array();
			foreach ($karyawan as $b) {
				$noinduk = $b['noinduk'];

				//mencari jumlah upah per karyawan dari table t_gaji_bulanan
				$sql = "select thp from t_gaji_bulanan where noinduk='$noinduk' and bulan='$bulan' 	and tahun='$tahun'";
				$jumthp = $this->db->query($sql)->result_array();
				$thp = $jumthp[0]['thp'];
				$thp1 += $thp;
				$jum_orang = $jum_orang + 1;
			}

			$insert = $this->db->query("insert into t_rekap_upah_bulanan_sby(bulan,tahun,seksi,orang,transfer,status)values('$bulan','$tahun','$seksi','$jum_orang','$thp1','$status')");

			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_lap_upah_bulanan_sby_org()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');
		$pabrik = $this->input->post('pabrik');

		//hapus data di table t_rekap_upah_bulanan_sby
		$this->db->query("truncate t_rekap_upah_bulanan_sby_org");

		//ambil seksi dari tabel karyawan
		$sql = "select * from t_karyawan where tkaryawan='bulanan' and skerja='$status' and saktif='1' and upah='Y' and pabrik='$pabrik'";
		$karyawan = $this->db->query($sql)->result_array();

		//mencari karyawan sesuai seksi
		foreach ($karyawan as $d) {
			$noinduk = $d['noinduk'];
			$seksi = $d['seksi'];
			$norek	= $d['norek'];

			$sqlgaji = "select * from t_gaji_bulanan where noinduk='$noinduk' and bulan ='$bulan' and tahun ='$tahun'";
			$gaji = $this->db->query($sqlgaji)->result_array();
			foreach ($gaji as $b) {
				$upah = $b['gp'] + $b['tjab'] + $b['tmakan'] + $b['t3m'];


				$premi = $b['premi'];
				$lembur = $b['lembur'];
				$absen  = $b['pot_absen'];
				$pot_lain = $b['pot_t3m'];
				$bpjs_tk = $b['bpjs_tk'];
				$bpjs_kes = $b['bpjs_kes'];
				$spsi = $b['spsi'];
				$koperasi = $b['koperasi'];
				$transfer = $b['thp'];


				$insert = $this->db->query("insert into t_rekap_upah_bulanan_sby_org(noinduk,bulan,tahun,seksi,norek,upah,premi,lembur,absen,lain_lain,bpjs_tk,bpjs_kes,spsi,koperasi,transfer,status)values('$noinduk','$bulan','$tahun','$seksi','$norek','$upah','$premi','$lembur','$absen','$pot_lain','$bpjs_tk','$bpjs_kes','$spsi','$koperasi','$transfer','$status')");
			}


			$hasil['pesan'] = 'Proses Berhasil';
		}
		echo json_encode($hasil);
	}

	function proses_lap_cekpremi()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$sql = "SELECT DISTINCT a.seksi ,b.nama FROM t_karyawan a 
				left join t_seksi b on b.kode=a.seksi WHERE a.tkaryawan='bulanan' AND a.skerja='T' AND a.saktif='1' AND a.upah='Y' order by b.nama";

		$data = $this->db->query($sql)->result_array();
		$data = array(
			'data' 	=> $data,
			'bulan'	=> $bulan,
			'tahun' => $tahun
		);

		$this->load->view('upah/bulanan/laporan/view/view_cekpremi', $data);
	}

	function proses_lap_cekpotlain()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');



		$sql = "SELECT DISTINCT a.seksi ,b.nama FROM t_karyawan a 
				left join t_seksi b on b.kode=a.seksi WHERE a.tkaryawan='bulanan' AND a.saktif='1' AND a.upah='Y' order by b.nama";

		$data = $this->db->query($sql)->result_array();
		$data = array(
			'data' 	=> $data,
			'bulan'	=> $bulan,
			'tahun' => $tahun
		);

		$this->load->view('upah/bulanan/laporan/view/view_cekpotlain', $data);
	}

	function proses_lap_cekpotabsen()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');



		$sql = "SELECT DISTINCT a.seksi ,b.nama FROM t_karyawan a 
				left join t_seksi b on b.kode=a.seksi WHERE a.tkaryawan='bulanan' AND a.saktif='1' AND a.upah='Y' order by b.nama";

		$data = $this->db->query($sql)->result_array();
		$data = array(
			'data' 	=> $data,
			'bulan'	=> $bulan,
			'tahun' => $tahun
		);

		$this->load->view('upah/bulanan/laporan/view/view_cekpotabsen', $data);
	}


	function proses_slip()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');

		$sql = "select a.*,b.noslip,b.seksi,b.nama from t_gaji_bulanan a
				join t_karyawan b on b.noinduk=a.noinduk where a.bulan='$bulan' and a.tahun='$tahun' and b.tkaryawan ='bulanan' and skerja='$status'";
		$data = $this->db->query($sql)->result_array();

		$hasil = array(
			'data'		=> $data,
			'bulan' 	=> $bulan,
			'tahun' 	=> $tahun,
			'status'	=> $status
		);

		$this->load->view('upah/bulanan/laporan/view/view_slip', $hasil);
	}

	//report Excell

	function lap_rekap_upah_bulanan_excell($bulan, $tahun, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select a.*,b.nama from t_rekap_upah_bulanan a
					join t_seksi b on b.kode=a.seksi";
		// order by b.nama";
		$data = $this->db->query($sql)->result_array();
		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		// Create new PHPExcel object
		$object = new PHPExcel();

		// Set properties
		$object->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");
		// Add some data
		//membuat lebar kolom otomatis
		$object->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:K1');
		$object->getActiveSheet()->mergeCells('A2:K2');
		$object->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:K3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:K3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'REKAPITULASI UPAH BULANAN' . ' ' . $status . ' PT. ' . $pabrik)
			->setCellValue('A2', 'BULAN : ' . $bul[$bulan] . ' ' . $tahun)
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'SEKSI')
			->setCellValue('C3', 'UPAH')
			->setCellValue('D3', 'PREMI')
			->setCellValue('E3', 'POT. LAIN')
			->setCellValue('F3', 'ABSENSI')
			->setCellValue('G3', 'BPJS-TK')
			->setCellValue('H3', 'BPJS-KES')
			->setCellValue('I3', 'SPSI')
			->setCellValue('J3', 'KOPERASI')
			->setCellValue('K3', 'JUMLAH');

		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		$tot_upah = '';
		$tot_premi = '';
		$tot_pot_lain = '';
		$tot_absensi = '';
		$tot_bpjs_tk = '';
		$tot_bpjs_kes = '';
		$tot_spsi = '';
		$tot_koperasi = '';
		$tot_jumlah = '';
		foreach ($data as $d) {
			$jumlah = ($d['upah'] + $d['premi']) - ($d['absensi'] + $d['bpjs_tk'] + $d['bpjs_kes'] + $d['spsi'] + $d['koperasi']);
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':K' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $d['nama']);
			$ex->setCellValue("C" . $counter, $d['upah']);
			$ex->setCellValue("D" . $counter, $d['premi']);
			$ex->setCellValue("E" . $counter, $d['pot_lain']);
			$ex->setCellValue("F" . $counter, $d['absensi']);
			$ex->setCellValue("G" . $counter, $d['bpjs_tk']);
			$ex->setCellValue("H" . $counter, $d['bpjs_kes']);
			$ex->setCellValue("I" . $counter, $d['spsi']);
			$ex->setCellValue("J" . $counter, $d['koperasi']);
			$ex->setCellValue("K" . $counter, $jumlah);

			$counter = $counter + 1;
			$no++;
			$tot_upah += $d['upah'];
			$tot_premi += $d['premi'];
			$tot_pot_lain += $d['pot_lain'];
			$tot_absensi += $d['absensi'];
			$tot_bpjs_tk += $d['bpjs_tk'];
			$tot_bpjs_kes += $d['bpjs_kes'];
			$tot_spsi += $d['spsi'];
			$tot_koperasi += $d['koperasi'];
			$tot_jumlah += $jumlah;
		}
		$object->getSheet(0)->getStyle('A' . $counter . ':K' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "B" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("C" . $counter, $tot_upah);
		$ex->setCellValue("D" . $counter, $tot_premi);
		$ex->setCellValue("E" . $counter, $tot_pot_lain);
		$ex->setCellValue("F" . $counter, $tot_absensi);
		$ex->setCellValue("G" . $counter, $tot_bpjs_tk);
		$ex->setCellValue("H" . $counter, $tot_bpjs_kes);
		$ex->setCellValue("I" . $counter, $tot_spsi);
		$ex->setCellValue("J" . $counter, $tot_koperasi);
		$ex->setCellValue("K" . $counter, $tot_jumlah);
		$x = $counter + 2;
		$x1 = $counter + 3;
		//membuat ttd bawah
		$ex->setCellValue("J" . $x, 'Bangun' . '  ' . date('d-m-Y'));
		$ex->setCellValue("D" . $x1, 'Disetujui,');
		$ex->setCellValue("F" . $x1, 'Diperiksa,');
		$ex->setCellValue("J" . $x1, 'Dibuat,');

		$object->getActiveSheet()->setTitle('Laporan Upah bulanan tetap');

		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Bulanan Tetap.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_lembur_excell($bulan, $tahun, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select a.*,b.nama from t_rekap_lembur_bulanan a
					join t_seksi b on b.kode=a.seksi
 					order by b.nama";
		$data = $this->db->query($sql)->result_array();
		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		// Create new PHPExcel object
		$object = new PHPExcel();

		// Set properties
		$object->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");
		// Add some data
		//membuat lebar kolom otomatis
		$object->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:D1');
		$object->getActiveSheet()->mergeCells('A2:D2');
		$object->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'REKAPITULASI UPAH LEMBUR BULANAN PT. ' . $pabrik . '(' . $status . ')')
			->setCellValue('A2', 'BULAN : ' . $bul[$bulan] . ' ' . $tahun)
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'SEKSI')
			->setCellValue('C3', 'JUMLAH')
			->setCellValue('D3', 'SPL + LT/LT');

		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		$tot_jumlah = '';
		$tot_spllt = '';
		$tot_lt = '';
		foreach ($data as $d) {
			$spllt = $d['spl'] + $d['lt'];
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $d['nama']);
			$ex->setCellValue("C" . $counter, $d['lembur']);
			$ex->setCellValue("D" . $counter, $spllt . '/' . $d['lt']);

			$counter = $counter + 1;
			$no++;
			$tot_jumlah += $d['lembur'];
			$tot_spllt += $spllt;
			$tot_lt += $d['lt'];
		}

		$object->getSheet(0)->getStyle('A' . $counter . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "B" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("C" . $counter, $tot_jumlah);
		$ex->setCellValue("D" . $counter, $tot_spllt . "/" . $tot_lt);
		$x = $counter + 2;
		$x1 = $counter + 3;
		//membuat ttd bawah
		$ex->setCellValue("D" . $x, 'Bangun' . '  ' . date('d-m-Y'));
		$ex->setCellValue("A" . $x1, 'Disetujui,');
		$ex->setCellValue("C" . $x1, 'Diperiksa,');
		$ex->setCellValue("D" . $x1, 'Dibuat,');

		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan Upah Lembur');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Lembur Bulanan.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_spl_excell($bulan, $tahun, $status, $seksi, $proyek, $susulan, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select a.*,b.nama from t_rekap_spl_bulanan a
					join t_seksi b on b.kode=a.seksi 
					where a.jam != 0
 					order by b.nama";
		$data = $this->db->query($sql)->result_array();

		$nmseksi = $this->db->query("select nama from t_seksi where kode='$seksi'")->result_array();


		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}

		if ($proyek == 0) {
			$proyek = "";
		} else {
			$proyek = "PROYEK";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		// Create new PHPExcel object
		$object = new PHPExcel();

		// Set properties
		$object->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");
		// Add some data
		//membuat lebar kolom otomatis
		$object->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('M')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('N')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('O')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('P')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('Q')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('R')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('S')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('T')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('U')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('V')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('W')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('X')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('Y')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('Z')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AA')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AB')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AC')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AD')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AE')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AF')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AG')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AH')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AI')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('AJ')->setAutoSize(true);

		$object->getActiveSheet()->mergeCells('A1:AJ1');
		$object->getActiveSheet()->mergeCells('A2:AJ2');
		$object->getActiveSheet()->mergeCells('B6:AG6');
		$object->getActiveSheet()->mergeCells('A6:A7');
		$object->getActiveSheet()->mergeCells('AH6:AH7');
		$object->getActiveSheet()->mergeCells('AI6:AI7');
		$object->getActiveSheet()->mergeCells('AJ6:AJ7');
		$object->getActiveSheet()->mergeCells('B4:I4');
		$object->getActiveSheet()->mergeCells('B5:I5');
		$object->getActiveSheet()->getStyle('A6:AJ6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('B6:AG6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A6:A7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('AH6:AH7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('AI6:AI7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$object->getActiveSheet()->getStyle('AJ6:AJ7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A6:AJ6')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A6:AJ6')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'DAFTAR UPAH LEMBUR KARYAWAN BULANAN (' . $status . ')')
			->setCellValue('A2', 'PT. ' . $pabrik . ' (' . $proyek . ')')
			->setCellValue('A3', 'BAGIAN :')
			->setCellValue('B3', '')
			->setCellValue('A4', 'SEKSI :')
			->setCellValue('B4', $nmseksi[0]['nama'])
			->setCellValue('A5', 'BULAN')
			->setCellValue('B5', $bul[$bulan] . ' ' . $tahun)
			->setCellValue('A6', 'NAMA')
			->setCellValue('B6', 'TANGGAL')
			->setCellValue('AH6', 'JAM')
			->setCellValue('AI6', 'L/JAM')
			->setCellValue('AJ6', 'JUMLAH')
			//tanggal
			->setCellValue('B7', '01')
			->setCellValue('C7', '02')
			->setCellValue('D7', '03')
			->setCellValue('E7', '04')
			->setCellValue('F7', '05')
			->setCellValue('G7', '06')
			->setCellValue('H7', '07')
			->setCellValue('I7', '08')
			->setCellValue('J7', '09')
			->setCellValue('K7', '10')
			->setCellValue('L7', '11')
			->setCellValue('M7', '12')
			->setCellValue('N7', '13')
			->setCellValue('O7', '14')
			->setCellValue('P7', '15')
			->setCellValue('Q7', '16')
			->setCellValue('R7', '17')
			->setCellValue('S7', '18')
			->setCellValue('T7', '19')
			->setCellValue('U7', '20')
			->setCellValue('V7', '21')
			->setCellValue('W7', '22')
			->setCellValue('X7', '23')
			->setCellValue('Y7', '24')
			->setCellValue('Z7', '25')
			->setCellValue('AA7', '26')
			->setCellValue('AB7', '27')
			->setCellValue('AC7', '28')
			->setCellValue('AD7', '29')
			->setCellValue('AE7', '30')
			->setCellValue('AF7', '31')
			->setCellValue('AG7', 'LT');

		//add data
		$counter = 8;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 6;
		$tot_jam = '';
		$tot_jumlah = '';
		foreach ($data as $d) {
			$noinduk = $d['noinduk'];
			$nm = $this->db->query("select nama from t_karyawan where noinduk='$noinduk'")->result_array();
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':AJ' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $nm[0]['nama']);
			$ex->setCellValue("B" . $counter, $d['tgl1']);
			$ex->setCellValue("C" . $counter, $d['tgl2']);
			$ex->setCellValue("D" . $counter, $d['tgl3']);
			$ex->setCellValue("E" . $counter, $d['tgl4']);
			$ex->setCellValue("F" . $counter, $d['tgl5']);
			$ex->setCellValue("G" . $counter, $d['tgl6']);
			$ex->setCellValue("H" . $counter, $d['tgl7']);
			$ex->setCellValue("I" . $counter, $d['tgl8']);
			$ex->setCellValue("J" . $counter, $d['tgl9']);
			$ex->setCellValue("K" . $counter, $d['tgl10']);
			$ex->setCellValue("L" . $counter, $d['tgl11']);
			$ex->setCellValue("M" . $counter, $d['tgl12']);
			$ex->setCellValue("N" . $counter, $d['tgl13']);
			$ex->setCellValue("O" . $counter, $d['tgl14']);
			$ex->setCellValue("P" . $counter, $d['tgl15']);
			$ex->setCellValue("Q" . $counter, $d['tgl16']);
			$ex->setCellValue("R" . $counter, $d['tgl17']);
			$ex->setCellValue("S" . $counter, $d['tgl18']);
			$ex->setCellValue("T" . $counter, $d['tgl19']);
			$ex->setCellValue("U" . $counter, $d['tgl20']);
			$ex->setCellValue("V" . $counter, $d['tgl21']);
			$ex->setCellValue("W" . $counter, $d['tgl22']);
			$ex->setCellValue("X" . $counter, $d['tgl23']);
			$ex->setCellValue("Y" . $counter, $d['tgl24']);
			$ex->setCellValue("Z" . $counter, $d['tgl25']);
			$ex->setCellValue("AA" . $counter, $d['tgl26']);
			$ex->setCellValue("AB" . $counter, $d['tgl27']);
			$ex->setCellValue("AC" . $counter, $d['tgl28']);
			$ex->setCellValue("AD" . $counter, $d['tgl29']);
			$ex->setCellValue("AE" . $counter, $d['tgl30']);
			$ex->setCellValue("AF" . $counter, $d['tgl31']);
			$ex->setCellValue("AG" . $counter, $d['lt']);
			$ex->setCellValue("AH" . $counter, $d['jam']);
			$ex->setCellValue("AI" . $counter, $d['l_jam']);
			$ex->setCellValue("AJ" . $counter, $d['jumlah']);

			$counter = $counter + 1;

			$tot_jumlah += $d['jumlah'];
			$tot_jam += $d['jam'];
		}

		$object->getSheet(0)->getStyle('A' . $counter . ':AJ' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->getStyle('B' . $counter . ':B' . $counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$object->getActiveSheet()->mergeCells("B" . $counter . ":" . "AG" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("B" . $counter, 'JUMLAH Rp.');
		$ex->setCellValue("AH" . $counter, $tot_jam);
		$ex->setCellValue("AJ" . $counter, $tot_jumlah);
		/*$x = $counter + 2;
			 $x1 = $counter + 3;
			 //membuat ttd bawah
 			$ex->setCellValue("D".$x,'Bangun'.'  '.date('d-m-Y'));			 
			$ex->setCellValue("A".$x1,'Disetujui,');			 
			$ex->setCellValue("C".$x1,'Diperiksa,');		 
			$ex->setCellValue("D".$x1,'Dibuat,');	*/

		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan SPL Bulanan');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan spl Bulanan.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_upah_bulanan_sby_excell($bulan, $tahun, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select a.*,b.nama from t_rekap_upah_bulanan_sby a
					join t_seksi b on b.kode=a.seksi
 					order by b.nama";
		$data = $this->db->query($sql)->result_array();
		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		// Create new PHPExcel object
		$object = new PHPExcel();

		// Set properties
		$object->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");
		// Add some data
		//membuat lebar kolom otomatis
		$object->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:D1');
		$object->getActiveSheet()->mergeCells('A2:D2');
		$object->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:D3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'LAPORAN UPAH BULANAN PT. ' . $pabrik . ' (' . $status . ')')
			->setCellValue('A2', 'BULAN : ' . $bul[$bulan] . ' ' . $tahun)
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'SEKSI')
			->setCellValue('C3', 'JUMLAH ORANG')
			->setCellValue('D3', 'TRANSFER');

		//add data
		$counter = 4;
		$ex = $object->setActiveSheetIndex(0);
		$no = 1;
		$baris1 = 3;
		$tot_org = '';
		$tot_transfer = '';
		foreach ($data as $d) {

			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$ex->setCellValue("A" . $counter, $no);
			$ex->setCellValue("B" . $counter, $d['nama']);
			$ex->setCellValue("C" . $counter, $d['orang']);
			$ex->setCellValue("D" . $counter, $d['transfer']);

			$counter = $counter + 1;
			$no++;
			$tot_org += $d['orang'];
			$tot_transfer += $d['transfer'];
		}
		$object->getSheet(0)->getStyle('A' . $counter . ':D' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$object->getActiveSheet()->mergeCells("A" . $counter . ":" . "B" . $counter);
		$ex->setCellValue("A" . $counter, 'TOTAL');
		$ex->setCellValue("C" . $counter, $tot_org);
		$ex->setCellValue("D" . $counter, $tot_transfer);
		$x = $counter + 2;
		$x1 = $counter + 3;
		//membuat ttd bawah
		$ex->setCellValue("D" . $x, 'Bangun' . '  ' . date('d-m-Y'));
		$ex->setCellValue("A" . $x1, 'Disetujui,');
		$ex->setCellValue("C" . $x1, 'Diperiksa,');
		$ex->setCellValue("D" . $x1, 'Dibuat,');
		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan Upah Bulanan');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Bulanan.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}

	function lap_rekap_upah_bulanan_sby_org_excell($bulan, $tahun, $status, $pabrik)
	{
		ini_set('max_execution_time', '3000');

		$sql = "select distinct a.seksi,b.nama from t_rekap_upah_bulanan_sby_org a
					left join t_seksi b on b.kode=a.seksi where a.status='$status' order by b.bagian,b.nama";
		$data = $this->db->query($sql)->result_array();
		if ($status == "T") {
			$status = "TETAP";
		} elseif ($status == "K") {
			$status = "KONTRAK";
		} elseif ($status == "H") {
			$status = "HONOR";
		} else {
			$status = "MAGANG";
		}
		$bul = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		// Create new PHPExcel object
		$object = new PHPExcel();

		// Set properties
		$object->getProperties()->setCreator("Mr G")
			->setLastModifiedBy("Mr G")
			->setCategory("Approve by ");
		// Add some data
		//membuat lebar kolom otomatis
		$object->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$object->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
		$object->getActiveSheet()->mergeCells('A1:L1');
		$object->getActiveSheet()->mergeCells('A2:L2');
		$object->getActiveSheet()->mergeCells('A3:L3');

		$object->getActiveSheet()->getStyle('A3:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A2:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A1:A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


		//WARNA BG
		$object->getSheet(0)->getStyle('A3:L3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$object->getSheet(0)->getStyle('A3:l3')->getFill()
			->getStartColor()->setRGB('eae4e4');

		$object->setActiveSheetIndex(0)
			->setCellValue('A1', 'PT. ' . $pabrik)
			->setCellValue('A2', 'LAPORAN UPAH KARYAN BULANAN ' . $status . '(Utk. Surabaya)')
			->setCellValue('A3', 'BULAN / TAHUN : ' . $bul[$bulan] . ' ' . $tahun)
			->setCellValue('A4', 'Nama')
			->setCellValue('B4', 'No. Rekening')
			->setCellValue('C4', 'GAJI')
			->setCellValue('D4', 'PREMI')
			->setCellValue('E4', 'LEMBUR')
			->setCellValue('F4', 'ABSEN')
			->setCellValue('G4', 'LAIN-LAIN')
			->setCellValue('H4', 'BPJS-TK')
			->setCellValue('I4', 'BPJS-KES')
			->setCellValue('J4', 'SPSI')
			->setCellValue('K4', 'KOPERASI')
			->setCellValue('L4', 'TRANSFER');


		//add data
		$counter = 5;
		$ex = $object->setActiveSheetIndex(0);
		$baris1 = 4;

		foreach ($data as $d) {
			$tot_upah = '';
			$tot_premi = '';
			$tot_lembur = '';
			$tot_absensi = '';
			$tot_lain_lain = '';
			$tot_bpjs_tk = '';
			$tot_bpjs_kes = '';
			$tot_spsi = '';
			$tot_koperasi = '';
			$tot_transfer = '';

			$kdseksi = $d['seksi'];
			$nmseksi = $d['nama'];

			$karyawan = $this->db->query("select a.*,b.nama from  							t_rekap_upah_bulanan_sby_org a
									join t_karyawan b on b.noinduk=a.noinduk
									 where a.seksi='$kdseksi' order by b.nama")->result_array();
			//memberi border
			$object->getSheet(0)->getStyle('A' . $baris1 . ':L' . $counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			//tempat nama seksi
			$object->getActiveSheet()->mergeCells('A' . $counter . ':L' . $counter);


			//tampilkan nama seksi
			$ex->setCellValue("A" . $counter, $nmseksi);
			$object->getActiveSheet()->getStyle('A' . $counter)->getFont()->setBold(true);
			foreach ($karyawan as $b) {

				$counter = $counter + 1;
				$ex->setCellValue("A" . $counter, $b['nama']);
				$ex->setCellValue("B" . $counter, $b['norek']);
				$ex->setCellValue("C" . $counter, $b['upah']);
				$ex->setCellValue("D" . $counter, $b['premi']);
				$ex->setCellValue("E" . $counter, $b['lembur']);
				$ex->setCellValue("F" . $counter, $b['absen']);
				$ex->setCellValue("G" . $counter, $b['lain_lain']);
				$ex->setCellValue("H" . $counter, $b['bpjs_tk']);
				$ex->setCellValue("I" . $counter, $b['bpjs_kes']);
				$ex->setCellValue("J" . $counter, $b['spsi']);
				$ex->setCellValue("K" . $counter, $b['koperasi']);
				$ex->setCellValue("L" . $counter, $b['transfer']);



				$tot_upah += $b['upah'];
				$tot_premi += $b['premi'];
				$tot_lembur += $b['lembur'];
				$tot_absensi += $b['absen'];
				$tot_lain_lain += $b['lain_lain'];
				$tot_bpjs_tk += $b['bpjs_tk'];
				$tot_bpjs_kes += $b['bpjs_kes'];
				$tot_spsi += $b['spsi'];
				$tot_koperasi += $b['koperasi'];
				$tot_transfer += $b['transfer'];
			}
			$counter = $counter + 1;
			$object->getActiveSheet()->getStyle('A' . $counter . ':L' . $counter)->getFont()->setBold(true);
			$ex->setCellValue("A" . $counter, 'TOTAL');
			$ex->setCellValue("C" . $counter, $tot_upah);
			$ex->setCellValue("D" . $counter, $tot_premi);
			$ex->setCellValue("E" . $counter, $tot_lembur);
			$ex->setCellValue("F" . $counter, $tot_absensi);
			$ex->setCellValue("G" . $counter, $tot_lain_lain);
			$ex->setCellValue("H" . $counter, $tot_bpjs_tk);
			$ex->setCellValue("I" . $counter, $tot_bpjs_kes);
			$ex->setCellValue("J" . $counter, $tot_spsi);
			$ex->setCellValue("K" . $counter, $tot_koperasi);
			$ex->setCellValue("L" . $counter, $tot_transfer);
			$counter = $counter + 1;
		}
		//  		 $object->getSheet(0)->getStyle('A'.$counter.':M'.$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// $object->getActiveSheet()->mergeCells("A".$counter.":"."C".$counter);
		//  $ex->setCellValue("A".$counter,'TOTAL');
		//  $ex->setCellValue("D".$counter,$tot_upah);
		//  $ex->setCellValue("E".$counter,$tot_premi);
		//  $ex->setCellValue("F".$counter,$tot_lembur);
		//  $ex->setCellValue("G".$counter,$tot_absensi);
		//  $ex->setCellValue("H".$counter,$tot_lain_lain);
		//  $ex->setCellValue("I".$counter,$tot_bpjs_tk);
		//  $ex->setCellValue("J".$counter,$tot_bpjs_kes);
		//  $ex->setCellValue("K".$counter,$tot_spsi);
		//  $ex->setCellValue("L".$counter,$tot_koperasi);
		//  $ex->setCellValue("M".$counter,$tot_transfer);
		//  $x = $counter + 2;
		//  $x1 = $counter + 3;
		//  //membuat ttd bawah
		// 	$ex->setCellValue("D".$x,'Bangun'.'  '.date('d-m-Y'));			 
		// $ex->setCellValue("A".$x1,'Disetujui,');			 
		// $ex->setCellValue("C".$x1,'Diperiksa,');		 
		// $ex->setCellValue("D".$x1,'Dibuat,');	
		// Rename sheet
		// 	$object->getActiveSheet()->setTitle('Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year']);

		$object->getActiveSheet()->setTitle('Laporan Upah Bulanan');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$object->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detail_approve_'.$_GET['user'].'_'.$_GET['m'].'_'.$_GET['year'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Upah Bulanan.xlsx"');
		header('Cache-Control: max-age=0');

		/* $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                 */
		$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		if (ob_get_contents()) ob_end_clean();
		//ob_end_clean();
		$objWriter->save('php://output');
		exit;
	}
}/* End of file bulanan.php */
