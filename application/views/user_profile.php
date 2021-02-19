<html>
<head>
<title></title>
</head>
<body>
<?php
	$foto = $this->db->query("select foto from t_user where kode='$user'")->result_array();
	$nm_foto = $foto[0]['foto'];
?>
<li class="purple dropdown-modal">
<!--
	<a  class="dropdown-toggle" href="<?php echo base_url();?>./index.php/utama/panggil/chat">
		<i class="ace-icon fa fa-bell icon-animated-bell" alt="Chating"></i>
		<span class="badge badge-important">Chat</span>
	</a>
-->
	<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
		<li class="dropdown-header">
			<i class="ace-icon fa fa-exclamation-triangle"></i>
			&nbsp;	
		</li>
		<li class="dropdown-content">
			<ul class="dropdown-menu dropdown-navbar navbar-pink">
				<li>
					<a href="<?php echo base_url();?>./index.php/utama/panggil/chat">
						<div class="clearfix">
							<span class="pull-left">
								<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
								Conversation
							</span>
							<!--<span class="pull-right badge badge-info">+12</span>-->
						</div>
					</a>
				</li>

				
			</ul>
		</li>
	</ul>
</li>
<li class="light-blue dropdown-modal">
	<a data-toggle="dropdown" href="#" class="dropdown-toggle">
		<?php
			if($nm_foto){
		
		?>
			<img class="nav-user-photo" width = "36" src="<?php echo base_url();?>./gambar_user/<?php echo $nm_foto;?>" alt="user Photo" />
		<?php
			}else{
			
		?>
			<img class="nav-user-photo" src="<?php echo base_url();?>./gambar_user/nophoto.jpg" alt="user Photo" />		
		<?php
			}
		?>			
		<span class="user-info">
			<small>Welcome,</small>
			<?php
				echo $user;
			?>
		</span>

		<i class="ace-icon fa fa-caret-down"></i>
	</a>

	<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
		<!--
		<li>
			<a href="#">
				<i class="ace-icon fa fa-cog"></i>
				Settings
			</a>
		</li>
		-->
		<li>
			<a href="<?php echo base_url()."index.php/utama/panggil/ganti_password";?>">
				<i class="ace-icon fa fa-user"></i>
				Ganti Password
			</a>
		</li>

		<li class="divider"></li>
		
		<li>
			<a href="<?php echo base_url()."index.php/login/process_logout";?>">
				<i class="ace-icon fa fa-power-off"></i>
				Logout
			</a>
		</li>
	</ul>
</li>

	

</body>
</html>