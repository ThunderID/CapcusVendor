<div class="card">
	<div class="card-block">
		<h4 class="card-title">My Account</h4>
		<p class="card-text">Pengaturan akun anda </p>
	</div>
	<ul class="list-group list-group-flush">
		<a href="{{ route('me') }}"><li class="list-group-item card-link">Home <i class='fa fa-chevron-right pull-right hidden-md-down'></i></li></a>
		<a href="{{ route('me.update_password') }}"><li class="list-group-item card-link">Update Password <i class='fa fa-chevron-right pull-right hidden-md-down'></i></li></a>
	</ul>
</div>