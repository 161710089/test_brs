@extends('template')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">SALES ORDER</h4>
	</div>
</div>
<div class="content-wrapper">
	<div class="row">
		<div class="white-box">
			<div class="box-header with-border">
				<h3 class="box-title">FORM SALES ORDER</h3>
			</div>

        <form action="{!! route('sales_order_create_action') !!}" method="post">
          @csrf
          @if (request()->get('id'))
            <input type="hidden" name="id" value="{{request()->get('id')}}">
          @endif
				<table class='table table-bordered'>
					<tr>
						<td width='200'>kode Sales Order</td>
						<td><input type="text" name="kode_sales_order" class="form-control" value="{{isset($kode_sales_order) ? $kode_sales_order : '' }}" id=""  readonly/></td>
					</tr>
					<tr>
						<td width='200'>Customer </td>
						<td>
							<select name="id_customer" class="form-control customer select2" id="customer">
								<!-- <option value="1">a</option> -->
							<select>
						</td>
					</tr>
                    <tr>
						<td width='200'>Tanggal </td>
						<td><input type="date" class="form-control" name="tanggal" id="tanggal"  value="{{isset($sales_order) ? $sales_order->tanggal : ''}}" /></td>
					</tr>
					<tr>
						<td width='200'>Total </td><td><input type="text" name="total" class="form-control rupiah" value="{{isset($sales_order) ? $sales_order->tanggal : ''}}" id="total"  readonly/></td>
					</tr>
                    <tr>
						<td></td>
						<td>
							<a class="btn btn-danger btn-submit"><i class="fa fa-floppy-o"></i> Simpan </a>
							<a href="#" class="btn btn-info btn-cancel"><i class="fa fa-sign-out"></i> Kembali </a>
						</td>
					</tr>
				</table>

				<div class="table-responsive" style="overflow-x:auto;">
					<table class="table table-bordered table-striped table-hover" id="mytable">
						<thead>
							<tr>
								<th width="10px" style="width:10px">No </th>
								<th width="3000px" style="width:3000px">Barang</th>
								<th width="10px" style="width:10px">Jml Pembelian</th>
								<th width="200px" style="width:200px">Harga Beli</th>
								<th width="200px" style="width:200px">Total Per barang</th>
								<th width="10px" style="width:10px" style="white-space: nowrap;">Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr id="foot1">
								<td></td>
								<td>
									<select name="id_produk" id="id_produk" style="min-width:200px" onChange="get_harga(this.closest('tr').id)" class="form-control id_produk"></select>
								</td>
								<td>
									<input type="text" name="kuantitas" data-class="kuantitas" class="form-control kuantitas" value="" id="kuantitas">
								</td>
								<td>
									<div class="input-group">
										<div class="input-group-addon">Rp.</div>
										<input type="text" id="harga" name="harga" style="min-width:150px" class="form-control harga">	
									</div>
								</td>
								<td>
									<div class="input-group">
										<div class="input-group-addon">Rp.</div>
										<input type="text" id="total_perbarang" name="total_perbarang" value="" style="min-width:150px" class="form-control total_perbarang " readonly>	
									</div>
								</td>
								<td>
									<button class="btn btn-danger btn-sm" id="addrow"><i class="fa fa-plus"></i></button>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="{!! asset('assets/datatables/jquery.dataTables.js')  !!}"></script>
<script src="{!! asset('assets/datatables/dataTables.bootstrap.js')  !!}"></script>
<script type="text/javascript" src="{!! asset('assets/jquery-mask/dist/jquery.mask.min.js') !!}"></script>
<script type="text/javascript">
	$('#total').mask('#.##0', {reverse: true});
	$('.harga').mask('#.##0', {reverse: true});
	$('.kuantitas').mask('#.##0', {reverse: true});
	$('.total_perbarang').mask('#.##0', {reverse: true});
</script>
<script src="{!! asset ('assets/adminlte/bower_components/select2/dist/js/select2.min.js') !!}	"></script>
<script type="text/javascript">
	
	var dataset = `{!! $detail_sales_order !!}`;
	if(dataset.length > 0){
		 dataset = JSON.parse(dataset);
	}

	$('#kode_sales_order').mask("AAB000",{placeholder: "Kode sales_order (exp : EXP001)", 'translation': {
		A:{pattern : /[A-Z]/},
		B:{pattern : /[A-Z0-9]/}
	}});

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
		var t = $("#mytable").DataTable(
		{
			data : dataset,
			columns: [
				{"data" : "id_detail_sales_order", "orderable" : false},
				{"data": "id_produk"},
				{"data": "kuantitas"},
				{"data": "harga"},
				{"data": "total_perbarang"},
				{
					"data" : "action",
					"orderable": false,
					"className" : "text-center"
				}
			],
			order: [[0, 'desc']],
			"columnDefs": [
				{ "width": "10px", "targets": 0 },
				{ "width": "3000px", "targets": 1 },
				{ "width": "10px", "targets": 2 },
				{ "width": "10px", "targets": 3 },
				{ "width": "1200px", "targets": 4 },
				{ "width": "1200px", "targets": 5 },
			],
			lengthMenu: [[-1], ["All"]],
			createdRow: function( row, data, dataIndex){
				$(row).attr('id', 'my' + dataIndex);
			},
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		}
		);

		$('#addrow').on('click', function(e){
			e.preventDefault();
			// sum_total();
			if(validate()){
				t.row.add(
					{
					"id_detail_sales_order" : "",
					"id_produk" : $('#id_produk option:selected').text() + '<input type="hidden" class="id_produk_validate" name="id_produk[]" value="'+$('#id_produk').val()+'" />',
					"kuantitas" : $('#kuantitas').val() + '<input type="hidden" name="kuantitas[]" class="kuantitas" value="'+$('#kuantitas').val()+'" />',
					"harga" : 'Rp. ' + $('#harga').val() + '<input type="hidden" name="harga[]" class="harga" value="'+$('#harga').val()+'" />',
					"total_perbarang" : 'Rp. ' + $('#total_perbarang').val() + '<input type="hidden" name="total_perbarang[]" class="total_perbarang" value="'+$('#total_perbarang').val()+'" />',
					"action" : '<button class="btn btn-danger btn-sm btn-remove-row"><i class="fa fa-minus"></i></button>'
					} 
					)
				.draw();
				$('#kuantitas').val('');
				$('#id_produk').val(null).trigger('change');
				$('#harga').val(0);
				$('#total_perbarang').val(0);
			}else{
				alert("Form Belum terisi dengan benar");
			}
			
		});

		$('#mytable tbody').on('click', 'button.btn-remove-row', function(e){
			e.preventDefault();
			var harga = parseFloat($(this).parents('tr').find('.harga').cleanVal());
			var kuantitas = parseFloat($(this).parents('tr').find('.kuantitas').cleanVal());
			var total = parseFloat($('#total').cleanVal());
			total -= harga * kuantitas;
			$('#total').val(total);
			$('#total').trigger('input');
			t.row($(this).parents('tr')).remove().draw();
		});

		$(document).on('keyup change','.kuantitas, .harga',function(){
			id_harga = $(this).parents('tr').find('.harga').attr('id');
			id_kuantitas = $(this).parents('tr').find('.kuantitas').attr('id');
			total_perbarang_id = $(this).parents('tr').find('.total_perbarang').attr('id');

			var val_kuantitas = $("#"+id_kuantitas).val();
			var val_harga_beli = $("#"+id_harga).val();
			if(val_kuantitas != '' && val_harga_beli != ''){
				var kuantitas = parseFloat($('#'+id_kuantitas).cleanVal());
				var harga = parseFloat($('#'+id_harga).cleanVal());
			}else{
				var kuantitas = 0;
				var harga = 0;
			}
			
			var total = 0;
			if(harga != 0 && kuantitas != 0 ){
				total_perbarang = (harga * kuantitas);
				$('#'+total_perbarang_id).val(total_perbarang);
				$('#'+total_perbarang_id).trigger('input');	
			}else{
				$("#"+total_perbarang_id).val(0);
				$('#'+total_perbarang_id).trigger('input');
			}

			$('.total_perbarang').each(function(k){
				total_perbarang = parseFloat($(this).cleanVal());
				// alert(total_perbarang);
				total += total_perbarang;
			})
			$("#total").val(total);
			$('#total').trigger('input');
		});

		function validate(){
			id_produk = $("#id_produk").val();
			kuantitas = $("#kuantitas").val();
			harga = $("#harga").val();
			if(!id_produk || !kuantitas || !harga ){
				return false;
			}else{
				return true;
			}
		}

		function validate_minimum(){
			var count = 0;
			$('.id_produk_validate').each(function(k){
				count += 1;
			})
			if(count <= 0 ){
				return false;
			}else{
				return true;
			}
		}

		$('.btn-submit').click((e) => {
			e.preventDefault();
			result = confirm("Apakah data sudah benar");
			if(result) {
				if(validate_minimum()){
					$('form').submit();
				}else{
					alert("Isi detail minimal 1 baris");
				}	
			}
		})

	});

	$('#customer').select2({
		ajax: {
			url: "{!! route('select2_customer') !!}",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'json',
			delay: 250,
			method: 'post',
			data: function (params) {
				return {
					search: params.term, // search term
					type: 'public',
				};
			},
			processResults: function (data) {
				return {
					results: data.results,
				};
			},
			cache: true
		},
		placeholder: 'Pilih Customer',
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 0
	});

	$('.id_produk').select2({
		ajax: {
			url: "{!! route('select2_produk') !!}",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'json',
			delay: 250,
			method: 'post',
			data: function (params) {
				return {
					search: params.term, // search term
					type: 'public',
				};
			},
			processResults: function (data) {
				return {
					results: data.results,
				};
			},
			cache: true
		},
		placeholder: 'Pilih Produk',
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 0
	});

	function get_harga(closest){
		var id_produk = $('#'+closest).find('.id_produk').attr('id'); 
		var val_produk = $("#"+id_produk).val();
	
		var data_produk = {
			'id_produk':val_produk
		}
		
		$.post('{{route("get_harga")}}', data_produk, function(response){
			console.log(response.harga_beli);
			var harga = $('#'+closest).find('.harga').attr('id');
			var kuantitas = $('#'+closest).find('.kuantitas').attr('id');
			var total_perbarang = $('#'+closest).find('.total_perbarang').attr('id'); 
			
			var val_harga = response.harga;
				val_harga = parseInt(val_harga);
	
				console.log(harga,val_harga)
	
				$('#'+harga).val(val_harga);
				$('#'+harga).trigger('input');
			
			val_total_perbarang = 0;
			var val_kuantitas = $("#"+kuantitas).val();
			var val_harga_beli = $("#"+harga).val();
			if(val_kuantitas != '' && val_harga_beli != ''){
				var parse_kuantitas = parseFloat($('#'+kuantitas).val());
				var parse_harga = parseFloat($('#'+harga).cleanVal());
			}else{
				var parse_kuantitas = 0;
				var parse_harga = 0;
			}
			
			var total = 0;
			if(parse_harga != 0 && parse_kuantitas != 0 ){
			val_total_perbarang = (parse_harga * parse_kuantitas);
				$('#'+total_perbarang).val(val_total_perbarang);
				$('#'+total_perbarang).trigger('input');	
			}else{
				$("#"+total_perbarang).val(0);
				$('#'+total_perbarang).trigger('input');
			}

			$('.total_perbarang').each(function(k){
				val_total_perbarang = parseFloat($(this).cleanVal());
				total += val_total_perbarang;
			})
			$("#total").val(total);
			$('#total').trigger('input');
		
		}, 'json');
		

	}
	
</script>
<script>
	$(() => {
		@if(!empty($sales_order))
			var newOption = new Option("{{$sales_order->customer}}", {{$sales_order->id_customer}}, true, false);
			$('#customer').val({{$sales_order->id_customer}});
			$('#customer').html(newOption);
		@endif
	});
</script>
@endsection
