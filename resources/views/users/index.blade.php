@extends('includes.dashboard')

@section('title', 'Users')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Users</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Users</li>
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
		<h4 class="text-blue h4">All Users</h4>
		<p class="mb-0">All users data on here</p>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th>No</th>
					<th class="table-plus datatable-nosort">Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Projects</th>
					<th style="width: 50px" class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
						<tr>
							<td>#</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->role }}</td>
							<td>
								<a class="text-white badge badge-success"><i class="dw dw-rocket"></i> Active Project</a>
								<a class="text-white badge badge-primary"><i class="dw dw-wall-clock2"></i> History Project</a>
							</td>
							<td>
								<a class="text-white badge badge-warning d-inline-block" href="{{ route('users.edit', $user->id) }}"><i class="dw dw-edit2"> </i> Edit</a>
								<form class="d-inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button class="text-white badge badge-danger d-inline-block" id="sa-params"><i class="dw dw-trash"></i> </i> Hapus</div>
								</form>
								<button type="submit" class="btn mb-20 btn-primary btn-block" id="sa-params">aaa</button>
							</td>
						</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection