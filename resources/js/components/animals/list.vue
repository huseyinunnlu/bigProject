<template>
	<div>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Profile</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">User Profile</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-tools">
										<div class="input-group input-group-sm">
											<input :disabled="filter.col==null" type="text" class="form-control float-right" placeholder="Search Strap, earring or name" style="width: 200px;" v-model="filter.search">
											<select v-model="filter.col" class="form-control" style="width: 120px;">
												<option :value="null">Select Column</option>
												<option v-for="col in cols" :value="col">{{col.toUpperCase()}}</option>
											</select>
											<select v-model="filter.type" class="form-control" style="width: 120px;">
												<option :value="null">Select Type</option>
												<option v-for="type in types" :value="type.value">{{type.name}}</option>
											</select>
											<select v-model="filter.gender" class="form-control" style="width: 120px;">
												<option :value="null">Select Gender</option>
												<option v-for="gender in genders" :value="gender">{{gender.toUpperCase()}}</option>
											</select>
											<div class="input-group-append">
												<button type="submit" class="btn btn-default" @click="getAnimals">
													<i class="fas fa-search"></i>
												</button>
												<button @click="reset" type="submit" class="btn btn-default">
													<i class="fas fa-undo"></i>
												</button>
											</div>
										</div>
									</div>
									<button data-toggle="modal" data-target="#addAnimal" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Animal</button>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive p-0">
									<table class="table table-hover text-nowrap">
										<thead>
											<tr>
												<th>Name</th>
												<th>Earring / Strap</th>
												<th>Gender/Type</th>
												<th>Birth / Death</th>
												<th>Opr.</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="animal in animals.data">
												<td>{{animal.id}}</td>
												<td>{{animal.earring}} / {{animal.strap}}</td>
												<td>{{animal.gender}} / {{animal.type}}</td>
												<td>{{animal.birth}} / {{animal.death}}</td>
												<td>
													<router-link :to="{
														name: 'AnimalsEdit',
														params :{id:animal.id}
													}"   class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></router-link>
													<button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												</td>
											</tr>
										</tbody>
									</table>
									<pagination class="ml-2" :show-disabled="true" :data="animals" @pagination-change-page="getAnimals"></pagination>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
				<div>
					<div class="modal fade" id="addAnimal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Add Animal</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div v-if="message==true" class="alert alert-success text-center">
										<span>Animal Created Successfully</span>
									</div>	
									<form @submit.prevent="addAnimal">
										<div class="form-group">
											<label for="earring">Earring Number</label>
											<input id="earring" type="text" class="form-control" placeholder="ex:TR201090, 2090" v-model="form.earring">
											<span v-if="error.earring" class="text text-danger">{{ error.earring[0] }}</span>
										</div>
										<div class="form-group">
											<label for="strap">Strap Number</label>
											<input id="strap" type="number" class="form-control" placeholder="ex:12, 100, 02" v-model="form.strap">
											<span v-if="error.strap" class="text text-danger">{{ error.strap[0] }}</span>
										</div>
										<div class="form-group">
											<label for="name">Name</label>
											<input id="name" type="text" class="form-control" placeholder="Name" v-model="form.name">
											<span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span>
										</div>
										<div class="form-group">
											<label for="type">Type</label>
											<select class="form-control" v-model="form.type">
												<option :value="null">Select Type</option>
												<option v-for="type in types" :value="type.value">{{type.name}}</option>
												<span v-if="error.type" class="text text-danger">{{ error.type[0] }}</span>
											</select>
										</div>
										<div class="form-group">
											<label for="gender">Gender</label>
											<select class="form-control" v-model="form.gender">
												<option :value="null">Select Gender</option>
												<option v-for="gender in genders" :value="gender">{{gender.toUpperCase()}}</option>
												<span v-if="error.gender" class="text text-danger">{{ error.gender[0] }}</span>
											</select>
										</div>
										<div class="form-group">
											<label for="birth">Birth Date</label>
											<input id="birth" type="date" class="form-control" v-model="form.birth">
											<span v-if="error.birth" class="text text-danger">{{ error.birth[0] }}</span>
										</div>
										<button type="submit" class="btn btn-success btn-sm">Add Animal</button>
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
export default{
	data(){
		return {
			animals:{},
			types:[{name:'Cattles',value:'cattle',},{name:'Sheeps And Goats',value:'shandgo',}],
			genders:['male','female'],
			cols:['earring','name','strap'],
			form:{	
				earring:'',
				strap:'',
				name:'',
				type:'',
				gender:'',
				birth:'',
			},
			filter:{
				col:null,
				search:'',
				gender:null,
				type:null,
			},
			message:false,
			error:[],
		}
	},
	created(){
		this.getAnimals()
	},
	props:['userid'],
	methods:{
		addAnimal(){
			axios.post('/api/animals/create',{
				'user_id':this.userid,
				'earring':this.form.earring,
				'strap':this.form.strap,
				'name':this.form.name,
				'type':this.form.type,
				'gender':this.form.gender,
				'birth':this.form.birth,
			})
			.then(res=>{
				this.getAnimals()
				this.message = true
			})
			.catch(err=>{
				this.error = err.response.data.errors;
				console.log(err)
			})
		},
		getAnimals(page = 1){
			axios.get('/api/animals?page=' + page,{
				params:{
					user_id:this.userid,
					search:this.filter.search,
					col:this.filter.col,
					type:this.filter.type,
					gender:this.filter.gender,
				}
			})
			.then(res=>{
				this.animals = res.data
			})
			.catch(err=>{
				console.log(err)
			})
		},
		reset(){
			this.filter.col=null
			this.filter.search=''
			this.filter.gender=null
			this.filter.type=null
			this.getAnimals()
		},
	}

}
</script>