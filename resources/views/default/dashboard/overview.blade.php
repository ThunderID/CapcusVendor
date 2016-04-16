@push('breadcrumb')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb white">
				<li><a href="{{route('dashboard')}}">CAPCUS.id</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div>
	</div>
</div>
@endpush

@push('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				
				<div class='card'>
					<div class='card-block'>
						<h3 class='card-title'>ISSUED VOUCHER VS VALIDATED VOUCHER</h3>
						<p class='card-text'>
							<div class="row">
								<div class='col-xs-12'>
									<canvas height='100' id="voucher_chart"></canvas>
								</div>
							</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endpush

@push('js')
	<script>
		$(document).ready(function(){
			var canvas = $('#voucher_chart').get(0).getContext("2d");
			var data = 	{
							labels: [{!! '"' . implode('","', array_keys($stats['issued_vouchers'])) . '"' !!}],
							datasets: [
								{
									label: "Issued Voucher",
									backgroundColor: "rgba(0,150,255,0.1)",
									borderColor: "rgba(0,150,225,1)",
									fillColor: "#f00",
									strokeColor: "#f00",
									pointColor: "#f00",
									pointStrokeColor: "#fff",
									pointHighlightFill: "#fff",
									pointHighlightStroke: "rgba(0,0,255,1)",
									data: [{{implode(',', $stats['issued_vouchers'])}}]
								},
								{
									label: "Validated Voucher",
									backgroundColor: "rgba(0,255,150,0.1)",
									borderColor: "rgba(0,225,150,1)",
									fillColor: "rgba(255,255,0,0.2)",
									strokeColor: "rgba(255,255,0,1)",
									pointColor: "rgba(255,255,0,1)",
									pointStrokeColor: "#fff",
									pointHighlightFill: "#fff",
									pointHighlightStroke: "rgba(255,255,0,1)",
									data: [{{implode(',', $stats['validated_vouchers'])}}]
								}
							]
						};
			var voucher_chart = new Chart(canvas, {
													type:'line', 
													data: data,
													options: {
																scales: {
																	yAxes: [{
																			ticks: {
																				beginAtZero:true
																			}
																		}]
																}
															}
												}
										);
		});

	</script>
@endpush