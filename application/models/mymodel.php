<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mymodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function ganti_password($table, $data, $where)
	{
		$data = $this->db->update($table, $data, $where);
		return $data;
	}

	function get_karyawan_aktif($table)
	{
		$where  = array(
			'saktif'	=> '1',
			//'noinduk'	=> '46'
		);
		return $this->db->get_where($table, $where);
	}

	function get_karyawan_bulanan($table)
	{
		$where = array(
			'tkaryawan' => 'B',
			'saktif'	=> '1'
		);
		return $this->db->get_where($table, $where);
	}

	function get_karyawan_mingguan($table)
	{
		$where = array(
			'tkaryawan' => 'H',
			'saktif'	=> '1'
		);
		return $this->db->get_where($table, $where);
	}
	function get_karyawan_insentif($table)
	{
		$sql = "select * from $table where tkaryawan='H' and skerja='T' and saktif='1' and upah ='Y' order by noinduk";
		return $this->db->query($sql);
	}
	function get_pengguna()
	{
		$sql = "select * from t_user where status='1' order by nama";
		$data = $this->db->query($sql);
		return $data;
	}

	function get_kompgaji($table)
	{
		return $data = $this->db->get($table);
	}

	function get_kompgajitetap($table)
	{
		return $data = $this->db->get($table);
	}

	function get_seksi($table)
	{
		return $data = $this->db->get($table);
	}
	function ambildata($table)
	{
		return  $this->db->get($table);
	}

	function data_kondite($tahun)
	{
		return $this->db->query("select * from t_kondite where tahun='$tahun'");
	}

	function data_deviasi($tahun)
	{
		$sql = "select  a.*,b.nama,b.pabrik,c.nama as seksi from t_deviasi a 
				left join t_karyawan b on b.noinduk=a.noinduk 
				left join t_seksi c on c.kode = b.seksi
				where a.tahun='$tahun' order by b.seksi";
		return $this->db->query($sql);
	}

	function jumlah_absen_bulanan($bulan, $tahun)
	{
		return $this->db->query("select * from t_absen_bulanan where bulan='$bulan' and tahun='$tahun'");
	}

	function jumlah_absen_mingguan($pawal, $pakhir)
	{
		return $this->db->query("select * from t_absen_mingguan where pawal='$pawal' and pakhir='$pakhir'");
	}

	function jumlah_lt_bulanan($bulan, $tahun)
	{
		return $this->db->query("select * from t_lt_bulanan where bulan='$bulan' and tahun='$tahun'");
	}

	function jumlah_gaji_bulanan($bulan, $tahun)
	{
		return $this->db->query("select * from t_gaji_bulanan where bulan='$bulan' and tahun='$tahun'");
	}

	function jumlah_gaji_mingguan($periode_awal_upah, $periode_akhir_upah)
	{
		return $this->db->query("select * from t_gaji_mingguan where periode_awal_upah='$periode_awal_upah' and periode_akhir_upah='$periode_akhir_upah'");
	}

	function jumlah_lt_mingguan($pawal, $pakhir)
	{
		return $this->db->query("select * from t_lt_mingguan where pawal='$pawal' and pakhir='$pakhir'");
	}

	function jumlah_premi_bulanan($bulan, $tahun)
	{
		return $this->db->query("select * from t_premi_bulanan where bulan='$bulan' and tahun='$tahun'");
	}

	function jumlah_premi_mingguan($pawal, $pakhir)
	{
		return $this->db->query("select * from t_premi_mingguan where pawal='$pawal' and pakhir='$pakhir' and noinduk!='0'");
	}


	function jumlah_koperasi_bulanan($bulan, $tahun)
	{
		return $this->db->query("select * from t_koperasi_bulanan where bulan='$bulan' and tahun='$tahun'");
	}

	function jumlah_koperasi_mingguan($pawal, $pakhir)
	{
		return $this->db->query("select * from t_koperasi_mingguan where pawal='$pawal' and pakhir='$pakhir'");
	}

	function get_absen_bulanan($table)
	{
		return $this->db->get($table);
	}

	//datatables server side komponen gaji
	var $table = 'v_komp_gaji'; //nama tabel dari database
	var $column_order = array('noinduk', 'pendapatan', 'gp', 'tjab', 't3m', 't3e'); //field yang ada di table Barang
	var $column_search = array('noinduk', 'nama', 'gp', 'tjab', 't3m', 't3e'); //field yang diizin untuk pencarian 
	var $order = array('noinduk' => 'asc'); // default order 

	private function get_kompgaji_datatables_query()
	{

		$this->db->from($this->table);
		// $this->db->select('t_komp_gaji.noinduk,t_komp_gaji.pendapatan,t_karyawan.nama,t_komp_gaji.gp,t_komp_gaji.tjab,t_komp_gaji.t3m,t_komp_gaji.t3e');
		// $this->db->from($this->table);
		// $this->db->join('t_karyawan', 't_karyawan.noinduk=t_komp_gaji.noinduk');
		// $this->db->where('t_karyawan.saktif', '1');

		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_kompgaji_datatables()
	{
		$this->get_kompgaji_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->get_kompgaji_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	// akhir script server side komponen gaji

}	//Akhir script mymodel.php
