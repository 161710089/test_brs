@extends('template')
@section('content')
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">MASTER SUPLIER</h4>
	</div>
</div>
<div class="content-wrapper">
	<div class="row">
		<div class="white-box">
			<div class="box-header with-border">
				<h3 class="box-title">FORM MASTER SUPLIER</h3>
			</div>

        <form action="{{route('suplier_create_action')}}" method="post">
          @csrf
          @if (request()->get('id'))
            <input type="hidden" name="id" value="{{request()->get('id')}}">
          @endif
				<table class='table table-bordered'>
                    <tr>
						<td width='200'>Kode Suplier </td>
						<td><input type="text" class="form-control" name="kode_suplier" id="kode_suplier" placeholder="Kode suplier" value="{{isset($suplier) ? $suplier->kode_suplier : ''}}" /></td>
					</tr>
                    <tr>
						<td width='200'>Suplier </td>
						<td><input type="text" class="form-control" name="suplier" id="suplier" placeholder="Nama suplier" value="{{isset($suplier) ? $suplier->suplier : ''}}" /></td>
					</tr>
					<tr>
						<td width='200'>Alamat </td><td><input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="{{isset($suplier) ? $suplier->alamat : ''}}" /></td>
					</tr>
                    <tr>
						<td width='200'>No Telepon </td>
						<td><input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="No.Telp" value="{{isset($suplier) ? $suplier->no_telepon : ''}}" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Simpan </button>
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

	$('#kode_suplier').mask("AAB000",{placeholder: "Kode Suplier (exp : EXP001)", 'translation': {
		A:{pattern : /[A-Z]/},
		B:{pattern : /[A-Z0-9]/}
	}});
</script>
@endsection
