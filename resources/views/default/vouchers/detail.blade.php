@push('breadcrumb')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb white">
				<li><a href="{{route('dashboard')}}">Dashboard</a></li>
				<li><a href="{{route('voucher.index')}}">Voucher</a></li>
				<li class="active">Voucher: {{$issued_voucher->code}}</li>
			</ol>
		</div>
	</div>
</div>
@endpush

@push('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-5 col-md-4 pull-sm-right hidden-sm-down">
				<div class='card'>
					<div class='card-block'>
						<h5 class='card-title font-light'>VALIDASI VOUCHER</h5>
						<p class='card-text'>
							{!! Form::open(['url' => route('voucher.validate'), 'method' => 'post']) !!}
							{!! Form::text('kode', '', ['class' => 'form-control', 'placeholder' => 'masukkan kode voucher']) !!}
							{!! Form::submit('VALIDASI', ['class' => 'btn btn-primary btn-block m-t-1']) !!}
							{!! Form::close() !!}
						</p>
					</div>
				</div>		
			</div>
			<div class="col-xs-12 col-sm-7 col-md-8">
				<div class='card'>
					<div class='card-block'>
						<h5 class='card-title font-light'>
							<a href='{{Session::get('previous') ? Session::get('previous') : route('voucher.index')}}' class='btn btn-primary-outline btn-sm m-r-1'><i class='fa fa-chevron-left'></i></a>
							VOUCHER: {{$issued_voucher->code}}
						</h5>

						<hr>
						</h5>
						<div class="row">
							<div class="col-xs-12 col-md-3">
								<span class='text-primary'>PELANGGAN</span>
							</div>
							<div class='col-xs-12 col-md-9'>
								{{$issued_voucher->user->name}}
								<br><i class='fa fa-fw fa-phone'></i> {{$issued_voucher->user->phone}}
								<br><i class='fa fa-fw fa-envelope'></i> {{$issued_voucher->user->email}}
							</div>
							<div class='col-xs-12'><hr></div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-3">
								<span class='text-primary'>PAKET TOUR</span>
							</div>
							<div class='col-xs-12 col-md-9'>
								{{$issued_voucher->tour->name}}
								
								<br><i class='fa fa-fw fa-plane'></i> 
								@foreach ($issued_voucher->tour->schedules as $schedule)
									@if (str_is($issued_voucher->schedule_id, $schedule->_id))
										{{\Carbon\Carbon::parse($schedule->departure)->format('d-M-Y')}}
										@if ($issued_voucher->departure_until)
											s/d {{\Carbon\Carbon::parse($schedule->departure_until)->format('d-M-Y')}}
										@endif
									@endif
								@endforeach
								
								<br><i class='fa fa-fw fa-money'></i>
								@foreach ($issued_voucher->tour->schedules as $schedule)
									@if (str_is($issued_voucher->schedule_id, $schedule->_id))
										@foreach ($schedule->vouchers as $voucher)
											@if (str_is($issued_voucher->voucher_id, $voucher->_id->{'$id'}))
												{{$schedule->currency}} {{ number_format($voucher->amount) }}
											@endif
										@endforeach
									@else
									@endif
								@endforeach

								<br><i class='fa fa-fw fa-calendar'></i> Issued At: {{\Carbon\Carbon::parse($issued_voucher->created_at)->format('d-m-Y [H:i]')}}
								<br><i class='fa fa-fw fa-calendar'></i> Validated At: {{$issued_voucher->validated_at ? \Carbon\Carbon::parse($issued_voucher->validated_at)->format('d-m-Y [H:i]') : '-'}}
							</div>
						</div>



					</div>
				</div>		
			</div>
		</div>
	</div>
@endpush