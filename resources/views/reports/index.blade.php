@extends('includes.report')

@section('title', 'Report')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Reports</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Reports</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="d-flex justify-content-between">
			<div>
				<h4 class="text-blue h4">All Report</h4>
				<p class="mb-0">All report data on here</p>
			</div>
			<form action="{{ route('reports') }}" method="GET" id="yearForm" class="d-inline">	
				<table>
					<tr>
						<td class="pr-1 h5">
							Select Year
						</td>
						<td>
							<select name="monthlyYear" id="" class="round" onchange="return $('#yearForm').submit()" style="padding: 5px 10px">
								@php
									$yearNow = date('Y', strtotime(now()));
									$yearMin = date('Y', strtotime(App\Models\Kas::orderBy('date')->pluck('date')->first()));
									
								@endphp
								@for ($i = $yearNow; $i >= $yearMin; $i--)
									<option value="{{ $i }}" {{ $monthlyYear ? $monthlyYear == $i ? 'selected' : null : null }}>{{ $i }}</option>
								@endfor
							</select>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div class="pd-20">
		<span class="h5">Cash Mahir Teckhno In {{ $monthlyYear }}</span>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="table-plus">Date</th>
					<th>Income</th>
					<th>Expense</th>
					<th>Category</th>
					<th>Subject</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($cashs as $cash)
					<tr>
						<td>{{ $cash->date }}</td>
						<td>Rp{{ number_format($cash->income) }}</td>
						<td>Rp{{ number_format($cash->expense) }}</td>
						<td>{{ $cash->category }}</td>
						<td>{{ $cash->subject }}</td>
						<td>{{ $cash->description }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Total Income</th>
					<th>Rp{{ number_format($totin) }}</th>
					<th>Total Expense</th>
					<th>Rp{{ number_format($totex) }}</th>
					<th>Total Cashs</th>
					<th>Rp{{ number_format($totCashs) }}</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<span class="h5">Project Entered in {{ $monthlyYear }}</span>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="table-plus">Project Name</th>
					<th>client Name</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($projects as $project)
					<tr>
						<td>{{ $project->project_name }}</td>
						<td>{{ $project->client_project->client->client_name }}</td>
						<td>Rp{{ number_format($project->price) }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="2">Total Project</th>
					<th>{{ $totproj }}</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
@endsection

@section('script')
	<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
	{{-- <script src=""></script> --}}
	<script>
		$(document).ready(function() {
				$('.table').DataTable( {
						dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excel',
								messageTop: 'Cashs MahirTeckhno Agustus 2020',
								// footer: true,
							},
							{
								extend: 'pdf',
								messageTop: 'Cashs MahirTeckhno Agustus 2020',
								// footer: true,
							},
						]
				} );
		} );
	</script>
@endsection