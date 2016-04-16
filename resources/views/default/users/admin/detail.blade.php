<div class="card">
	<div class="card-block">
		<h4 class="card-title">Member: {{$data->name}}</h4>
		<hr>
		<a href='{{ route('admins') }}' class='btn btn-primary-outline'><i class='fa fa-chevron-left'></i> Back</a>
		{!! Html::link(route('admin.form', ['id' => $data->_id]), 'Edit', ['class' => 'btn btn-primary-outline']) !!}
		<hr class='thick'>

		<div class='accordion' id="detail-accordion">
			<!-- TAB -->
			<ul class="nav nav-tabs m-b-2" id='detail-menu'>
				<li class="nav-item">
					<a class="nav-link active" href="#" data-toggle='collapse' data-parent='#detail-accordion' data-target='#collapse-summary'>Summary</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle='collapse' data-parent='#detail-accordion' data-target='#collapse-log'>Log</a>
				</li>
			</ul>

			<!-- SUMMARY -->
			<div class='collapse in ' id='collapse-summary' data-parent='#detail-accordion'>
				<div class="row">
					<div class="col-xs-4 col-md-3 text-uppercase">
						Join At
					</div>
					<div class="col-xs-8 col-md-9">
						{{ \Carbon\Carbon::parse($data->created_at)->format('d-M-Y [H:i]') }}
					</div>
				</div>
			</div>

			<!-- LOG -->
			<div class='collapse ' id='collapse-log' data-parent='#detail-accordion'>
				Log
			</div>
		</div>
	</div>
</div>