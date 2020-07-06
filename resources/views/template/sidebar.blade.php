

<div class="sidebar-nav slimscrollsidebar" style="width:100px;">
	<div class="sidebar-head">
		<h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
	</div>
	<ul class="nav" id="side-menu">
		<li style="padding: 70px 0 0;">
			<a href="{{route('home')}}"><i style='color: #fdc31a;' class="fa fa-clock-o fa-fw" aria-hidden="true"></i>DASHBOARD</a>
		</li>
		<?php
			$id_level = Auth::user()->id_level;
			$sql_menu = "SELECT * 
			FROM tbl_menu 
			WHERE id in(select id_menu from tbl_hak_akses where id_level=$id_level) and is_main_menu=0 and is_aktif='y'";
			$main_menu = DB::select($sql_menu);
			foreach ($main_menu as $menu) {
			
				$sql_sub_menu = "select * from tbl_menu where is_aktif='y' and is_main_menu=$menu->id";
				$submenu = DB::select($sql_sub_menu);
				if(count($submenu) > 0){
		?>
				<li style='font-size:12px;'> <a href="#" class="waves-effect"><?php echo "<i style='color: #fdc31a;' class='$menu->icon fa-fw'></i><span> ".strtoupper($menu->menu)."</span> "; ?><span class="fa arrow"></a>
					<ul class="nav nav-second-level">
						<?php foreach ($submenu as $sub){ 
							$this->db->where('is_aktif',"y");
							$this->db->where('is_main_menu',$sub->id);
						?>	
							<li><?php echo anchor($sub->url,"<i style='color: #fdc31a;' class='".$sub->icon." fa-fw'></i></font> ".strtoupper($sub->menu)); ?></li>
						<?php } ?>
					</ul>
				</li>
		<?php 
			} else{
		?>
				<li>
					<a href="{{route($menu->url) }}">
						<i style='color: #fdc31a;' class='{{$menu->icon}} fa-fw'></i>
						<?= $menu->menu ?>
					</a>
				
		<?php
			}
		}
		?>
		<li>
			<a class="dropdown-item" href="{{ route('logout') }}"
				onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
				<i style='color: #fdc31a;' class='fa fa-sign-out fa-fw'></i> LOGOUT
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</li>
	</ul>
	<div class="center p-20">
	</div>
</div>
