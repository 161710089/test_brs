@extends('template')
@section('content')



<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	<h4 class="page-title">Dashboard</h4> </div>
	
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- ============================================================== -->
<!-- Different data widgets -->
<!-- ============================================================== -->
<!-- .row -->
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	<div class="row">
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-open"></i> Selamat Datang ! </h4>
        Selamat Datang dihalaman utama
    </div>
   </div>
</div>

<div class="row">
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Jumlah Produk</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash"></div>
				</li>
                <li class="text-right"><i class="ti-arrow-up text-success"></i> 
                    <span class="counter text-success">
                        {{$jumlah_produk}}
                    </span>
                </li>
			</ul>
		</div>
	</div>
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Jumlah Customer</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash2"></div>
				</li>
                <li class="text-right"><i class="ti-arrow-up text-purple"></i> 
                    <span class="counter text-purple">
                        {{$jumlah_customer}}
                    </span>
                </li>
			</ul>
		</div>
	</div>
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Jumlah Sales Order</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash3"></div>
				</li>
                <li class="text-right">
                    <i class="ti-arrow-up text-info"></i> 
                    <span class="counter text-info">
                        {{$jumlah_sales_order}}
                    </span>
                </li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Jumlah Sales Order 7 hari yang lalu ({{$tanggal_minggu_lalu}}) </h3>
            <canvas id="pie_sales" style="height: 305px;" height="-5000"></canvas>
            <div id="data_kosong_pie" style="padding:110px 0 0 0; height:304px; text-align:center; font-size:30px; display:none;">Belum ada data</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Jumlah Sales Order 7 hari yang lalu ({{$tanggal_minggu_lalu}}) </h3>
            <canvas id="line_sales" style="height: 305px;" height="-5000"></canvas>
            <div id="data_kosong_line" style="padding:110px 0 0 0; height:304px; text-align:center; font-size:30px; display:none;">Belum ada data</div>
        </div>
    </div>
</div>



<!-- ChartJS -->
<script src="{!! asset('assets/adminlte/bower_components/chart.js/Chart.js') !!}"></script>
<script src="{!! asset('assets/adminlte/bower_components/select2/dist/js/select2.min.js') !!}"></script>

<script>
    var pie_sales = `{!! $pie_sales !!}`;
    var bar_sales = `{!! $bar_sales !!}`;
    if(pie_sales.length > 0){
        pie_sales = JSON.parse(pie_sales);
    }

    $('#line_sales').hide();
    $('#data_kosong_line').show();
    
    
    if(bar_sales.length > 0){
        $('#line_sales').show();	
        $('#data_kosong_line').hide();
        bar_sales = JSON.parse(bar_sales);
    }
    var pieOptions     = {
		segmentShowStroke    : true,
		segmentStrokeColor   : '#fff',
		segmentStrokeWidth   : 2,
		percentageInnerCutout: 50, // This is 0 for Pie charts
		animationSteps       : 100,
		animationEasing      : 'easeOutBounce',
		animateRotate        : true,
		animateScale         : false,
		responsive           : true,
		maintainAspectRatio  : true,
		legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
	}

	$('.select2').select2();
    $('#pie_sales').hide();
    $('#data_kosong_pie').show();
    
    if(pie_sales.length > 0){ 
        $('#pie_sales').show();	
        $('#data_kosong_pie').hide();
        var pieChartCanvas = $('#pie_sales').get(0).getContext('2d')
        var ctx = document.getElementById("pie_sales");
        ctx.height = 100;
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = pie_sales

        pieChart.Doughnut(PieData, pieOptions);
    }

    var salesChartCanvas = $('#line_sales').get(0).getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var salesChart       = new Chart(salesChartCanvas);

    var areaChartOptions = {
       //Boolean - If we should show the scale at all
       showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
	}

    var salesChartOptions = {
        // Boolean - If we should show the scale at all
        showScale               : true,
        // Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        // String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        // Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        // Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        // Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        // Boolean - Whether the line is curved between points
     
        pointDot                : false,
        // Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        // Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        // Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        // Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        // Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        // String - A legend template
        legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        // Boolean - whether to make the chart responsive to window resizing
        responsive              : true
    };

    // Create the line chart
    var lineChartCanvas          = $('#line_sales').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(bar_sales, lineChartOptions)
    
</script>
@endsection
