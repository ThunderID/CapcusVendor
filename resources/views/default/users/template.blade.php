@section('pre_page')
@stop

@section('post_page')
@stop

@section('page_title')
	
@stop

@section('page_subtitle')
@stop

@section('page_action')
@stop


@push('content')
<div class="container-fluid">
	<div class="row">
		<!-- MENU -->
		<div class="col-xs-12 col-lg-3">
			@include('default.users.components.menu_card')
		</div>

		<!-- CONTENT -->
		<div class="col-xs-12 col-lg-9">
			{!! $page !!}
		</div>
	</div>
</div>
@endpush