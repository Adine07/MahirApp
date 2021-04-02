@extends('includes.dashboard')

@section('title')
{{ $data->project_name }}
@endsection

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
					<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
					<li class="breadcrumb-item active" aria-current="page">Payment | {{ $data->project_name }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Payment | {{ $data->project_name }}</h4>
		<p class="mb-0">Form Input Payment</p>
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
		<div class="row">
			<div class="col">
				<form action="{{ route('projects.payment.store', $data->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<div class="col-12 col-md-8">
							<label><b>Income</b></label>
							<input type="number" name="income" class="form-control">
						</div>
						<div class="col-12 col-md-4">
							<label>Payment Slip</label>
							<input type="file" accept="image/*" name="img_payment" class="form-control-file form-control height-auto">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col pb-3">
							<b>Allocation</b>
						</div>
					</div>
					@foreach ($data->project_member as $item)
						<div class="form-group row">
							<div class="col-12 col-md-8">
								<label>{{ $item->user->name }}</label>
								<input type="number" name="income_user[]" class="form-control">
								<input type="hidden" name="user_id[]" value="{{ $item->user_id }}">
							</div>
							<div class="col-12 col-md-4">
								<label>Payment Slip</label>
								<input type="file" accept="image/*" name="imgusr_payment[]" class="form-control-file form-control height-auto">
							</div>
						</div>
					@endforeach
					<div class="form-group row">
						<div class="col-12">
							<label>Cash</label>
							<input type="number" name="cash" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12">
							<label>Upload Invoice</label>
							<input type="file" accept=".pdf" name="invoice_ce" class="form-control-file form-control height-auto">
						</div>
					</div>
					<div class="form-group row">
						<div class="col">
							<button class="btn btn-primary btn-block">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
