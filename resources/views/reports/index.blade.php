@extends('includes.dashboard')

@section('title', 'Users')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Reports</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Reports</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">All Report</h4>
		<p class="mb-0">All report data on here</p>
	</div>
	<div class="pb-20">
		{{-- <table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th class="table-plus datatable-nosort">No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Projects</th>
					<th style="width: 50px" class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
						$no = 1;
				@endphp
				@foreach ($users as $user)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->role }}</td>
							<td>
								<a class="text-white badge badge-success"><i class="dw dw-rocket"></i> Active Project</a>
								<a class="text-white badge badge-primary"><i class="dw dw-wall-clock2"></i> History Project</a>
							</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i class="dw dw-edit2"></i> Edit</a>
										<a
                            href="{{ route('users.destroy', $user->id) }}"
                            onclick="event.preventDefault(); document.getElementById('destroy-form{{ $user->id }}').submit();"
                            class="dropdown-item"
                        >
												<i class="dw dw-delete-3"></i> Delete
                        </a>
                        <form
                            id="destroy-form{{ $user->id }}"
                            action="{{ route('users.destroy', $user->id) }}"
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
		</table> --}}
	</div>
</div>
@endsection