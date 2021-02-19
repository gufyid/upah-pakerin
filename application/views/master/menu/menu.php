<?php
	error_reporting(0);
?>
<html>
<head>
<title></title>
	<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
	
</head>
<body>
<?php
echo $this->session->flashdata('pesan');
$menu = $this->db->query("select * from t_acl where induk='0' and status='1' order by id")->result_array();
if(isset($pengguna1))
{
	$menu_user = $this->db->query("select * from t_user_acl where user='$pengguna1'")->result_array();	
	$x=$pengguna1;
}else{
	$x="";
}
?>
<div class="page-header">
	
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		
		<div class="row">
				
			<div class="col-sm-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat widget-header-small">
						<h5 class="widget-title">
							<i class="ace-icon fa fa-user"></i>
							Managemen Menu User <?php echo $x;?>
						</h5>
					</div>

					<div class="widget-body">
						<div class="widget-main">
							<form class="form-horizontal"  method="POST" 
								action="<?php echo base_url();?>index.php/utama/menu_user/menu" enctype="multipart/form-data" />
								
								
								<div class="space-4"></div>
								<div class="form-group"></div>
								

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-2">User</label>
									<div class="col-sm-7">
										<select name="pengguna" id="pengguna"  class="col-xs-10 col-sm-5" onchange="javascript:submit()"/>
										<option value="">Pilih</option>
										<?php
											foreach($pengguna as $d)
											{	
												if($pengguna1 == $d['kode'])
												{
													echo "<option value=".$d['kode']. " selected=\"selected\">".$d['nama']."</option>";
												}else{
													echo "<option value=".$d['kode'].">".$d['nama']."</option>";
												}
											}
										?>
										</select>
										<span class="help-inline col-xs-12 col-sm-7">
										</span>
									</div>
								</div>
							</form>	
							<form class="form-horizontal"  method="POST" 
							action="<?php echo base_url();?>index.php/utama/simpan_menu" enctype="multipart/form-data" />
								<div class="form-group">
									<table class="table table-striped table-hover" id="table2">
										<thead>
										<?php
											echo "<tr>";
											$i=0;
										foreach($menu as $d)
										{
											$induk = $d['id'];
											$sub = $this->db->query("select * from t_acl where induk='$induk' and status='1' order by urut")->result_array();
											
											if($i>=4)
											{
												echo "<tr></tr>";
												$i=0;
											}
											$i++;
											
												
													echo "<td>";
													echo "<ul>";
														echo "<b>".$d['nama']."</b>";
													echo "</ul>";
													foreach($sub as $e)
													{
														$id_acl = $e['id'];
														if(isset($pengguna1))
														{
															$cek_menu = $this->db->query("select acl from t_user_acl where user='$pengguna1' and acl='$id_acl'")->result_array();
															
                                                                if($cek_menu){		
																$acl =$cek_menu[0]['acl'];																														
																	if($acl == $id_acl)
																	{
																		echo "<li>";
																			echo "<input type=checkbox name=menu[] value=$acl checked>&nbsp;".$e['nama'];
																		echo "</li>";																			
																	}else{
																		echo "<li>";
																			echo "<input type=checkbox name=menu[] value=$acl>&nbsp;$e[nama]";
																		echo "</li>";
																	}
																}else{
																	echo "<li>";
																			echo "<input type=checkbox name=menu[] value=$id_acl>&nbsp;$e[nama]";
																	echo "</li>";
																	}
														}
													}
														//hidden jumlah sub menu
														echo "<input type=hidden name=menuh[] value=$d[id]>";
													
													echo "</td>";
												
													
										}
											echo "</tr>";
										?>
										<input type="hidden" name="penggunah" value="<?php echo $x;?>">
										</thead>
									</table>
								</div>
								

								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" id="proses">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Proses
										</button>

										&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset" id="reset">
											<i class="ace-icon fa fa-undo bigger-110" ></i>
											Reset
										</button>
									</div>
								</div>	
							</form>
							<div class="hr hr8 hr-double"></div>

						<div class="x_title">
			
						</div>
						</div><!-- /.widget-main -->
					</div><!-- /.widget-body -->
				</div><!-- /.widget-box -->
			</div><!-- /.col -->
		</div><!-- /.row -->


		
		<div class="hr hr32 hr-dotted"></div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->

<script src="<?php echo base_url();?>./assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>./assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#table1').DataTable();
		});							
</script>
</body>
</html>
