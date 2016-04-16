{!! Form::open(['url' => route('me.update_password.post')]) !!}
<div class='card'>
	<div class='card-block'>
		<h3 class='card-title'>Update Password</h3>
		<p class='card-text'>
			<fieldset class="form-group">
				<label for="name">Password Lama</label>
				{!! Form::password('password_lama', ['class' => 'form-control']) !!}
			</fieldset>

			<fieldset class="form-group">
				<label for="name">Password Baru <small class='text-primary'>min 8 karakter</small></label>
				{!! Form::password('password_baru', ['class' => 'form-control']) !!}
			</fieldset>

			<fieldset class="form-group">
				<label for="name">Konfirmasi Password Baru</label>
				{!! Form::password('password_baru_confirmation', ['class' => 'form-control']) !!}
			</fieldset>

			<button type='submit' class='m-t-2 btn btn-primary btn-block'>Update</button>
		</p>
	</div>
</div>
{!! Form::close() !!}