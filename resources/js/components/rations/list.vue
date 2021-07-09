<template>
	<div>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>All Created Rations</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a v-bind:href="/dashboard/">Home</a></li>
							<li class="breadcrumb-item active">All Created Rations</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<section class="content">
			<div class="container-fluid row">
				<div class="col-md-8 offset-md-2">
					<div class="card">
						<div class="card-header">
							<div class="card-tools">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control float-right" placeholder="Search Ration By Name" style="width: 200px;" v-model="form.search">
									<select class="form-control" v-model="form.get" style="width:auto">
										<option :value="null">All</option>
										<option :value="'fav'">Favorite Rations</option>
										<option :value="'my'">My Rations</option>
									</select>
									<select class="form-control" v-model="form.order" style="width:auto">
										<option :value="'desc'">Favorite (9 to 0)</option>
										<option :value="'asc'">Favorite (0 to 9)<i class="fas fa-sort-numeric-down"></i></option>
									</select>
									
									<div class="input-group-append">
										<button @click="getRations()" type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										</button>
										<button @click="reset()" type="submit" class="btn btn-default">
											<i class="fas fa-undo"></i>
										</button>
									</div>
								</div>
							</div>
							<router-link :to="{name:'FrontRationsCreate'}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Ration
							</router-link>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<thead>
									<tr>
										<th>Name</th>
										<th>User's Name</th>
										<th>Ration Name</th>
										<th>Energy</th> 
										<th>Protein</th>
										<th>Drym</th>
										<th>Sum Food</th>
										<th>Price Of 1kg</th>
										<th>Opr.</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="ration in rations.data" :key="ration.id">
										<td v-if="ration.user.id == userid">{{ration.name}} <i class="fas fa-user text-success"></i> <i class="fas fa-bookmark text-primary"></i> {{ration.favs_count}}</td>
										<td v-else="">{{ration.name}} <i class="fas fa-bookmark text-primary"></i> {{ration.favs_count}}</td>
										<td>{{ration.user.name}}</td>
										<td>{{ration.type.name}}</td>
										<td>{{ration.energy}}</td>
										<td>{{ration.protein}}</td>
										<td>{{ration.drym}}</td>
										<td>{{ration.sumfood}} - N.Of.Foods: <span class="badge badge-primary">{{ration.food_count}}</span></td>
										<td>{{ration.price}}</td>
										<td>
											<router-link v-if="userid == ration.user_id" :to="{
												name: 'FrontRationsEdit',
												params: {id:ration.id}
											}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></router-link>
											<router-link :userid="userid" :to="{
												name: 'FrontRationsDetails',
												params: {id:ration.id}
											}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></router-link>
										</td>
									</tr>
								</tbody>
							</table>
							<pagination class="ml-2" :show-disabled="true" :data="rations" @pagination-change-page="getRations"></pagination>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<!-- /.card -->
				</div>
			</div>
		</section>
	</div>
</template>
<script>
export default {
	data(){
		return{
			rations:{},
			form:{
				search:'',
				get:null,
				order:'desc',
			},
		}
	},
	props:['userid'],
	created(){
		this.getRations()	
	},
	methods:{
		reset(){
			this.form.search = ''
			this.form.get = null
			this.form.order = 'desc'
			this.getRations()
		},
		getRations(page = 1){
			axios.get('/api/rations/list?page=' + page,{
				params:{
					get:this.form.get,
					search:this.form.search,
					userid:this.userid,
					order:this.form.order
				}
			})
			.then(res=>{
				this.rations = res.data
			})
			.catch(err=>{
				console.log(err)
			})
		}
	}
}
</script>