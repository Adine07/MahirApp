@extends('includes.dashboard')

@section('title', 'Schedules')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Schedules</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Schedules</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
				{{ session('status') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@elseif(session('update'))
    <div class="alert alert-info alert-dismissible fade show">
				{{ session('update') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@elseif(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show">
				{{ session('delete') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@elseif(session('cant'))
    <div class="alert alert-warning alert-dismissible fade show">
				{{ session('cant') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@endif
<div class="card-box mb-30">
	<div class="pd-20 d-flex justify-content-between">
		<div>
			<h4 class="text-blue h4">All Schedules</h4>
			<p class="mb-0">All schedules data on here</p>
		</div>
		<div>
			<a href="{{ route('schedules.create') }}" class="text-white btn btn-success">Add Schedule</a>
		</div>
	</div>
	<div class="tab">
		<ul class="nav nav-tabs customtab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#sunday" role="tab" aria-selected="true">Sunday</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#monday" role="tab" aria-selected="false">Monday</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#tuesday" role="tab" aria-selected="false">Tuesday</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#wednesday" role="tab" aria-selected="false">Wednesday</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#thursday" role="tab" aria-selected="false">Thursday</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#friday" role="tab" aria-selected="false">Friday</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#saturday" role="tab" aria-selected="false">Saturday</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade show active pt-3" id="sunday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($sundays as $sunday)
								<tr>
									<td>{{ $sunday->time }}</td>
									<td>{{ $sunday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $sunday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $sunday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $sunday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $sunday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $sunday->id }}"
																action="{{ route('schedules.destroy', $sunday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade pt-3" id="monday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($mondays as $monday)
								<tr>
									<td>{{ $monday->time }}</td>
									<td>{{ $monday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $monday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $monday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $monday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $monday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $monday->id }}"
																action="{{ route('schedules.destroy', $monday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade pt-3" id="tuesday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tuesdays as $tuesday)
								<tr>
									<td>{{ $tuesday->time }}</td>
									<td>{{ $tuesday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $tuesday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $tuesday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $tuesday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $tuesday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $tuesday->id }}"
																action="{{ route('schedules.destroy', $tuesday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade pt-3" id="wednesday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($wednesdays as $wednesday)
								<tr>
									<td>{{ $wednesday->time }}</td>
									<td>{{ $wednesday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $wednesday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $wednesday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $wednesday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $wednesday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $wednesday->id }}"
																action="{{ route('schedules.destroy', $wednesday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade pt-3" id="thursday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($thursdays as $thursday)
								<tr>
									<td>{{ $thursday->time }}</td>
									<td>{{ $thursday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $thursday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $thursday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $thursday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $thursday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $thursday->id }}"
																action="{{ route('schedules.destroy', $thursday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade pt-3" id="friday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($fridays as $friday)
								<tr>
									<td>{{ $friday->time }}</td>
									<td>{{ $friday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $friday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $friday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $friday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $friday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $friday->id }}"
																action="{{ route('schedules.destroy', $friday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade pt-3" id="saturday" role="tabpanel">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th style="width: 100px">Time</th>
							<th>Name</th>
							<th style="width: 100px" class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($saturdays as $saturday)
								<tr>
									<td>{{ $saturday->time }}</td>
									<td>{{ $saturday->name }}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('schedules.show', $saturday->id) }}"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{ route('schedules.edit', $saturday->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a
																href="{{ route('schedules.destroy', $saturday->id) }}"
																onclick="event.preventDefault(); document.getElementById('destroy-form{{ $saturday->id }}').submit();"
																class="dropdown-item"
														>
														<i class="dw dw-delete-3"></i> Delete
														</a>
														<form
																id="destroy-form{{ $saturday->id }}"
																action="{{ route('schedules.destroy', $saturday->id) }}"
																method="POST"
																style="display: none;"
														>
																@csrf
																@method('DELETE')
														</form>
											</div>
										</div>
									</td>
								</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection