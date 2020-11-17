@extends('includes.dashboard')

@section('title', 'Projects')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>blank</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Projects</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
</div>
@endsection