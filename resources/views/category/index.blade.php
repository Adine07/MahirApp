@extends('includes.dashboard')

@section('title', 'Schedules')

@section('addon-style')

<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/sweetalert2/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Categories</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Categories</li>
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
	<div class="pd-20 d-flex justify-content-between">
        <div>
            <h4 class="text-blue h4">All Categories</h4>
            <p class="mb-0">All categories data on here</p>
        </div>
        <div>
            <a href="/category/create" class="btn btn-success">New Category</a>
        </div>
	</div>
	<table class="data-table table stripe hover nowrap">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Category Name</th>
                <th style="width: 100px" class="datatable-nosort">Action</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($categories as $category)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="{{ route('category.edit', $category->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                    <a
                                                    href="{{ route('category.destroy', $category->id) }}"
                                                    onclick="event.preventDefault(); document.getElementById('destroy-form{{ $category->id }}').submit();"
                                                    class="dropdown-item"
                                            >
                                            <i class="dw dw-delete-3"></i> Delete
                                            </a>
                                            <form
                                                    id="destroy-form{{ $category->id }}"
                                                    action="{{ route('category.destroy', $category->id) }}"
                                                    method="POST"
                                                    style="display: none;"
                                            >
                                                    @csrf
                                                    @method('DELETE')
                                            </form>
                                </div>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')

<script src="/deskapp/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
@endsection
