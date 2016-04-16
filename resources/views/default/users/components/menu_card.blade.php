<div class="card">
	<div class="card-block">
		<h4 class="card-title">Users</h4>
		<p class="card-text">Pengaturan admin dan members </p>
	</div>
	<ul class="list-group list-group-flush">
		<a href="{{ route('users') }}"><li class="list-group-item card-link">Home <i class='fa fa-chevron-right pull-right hidden-md-down'></i></li></a>
		<a href="{{ route('admins') }}"><li class="list-group-item card-link">Admin <i class='fa fa-chevron-right pull-right hidden-md-down'></i></li></a>
		<a href="{{ route('members') }}"><li class="list-group-item card-link">Members <i class='fa fa-chevron-right pull-right hidden-md-down'></i></li></a>
	</ul>
</div>