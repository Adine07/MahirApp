@extends('includes.dashboard')

@section('title', 'Category Create')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Category Create</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
					<li class="breadcrumb-item active" aria-current="page">Category Create</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Create Category</h4>
		<p class="mb-0">Input all category data</p>
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
		<form id="locations" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="form-group row">
				<label class="col-12 col-form-label">Category Name</label>
				<div class="col-12">
					<input class="form-control" type="text" name="name" value="{{ old('name') }}"  placeholder="Pembayaran">
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
