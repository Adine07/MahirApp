@extends('includes.dashboard')

@section('title', 'Cashs')

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
				<h4>{{ $data->subject }}</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('cashs.index') }}">Cashss</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $data->subject }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">{{ $data->subject }}</h4>
		<p class="mb-0">All project data</p>
	</div>
	<div class="pd-20">
		<div class="row">
			<div class="col">
				<table class="w-100">
					<tr>
						<td class="w-25">Date</td>
						<td style="width: 10px">: </td>
						<td>{{ $data->date }}</td>
					</tr>
					<tr>
						<td>User</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->user->name }}</td>
					</tr>
					<tr>
						<td>Income</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->income }}</td>
					</tr>
					<tr>
						<td>Expense</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->expense }}</td>
					</tr>
					<tr>
						<td>Category</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->category }}</td>
					</tr>
					<tr>
						<td>Subject</td>
						<td style="width: 10px">:</td>
						<td>{{ $data->subject }}</td>
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
