@if (!isset($field_name))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ $view_name }}</strong> Please set $field_name
	</div>
@else
	<fieldset class="form-group">
		<label for="name">Contact Person</label>
		<table class="table table-hover" id='table-cp'>
			<thead>
				<tr>
					<th width='5'></th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan='4'><a class='btn btn-primary-outline' data-toggle='modal' data-target='#modal_cp' data-table-container='#table-cp' data-field-result='{{$field_name}}'><i class='fa fa-plus'></i></a></td>
				</tr>
			</tbody>
			<tfoot>
				<tr ><td colspan='8'>&nbsp;</td></tr>
			</tfoot>
		</table>
	</fieldset>

	@push('modal')
	<div class="modal fade fullscreen-modal" id='modal_cp'>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class='fa fa-close'></i></span>
					</button>
					<h4 class="modal-title" id='detail_title'>Contact Person</h4>
				</div>
				<div class="modal-body detail_content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12">
								<fieldset class="form-group">
									<label for="name">Name</label>
									<input name="name" type="text" class="form-control" id="name" placeholder="">
								</fieldset>
							</div>
							<div class="col-xs-12">
								<fieldset class="form-group">
									<label for="province">Phones <small class='text-primary'>(One per row)</small></label>
									<textarea name="phones" class='form-control' rows='4'></textarea>
								</fieldset>
							</div>
							<div class="col-xs-12">
								<fieldset class="form-group">
									<label for="email">Email</label>
									<input name="email" type="text" class="form-control" id="email" placeholder="">
								</fieldset>
							</div>
							<div class="col-xs-12 text-xs-right mt-l mb-l">
								<button type='button' class='btn btn-primary btn-block btn-add-cp'>Add</button>
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
		var modal_cp = new function() { 
			this.modal = $('#modal_cp');
			this.caller = null;

			this.listen = function() {
					// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
					// LISTEN WHEN MODAL IS SHOWING
					// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
					this.modal.on('show.bs.modal', function(e){
						// Get Caller
						modal_cp.getCaller($(e.relatedTarget));
					});

					// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
					// LISTEN WHEN MODAL IS SHOWN
					// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
					this.modal.on('shown.bs.modal', function(e){
						// Set focus
						modal_cp.autofocus();

						// Load if editing
						modal_cp.loadForm();
					});

					// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
					// LISTEN WHEN ADD BUTTON IS CLICKED
					// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
					this.modal.find('.btn-add-cp').on('click', function(e) {
						// Add address to table
						modal_cp.addCP();
					});
				};

				this.getCaller = function(caller) { 
					this.caller = caller;
				};

				this.autofocus = function() {
					this.modal.find('input[name=name]').focus();
				}

				this.loadForm = function(){
					var value_field = this.caller.siblings('input[name="' + this.caller.data('field-result') + '[]"]');
					var value;
					if (value_field.length)
					{
						// PARSE VALUE
						value = JSON.parse(value_field.val());

						// FILL Form
						this.modal.find('input[name=name]').val(value.name);
						this.modal.find('textarea[name=phones]').val(value.phones);
						this.modal.find('input[name=email]').val(value.email);
					}
				}

				this.addCP = function() {
					// GET ALL DATA
					var submitted = {
						name 		: this.modal.find('input[name=name]').val(),
						phones 		: this.modal.find('textarea[name=phones]').val(),
						email 		: this.modal.find('input[name=email]').val()
					};

					// VALIDATE

					// APPEND ADDRESS INFO TO ADDRESS
					table = $(this.caller.data('table-container'));
					if (this.caller.siblings('input[name="' + this.caller.data('field-result') + '[]"]').val())
					{
						this.caller.siblings('input[name="' + this.caller.data('field-result') + '[]"]').val(JSON.stringify(submitted));
						if (this.caller.parent().siblings('td').length)
						{
							// 
							this.caller.parent().siblings('td:eq(0)').html(submitted.name);
							this.caller.parent().siblings('td:eq(1)').html(submitted.phones);
							this.caller.parent().siblings('td:eq(2)').html(submitted.email);
						}
					}
					else
					{
						table.find('tbody').append('<tr>' + 
							'<td>' + '<input type="hidden" name="'+ this.caller.data('field-result') +'[]" value=\''+ JSON.stringify(submitted) +'\'>' + 
							'<button type="button" class="btn btn-primary-outline" data-toggle="modal" data-target="#modal_cp" data-table-container="'+ this.caller.data('table-container') +'" data-field-result="{{$field_name}}"><i class="fa fa-pencil"></i></td>' + 
							'<td>' + submitted.name + '</td>' + 
							'<td>' + submitted.phones + '</td>' + 
							'<td>' + submitted.email + '</td>' + 
							'</tr>');
					}

					// CLEAR FORM
					this.modal.find('input[name=name]').val('');
					this.modal.find('textarea[name=phones]').val('');
					this.modal.find('textarea[name=email]').val('');

					// HIDE MODAL
					this.modal.modal('hide');
				};
			}

			modal_cp.listen();
		</script>
	@endpush
@endif