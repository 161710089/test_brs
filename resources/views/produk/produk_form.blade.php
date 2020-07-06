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

        <form action="{{route('produk_create_action')}}" method="post">
          @csrf
          @if (request()->get('id'))
            <input type="hidden" name="id" value="{{request()->get('id')}}">
          @endif
				<table class='table table-bordered'>
					<tr>
						<td width='200'>Kode produk </td>
						<td><input type="text" class="form-control" name="kode_produk" id="kode_produk" placeholder="Kode produk" value="{{isset($produk) ? $produk->kode_produk : ''}}" /></td>
					</tr>
					<tr>
						<td width='200'>produk </td><td><input type="text" class="form-control" name="produk" id="produk" placeholder="produk" value="{{isset($produk) ? $produk->produk : ''}}" /></td>
					</tr>
          			<tr>
						<td width='200'>Harga </td>
						<td><input type="text" class="form-control rupiah" name="harga" id="harga" placeholder="Harga" value="{{isset($produk) ? $produk->harga : ''}}" /></td>
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
