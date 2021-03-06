@extends('includes.dashboard')

@section('title', 'Edit Client')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Edit Client</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clients</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Client</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Edit Client</h4>
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
	<form id="locations" action="{{ route('clients.update', $client->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="pd-20">
		<h5 class="text-bold h5 pb-3">Data Client Form</h5>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Client Name</label>
						<div class="col-12">
							<input class="form-control" name="client_name" value="{{ old('client_name', $client->client_name) }}" type="text" placeholder="Johnny Brown">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Client Company Name</label>
						<div class="col-12">
							<input class="form-control" name="company_name" value="{{ old('company_name', $client->company_name) }}" placeholder="company_name" type="text">
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
							<input class="form-control" name="email" value="{{ old('email', $client->email) }}" placeholder="example@example.com" type="email">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Client WhatsApp</label>
						<div class="col-12">
							<input class="form-control" name="whatsapp" value="{{ old('whatsapp', $client->whatsapp) }}" type="text" placeholder="0856*********">
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
			
			<div class="form-group row">
				<label class="col-12 col-form-label">Client Address</label>
				<div class="col-12">
					<textarea name="address" class="form-control border-radius-0" placeholder="Enter your address ...">{{ old('address', $client->address) }}</textarea>
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
				<button class="btn btn-primary btn-lg btn-block">Update</button>
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
			this.getCitiesData();
			this.getDistrictsData();
			this.getVillagesData();
		},
		data: {
			provinces:null,
			cities:null,
			districts:null,
			villages:null,
			provinces_id:'{{ $client->provinces_id }}',
			cities_id:'{{ $client->cities_id }}',
			districts_id:'{{ $client->districts_id }}',
			villages_id:'{{ $client->villages_id }}',
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