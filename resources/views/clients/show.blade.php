@extends('includes.dashboard')

@section('title', 'Client')

@section('addon-style')
<style>
	td {
		vertical-align: text-top;
		padding-top: 5px; 
	}
</style>
@endsection

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>{{ $data->client_name }}</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clients</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $data->client_name }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">{{ $data->client_name }}</h4>
		<p class="mb-0">All client data</p>
	</div>
	<div class="pd-20">
		<div class="row">
			<div class="col">
				<table class="w-100">
					<tr>
						<td class="w-25">Name</td>
						<td style="width: 10px">: </td>
						<td>{{ $data->client_name }}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->email }}</td>
					</tr>
					<tr>
						<td>WhatsApp</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->whatsapp }}</td>
					</tr>
					<tr>
						<td>Company</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->company_name }}</td>
					</tr>
					<tr>
						<td>Province</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->province }}</td>
					</tr>
					<tr>
						<td>City</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->city }}</td>
					</tr>
					<tr>
						<td>District</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->district }}</td>
					</tr>
					<tr>
						<td>Village</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->village }}</td>
					</tr>
					<tr>
						<td>Address</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->address }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="pd-20">
		<h4 class="text-blue h4">{{ $data->client_name }} List Project</h4>
		<p class="mb-0">All project from {{ $data->client_name }}</p>
	</div>
	<div class="pd-20">
		<div class="row">
			<div class="col">
				<table class="table">
					<tr>
						<th>#</th>
						<th>Project Name</th>
						<th>Status</th>
						<th>Price</th>
						<th>Show</th>
					</tr>
					@php
							$no =1;
					@endphp
					@foreach ($data->client_project as $item)
							<tr>
								<td>{{ $no++ }}</td>
								<td><a href="{{ route('projects.show', $item->project->id) }}">{{ $item->project->project_name }}</a></td>
								<td>
									@if ($item->project->deleted_at)
										<span class="badge badge-danger" >Deleted</span>
									@else
										<span class="badge {{ $item->project->status === 'on-process' ? 'badge-warning' : '' }}{{ $item->project->status === 'on-progress' ? 'badge-primary' : '' }}{{ $item->project->status === 'done' ? 'badge-success' : '' }}{{ $item->project->status === 'cenceled' ? 'badge-danger' : '' }}">{{ $item->project->status }}</span>
									@endif
								</td>
								<td>{{ $item->project->price }}</td>
								<td><a href="{{ route('projects.show', $item->project->id) }}">Go</a></td>
							</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
