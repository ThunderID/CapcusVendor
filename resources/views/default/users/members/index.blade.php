<div class="card">
	<div class="card-block">
		<h4 class="card-title">
			Member {{$pagination['paginator']->currentPage() ? ' / Page ' . $pagination['paginator']->currentPage() : ''}}
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
							<th >SSO</th>
							<th >Join At</th>
						</tr>
					</tr>
				</thead>
				<tbody>
					@forelse ($data as $k => $member)
						<tr>
							<td>{{$pagination['paginator']->firstItem() + $k++}}</td>
							<td>{!! Html::link(route('member.show', ['id' => $member->_id]), $member->name) !!}</td>
							<td>	
								@foreach ($member->emails as $email)
									<p>{{ $email->email }}</p>
								@endforeach
							</td>
							<td>
								@foreach ($member->account_connects as $account)
									@if (str_is('facebook', $account->account))
										<a target="_blank" href='http://facebook.com/{{$account->id}}' class='btn btn-primary-outline'><i class='fa fa-fw fa-facebook'></i></a>
									@elseif (str_is('twitter', $account->account))
										<a target="_blank" href='http://twitter.com/{{with(json_decode($account->data))->nickname}}' class='btn btn-primary-outline'><i class='fa fa-fw fa-twitter'></i></a>
									@endif
								@endforeach
							</td>
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