<template>
	<div>
		<div class="card">
			<div class="card-header p-2">
				<ul class="nav nav-pills">
					<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
					<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
					<li v-if="userid == auth" class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="active tab-pane" id="activity">
					</div>
					<div v-if="userid == auth" class="tab-pane" id="settings">
						<div v-if="message==true" class="alert alert-success">
							<span class="text-cener">Updated Successfully</span>
						</div>
						<form class="form-horizontal" @submit.prevent="updateSettings">
							<div class="form-group row">
								<label for="inputName" class="col-sm-2 col-form-label">Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputName" placeholder="Name" v-model="form.name">
									<span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span><br>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="inputEmail" v-model="form.email">
									<span v-if="error.email" class="text text-danger">{{ error.email[0] }}</span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName2" class="col-sm-2 col-form-label">Account Type</label>
								<div class="col-sm-10">
									<select id="inputName2" v-model="form.acctype" class="form-control">
										<option v-for="type in types" :value="type">{{type.toUpperCase()}}</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
									<button type="submit" class="btn btn-danger">Submit</button>
								</div>
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return {
				form:{
					name:'',
					email:'',
					acctype:null,
				},
				types:['public','private','onlyme'],
				error:[],
				message:false,
			}
		},
		props:['auth','userid'],
		created(){
			this.getUser()
		},
		methods:{
			getUser(){
				axios.get('/api/profile/'+this.userid)
				.then(res=>{
					this.form = res.data
				})
				.catch(err=>{
					console.log(err)
				})
			},
			updateSettings(){
				axios.post('/api/profile/'+this.userid+'/settings',{
					'name':this.form.name,
					'email':this.form.email,
					'acctype':this.form.acctype,
				})
				.then(res=>{
					this.error = []
					this.message = true
					this.getUser()
				})
				.catch(err=>{
					console.log(err)
					this.error=err.response.data.errors
				})
			}

		}
		
	}
</script>