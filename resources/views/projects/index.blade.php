@extends('includes.dashboard')

@section('title', 'Projects')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Projects</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Projects</li>
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
	<div class="pd-20">
		<h4 class="text-blue h4">All Projects</h4>
		<p class="mb-0">All projects data on here</p>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th class="table-plus datatable-nosort">No</th>
					<th>Project Name</th>
					{{-- <th>Client Name</th> --}}
					<th>Status</th>
					<th>Deadline</th>
					<th>Price</th>
					<th>Member</th>
					<th>Payment</th>
					<th style="width: 50px" class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
						$no = 1;
				@endphp
				@foreach ($projects as $project)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $project->project_name }}</td>
							<td>{{ $project->start }}</td>
							<td>{{ $project->finish }}</td>
							<td>{{ $project->price }}</td>
							<td>{{ $project->price }}</td>
							<td>{{ $project->price }}</td>
							{{-- <td>
								<a class="text-white badge badge-success"><i class="dw dw-rocket"></i> Active Project</a>
								<a class="text-white badge badge-primary"><i class="dw dw-wall-clock2"></i> History Project</a>
							</td> --}}
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
										<a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}"><i class="dw dw-edit2"></i> Edit</a>
										<a
                            href="{{ route('projects.destroy', $project->id) }}"
                            onclick="event.preventDefault(); document.getElementById('destroy-form{{ $project->id }}').submit();"
                            class="dropdown-item"
                        >
												<i class="dw dw-delete-3"></i> Delete
                        </a>
                        <form
                            id="destroy-form{{ $project->id }}"
                            action="{{ route('projects.destroy', $project->id) }}"
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
@endsection