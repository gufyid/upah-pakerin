<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Gaji extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	function ambilid()
	{
		$noinduk = $this->input->post('id');
		$hasil = $this->db->query("select * from t_karyawan where noinduk='$noinduk'")->result_array();
		$data = array(
			'data' => $hasil,
		);
		$this->load->view('upah/gaji/view', $data);
	}

	function datagaji()
	{
		$noinduk = $this->input->post('id');
		$sql = "select a.*,b.nama from t_komp_gaji a
				left join t_karyawan b on b.noinduk=a.noinduk 
 				where a.noinduk='$noinduk'";
		$datagaji = $this->db->query($sql)->result();
		echo json_encode($datagaji);
	}

	function datainsentif()
	{
		$noinduk = $this->input->post('id');
		$sql = "select a.*,b.nama from t_insentif_mingguan a
				left join t_karyawan b on b.noinduk=a.noinduk
				where a.noinduk = '$noinduk'";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function datagajitetap()
	{
		$id = $this->input->post('id');
		$datagajisama = $this->db->query("select * from t_komp_gaji_sama where id='$id'")->result();
		echo json_encode($datagajisama);
	}

	function simpan_komp_gaji()
	{
		$noinduk 	= $this->input->post('noinduk');
		$gp 		= $this->input->post('gp');
		$tjab 		= $this->input->post('tjab');
		$t3m 		= $this->input->post('t3m');
		$t3e 		= $this->input->post('t3e');
		$pendapatan = $gp + $tjab + $t3m + $t3e + 850000;
		$this->db->query("insert into t_komp_gaji(noinduk,pendapatan,gp,tjab,t3m,t3e)values('$noinduk','$pendapatan','$gp','$tjab','$t3m','$t3e')");

		$result['pesan'] = 'Data berhasil disimpan';
		echo json_encode($result);
	}
	function update_komp_gaji()
	{
		$noinduk = $this->input->post('noinduk');
		$gp = $this->input->post('gp');
		$tjab = $this->input->post('tjab');
		$t3m = $this->input->post('t3m');
		$t3e = $this->input->post('t3e');
		$update = $this->db->query("update t_komp_gaji set gp='$gp',
														   tjab='$tjab',
														   	t3m ='$t3m',
														   	t3e = '$t3e'
														   	where noinduk='$noinduk'");

		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function update_komp_gaji_sama()
	{
		$ump = $this->input->post('ump');
		$tmakan = $this->input->post('tmakan');
		$spsi = $this->input->post('spsi');
		$update = $this->db->query("update t_komp_gaji_sama set ump='$ump',
														   t_makan='$tmakan',
														   	spsi ='$spsi'");

		$result['pesan'] = 'berhasil';
		echo json_encode($result);
	}

	function cekkompgaji()
	{
		$noinduk = $this->input->post('id');
		$cek = $this->db->query("select * from t_komp_gaji where noinduk='$noinduk'")->num_rows();
		if ($cek > 0) {
			$pesan = "Data Sudah ada";
		} else {
			$cekkar = $this->db->query("select * from t_karyawan where noinduk='$noinduk'")->num_rows();
			if ($cekkar <= 0) {
				$pesan = "Data Karyawan belum ada";
			} else {
				$pesan = "";
			}
		}
		echo json_encode($pesan);
	}
}/* End of file Gaji.php */
