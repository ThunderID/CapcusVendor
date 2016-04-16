@push('content')
	<div class='jumbotron text-xs-center'>
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-md-offset-4 col-md-4">
				<img src='{{ asset('images/logo-black-small.png') }}' class='img-fluid'>

				<!-- ERROR -->
				@if ($errors->count())
					<div class="alert alert-danger m-t-2">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						@foreach ($errors->messages() as $message)
							{{implode('<br>', $message)}}<br>
						@endforeach
					</div>
				@endif

				{!! Form::open(['url' => route('login.post')]) !!}
				{!! Form::text('username', '', ['class' => 'form-control m-t-2 m-b-1', 'placeholder' => 'username']) !!}
				{!! Form::password('password', ['class' => 'form-control m-b-1', 'placeholder' => 'password']) !!}
				{!! Form::submit('Login', ['class' => 'btn btn-primary btn-block text-uppercase']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endpush