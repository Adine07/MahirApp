@extends('includes.dashboard')

@section('title', 'Schedule Create')

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
					<li class="breadcrumb-item active" aria-current="page">Schedule Create</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Create Schedule</h4>
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
		<form id="locations" action="{{ route('schedules.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="form-group row">
				<label class="col-12 col-form-label">Name</label>
				<div class="col-12">
					<input class="form-control" type="text" name="name" value="{{ old('name') }}"  placeholder="Meeting Project A">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Day</label>
						<div class="col-12">
							<select name="day" class="form-control">
								<option value="sunday">Sunday</option>
								<option value="monday">Monday</option>
								<option value="tuesday">Tuesday</option>
								<option value="wednesday">Wednesday</option>
								<option value="thursday">Thursday</option>
								<option value="friday">Friday</option>
								<option value="saturday">Saturday</option>
							</select>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Time</label>
						<div class="col-12">
							<input class="form-control time-picker-default" name="time" value="{{ old('time') }}" placeholder="time" type="text">
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<textarea name="description" class="form-control border-radius-0" placeholder="Sechedule Description...">{{ old('description') }}</textarea>
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
