@if (!isset($field_name))


	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ $view_name }}</strong> Please set $field_name
	</div>


@else

	<a class='btn btn-primary-outline' data-toggle="modal" data-target="#modal_address" data-capcus-display-target=".address-list" data-capcus-field-target="{{$field_name}}" href='javascript:;'><i class="fa fa-plus"></i> Add new</a>
	
	<div class='address-list list-group mt-l'>
		@forelse ($data as $k => $x)
			<div class='list-group-item'>
				<a href='#' data-capcus-action='delete-address-list-item' class='pull-right btn btn-link'><i class='fa fa-remove'></i></a>
				<input type="hidden" name="{{ $field_name }}[]" value="{{ json_encode($x) }}">
				<div class='text-muted'>ADDRESS {{$k + 1}}</div>
				{{$x->street}}
				<br>{{$x->city}}, {{$x->province}}, {{$x->country}}
				
				<br><i class='fa fa-phone mr-m'></i>
				{{ implode(", ", $x->phones)}}

				<br><i class='fa fa-envelope mr-m'></i>
				{{$x->email}}
				<p class='mt-s'><a data-toggle="modal" data-target="#modal_address" data-capcus-data="{{json_encode((array)$x)}}" data-capcus-display-target=".address-list" data-capcus-field-target="{{$field_name}}" data-capcus-data-id="{{($x->_id->{'$id'})}}" href='javascript:;'><i class="fa fa-pencil"></i> Edit</a></p>
			</div>
		@empty
		@endforelse
	</div>

	@push('modal')
		<div class="modal fade fullscreen-modal" id='modal_address'>
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class='fa fa-close'></i></span>
						</button>
						<h4 class="modal-title" id='detail_title'>Address</h4>
					</div>
					<div class="modal-body detail_content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12">
									<fieldset class="form-group">
										<label for="street">Street</label>
										<input name="street" type="text" class="form-control" id="street" placeholder="">
									</fieldset>
								</div>
								<div class="col-xs-4">
									<fieldset class="form-group">
										<label for="city">City</label>
										<input name="city" type="text" class="form-control" id="city" placeholder="">
									</fieldset>
								</div>
								<div class="col-xs-4">
									<fieldset class="form-group">
										<label for="province">Province</label>
										<input name="province" type="text" class="form-control" id="province" placeholder="">
									</fieldset>
								</div>
								<div class="col-xs-4">
									<fieldset class="form-group">
										<label for="country">Country</label>
										<input name="country" type="text" class="form-control" id="country" placeholder="">
									</fieldset>
								</div>
								<div class="col-xs-12">
									<fieldset class="form-group">
										<label for="phones">Phones <small class='text-primary'>(One per row)</small></label>
										<textarea name="phones" class='form-control' rows='4'></textarea>
									</fieldset>
								</div>
								<div class="col-xs-12">
									<fieldset class="form-group">
										<label for="email">Email</label>
										<input type='text' name="email" class='form-control'></textarea>
									</fieldset>
								</div>
								{!! Form::hidden('address_id') !!}
								<div class="col-xs-12 text-xs-right mt-l mb-l">
									<button type='button' class='btn btn-primary btn-block btn-add-address' id='submit'>Add</button>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	@endpush

	@push('js')
	<script>
		modal_address.init();
	</script>
	@endpush
@endif