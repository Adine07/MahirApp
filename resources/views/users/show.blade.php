@extends('includes.dashboard')

@section('title', 'Schedule')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>{{ $data->name }}</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">{{ $data->name }}</h4>
		<p class="mb-0">All schedule data</p>
	</div>
	<div class="pd-20">
		<div class="row">
			<div class="col">
				<table class="w-100">
					<tr>
						<td class="w-25">Name</td>
						<td>: {{ $data->name }}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>: {{ $data->email }}</td>
					</tr>
					<tr>
					<tr>
						<td>Role</td>
						<td>: {{ $data->role }}</td>
					</tr>
					<tr>
						<td>Whatsapp</td>
						<td>: {{ $data->whatsapp }}</td>
					</tr>
					<tr>
						<td>Province</td>
						<td>: {{ $data->province }}</td>
					</tr>
					<tr>
						<td>City</td>
						<td>: {{ $data->city }}</td>
					</tr>
					<tr>
						<td>Disrict</td>
						<td>: {{ $data->district }}</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>: {{ $data->village }}</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>: {{ $data->address }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
