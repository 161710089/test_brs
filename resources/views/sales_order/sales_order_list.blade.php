@extends('template')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	   <h4 class="page-title">{{$label}}</h4>
	</div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="white-box">
      	<h3 class="box-title">{{$label}}</h3>
		<div style="padding-bottom: 10px;">
			<a href="{{route('sales_order_create')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" id="mytable">
				<thead>
					<tr>
						<th width="30px">No</th>
						<th>Customer</th>
						<th>Tanggal</th>
						<th>Total</th>
						<th width="200px">Action</th>
					</tr>
				</thead>
			</table>
		</div>
  	</div>
</div>

<script src="{!! asset('assets/datatables/jquery.dataTables.js') !!}"></script>
<script src="{!! asset('assets/datatables/dataTables.bootstrap.js') !!}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var t = $("#mytable").dataTable({
			initComplete: function() {
			var api = this.api();
			$('#mytable_filter input')
			.off('.DT')
				.on('keyup.DT', function(e) {
					if (e.keyCode == 13) {
					api.search(this.value).draw();
					}
				});
			},
			oLanguage: {
			sProcessing: "loading..."
			},
			ajax: {"url": "{{route('json_sales_order')}}", "type": "POST" },
			columns: [
			{
				"data": "id",
				"orderable": false
			},
			{"data": "customer"},
			{"data": "tanggal" , render:(data, meta, row) => {
				return format_date_id(data);
			}},
			{"data": "total" , render:(data, meta, row) =>  {
				data = parseFloat(data);
				return '<span class="">Rp. '+ numeral(data).format('0,0.[00]') +'</span>';
			}},
			{
				"data" : "action",
				"orderable": false,
				"className" : "text-center"
			}
			],
			order: [[0, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});
	});
	</script>

@endsection
