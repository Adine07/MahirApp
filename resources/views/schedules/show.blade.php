@extends('includes.dashboard')

@section('title', 'Schedule')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Schedule</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
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
						<td class="w-25">Schedule Name</td>
						<td>: {{ $data->name }}</td>
					</tr>
					<tr>
						<td>Day</td>
						<td>: {{ $data->day }}</td>
					</tr>
					<tr>
						<td>Time</td>
						<td>: {{ $data->time }}</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>: {{ $data->description }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
