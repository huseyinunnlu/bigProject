<template>
	<div>
		<section class="content">
			<div class="container-fluid">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Users {{users.length}} data found.</h3>
									<div class="card-tools">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control float-right" placeholder="Search name or email" v-model="form.search" style="width: 170px;">
											<select v-model="form.type" class="form-control" style="width: 100px">
												<option v-for="perm in perms" :key="perm" :value="perm">{{perm.toUpperCase()}}</option>
											</select>
											<div class="input-group-append">
												<button type="submit" class="btn btn-default" @click="getUsers">
													<i class="fas fa-search"></i>
												</button>
												<button type="submit" class="btn btn-default" @click="reset">
													<i class="fas fa-undo"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive p-0">
									<table class="table table-hover text-nowrap">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name Surname</th>
												<th>Email</th>
												<th>Register Date</th>
												<th>Type / Account Type</th>
												<th>Opr.</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="user in users" :key="user.id">
												<td>{{user.id}}</td>
												<td>{{user.name}}</td>
												<td>{{user.email}}</td>
												<td>{{user.created_at}}</td>
												<td>{{user.type}} / {{user.acctype}}</td>
												<td>
													<button data-toggle="modal" data-target="#editUser" class="btn btn-primary btn-sm" @click="getDetail(user.id)"><i class="fas fa-pen"></i></button>
													<button class="btn btn-danger btn-sm" @click="deleteUser(user.id)"><i class="fas fa-times"></i></button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
				<div>
					<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div v-if="message==true" class="alert alert-success">
										<span class="text-cener">Updated Successfully</span>
									</div>
									<form @submit.prevent="updateUser(id)">
										<div class="form-group">
											<label for="gender">Permisson</label>
											<select v-model="form.perm" class="form-control">
												<option :selected="form.perm==perm" v-for="perm in perms" :value="perm" v-text="perm.toUpperCase()"></option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary btn-sm">Update</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>
<script>
	export default {
		data(){
			return{
				perms:['user','verified','admin','moderator'],
				users:[],
				id:'',
				form:{
					perm:'',
					search:'',
					type:null,
				},
				message:false,
			}
		},
		created(){
			this.getUsers()
		},
		methods:{
			getUsers(){
				axios.get('/api/users', {
					params: {
						search: this.form.search,
						type: this.form.type,
					}
				})
				.then(res=>{
					this.users = res.data
				})
				.catch(err=>{
					console.log(err)
				})
			},
			reset(){
				this.form.search = ''
				this.form.type = null
				this.getUsers()
			},
			getDetail(id){
				axios.get('/api/users/'+id)
				.then(res=>{
					this.id = res.data.id
					this.form.perm = res.data.type
				})
				.catch(err=>{
					console.log(err)
				})
			},
			updateUser(id){
				axios.post('/api/users/'+id+'/update',{
					'type':this.form.perm,
				})
				.then(res=>{
					this.message=true
					this.getUsers()
				})
				.catch(err=>{
					console.log(err)
				})
			},
			deleteUser(id){
				axios.delete('api/users/'+id+'/delete')
				.then(res=>{
					this.getUsers()
				})
				.catch(err=>{
					console.log(err)
				})
			}
		}
	}
</script>