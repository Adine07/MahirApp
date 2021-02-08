@extends('includes.dashboard')

@section('title', 'Add Income')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Add Income</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('cashs.index') }}">Cashs</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Income</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Add Income</h4>
		<p class="mb-0">Input all income data</p>
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
		<form id="locations" action="{{ route('cashs.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Category</label>
						<div class="col-12">
							<select name="category" class="form-control custome-control">
								<option value="">-- select category --</option>
								@foreach ($category as $cat)
									<option value="{{ $cat->name }}">{{ $cat->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Date</label>
						<div class="col-12">
							<input class="form-control" name="date" value="{{ old('date') }}" type="date">
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Subject</label>
						<div class="col-12">
							<input class="form-control" name="subject" value="{{ old('subject') }}" type="text">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Nominal</label>
						<div class="col-12">
							<input class="form-control" name="income" value="{{ old('income') }}" type="number">
							<input type="hidden" name="expense" value="0">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-form-label">Description</label>
				<div class="col-sm-12">
					<textarea name="description" class="form-control border-radius-0" placeholder="Enter your description ...">{{ old('description') }}</textarea>
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