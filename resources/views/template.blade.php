<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" type="image/png" sizes="16x16" href="{!! asset('admin/plugins/images/IC-J.png') !!}">
		<title>SISTEM PEMESANAN MAKANAN</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="{!! asset('assets/jquery-ui/themes/base/jquery-ui.css') !!}">
		<link href="{!! asset('admin/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
		<!-- Menu CSS -->
		<link href="{!! asset('admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
		<!-- toast CSS -->
		<link href="{!! asset('admin/plugins/bower_components/toast-master/css/jquery.toast.css') !!}" rel="stylesheet">
		<!-- morris CSS -->
		<link href="{!! asset('admin/plugins/bower_components/morrisjs/morris.css') !!}" rel="stylesheet">
		<!-- chartist CSS -->
		<link href="{!! asset('admin/plugins/bower_components/chartist-js/dist/chartist.min.css') !!}" rel="stylesheet">
		<link href="{!! asset('admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') !!}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{!! asset('assets/adminlte/bower_components/select2/dist/css/select2.min.css') !!}">
		<link rel="stylesheet" type="text/css" href="{!! asset('login2/fonts/font-awesome-4.7.0/css/font-awesome.css') !!}">
		<!-- animation CSS -->
		<link href="{!! asset('admin/css/animate.css') !!}" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="{!! asset('admin/css/style.css') !!}" rel="stylesheet">
		<link href="{!! asset('admin/css/custom.css') !!}" rel="stylesheet">
		<!-- color CSS -->
		<link href="{!! asset('admin/css/colors/default.css" id="theme') !!}" rel="stylesheet">
		<link href="{!! asset('assets/css/custom_select2.css') !!}" rel="stylesheet">

		<link rel="stylesheet" href="{!! asset('assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
		<script src="{!! asset('admin/plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
		<script src="{!! asset('admin/bootstrap/dist/js/bootstrap.js') !!}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<link href="{!! asset('assets/css/material_yellow.css') !!}" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Sniglet:400,800&display=swap&subset=latin-ext" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

		<style>
				.fa-stack[data-count]:after{
					position:absolute;
					right:0%;
					top:1%;
					content: attr(data-count);
					font-size:40%;
					padding:.6em;
					border-radius:999px;
					line-height:.75em;
					color: white;
					background:rgba(255,0,0,.85);
					text-align:center;
					min-width:1em;
					font-weight:bold;
				}

				.center-things {
					height: 50px;
					top: 50%
					position: relative;
				}
				.center-things p {
					margin: 0;
					background: none;
					position: relative;
					top: 50%;
					left: 50%;
					/* margin-right: 50%; */
					transform: translate(-50%, -50%);
				}
				.borderless td, .borderless th {
					border: none !important;
				}
		</style>




	</head>
	<body class="fix-header">
		<div id="wrapper">

			<nav class="navbar navbar-default navbar-static-top m-b-0">
				<div class="navbar-header">
					<div class="top-left-part">
						<!-- Logo -->
						<a id="logo" class="logo" onClick="sidebar_open()" href="#">
							<!-- Logo icon image, you can use font-icon also -->
							<b>
								<!--This is dark logo icon-->
								<!-- <img src="{!! asset('admin/plugins/images/logo_brand.png') !!}" width="24" height="24" alt="home" class="dark-logo" /> -->
								<!--This is light logo icon-->
								<img src="{!! asset('admin/plugins/images/logo_label.png') !!}" width="39" height="50" alt="home" class="light-logo" />
							</b>
							<!-- Logo text image you can use text also -->
							<span class="hidden-xs">
								<!--This is light logo text-->
								<img src="{!! asset('admin/plugins/images/logo_brand.png') !!}" width="180" height="50" alt="home" class="light-logo" />
							</span>
						</a>
					</div>
					<!-- /Logo -->
					<ul class="nav navbar-top-links navbar-right pull-right">
						<li>
							<a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
						</li>
						<li>

						</li>

							<li>
								{{-- <a class="profile-pic" href="#"> <img src="{!! asset('assets/foto_profil/<?php echo $session->userdata('images'); ?>') !!}" alt="user-img"  style="object-fit: cover;height: 40px;width: 40px;" class="img-circle"><b class="hidden-xs"> <?php echo $session->userdata('full_name'); ?> </b></a> --}}
						</li>
					</ul>
				</div>
				<!-- /.navbar-header -->
				<!-- /.navbar-top-links -->
				<!-- /.navbar-static-side -->
			</nav>

            <!-- Left side column. contains the logo and sidebar -->
			<div class="navbar-default sidebar" id="sidebar" role="navigation">
          @include('template.sidebar')
			</div>
			<div id="page-wrapper">
				<div class="container-fluid">
        	@yield('content')
				</div>
			</div>


		</div>
		<footer class="footer text-center"> <?php echo date("Y"); ?> &copy; JEERA POS OFFICE </footer>
	</div>
	<div class="modal fade" id="modal_setting_jurnal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-dynamic" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>

            </div>
        </div>
	</div>

	<div class="modal modal-md fade" id="dynamicModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-dynamic" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>


	<script src="{!! asset('assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') !!}"></script>
	<!-- FastClick -->
	<script src="{!! asset('assets/adminlte/bower_components/fastclick/lib/fastclick.js') !!}"></script>
	<!-- AdminLTE App -->
	<!-- Select2 -->

	<!-- Addon script -->
	<script src="{!! asset('assets/js/autoNumeric.js') !!}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
  	<script src="{!! asset('admin/js/custom.js') !!}"></script>
	<script src="{!! asset('admin/plugins/bower_components/toast-master/js/jquery.toast.js') !!}"></script>
	<script src="{!! asset('assets/js/jquery.blockUI.js') !!}"></script>
	<script src="{!! asset('assets/js/sweetalert2.all.min.js') !!}"></script>
	<script src="{!! asset('assets/adminlte/bower_components/select2/dist/js/select2.full.min.js') !!}"></script>
	<script>

  	$('.select_2').select2();

  	 @php
      $msg = Session::get('msg');
      $msgs = json_decode($msg);
     @endphp
     console.log('{{$msg}}');
     @if(!empty($msg))
  	    $.toast({
  				heading: 'Notif!',
  				text: '{{$msgs->pesan}}',
  				position: 'top-right',
  				loaderBg: '#fff',
  				icon: '{{$msgs->type}}',
  				hideAfter: 10000,
  				stack: 6
  			});
   	  @endif

  	// load a locale
  	numeral.register('locale', 'id', {
  		delimiters: {
  			thousands: '.',
  			decimal: ','
  		},
  		currency: {
  			symbol: 'Rp.'
  		}
  	});
  	// switch between locales
  	numeral.locale('id');
	</script>
	<script>
		function Paginator(items, page, per_page) {
			var page = page || 1,
			per_page = per_page || 10,
			offset = (page - 1) * per_page,
			paginatedItems = items.slice(offset).slice(0, per_page),
			total_pages = Math.ceil(items.length / per_page);
			return {
			page: page,
			per_page: per_page,
			pre_page: page - 1 ? page - 1 : null,
			next_page: (total_pages > page) ? page + 1 : null,
			total: items.length,
			total_pages: total_pages,
			data: paginatedItems
			};
		}


	</script>
	<script>
			function sidebar_open() {
				var sidebar = document.getElementById("sidebar");
				var page_wrapper = document.getElementById("page-wrapper");

				sidebar.style.left = "0";
				page_wrapper.style.marginLeft = "240px";

				$("#logo").attr('onclick','sidebar_close()');
			}

			function sidebar_close() {
				var sidebar = document.getElementById("sidebar");
				var page_wrapper = document.getElementById("page-wrapper");

				sidebar.style.left = "240px;";
				page_wrapper.style.marginLeft = "0";

				$("#logo").attr('onclick','sidebar_open()');
				$("#sidebar").css('left','-240px');
			}

			$('.btn-cancel').click(() => {
				window.history.back();
			})
		</script>
</body>
</html>
