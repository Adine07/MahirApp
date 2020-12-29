@extends('includes.dashboard')

@section('title', 'Schedule Edit')

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
				<h4>{{ $data->project_name }}</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $data->project_name }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">{{ $data->project_name }}</h4>
		<p class="mb-0">All project data</p>
	</div>
	<div class="pd-20">
		<div class="row">
			<div class="col">
				<table class="w-100">
					<tr>
						<td class="w-25">Project Name</td>
						<td style="width: 10px">: </td>
						<td>{{ $data->project_name }}</td>
					</tr>
					<tr>
						<td>Status</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->status }}</td>
					</tr>
					<tr>
						<td>Price</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->price }}</td>
					</tr>
					<tr>
						<td>Start</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->start }}</td>
					</tr>
					<tr>
						<td>Finish</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->finish }}</td>
					</tr>
					<tr>
						<td>Description</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->description }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
