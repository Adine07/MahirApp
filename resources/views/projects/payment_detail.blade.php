@extends('includes.dashboard')

@section('title', 'Project Show')

@section('addon-style')
<style>
	td {
		vertical-align: text-top;
		padding-top: 5px; 
	}

  .custab{
    /* border: none !important; */
    vertical-align: top !important;
    padding-top: 10px !important;
    text-align: center;
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
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
				{{ session('status') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@elseif(session('update'))
    <div class="alert alert-info alert-dismissible fade show">
				{{ session('update') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@elseif(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show">
				{{ session('delete') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@elseif(session('cant'))
    <div class="alert alert-warning alert-dismissible fade show">
				{{ session('cant') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
    </div>
@endif
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
						<td>Client Name</td>
						<td style="width: 10px">:</td>
						<td>{{ $client->client->client_name }}</td>
					</tr>
					<tr>
						<td>Status</td>
						<td style="width: 10px">:</td>
						<td><span class="badge {{ $data->status === 'on-process' ? 'badge-warning' : '' }}{{ $data->status === 'on-progress' ? 'badge-primary' : '' }}{{ $data->status === 'done' ? 'badge-success' : '' }}{{ $data->status === 'cenceled' ? 'badge-danger' : '' }}">{{ $data->status }}</span></td>
					</tr>
					<tr>
						<td>Price</td>
						<td style="width: 10px">:</td>
						<td>Rp {{ number_format($data->price) }}</td>
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
  <div class="pd-20">
		<h4 class="text-blue h4">{{ $data->project_name }} Payment</h4>
		<p class="mb-0">All project payment data</p>
  </div>
  <div class="pd-20">
		<div class="row">
			<div class="col">
				<table class="w-100 mb-3">
					<tr>
						<td class="w-25">Payment</td>
						<td style="width: 10px">: </td>
						<td>Rp {{ number_format($pay) }} / Rp {{ number_format($data->price) }}</td>
					</tr>
				</table>
			</div>
		</div>
    <div class="row">
      <div class="col">
        <table class="table table-bordered">
          <tr class="custab">
            <th class="custab">#</th>
            <th class="custab">Date</th>
            <th class="custab">Nominal</th>
            <th class="custab">Payment Slip</th>
            <th class="custab">Invoice</th>
            <th class="custab">Allocation</th>
            <th class="custab">Action</th>
          </tr>
          @php
              $no = 1;
          @endphp
          @foreach ($data->payment as $payment)
            <tr class="custab">
              <td class="custab">Termin {{ $no++ }}</td>
              <td class="custab">{{ $payment->date }}</td>
              <td class="custab">{{ $payment->nominal }}</td>
              <td class="custab"><a href="/img/{{ $payment->image }}" target="_blank"><img width="80px" height="120px" src="/img/{{ $payment->image }}" alt="gambar slip pembayaran"></a></td>
              <td class="custab">
                <embed src="/pdf/{{ $payment->invoice }}" type="application/pdf" width="300" height="200" >
                <a href="/pdf/{{ $payment->invoice }}" target="_blank">Show</a>
              </td>
              <td class="custab">
                <table style="margin: auto; border: none !important" class="table table-bordered">
                  @foreach ($payment->payment_detail as $detail)
                    <tr>
                      <td style=" border: none; border-bottom: 1px solid #dee2e6">{{ $detail->user->name }}</td>
                      <td style=" border: none; border-bottom: 1px solid #dee2e6">{{ $detail->nominal }}</td>
                      <td style=" border: none; border-bottom: 1px solid #dee2e6"><a href="/img/{{ $detail->image }}" target="_blank"><img width="80px" height="120px" src="/img/{{ $detail->image }}" alt="gambar slip pembayaran"></a></td>
                    </tr>
                  @endforeach
                </table>
              </td>
              <td>
                <a href="{{ route('projects.payment.edit', $payment->id) }}" class="btn btn-warning btn-sm btn-block mb-2 ">Edit</a>
                <a
									href="{{ route('projects.payment.delete', $payment->id) }}"
									onclick="event.preventDefault(); document.getElementById('destroy-form{{ $payment->id }}').submit();"
									class="btn btn-danger btn-sm btn-block"
								>
									Delete
								</a>
								<form
									id="destroy-form{{ $payment->id }}"
									action="{{ route('projects.payment.delete', $payment->id) }}"
									method="POST"
									style="display: none;"
								>
									@csrf
									@method('DELETE')
								</form>
							</td>
            </tr>
          @endforeach
        </table>
      </div>
		</div>
		<div class="pd-20">
			<h4 class="text-blue h4">Set Status {{ $data->project_name }}</h4>
			<p class="mb-0">Set Status to this project</p>
		</div>
		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col" style="{{ $data->status == 'on-process' ? 'display: none' : '' }}">
						<a href="/projects/status/{{ $data->id }}/on-process" class="btn btn-warning btn-block">On-proccess</a>
					</div>
					<div class="col" style="{{ $data->status == 'on-progress' ? 'display: none' : '' }}">
						<a href="/projects/status/{{ $data->id }}/on-progress" class="btn btn-primary btn-block">On-progress</a>
					</div>
					<div class="col" style="{{ $data->status == 'done' ? 'display: none' : '' }}">
						<a href="/projects/status/{{ $data->id }}/done" class="btn btn-success btn-block">Done</a>
					</div>
					<div class="col" style="{{ $data->status == 'cenceled' ? 'display: none' : '' }}">
						<a href="/projects/status/{{ $data->id }}/canceled" class="btn btn-danger btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
@endsection
