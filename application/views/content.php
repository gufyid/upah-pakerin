<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo base_url();?>">Home</a>
		</li>
		<?php
			if(isset($id))
				{
					if($id == "ganti_password")
					{
						echo "<li class=\"active\">Ganti Password</li>";
					}elseif($id == "brand")
					{
						echo "<li>Master</li>";
						echo "<li class=\"active\">Brand</li>";
					}
				}else{		
					echo "<li class=\"active\">Dashboard</li>";
				}	
		?>
	</ul><!-- /.breadcrumb -->

<!-- Search
	<div class="nav-search" id="nav-search">
		<form class="form-search">
			<span class="input-icon">
				<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
				<i class="ace-icon fa fa-search nav-search-icon"></i>
			</span>
		</form>
	</div><!-- /.nav-search -->
	
</div>

<div class="page-content">
	<?php
		if(isset($id)){
				if($id=='ganti_password')
				{
					$this->load->view('ganti_password1');					
				}elseif($id='brand')
				{
					$this->load->view('master/master_brand');
				}
			}else{		
			$this->load->view('dashboard');
			}
	?>		
</div><!-- /.page-content -->