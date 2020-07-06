@extends('template')
@section('content')
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">MASTER KATEGORI</h4>
	</div>
</div>
<div class="content-wrapper">
	<div class="row">
		<div class="white-box">
			<div class="box-header with-border">
				<h3 class="box-title">FORM MASTER KATEGORI</h3>
			</div>

        <form action="{{route('master_create_action')}}" method="post">
          @csrf
          @if (request()->get('id'))
            <input type="hidden" name="id" value="{{request()->get('id')}}">
          @endif
				<table class='table table-bordered'>
					<tr>
						<td width='200'>Customer </td>
						<td><input type="text" class="form-control" name="customer" id="customer" placeholder="Nama Customer" value="{{isset($customer) ? $customer->customer : ''}}" /></td>
					</tr>
					<tr>
						<td width='200'>Alamat </td>
						<td>
							<!-- <input type="text"  value="" /> -->
							<textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" >{{isset($customer) ? $customer->alamat : ''}}
							</textarea>
						</td>
					</tr>
          			<tr>
						<td width='200'>No Telepon </td>
						<td><input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="No.Telp" value="{{isset($customer) ? $customer->no_telepon : ''}}" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<a class="btn btn-danger btn-submit"><i class="fa fa-floppy-o"></i> Simpan </a>
							<a href="#" class="btn btn-info btn-cancel"><i class="fa fa-sign-out"></i> Kembali </a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="{!! asset('assets/jquery-mask/dist/jquery.mask.min.js') !!}"></script>
<script type="text/javascript">

	$('#no_telepon').mask('(+6200) 000-000-0000',{placeholder: "(+62__) ___-___-_____"});
	$('#kode_produk').mask("AAB000",{placeholder: "Kode produk (exp : EXP001)", 'translation': {
		A:{pattern : /[A-Z]/},
		B:{pattern : /[A-Z0-9]/}
	}});

	$('.btn-submit').click((e) => {
		e.preventDefault();
		result = confirm("Apakah data sudah benar");
		if(result) {
			$('form').submit();	
		}
	})
</script>
@endsection
