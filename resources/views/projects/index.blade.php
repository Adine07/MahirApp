@extends('includes.dashboard')

@section('title', 'Projects')
@section('addon-style')

<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/sweetalert2/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
				width: 600px;
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
			.npm {
				width: 700px;
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
		<script type="text/javascript">
			window.csrf_token = "{{ csrf_token() }}"
		</script>
		<script src="/vendor/vue/vue.js"></script>
		<script src="https://unpkg.com/vue-toasted"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		{{-- Modal member --}}
		<script type="text/x-template" id="modalmem-template">
			<transition name="modal">
				<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container mem">

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
		{{-- modal Payment --}}
		<script type="text/x-template" id="modalpay-template">
			<transition name="modal">
				<div class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container pay">

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
						<slot name="footer1">
						</slot>
						<slot name="footer2">
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
		{{-- Modal new payment --}}
		<script type="text/x-template" id="modalnpm-template">
			<transition name="modalnpm">
				<div class="modal-mask mask-npm">
					<div class="modal-wrapper">
						<div class="modal-container npm">

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
								Cencel
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
				<h4>Projects</h4>
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
		<h4 class="text-blue h4">All Projects</h4>
		<p class="mb-0">All projects data on here</p>
	</div>
	<div class="pb-20" id="app">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th class="table-plus datatable-nosort">No</th>
					<th>Project Name</th>
					{{-- <th>Client Name</th> --}}
					<th>Status</th>
					<th>Deadline</th>
					<th>Price</th>
					<th>Member</th>
					<th>Payment</th>
					<th style="width: 50px" class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
						$no = 1;
				@endphp
				@foreach ($projects as $project)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $project->project_name }}</td>
							<td><span class="badge {{ $project->status === 'on-process' ? 'badge-warning' : '' }}{{ $project->status === 'on-progress' ? 'badge-primary' : '' }}{{ $project->status === 'done' ? 'badge-success' : '' }}{{ $project->status === 'cenceled' ? 'badge-danger' : '' }}">{{ $project->status }}</span></td>
							<td>{{ $project->finish }}</td>
							<td>Rp{{ number_format($project->price) }}</td>
							<td>
								<a class="text-white badge badge-success badge-sm" id="show-modal" @click="projectIdm = {{ $project->id }}; showModalMember{{ $project->id }} = true"><i class="dw dw-rocket"></i> Members</a>
								<!-- use the modal component, pass in the prop -->
								{{-- Modal member --}}
								<modalmem v-if="showModalMember{{ $project->id }}" @close="showModalMember{{ $project->id }} = false; members = null; projectIdm = null">
									<!--
								you can use custom content here to overwrite
								default content
								-->
									<h3 slot="header" class=" m-auto">@{{ members.project_name }}</h3>
									<table slot="body" class="table tbm">
										<thead>
											<tr>
												<th style="width: 50%">Members</th>
												<th>Role</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="member in members.project_member">
												<td>@{{ member.user.name }}</td>
												<td>@{{ member.role }}</td>
											</tr>
										</tbody>
									</table>
								</modalmem>
							</td>
							<td>
								<a class="text-white badge badge-success badge-sm" id="show-modal" @click="projectIdp = {{ $project->id }}; showModalPayment{{ $project->id }} = true; price = {{ $project->price }}"><i class="dw dw-rocket"></i> Payment</a>
								<!-- use the modal component, pass in the prop -->
								{{-- Modal member --}}
								<modalpay v-if="showModalPayment{{ $project->id }}" @close="showModalPayment{{ $project->id }} = false; payments = null; projectIdp = null; cash = null; price = null; income = null">
									<!--
								you can use custom content here to overwrite
								default content
								-->
									<h3 slot="header" class="m-auto">@{{ payments.project_name }}</h3>
									<table slot="body" class="table tbm">
										<thead>
											<tr>
												<th>No</th>
												<th>Date</th>
												<th>Nominal</th>
												<th style="width: 50%" colspan="2" class="text-center">Allocations</th>
											</tr>
										</thead>
										<tbody>
											<template v-for="(payment, index) in payments.payment">
												<tr>
													<td style="vertical-align: top !important;">Termin @{{ 1 + index }}</td>
													<td style="vertical-align: top !important;">@{{ payment.date }}</td>
													<td style="vertical-align: top !important;">Rp@{{ payment.nominal }}</td>
													<td style="vertical-align: top !important;">
														<table class="m-auto">
															<tr v-for="allocation in payment.payment_detail">
																<td style="vertical-align: top !important; padding-top: 0 !important;">@{{ allocation.user.name }}</td>
																<td style="vertical-align: top !important; padding-top: 0 !important;">Rp@{{ allocation.nominal }}</td>
															</tr>
															<tr>
																<td style="vertical-align: top !important; padding-top: 0 !important;">Cash</td>
																<td style="vertical-align: top !important; padding-top: 0 !important;">Rp@{{ cash.payment[index].cash.income }}</td>
															</tr>
														</table>
													</td>
												</tr>
											</template>
										</tbody>
									</table>
									<p slot="footer1" class="mr-auto text-pay">Rp@{{ pay }} / Rp@{{ price }}</p>
                                    @if (Auth::user()->role == 'manager')
                                        <a v-if="pay < price" slot="footer2" href="{{ route('projects.payment',$project->id) }}" class="text-white btn btn-success">Add New Payment</a>
                                    @endif
								</modalpay>
							</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" href="{{ route('projects.show', $project->id) }}"><i class="dw dw-eye"></i> View</a>
										{{-- <a class="dropdown-item" href="{{ route('projects.payment', $project->id) }}"><i class="dw dw-money-1"></i> Payment</a> --}}
										@if (Auth::user()->role == 'manager')
										<a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}"><i class="dw dw-edit2"></i> Edit</a>
										<a
											href="{{ route('projects.destroy', $project->id) }}"
											onclick="event.preventDefault(); document.getElementById('destroy-form{{ $project->id }}').submit();"
											class="dropdown-item"
										>
											<i class="dw dw-delete-3"></i> Delete
										</a>
										<form
											id="destroy-form{{ $project->id }}"
											action="{{ route('projects.destroy', $project->id) }}"
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
			<modalnpm v-if="showModalNewPayment" @close="showModalNewPayment = false">
				<h3 slot="header" class="m-auto">Input New Payment</h3>
				<div slot="body">
					<div class="form-group row mx-0">
						<label class="col-12 col-form-label" style="font-weight: bold">Income</label>
						<div class="col-12">
							<input class="form-control" name="income" v-model="form.income" placeholder="10000000" type="number" required>
						</div>
					</div>
					<hr>
					<div class="row form-group mx-0">
						<div class="col">
							<p>Allocations</p>
						</div>
					</div>
					<template v-for="(member, index) in members.project_member">
						<div class="form-group row mx-0">
							<label class="col-12 col-form-label">@{{ member.user.name }}</label>
							<div class="col-12">
								<input class="form-control" v-bind:value="form.nominal[index]" v-on:input="pushId($event.target.value, member.user.id, index)" placeholder="10000000" type="number" required>
							</div>
						</div>
					</template>
					<div class="form-group row mx-0">
						<label class="col-12 col-form-label">Cashs</label>
						<div class="col-12">
							<input type="number" class="form-control" v-model="form.cashs" placeholder="10000000" required>
						</div>
					</div>
				</div>
				<button slot="footer" class="btn btn-primary" @click="handleSubmit">Submit</button>
			</modalnpm>
		</table>
	</div>
</div>
@endsection

@section('addon-script')
<script>
	axios.defaults.headers.common = {
		'X-Requested-With': 'XMLHttpRequest',
		'X-CSRF-TOKEN': window.csrf_token
	};
	// register modal component
	Vue.component("modalmem", {
		template: "#modalmem-template"
	});
	// register modal component
	Vue.component("modalpay", {
		template: "#modalpay-template"
	});
	// register modal component
	Vue.component("modalnpm", {
		template: "#modalnpm-template"
	});

	const initForm = { bio: null, date: null, user_id: [], nominal: [], cashs: null, income: null, project_id: null, project_name: null }

	var d = new Date();

    var date = d.getUTCDate();
    var month = d.getUTCMonth() + 1; // Since getUTCMonth() returns month from 0-11 not 1-12
    var year = d.getUTCFullYear();

    var dateStr = year + "-" + month + "-" + date;

	// start app
	new Vue({
		el: "#app",
		data: {
			@foreach ($projects as $project)
				showModalMember{{ $project->id }}: false,
				showModalPayment{{ $project->id }}: false,
			@endforeach
			showModalNewPayment: false,
			projectIdm: null,
			projectIdp: null,
			pay: null,
			members: null,
			payments: null,
			cash: null,
			num: 0,
			form: { ...initForm },
		},
		methods: {
			getMembersData(){
				var self = this;
				axios.get("{{ url('api/members') }}/" + self.projectIdm).then(function(response){
					self.members = response.data;
				})
			},
			getPaymentsData(){
				var self = this;
				axios.get("{{ url('api/payments') }}/" + self.projectIdp).then(function(response){
					self.payments = response.data;
				})
			},
			getPaymentsCashData(){
				var self = this;
				axios.get("{{ url('api/payments-cash') }}/" + self.projectIdp).then(function(response){
					self.cash = response.data;
				})
			},
			getPayCashData(){
				var self = this;
				axios.get("{{ url('api/fullpay') }}/" + self.projectIdp).then(function(response){
					self.pay = response.data.payed;
				})
			},
			pushId(value, id, index){
				var self = this;
				this.form.nominal[index] = value
				this.form.user_id[index] = id
				this.form.date = dateStr
			},
			handleSubmit () {
				console.log(this.form)
				axios.post('http://localhost:8000/api/payments/', this.form)
					.then(() => {
						this.form = { ...initForm }
						this.showModalNewPayment = false
						this.getPaymentsData()
						this.getPaymentsCashData()
						this.getPayCashData()
					})
					.cath((err) => console.log(err.response))
			}
		},
		watch: {
			projectIdm: function(val, oldVal){
				this.getMembersData();
				this.form.project_id = this.projectIdm;
				this.form.project_name = this.payments.project_name;
			},
			projectIdp: function(val, oldVal){
				this.getPaymentsData();
				this.getPaymentsCashData();
				this.getPayCashData();
			},
		},
	});
</script>
@endsection

@section('script')

<script src="/deskapp/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
@endsection
