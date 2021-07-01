@extends('includes.dashboard')

@section('title', 'Client')

@section('addon-style')

<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/sweetalert2/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Client</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Client</li>
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
		<div class="d-inline-block w-50">
			<h4 class="text-blue h4">All Clients</h4>
			<p class="mb-0">All clients data on here</p>
		</div>
		<div>
			@if (Auth::user()->role == 'manager')
				<a href="{{ route('clients.create') }}" class="btn btn-primary ml-auto mt-3">Create Client</a>
			@endif
		</div>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th class="table-plus datatable-nosort">No</th>
					<th>Name</th>
					<th>Company Name</th>
					<th>Email</th>
					<th>Whatsapp</th>
					<th style="width: 50px" class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
						$no = 1;
				@endphp
				@foreach ($clients as $client)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $client->client_name }}</td>
							<td>{{ $client->company_name }}</td>
							<td>{{ $client->email }}</td>
							<td>{{ $client->whatsapp }}</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="{{ route('clients.show', $client->id) }}"><i class="dw dw-eye"></i> View</a>
										@if (Auth::user()->role == 'manager')
											<a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}"><i class="dw dw-edit2"></i> Edit</a>
											<a
													href="{{ route('clients.destroy', $client->id) }}"
													onclick="event.preventDefault(); document.getElementById('destroy-form{{ $client->id }}').submit();"
													class="dropdown-item"
											>
											<i class="dw dw-delete-3"></i> Delete
											</a>
											<form
												id="destroy-form{{ $client->id }}"
												action="{{ route('clients.destroy', $client->id) }}"
												method="POST"
												style="display: none;"
											>
												@csrf
												@method('DELETE')
											</form>
										@endif
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

@section('script')

<script src="/deskapp/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
@endsection
