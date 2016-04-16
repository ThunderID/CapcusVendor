@push('breadcrumb')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb white">
				<li><a href="{{route('dashboard')}}">Dashboard</a></li>
				@if ($is_validated_mode)
					<li class="active">Voucher (Validated Voucher)</li>
				@else
					<li class="active">Voucher (Issued Voucher)</li>
				@endif
			</ol>
		</div>
	</div>
</div>
@endpush

@push('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-5 col-md-4 pull-sm-right">
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
						<h5 class='card-title font-light'>VOUCHERS</h5>
						<ul class="nav nav-pills">
							<li class="nav-item ">
								<a class="nav-link {{ !$is_validated_mode ? 'active' : ''}}" href="{{ route('voucher.index')}}">Issued</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link {{ $is_validated_mode ? 'active' : ''}}" href="{{ route('voucher.index', ['sort' => 'latest-validated'])}}">Validated</a>
							</li>
						</ul>

						<p class='card-text'>
							<table class='table'>
								<thead>
									<tr>
										<!-- XS -->
										<td class='hidden-lg-up'>VOUCHER</td>
										<!-- LG -->
										<td class='hidden-md-down'>TGL</td>
										<td class='hidden-md-down'>KODE</td>
										<td class='hidden-md-down'>PAKET TOUR</td>
										<td class='hidden-md-down'>NOMINAL</td>
										<td class='hidden-md-down'>VALIDATED?</td>
										<td class='hidden-md-down'></td>
									</tr>
								</thead>
								<tbody>
									@forelse ($data as $issued_voucher)
										<tr>
											<!-- XS -->
											<td class='hidden-lg-up'>
												<p>
													<strong>{{$issued_voucher->code}}</strong>
													@foreach ($issued_voucher->tour->schedules as $schedule)
														@if (str_is($issued_voucher->schedule_id, $schedule->_id))
															@foreach ($schedule->vouchers as $voucher)
																@if (str_is($issued_voucher->voucher_id, $voucher->_id->{'$id'}))
																	<br>{{$schedule->currency}} {{ number_format($voucher->amount) }}
																	<br>Issued: {{\Carbon\Carbon::parse($issued_voucher->created_at)->format('d-M-Y [H:i]')}}
																	<br>Validasi: {{\Carbon\Carbon::parse($issued_voucher->validated_at)->format('d-M-Y [H:i]')}}
																@endif
															@endforeach
														@else
														@endif
													@endforeach
												</p>


												<p class='m-t-1'>
													<strong class='text-primary'>PAKET TOUR</strong>
													<br>{{ $issued_voucher->tour->name }}
													@foreach ($issued_voucher->tour->schedules as $schedule)
														@if (str_is($issued_voucher->schedule_id, $schedule->_id))
															<br>{{\Carbon\Carbon::parse($schedule->departure)->format('d-M-Y')}}
															@if ($issued_voucher->departure_until)
																s/d {{\Carbon\Carbon::parse($schedule->departure_until)->format('d-M-Y')}}
															@endif
														@endif
													@endforeach
												</p>

												<p class='m-t-1'>
													<strong class='text-primary'>PELANGGAN</strong>
													<br>{{$issued_voucher->user->name}}
													<br><i class='fa fa-fw fa-phone'></i> {{$issued_voucher->user->phone}}
													<br><i class='fa fa-fw fa-envelope'></i> {{$issued_voucher->user->email}}
												</p>
												
												<p>
													<a href='{{ route("voucher.detail", ['code' => $issued_voucher->code]) }}' class='btn btn-primary-outline btn-sm'>DETAIL <i class='fa fa-chevron-right'></i></a>
												</p>
											</td>
											<!-- LG -->
											<td class='hidden-md-down'>{{ \Carbon\Carbon::parse($issued_voucher->validated_at)->format('d-m-Y')}}</td>
											<td class='hidden-md-down'>
												{{ $issued_voucher->code }}
												<div class='text-primary'>
													<i class='fa fa-fw fa-user'></i> {{ $issued_voucher->user->name }}
													<br><i class="fa fa-fw fa-envelope"></i> 
													<br><i class="fa fa-fw fa-phone"></i> 
												</div>
											</td>
											<td class='hidden-md-down'>
												{{ $issued_voucher->tour->name }}
												@foreach ($issued_voucher->tour->schedules as $schedule)
													@if (str_is($issued_voucher->schedule_id, $schedule->_id))
														<div class='text-primary'>
															Keberangkatan: {{\Carbon\Carbon::parse($schedule->departure)->format('d-M-Y')}}
															@if ($issued_voucher->departure_until)
																s/d {{\Carbon\Carbon::parse($schedule->departure_until)->format('d-M-Y')}}
															@endif
														</div>
													@endif
												@endforeach
											</td>
											<td class='hidden-md-down'>
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
											</td>
											<td class='hidden-md-down'>
												@if ($issued_voucher->validated_at)
													<i class='fa fa-check text-success'></i> {{\Carbon\Carbon::parse($issued_voucher->validated_at)->format('d-m-Y [H:i]')}}
												@else
													-
												@endif
											</td>
											<td class='hidden-md-down'>
												<a href='{{ route("voucher.detail", ['code' => $issued_voucher->code]) }}' class='btn btn-primary-outline btn-sm'>DETAIL <i class='fa fa-chevron-right'></i></a>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan='5' align='center'>
											@if ($is_validated_mode)
												<i>Belum ada voucher yang divalidasi</i>
											@else
												<i>Belum ada voucher yang diissue</i>
											@endif
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</p>

						<p class='card-text'>
							{!! $pagination['paginator']->render(new \Illuminate\Pagination\BootstrapFourPresenter($pagination['paginator'])); !!}
						</p>
					</div>
				</div>		
			</div>
		</div>
	</div>
@endpush