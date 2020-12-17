@extends('includes.dashboard')

@section('title', 'Schedule Edit')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Schedule Create</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
					<li class="breadcrumb-item active" aria-current="page">Schedule Edit</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Edit Schedule</h4>
		<p class="mb-0">Input all schedule data</p>
	</div>
	@if ($errors->any())
			<div class="alert alert-danger">
					<ul>
							@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
							@endforeach
					</ul>
			</div>
	@endif
	<div class="pd-20">
		<form id="locations" action="{{ route('schedules.update', $data->id) }}" method="post" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="form-group row">
				<label class="col-12 col-form-label">Name</label>
				<div class="col-12">
					<input class="form-control" type="text" name="name" value="{{ old('name', $data->name) }}"  placeholder="Meeting Project A">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Day</label>
						<div class="col-12">
							<select name="day" class="form-control">
								<option value="Sunday" {{ $data->day === 'Sunday' ? 'selected' : '' }}>Sunday</option>
								<option value="Monday" {{ $data->day === 'Monday' ? 'selected' : '' }}>Monday</option>
								<option value="Tuesday" {{ $data->day === 'Muesday' ? 'selected' : '' }}>Tuesday</option>
								<option value="Wednesday" {{ $data->day === 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
								<option value="Thursday" {{ $data->day === 'Thursday' ? 'selected' : '' }}>Thursday</option>
								<option value="Friday" {{ $data->day === 'Friday' ? 'selected' : '' }}>Friday</option>
								<option value="Saturday" {{ $data->day === 'Saturday' ? 'selected' : '' }}>Saturday</option>
							</select>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Time</label>
						<div class="col-12">
							<input class="form-control time-picker" name="time" value="{{ old('time', $data->time) }}"  type="text">
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<textarea name="description" class="form-control border-radius-0" placeholder="Sechedule Description...">{{ old('description', $data->description) }}</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="input-group mb-0">
						<!--
							use code for form submit
							<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
						-->
						<button class="btn btn-primary btn-lg btn-block">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
