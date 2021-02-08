@extends('includes.dashboard')

@section('title', 'Users')

@section('addon-style')
		<style>
			.modal-mask {
				position: fixed;
				z-index: 9997;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				display: table;
				transition: opacity 0.3s ease;
			}

			.mask-npm {
				z-index: 9998;
			}

			.modal-wrapper {
				display: table-cell;
				vertical-align: middle;
			}

			.modal-container {
				width: 400px;
				margin: 0px auto;
				background-color: #fff;
				border-radius: 2px;
				transition: all 0.3s ease;
				font-family: Helvetica, Arial, sans-serif;
				border-radius: 8px;
			}
			.mem{
				width: 400px;
			}
			.pay{
				width: 45%;
			}

			.modal-header h3 {
				margin-top: 0;
				color: #42b983;
			}

			.modal-body {
				padding: 0 10px;
				max-height: 50vh;
				overflow-y: auto;
			}

			/*
			* The following styles are auto-applied to elements with
			* transition="modal" when their visibility is toggled
			* by Vue.js.
			*
			* You can easily play with the modal transition by editing
			* these styles.
			*/

			.modal-enter {
				opacity: 0;
			}

			.modal-leave-active {
				opacity: 0;
			}

			.modal-enter .modal-container,
			.modal-leave-active .modal-container {
				-webkit-transform: scale(1.1);
				transform: scale(1.1);
			}

			/* My style */

			.tbm{
				margin: 0 !important;
			}

			.tbm table, .tbm td, .tbm th{
				border: none !important;
			}

			.text-pay{
				font-weight: 600;
				font-size: 24px;
			}

		</style>
		<script src="/vendor/vue/vue.js"></script>
		<script src="https://unpkg.com/vue-toasted"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		{{-- Modal member active --}}
		<script type="text/x-template" id="modalact-template">
			<transition name="modal">
				<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container">

					<div class="modal-header">
						<slot name="header">
						default header
						</slot>
					</div>

					<div class="modal-body">
						<slot name="body" class="body-m">
							default body
						</slot>
					</div>

					<div class="modal-footer">
						<slot name="footer">
						</slot>
						<a class="text-white btn btn-success" @click="$emit('close')">
							Close
						</a>
					</div>
					</div>
				</div>
				</div>
			</transition>
		</script>
		{{-- Modal member --}}
		<script type="text/x-template" id="modalhtr-template">
			<transition name="modal">
				<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container">

					<div class="modal-header">
						<slot name="header">
						default header
						</slot>
					</div>

					<div class="modal-body">
						<slot name="body" class="body-m">
											default body
						</slot>
					</div>

					<div class="modal-footer">
						<slot name="footer">
						</slot>
						<a class="text-white btn btn-success" @click="$emit('close')">
							Close
						</a>
					</div>
					</div>
				</div>
				</div>
			</transition>
		</script>
@endsection

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Users</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Users</li>
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
		<h4 class="text-blue h4">All Users</h4>
		<p class="mb-0">All users data on here</p>
	</div>
	<div class="pb-20" id="app">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th class="table-plus datatable-nosort">No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Projects</th>
					<th style="width: 50px" class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
						$no = 1;
				@endphp
				@foreach ($users as $user)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->role }}</td>
							<td>
								<a class="text-white badge badge-success" @click="userIdAct = {{ $user->id }}; showModalActive{{ $user->id }} = true"><i class="dw dw-rocket"></i> Active Project</a>
								<a class="text-white badge badge-primary" @click="userIdHtr = {{ $user->id }}; showModalHistory{{ $user->id }} = true"><i class="dw dw-wall-clock2"></i> History Project</a>

								<modalact v-if="showModalActive{{ $user->id }}" @close="showModalActive{{ $user->id }} = false; userIdAct = null; PrjAct = null">
									<!--
								you can use custom content here to overwrite
								default content
								-->
									<h3 slot="header" class=" m-auto">Active Project</h3>
									<table slot="body" class="table tbm">
										<thead>
											<tr>
												<th style="width: 50%">Project Name</th>
												<th>Role</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="prj in PrjAct">
												<td>@{{ prj.project.project_name }}</td>
												<td>@{{ prj.role }}</td>
											</tr>
										</tbody>
									</table>
								</modalact>

								<modalact v-if="showModalHistory{{ $user->id }}" @close="showModalHistory{{ $user->id }} = false; userIdHtr = null; PrjHtr = null">
									<!--
								you can use custom content here to overwrite
								default content
								-->
									<h3 slot="header" class=" m-auto">History Project</h3>
									<table slot="body" class="table tbm">
										<thead>
											<tr>
												<th style="width: 50%">Project Name</th>
												<th>Income</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(prj, index) in PrjHtr">
												<td>@{{ index }}</td>
												<td>@{{ prj }}</td>
											</tr>
										</tbody>
									</table>
								</modalact>
							</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i class="dw dw-eye"></i> View</a>
										@if (Auth::user()->role == 'manager')
											<a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i class="dw dw-edit2"></i> Edit</a>
											<a
													href="{{ route('users.destroy', $user->id) }}"
													onclick="event.preventDefault(); document.getElementById('destroy-form{{ $user->id }}').submit();"
													class="dropdown-item"
											>
												<i class="dw dw-delete-3"></i> Delete
											</a>
											<form
												id="destroy-form{{ $user->id }}"
												action="{{ route('users.destroy', $user->id) }}"
												method="POST"
												style="display: none;"
											>
												@csrf
												@method('DELETE')
											</form>
										@endif
									</div>
								</div>
							</td>
						</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('addon-script')

<script>
	// User Aactive Project Modal
	Vue.component("modalact", {
		template: "#modalact-template"
	});

	// User History Project Modal
	Vue.component("modalhtr", {
		template: "#modalhtr-template"
	});

	// Start App
	new Vue({
		el: "#app",
		data: {
			@foreach ($users as $user)
				showModalActive{{ $user->id }}: false,
				showModalHistory{{ $user->id }}: false,
			@endforeach
			userIdAct: null,
			userIdHtr: null,
			PrjAct: null,
			PrjHtr: null,
		},
		methods: {
			getActData(){
				var self = this;
				axios.get("{{ url('api/active') }}/" + self.userIdAct).then(function(response){
					self.PrjAct = response.data;
				})
			},
			getHtrData(){
				var self = this;
				axios.get("{{ url('api/history') }}/" + self.userIdHtr).then(function(response){
					self.PrjHtr = response.data;
				})
			},
		},
		watch: {
			userIdAct: function(val, oldVal){
				this.getActData();
			},
			userIdHtr: function(val, oldVal){
				this.getHtrData();
			},
		}
	});

</script>

@endsection