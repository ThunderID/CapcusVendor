{!! Form::open(['url' => route('admin.store', ['id' => $data->_id]) ]) !!}
<div class="card">
	<div class="card-block">

		<h4 class="card-title">
			{{$data->_id ? $data->name : 'New Admin'}}
		</h4>
		<hr>

		<!-- MENU -->
		<a href="{{ $data->_id ? route('admin.show', ['id' => $data->_id]) : route('articles')  }}" class='btn btn-primary-outline' ><i class='fa fa-chevron-left'></i> Back</a>
		<button type='submit' class='btn btn-primary-outline pull-right'><i class='fa fa-save'></i> Save</button>
		<hr class='thick' >

		<div class='accordion' id="detail-accordion">
			<!-- TAB -->
			<ul class="nav nav-tabs m-b-2" id='detail-menu '>
				<li class="nav-item">
					<a class="nav-link active" href="#" data-toggle='collapse' data-parent='#detail-accordion' data-target='#collapse-summary'>User Data</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle='collapse' data-parent='#detail-accordion' data-target='#collapse-auth'>Password</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle='collapse' data-parent='#detail-accordion' data-target='#collapse-role-dashboard'>Dashboard Access</a>
				</li>
			</ul>

			<!-- Travel Agent -->
			<div class='collapse in' id='collapse-summary'>
				<fieldset class="form-group">
					<label for="name">Name</label>
					{!! Form::text('name', $data->name, ['class' => 'form-control']) !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="name">Gender</label>
					{!! Form::select('gender', ['' => '', 'pria' => 'Pria', 'wanita' => 'Wanita'], $data->gender, ['class' => 'c-select form-control']) !!}
				</fieldset>


				<fieldset class="form-group">
					<label for="name">Email</label>
					{!! Form::text('email', $data->email, ['class' => 'form-control']) !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="name">Phone</label>
					{!! Form::text('phone', $data->phone, ['class' => 'form-control']) !!}
				</fieldset>
				
				<fieldset class="form-group">
					<label for="name">DoB</label>
					{!! Form::text('dob', $data->dob ? \Carbon\Carbon::parse($data->dob)->format('d-m-Y') : '', ['class' => 'form-control', 'data-inputmask' => "'mask':'d-m-y'"]) !!}
				</fieldset>
			</div>

			<!-- Auth -->
			<div class='collapse' id='collapse-auth'>
				<fieldset class="form-group">
					<label for="name">Password</label>
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="name">Confirm Password</label>
					{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
				</fieldset>
			</div>

			<!-- Auth -->
			<div class='collapse' id='collapse-role-dashboard'>
				<fieldset class="form-group">
					<p>{!! Form::checkbox('dashboard_tour_management', true, $data->auth->dashboard->tour) !!} Tour Management</p>
					<p>{!! Form::checkbox('dashboard_blog_management', true, $data->auth->dashboard->blog) !!} Blog Management</p>
					<p>{!! Form::checkbox('dashboard_user_management', true, $data->auth->dashboard->user) !!} User Management</p>
				</fieldset>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}