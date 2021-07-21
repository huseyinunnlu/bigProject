<template>
	<div>
		<div>
			<loading :active.sync="isLoading" />
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Rations</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a v-bind:href="/dashboard/">Home</a></li>
								<li class="breadcrumb-item active">Rations</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<section class="content">
				<div class="container-fluid row">
					<div v-if="delMessage==true" class="alert alert-success text-center col-md-12">
						<span>Deleted Successfully</span>
					</div>
					<div class="col-md-8 offset-md-2">
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control float-right" placeholder="Search Food By Name" style="width: 200px;" v-model="search">
										<div class="input-group-append">
											<button @click="getFood" type="submit" class="btn btn-default">
												<i class="fas fa-search"></i>
											</button>
											<button @click="reset" type="submit" class="btn btn-default">
												<i class="fas fa-undo"></i>
											</button>
										</div>
									</div>
								</div>
								<button data-toggle="modal" data-target="#addRationFood" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Ration Food</button>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th>Name</th>
											<th>Dry Matter</th>
											<th>Energy</th>
											<th>Protein</th> 
											<th>Destroyable Protein</th>
											<th>Bypass Protein</th>
											<th>Opr.</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="food in foods" :key="food.id">
											<td>{{food.name}}</td>
											<td>{{food.drym}}</td>
											<td>{{food.energy}}</td>
											<td>{{food.protein}}</td>
											<td>{{food.dp}}</td>
											<td>{{food.bp}}</td>
											<td>
												<router-link :to="{
													name: 'RationFood',
													params :{id:food.id}
												}"   class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></router-link>
												<button class="btn btn-danger btn-sm" @click="deleteFood(food.id)"><i class="fas fa-times"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
								<pagination class="ml-2" :show-disabled="true" :data="foods" @pagination-change-page="getFood"></pagination>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control float-right" placeholder="Search Food By Name" style="width: 200px;" v-model="typeSearch">
										<div class="input-group-append">
											<button @click="getType" type="submit" class="btn btn-default">
												<i class="fas fa-search"></i>
											</button>
											<button @click="resettype" type="submit" class="btn btn-default">
												<i class="fas fa-undo"></i>
											</button>
										</div>
									</div>
								</div>
								<button data-toggle="modal" data-target="#addRationType" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Ration Type</button>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th>Name</th>
											<th>Energy</th>
											<th>Protein / Dry Matter</th> 
											<th>Calcium / Phosfor</th>
											<th>Nacl</th>
											<th>Opr.</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="type in types" :key="type.id">
											<td>{{type.name}}</td>
											<td>{{type.energy}}</td>
											<td>{{type.protein}} / {{type.drym}}</td>
											<td>{{type.ca}} / {{type.p}}</td>
											<td>{{type.nacl}}</td>
											<td>
												<router-link :to="{
													name: 'RationType',
													params :{id:type.id}
												}"   class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></router-link>
												<button class="btn btn-danger btn-sm" @click="deleteType(type.id)"><i class="fas fa-times"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<div>
						<div class="modal fade" id="addRationFood" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Food Create</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div v-if="foodMessage==true" class="alert alert-success text-center">
											<span>Food Created Successfully</span>
										</div>	
										<form @submit.prevent="addFood">
											<div class="row">
												<div class="form-group">
													<label for="name">Food Name</label>
													<input id="name" type="text" class="form-control" placeholder="Food Name" v-model="foodForm.name">
													<span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="drym">DryMatter(%)</label>
														<input id="drym" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.drym">
														<span v-if="error.drym" class="text text-danger">{{ error.drym[0] }}</span>
													</div>
													<div class="form-group col-md-6">
														<label for="dryMatter">Energy(mcal/kg)</label>
														<input id="dryMatter" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.energy">
														<span v-if="error.energy" class="text text-danger">{{ error.energy[0] }}</span>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-4">
														<label for="proteindp">Protein(Gr)</label>
														<input id="proteindp" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.protein">
														<span v-if="error.protein" class="text text-danger">{{ error.protein[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="dp">Destr. Protein(gr)</label>
														<input id="dp" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.dp">
														<span v-if="error.dp" class="text text-danger">{{ error.dp[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="bp">Bypass Protein(gr)</label>
														<input id="bp" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.bp">
														<span v-if="error.bp" class="text text-danger">{{ error.bp[0] }}</span>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-4">
														<label for="c">Cellulose(Gr)</label>
														<input id="c" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.cel">
														<span v-if="error.cel" class="text text-danger">{{ error.cel[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="fat">Fat(Gr)</label>
														<input id="fat" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.fat">
														<span v-if="error.fat" class="text text-danger">{{ error.fat[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="ash">Ash(Gr)</label>
														<input id="ash" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.ash">
														<span v-if="error.ash" class="text text-danger">{{ error.ash[0] }}</span>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-4">
														<label for="ca">Calsium(Gr)</label>
														<input id="ca" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.ca">
														<span v-if="error.ca" class="text text-danger">{{ error.ca[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="p">Phospor(Gr)</label>
														<input id="p" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.p">
														<span v-if="error.p" class="text text-danger">{{ error.p[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="na">Sodium(Gr)</label>
														<input id="na" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.na">
														<span v-if="error.na" class="text text-danger">{{ error.na[0] }}</span>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-4">
														<label for="k">Potasium(Gr)</label>
														<input id="k" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.k">
														<span v-if="error.k" class="text text-danger">{{ error.k[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="s">Kükürt(Gr)</label>
														<input id="s" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.s">
														<span v-if="error.s" class="text text-danger">{{ error.s[0] }}</span>
													</div>	
													<div class="form-group col-md-4">
														<label for="cl">Clor(Gr)</label>
														<input id="cl" type="text" class="form-control" placeholder="Ex:50,80" v-model="foodForm.cl">
														<span v-if="error.cl" class="text text-danger">{{ error.cl[0] }}</span>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-success btn-sm">Add Food</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="addRationType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Ration Type Create</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div v-if="typeMessage==true" class="alert alert-success text-center">
											<span>Ration Type Created Successfully</span>
										</div>	
										<form @submit.prevent="addType">
											<div class="row">
												<div class="form-group col-md-12">
													<label for="name">Type Name</label>
													<input id="name" type="text" class="form-control" placeholder="Type Name" v-model="typeForm.name">
													<span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span>
												</div>
												<div class="form-group col-md-12">
													<label for="energy">Type Energy(kcal)</label>
													<input id="energy" type="text" class="form-control" placeholder="Type Energy" v-model="typeForm.energy">
													<span v-if="error.energy" class="text text-danger">{{ error.energy[0] }}</span>
												</div>
												<div class="form-group col-md-6">
													<label for="protein">Protein(%)</label>
													<input id="protein" type="text" class="form-control" placeholder="Type Protein" v-model="typeForm.protein">
													<span v-if="error.protein" class="text text-danger">{{ error.protein[0] }}</span>
												</div>
												<div class="form-group col-md-6">
													<label for="drym">Dry Matter(%)</label>
													<input id="drym" type="text" class="form-control" placeholder="DryMatter" v-model="typeForm.drym">
													<span v-if="error.drym" class="text text-danger">{{ error.drym[0] }}</span>
												</div>
												<div class="row">
													<div class="form-group col-md-4">
														<label for="ca">Ca(%)</label>
														<input id="ca" type="text" class="form-control" placeholder="Calcium" v-model="typeForm.ca">
														<span v-if="error.ca" class="text text-danger">{{ error.ca[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="p">Phosfor(%)</label>
														<input id="p" type="text" class="form-control" placeholder="Phosfor" v-model="typeForm.p">
														<span v-if="error.p" class="text text-danger">{{ error.p[0] }}</span>
													</div>
													<div class="form-group col-md-4">
														<label for="nacl">Nacl(%)</label>
														<input id="nacl" type="text" class="form-control" placeholder="Nacl" v-model="typeForm.nacl">
														<span v-if="error.nacl" class="text text-danger">{{ error.nacl[0] }}</span>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-success btn-sm">Add Ration Type</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</template>
<script>
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
	components:{
		Loading
	},
	data(){
		return {
			foods:{},
			types:[],
			foodForm:{
				'name':'',
				'drym':'',
				'energy':'',
				'protein':'',
				'dp':'',
				'bp':'',
				'cel':'',
				'fat':'',
				'ash':'',
				'ca':'',
				'p':'',
				'na':'',
				'k':'',
				's':'',
				'cl':'',
			},
			typeForm:{
				'name':'',
				'energy':'',
				'protein':'',
				'drym':'',
				'ca':'',
				'p':'',
				'nacl':'',
			},
			search:'',
			typeSearch:'',
			foodMessage:false,
			typeMessage:false,
			delMessage:false,
			error:[],
			isLoading:false,
			isSuccess:false,
		}
	},
	created(){
		this.getFood()
		this.getType()
	},
	props:['userid'],
	methods:{
		reset(){
			this.search = ''
			this.getFood()
		},
		resettype(){
			this.typeSearch = ''
			this.getType()
		},
		addFood(){
			this.isLoading = true
			axios.post('/api/rations/addfood',{
				'name':this.foodForm.name,
				'drym':this.foodForm.drym,
				'energy':this.foodForm.energy,
				'protein':this.foodForm.protein,
				'dp':this.foodForm.dp,
				'bp':this.foodForm.bp,
				'cel':this.foodForm.cel,
				'fat':this.foodForm.fat,
				'ash':this.foodForm.ash,
				'ca':this.foodForm.ca,
				'p':this.foodForm.p,
				'na':this.foodForm.na,
				'k':this.foodForm.k,
				's':this.foodForm.s,
				'cl':this.foodForm.cl,
			})
			.then(res=>{
				this.foodMessage=true
				this.getFood()
				this.foodForm = ''
				this.isSuccess = true
			})
			.catch(err=>{
				this.error = err.response.data.errors;
			})
			.finally(()=>this.isLoading = false)
		},
		addType(){
			this.isLoading = true
			axios.post('/api/rations/addType',{
				'name':this.typeForm.name,
				'energy':this.typeForm.energy,
				'protein':this.typeForm.protein,
				'drym':this.typeForm.drym,
				'ca':this.typeForm.ca,
				'p':this.typeForm.p,
				'nacl':this.typeForm.nacl,
			})
			.then(res=>{
				this.typeMessage=true
				this.isSuccess = true
			})
			.catch(err=>{
				this.error = err.response.data.errors
			})
			.finally(()=>this.isLoading = false)
		},
		getType(){
			this.isLoading = true
			axios.get('/api/rations/gettype',{
				params:{
					typesearch:this.typeSearch,
				}
			})
			.then(res=>{
				this.types = res.data
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)			
		},
		getFood(page = 1){
			this.isLoading = true
			axios.get('/api/rations/getfood?page=' + page,{
				params:{
					search:this.search,
				}
			})
			.then(res=>{
				this.foods = res.data
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)	
		},
		deleteFood(id){
			this.isLoading = true
			axios.delete('/api/rations/'+id+'/deletefood')
			.then(res=>{
				this.delMessage=true
				this.getFood()
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)
		},
		deleteType(id){
			this.isLoading = true
			axios.delete('/api/rations/'+id+'/deletetype')
			.then(res=>{
				this.delMessage=true
				this.getType()
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)
		}

	},
}
</script>	