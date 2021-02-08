@extends('includes.dashboard')

@section('title', 'Create Project')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Create Project</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
					<li class="breadcrumb-item active" aria-current="page">Create Project</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Create Project</h4>
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
	<form id="locations" action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="pd-20">
		<h5 class="text-bold h5 pb-3">Data Project Form</h5>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Project Name</label>
						<div class="col-12">
							<input class="form-control" name="project_name" value="{{ old('project_name') }}" type="text" placeholder="Project Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Project Start</label>
						<div class="col-12">
							<input class="form-control date-picker" name="start" value="{{ old('start') }}" placeholder="Select Date" type="text" data-date-format="yyyy-m-d" readonly style="background-color: white !important;">
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Project price</label>
						<div class="col-12">
							<input class="form-control" name="price" value="{{ old('price') }}" placeholder="10000000" type="number">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Project Finish</label>
						<div class="col-12">
							<input class="form-control date-picker" name="finish" value="{{ old('finish') }}" placeholder="Select Date" type="text" data-date-format="yyyy-m-d" readonly style="background-color: white !important;">
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-12 col-form-label">Project Description</label>
				<div class="col-sm-12">
					<textarea name="description" class="form-control border-radius-0" placeholder="Enter your description ...">{{ old('description') }}</textarea>
				</div>
			</div>
	</div>
	<div class="pd-20">
		<h5 class="text-bold h5 pb-3">Data Client Form</h5>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<div
						class="custom-control custom-radio custom-control-inline"
					>
						<input
							type="radio"
							class="custom-control-input"
							name="is_client_old"
							id="openStoreTrue"
							v-model="is_client_old"
							:value="true"
						/>
						<label for="openStoreTrue" class="custom-control-label">
							Old Client
						</label>
					</div>
					<div
						class="custom-control custom-radio custom-control-inline"
					>
						<input
							type="radio"
							class="custom-control-input"
							name="is_client_old"
							id="openStoreFalse"
							v-model="is_client_old"
							:value="false"
						/>
						<label for="openStoreFalse" class="custom-control-label">
							New Client
						</label>
					</div>
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group row" v-if="is_client_old">
						<label class="col-12 col-form-label">Select Client</label>
						<div class="col-12">
							<select name="client_id" class="custom-select2 form-control">
								@foreach ($clients as $client)
										<option value="{{ $client->id }}">{{ $client->client_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row" v-if="!is_client_old">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Client Name</label>
						<div class="col-12">
							<input class="form-control" name="client_name" value="{{ old('client_name') }}" type="text" placeholder="Johnny Brown">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Client Company Name</label>
						<div class="col-12">
							<input class="form-control" name="company_name" value="{{ old('company_name') }}" placeholder="company_name" type="text">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Province</label>
						<div class="col-12">
							<select class="custom-select" name="provinces_id" id="provinces_id" v-if="provinces" v-model="provinces_id">
								<option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
							</select>
							<select v-else class="custom-select"></select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">District</label>
						<div class="col-12">
							<select class="custom-select" name="districts_id" id="districts_id" v-if="districts" v-model="districts_id">
								<option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
							</select>
							<select v-else class="custom-select"></select>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Client Email</label>
						<div class="col-12">
							<input class="form-control" name="email" value="{{ old('email') }}" placeholder="example@example.com" type="email">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Client WhatsApp</label>
						<div class="col-12">
							<input class="form-control" name="whatsapp" value="{{ old('whatsapp') }}" type="text" placeholder="0856*********">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">City</label>
						<div class="col-12">
							<select class="custom-select" name="cities_id" id="cities_id" v-if="cities" v-model="cities_id">
								<option v-for="city in cities" :value="city.id">@{{ city.name }}</option>
							</select>
							<select v-else class="custom-select"></select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Village</label>
						<div class="col-12">
							<select class="custom-select" name="villages_id" id="villages_id" v-if="villages" v-model="villages_id">
								<option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
							</select>
							<select v-else class="custom-select"></select>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group row" v-if="!is_client_old">
				<label class="col-12 col-form-label">Client Address</label>
				<div class="col-12">
					<textarea name="address" class="form-control border-radius-0" placeholder="Enter your address ...">{{ old('address') }}</textarea>
				</div>
			</div>
	</div>
	<div class="pd-20">
		<h5 class="text-bold h5 pb-3">Member of project</h5>
		<div class="row">
				<div class="col">
						<div class="form-group">
								<button class="btn btn-sm btn-success" type="button" v-on:click="addRows">Add</button>
						</div>
				</div>
		</div>
			<div v-for="(member, index) in members">
				<div class="row">
					<div class="col-sm-12 col-md-5">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">User Name</label>
							<div class="col-12">
								<select name="user_id[]" class="custom-select form-control" v-model="member.user_id">
									@foreach ($users as $user)
											<option value="{{ $user->id }}">{{ $user->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-5">
						<div class="form-group row">
							<label class="col-12 col-form-label">User Role</label>
							<div class="col-12">
								<select name="role[]" class="custom-select from-control" v-model="member.role">
									@foreach ($role as $ro)
										<option value="{{ $ro->name }}">{{ $ro->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-2">
						<div class="form-group row">
							<label class="col-12 col-form-label">Remove</label>
							<div class="col-12">
								<button class="btn btn-sm btn-danger" type="button" v-on:click="removeRows(index)">remove</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="input-group mb-0">
						<!--
							use code for form submit
							<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
						-->
						<button class="btn btn-primary btn-lg btn-block">Submit</button>
					</div>
				</div>
			</div>
	</div>
	</form>
</div>

@endsection

@section('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
	var locations = new Vue({
		el: "#locations",
		mounted(){
			this.getProvincesData();
			this.members = JSON.parse(this.$el.dataset.members)
		},
		data: {
			is_client_old: true,
			provinces:null,
			cities:null,
			districts:null,
			villages:null,
			provinces_id:null,
			cities_id:null,
			districts_id:null,
			villages_id:null,
			member: {
				user_id: '',
				role: '',
			},
			members: [],
		},
		methods: {
			getProvincesData(){
				var self = this;
				axios.get("{{ route('api-provinces')}}").then(function(response){
					self.provinces = response.data;
				});
			},
			getCitiesData(){
				var self = this;
				axios.get("{{ url('api/cities') }}/" + self.provinces_id).then(function(response){
					self.cities = response.data;
				});
			},
			getDistrictsData(){
				var self = this;
				axios.get("{{ url('api/districts') }}/" + self.cities_id).then(function(response){
					self.districts = response.data;
				});
			},
			getVillagesData(){
				var self = this;
				axios.get("{{ url('api/villages') }}/" + self.districts_id).then(function(response){
					self.villages = response.data;
				});
			},
			addRows: function (){
				this.members.push(Vue.util.extend({}, this.member))
			},
			removeRows: function (index){
				Vue.delete(this.members, index)
			},
		},
		watch: {
			provinces_id: function(val, oldVal){
				this.cities_id = null;
				this.getCitiesData();
			},
			cities_id: function(val, oldVal){
				this.districts_id = null;
				this.getDistrictsData();
			},
			districts_id: function(val, oldVal){
				this.villages_id = null;
				this.getVillagesData();
			},
		}
	})
</script>
@endsection