@extends('includes.dashboard')

@section('title', 'Edit Project')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>Edit Project</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
					<li class="breadcrumb-item active" aria-current="page">Edit Project</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Form Edit Project</h4>
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
	<form id="locations" action="{{ route('projects.update', $project->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="pd-20">
		<h5 class="text-bold h5 pb-3">Data Project Form</h5>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Project Name</label>
						<div class="col-12">
							<input class="form-control" name="project_name" value="{{ old('project_name', $project->project_name) }}" type="text" placeholder="Project Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Project Start</label>
						<div class="col-12">
							<input class="form-control" name="start" value="{{ old('start', $project->start) }}" placeholder="Select Date" type="date">
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group row">
						<label class="col-12 col-form-label">Project price</label>
						<div class="col-12">
							<input class="form-control" name="price" value="{{ old('price', $project->price) }}" placeholder="10000000" type="number">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-12 col-form-label">Project Finish</label>
						<div class="col-12">
							<input class="form-control" name="finish" value="{{ old('finish', $project->finish) }}" placeholder="Select Date" type="date">
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-12 col-form-label">Project Description</label>
				<div class="col-sm-12">
					<textarea name="description" class="form-control border-radius-0" placeholder="Enter your description ...">{{ old('description', $project->description) }}</textarea>
				</div>
			</div>
	</div>
	<div class="pd-20">
		<h5 class="text-bold h5 pb-3">Data Client Form</h5>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group row">
						<label class="col-12 col-form-label">Select Client</label>
						<div class="col-12">
							<select name="client_id" class="custom-select selectc">
								@foreach ($clients as $client)
										<option value="{{ $client->id }}">{{ $client->client_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
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
								<select name="user_id[]" class="custom-select2 form-control" v-model="member.user_id">
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
								<input type="text" name="role[]" class="form-control" v-model="member.role">
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
			this.getMembersData();
			this.members = JSON.parse(this.$el.dataset.members)
		},
		data: {
			is_client_old: true,
			projectId: '{{ $project->id }}',
			member: {
				user_id: '',
				role: '',
			},
			members: null,
		},
		methods: {
			getMembersData(){
				var self = this;
				axios.get("{{ url('api/members') }}/" + self.projectId).then(function(response){
					self.members = response.data.project_member;
				})
			},
			addRows: function (){
				this.members.push(Vue.util.extend({}, this.member))
			},
			removeRows: function (index){
				Vue.delete(this.members, index)
			},
		},
		watch: {
		}
	})
</script>
@endsection