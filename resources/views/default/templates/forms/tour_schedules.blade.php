@if (!isset($field_name))


	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ $view_name }}</strong> Please set $field_name
	</div>


@else

	<a class='btn btn-primary-outline' data-toggle="modal" data-target="#modal_tour_schedule" data-capcus-display-target=".schedule-list" data-capcus-field-target="{{$field_name}}" href='javascript:;'><i class="fa fa-plus"></i> Add new</a>
	<input type='hidden' name='{{ $field_name }}' value='{{ old($field_name, json_encode($schedules)) }}'>
	<div class='schedule-list list-group mt-l'>
	</div>

	@push('modal')
		<div class="modal fade fullscreen-modal" id='modal_tour_schedule'>
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class='fa fa-close'></i></span>
						</button>
						<h4 class="modal-title" id='detail_title'>SCHEDULE</h4>
					</div>
					<div class="modal-body detail_content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6">
									<fieldset class="form-group">
										<label for="street">Departure <small class='text-primary'></small></label>
										{!! Form::text('departure', '', ['class' => 'form-control', 'data-inputmask' => "'mask':'d-m-y'"]) !!}
									</fieldset>
								</div>
								<div class="col-xs-6">
									<fieldset class="form-group">
										<label for="street">Atau Sebelum <small class='text-primary'></small></label>
										{!! Form::text('departure_until', '', ['class' => 'form-control', 'data-inputmask' => "'mask':'d-m-y'"]) !!}
									</fieldset>
								</div>
								<div class="col-xs-4">
									<fieldset class="form-group">
										<label for="city">Currency</label>
										{!! Form::select('currency', ['IDR' => 'IDR'], $x->currency, ['class' => 'c-select form-control']) !!}
									</fieldset>
								</div>
								<div class="col-xs-4">
									<fieldset class="form-group">
										<label for="price">Price</label>
										{!! Form::text('price', '', ['class' => 'form-control thousand-separator'])!!}
									</fieldset>
								</div>
								<div class="col-xs-12">
									Promo
									<div class='pull-xs-right'><a href='javascript:;' id='add-new-promo'><i class='fa fa-plus'></i> new promo</a></div>
									<div class="table-responsive">
										<table class="table table-hover" id='table-tour-schedule-promo'>
											<thead>
												<tr>
													<th>Promo</th>
													<th>Since</th>
													<th>Until</th>
													<th>Price</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								{!! Form::hidden('_modal_tour_schedule_edit_index') !!}
								<div class="col-xs-12 text-xs-right mt-l mb-l">
									<button type='button' class='btn btn-primary btn-block btn-add-schedule' id='submit'>Add</button>
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
		modal_tour_schedule.init();
	</script>
	@endpush
@endif