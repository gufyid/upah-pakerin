<li class="active">
	<a href="<?php echo base_url(); ?>">
		<i class="menu-icon fa fa-tachometer"></i>
		<span class="menu-text"> Dashboard</span>
	</a>

	<b class="arrow"></b>
</li>
<?php
$induk = $this->db->query("select y.induk,b.nama from 
								(select a.*,b.nama,b.id,b.induk from t_user_acl a
								 join t_acl b on b.id=a.acl
								where a.user='$user' and status='1') as y 
								left join t_acl b on b.id=y.induk
								where b.status='1'
								group by y.induk order by b.urut")->result_array();
foreach ($induk as $d) {
	$id_induk = $d['induk'];
	if ($id_induk == '1') {
		$fa = "fa-desktop";
	} elseif ($id_induk == '13') {
		$fa = "fa-users";
	} elseif ($id_induk == '21') {
		$fa = "fa-money";
	} elseif ($id_induk == '25') {
		$fa = "fa-users";
	} elseif ($id_induk == '29') {
		$fa = "fa-check-square";
	} elseif ($id_induk == '74') {
		$fa = "fa-bar-chart";
	} elseif ($id_induk == '35') {
		$fa = "fa-book";
	} elseif ($id_induk == '18') {
		$fa = "fa-money";
	} elseif ($id_induk == '84') {
		$fa = "fa-question-circle";
	}
	$anak = $this->db->query("select a.*,b.acl,b.nama from t_user_acl a
							 join t_acl b on b.id=a.acl
							 where a.user='$user' and b.induk='$id_induk' and b.status='1' order by urut")->result_array();

	echo "<li class=\"\">";
	echo "<a href=\"#\" class=\"dropdown-toggle\">";
	echo "<i class=\"menu-icon fa $fa\"></i>";
	echo "<span class=\"menu-text\">";
	echo $d['nama'];
	echo "</span>";
	echo "<b class=\"arrow fa fa-angle-down\"></b>";
	echo "</a>";
	echo "<b class=\"arrow\"></b>";
	foreach ($anak as $e) {
		if ($e['acl'] == "batas") {
			echo "<ul class=\"submenu\">";
			echo "<li class=\"\">";
			echo "<a href='#'>";
			echo "<i class=\"menu-icon fa fa-caret-right\"></i>";
			echo "" . $e['nama'];
			echo "</a>";
			echo "<b class=\"arrow\"></b>";
			echo "</li>";
			echo "</ul>";
		} else {
			echo "<ul class=\"submenu\">";
			echo "<li class=\"\">";
			echo "<a href=" . base_url() . "index.php/utama/panggil/$e[acl]>";
			echo "<i class=\"menu-icon fa fa-caret-right\"></i>";
			echo $e['nama'];
			echo "</a>";
			echo "<b class=\"arrow\"></b>";
			echo "</li>";
			echo "</ul>";
		}
	}
	echo "</li>";
}
?>