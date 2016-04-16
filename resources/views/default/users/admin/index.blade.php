<div class="card">
	<div class="card-block">
		<h4 class="card-title">
			Admin {{$pagination['paginator']->currentPage() ? ' / Page ' . $pagination['paginator']->currentPage() : ''}}
			<a href="{{ route('admin.form') }}" class='pull-right btn btn-primary-outline'><i class='fa fa-plus'></i></a>
		</h4>
		<div class="card-text">
			{!! Form::open(['method' => 'get', 'class' => 'm-t-2 p-y-0']) !!}
			<div class="input-group">
				<input type="text" name='search' value="{{$filters['name']}}" class="form-control" placeholder="Search for...">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="button"><i class='fa fa-search'></i></button>
				</span>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
	<div class='card-block'>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<tr>
							<th width='5'>#</th>
							<th >Name</th>
							<th >Email</th>
							<th >Manage Tour</th>
							<th >Manage Blog</th>
							<th >Manage User</th>
							<th >Join At</th>
						</tr>
					</tr>
				</thead>
				<tbody>
					@forelse ($data as $k => $member)
						<tr>
							<td>{{$pagination['paginator']->firstItem() + $k++}}</td>
							<td>{!! Html::link(route('admin.show', ['id' => $member->_id]), $member->name) !!}</td>
							<td>
								@foreach ($member->emails as $email)
									{{ $email->email }}
								@endforeach
							</td>
							<td>{!! $member->auth->dashboard->tour ? "<i class='fa fa-check'></i>" : '' !!}</td>
							<td>{!! $member->auth->dashboard->blog ? "<i class='fa fa-check'></i>" : '' !!}</td>
							<td>{!! $member->auth->dashboard->user ? "<i class='fa fa-check'></i>" : '' !!}</td>
							<td>{!! \Carbon\Carbon::parse($member->created_at)->format('d-M-Y') . '<span class="text-info"> ' . \Carbon\Carbon::parse($member->created_at)->format('[H:i]') . '</span>' !!}
						</tr>
					@empty
					@endforelse
				</tbody>
			</table>
		</div>
		{!! $pagination['paginator']->render(new \Illuminate\Pagination\BootstrapFourPresenter($pagination['paginator'])); !!}
	</div>
</div>