@push('nav')
<nav class="navbar navbar-fixed-top navbar-light bg-faded white text-xs-center hidden-md-down">
	<a class="navbar-brand m-y-0 p-r-2" href="#">{{ Html::image('images/logo-black-small.png', 'Capcus.id', ['height' => 30]) }}</a>
	<ul class="nav navbar-nav p-l-2">
		<li class="nav-item {{ str_is('dashboard', $active_menu) ? 'active' : ''}}">
			<a class="nav-link" href="{{ route('dashboard') }}">DASHBOARD</a>
		</li>
		<li class="nav-item {{ str_is('voucher', $active_menu) ? 'active' : ''}}">
			<a class="nav-link" href="{{ route('voucher.index') }}">VOUCHER <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item  {{ str_is('user', $active_menu) ? 'active' : ''}}">
			<a class="nav-link" href="#">USER</a>
		</li>
	</ul>
	<ul class='nav navbar-nav pull-xs-right'>
		<li class="nav-item">
			<a class="nav-link" href="{{route('logout')}}"><i class='fa fa-logout'></i> LOGOUT</a>
		</li>
	</ul>
</nav>

<nav class="navbar navbar-fixed-top navbar-light bg-faded white text-xs-center hidden-lg-up">
	<div class="row">
		<div class="col-xs-12 text-xs-center">
			<a href="javascript:;" data-toggle="collapse" data-target="#menu-mobile" class='pull-left btn btn-menu-mobile'><i class='fa fa-th-large'></i></a>
			<a href="{{ route('dashboard') }}">{{ Html::image('images/logo-black-small.png', 'Capcus.id - Cari paket tour dari berbagai travel agent', ['style' => 'height:30px', 'class' => 'p-r-3'])}}</a>
		</div>
	</div>
</nav>
@endpush

@push('nav')
<nav class="navbar navbar-fixed-top navbar-dark bg-faded text-xs-center hidden-lg-up menu-mobile collapse" id='menu-mobile'>
	<ul class="nav navbar-nav">
		<li class="nav-item {{ str_is('dashboard', $active_menu) ? 'active' : ''}}">
			<a class="nav-link" href="{{ route('dashboard') }}">DASHBOARD</a>
		</li>
		<li class="nav-item {{ str_is('voucher', $active_menu) ? 'active' : ''}}">
			<a class="nav-link" href="{{ route('voucher.index') }}">VOUCHER <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item  {{ str_is('user', $active_menu) ? 'active' : ''}}">
			<a class="nav-link" href="#">USER</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('logout')}}"><i class='fa fa-logout'></i> LOGOUT</a>
		</li>
	</ul>
</nav>
@endpush

@push('alert')
	<div class="container-fluid">
		@if ($errors->count())
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				@foreach ($errors->messages() as $message)
					{{implode('<br>', $message)}}<br>
				@endforeach
			</div>
		@endif
		@foreach (['_alert_success', '_alert_danger', '_alert_warning', '_alert_info'] as $alert)
			@if ($$alert)
				<div class="row">
					<div class="col-xs-12">
						<div class="alert {{ str_replace('_', '-', substr($alert, 1)) }}">
							{!! nl2br($$alert) !!}
						</div>
					</div>
				</div>
			@endif
		@endforeach
	</div>
@endpush