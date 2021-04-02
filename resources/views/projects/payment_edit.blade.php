@extends('includes.dashboard')

@section('title')
{{ $data->project->project_name }}
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
				<h4>{{ $data->project->project_name }}</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Payment | {{ $data->project->project_name }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Edit Payment | {{ $data->project->project_name }}</h4>
		<p class="mb-0">Form Edit Payment</p>
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
				<form action="{{ route('projects.payment.update', $data->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
					<div class="form-group row">
						<div class="col-12 col-md-6">
							<label><b>Income</b></label>
							<input type="number" name="income" value="{{ $data->nominal }}" class="form-control">
            </div>
            <div class="col-12 col-md-2">
              <label>Payment Slip</label>
              <a href="/img/{{ $data->image }}" target="_blank"><img width="80px" height="120px" src="/img/{{ $data->image }}" alt="gambar slip pembayaran"></a>
            </div>
						<div class="col-12 col-md-4">
							<label>Fill if you want to change Slip</label>
							<input type="file" accept="image/*" name="img_payment" class="form-control-file form-control height-auto">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col pb-3">
							<b>Allocation</b>
						</div>
					</div>
					@foreach ($data->payment_detail as $item)
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label>{{ $item->user->name }}</label>
								<input type="number" name="income_user[]" value="{{ $item->nominal }}" class="form-control">
								<input type="hidden" name="user_id[]" value="{{ $item->user_id }}">
							</div>
							<div class="col-12 col-md-2">
                <label>Payment Slip</label>
                <a href="/img/{{ $item->image }}" target="_blank"><img width="80px" height="120px" src="/img/{{ $item->image }}" alt="gambar slip pembayaran"></a>
							</div>
							<div class="col-12 col-md-4">
                <label>
                  Fill if you want to change Slip
                </label>
                <input type="file" accept="image/*" name="imgusr_payment[{{ $item->user_id }}]" class="form-control-file form-control height-auto">
              </div>
						</div>
					@endforeach
					<div class="form-group row">
						<div class="col-12">
							<label>Cash</label>
							<input type="number" name="cash" value="{{ $data->cash->income }}" class="form-control">
						</div>
					</div>
					<div class="form-group row">
            <div class="col-6" style="vertical-align: text-top !important">
              <embed src="/pdf/{{ $data->invoice }}" type="application/pdf" width="300" height="200" >
              <a href="/pdf/{{ $data->invoice }}" target="_blank">Show</a>
            </div>
						<div class="col-6">
							<label>Fill if you want to change Invoice</label>
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
