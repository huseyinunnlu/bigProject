<template>
	<div>
		<loading :active.sync="isLoading" />		
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Details Of {{ration.name}}</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><router-link :to="{name: 'FrontRationsList'}">Go Back</router-link></li>
							<li class="breadcrumb-item active">Ration Details</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="head col-md-12 d-flex justify-content-between">
										<div>
											<h5 @change="myFav()">Ration Name: {{ration.type.name}} 
												<button v-if="!fav.id && userid != ration.user_id" @click="addFav()"  class="btn btn-primary btn-sm ml-2 mr-2" type="submit"><i class="far fa-bookmark"></i></button>
												<button v-if="fav.id && userid != ration.user_id" @click="delFav(fav.id)"class="btn btn-primary btn-sm ml-2 mr-2" type="submit"><i class="fas fa-bookmark"></i></button>
												<span class="text-success">{{ration.favs_count}} Favorites</span>
											</h5>
											<br>
											<h5 class="mb-2">Author: {{ration.user.name}}</h5>
										</div>
										<div v-if="userid==ration.user_id">
											<button data-toggle="modal" data-target="#deleteModal" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
											<button type="submit" class="btn btn-primary btn-sm">Edit</button>
										</div>
									</div>

									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.energy}}<sup style="font-size: 20px">mcal/kg</sup></h3>
												<p>Energy</p>
											</div>
											<div class="icon">
												<i class="fas fa-bolt"></i>
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.drym}}<sup style="font-size: 20px">%</sup></h3>
												<p>Dry Matter</p>
											</div>
											<div class="icon">
												<i class="fas fa-tint-slash"></i>
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.protein}}<sup style="font-size: 20px">gr</sup></h3>
												<p>Protein</p>
											</div>
											<div class="icon">
												<i class="fas fa-dna"></i>		
											</div>
										</div>
									</div>

									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.sumfood}}<sup style="font-size: 20px">(Kg)</sup></h3>
												<p>Sum Food</p>
											</div>
											<div class="icon">
												<i class="fas fa-plus"></i>
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3 v-if="ration.price">{{ration.price.slice(0,6)}}<sup style="font-size: 20px">(Tl or $)</sup></h3>
												<h3 v-else="">0<sup style="font-size: 20px">(Tl or $)</sup></h3>
												<p>Ration's 1KG Price</p>
											</div>
											<div class="icon">
												<i class="fas fa-plus"></i>
											</div>
										</div>
									</div>

									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.ca}}<sup style="font-size: 20px">(%)</sup></h3>
												<p>Calcium</p>
											</div>
											<div class="icon">

											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.p}}<sup style="font-size: 20px">(%)</sup></h3>
												<p>Phosfor</p>
											</div>
											<div class="icon">

											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{ration.nacl}}<sup style="font-size: 20px">%</sup></h3>
												<p>Ration's 1KG Price</p>
											</div>
											<div class="icon">
												<i class="fas fa-plus"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="card card-danger">
											<div class="card-header">
												<h3 class="card-title">Food Content</h3>
												<div class="card-tools"></div>
											</div>
											<div class="card-body">
												<ul class="list-group">
													<li class="list-group-item d-flex justify-content-between">
														<strong class="text-primary">Food Name:</strong>
														<div class="d-flex justify-content-around">
															<span class="badge badge-primary mr-2">Amount (Kg)</span>
															<span class="badge badge-primary">Price ($ or Tl)</span>
														</div>
													</li>
													<li v-for="food in ration.food" class="list-group-item d-flex justify-content-between">
														<strong class="text-primary">{{food.name.name}}</strong>
														<div class="d-flex justify-content-around">
															<span class="badge badge-primary mr-2">{{food.amount}}</span>
															<span class="badge badge-primary">{{food.price}}</span>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button @click="resetFields()" type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body row d-flex flex-column">
								<h3 class="text-success text-center">Are You Sure Delete Ration</h3>
							</div>
							<div class="modal-footer d-flex justify-content-center">
								<button @click="deleteRation(ration.id)" type="button" class="btn btn-danger btn-sm">Yes</button>
								<button type="button"  data-dismiss="modal" aria-label="Close" class="btn btn-primary btn-sm">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
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
			ration:[],
			message:false,
			fav:[],
			isLoading: false,
			isSuccess: false,
		}
	},
	props:['userid','type'],
	created(){
		this.getRation()
		this.myFav()
	},
	methods:{
		getRation(){
			this.isLoading = true
			axios.get('/api/ration/'+this.$route.params.id+'/details')
			.then(res=>{
				this.ration = res.data
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)
		},
		deleteRation(id){
			this.isLoading = true
			axios.delete('/api/ration/'+id+'/delete')
			.then(res=>{
				this.$router.push({name: 'FrontRationsList'});
				$('#deleteModal').hide();
				$('.modal-backdrop').hide();
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)
		},
		addFav(){
			this.isLoading = true
			axios.post('/api/ration/addfav',{
				user_id:this.userid,
				ration_id:this.ration.id
			})
			.then(res=>{
				this.getRation()
				this.isSuccess = true
			})
			.catch(err=>{
				console.log(err)
			})
			.finally(()=>this.isLoading = false)
		},

		myFav(){
			axios.get('/api/ration/myfav',{
				params:{
					user_id:this.userid,
					rat_id:this.$route.params.id,
				}
			})
			.then(res=>{
				this.getRation()
				this.fav = res.data
			})
			.catch(err=>{
				console.log(err)
			})
		},
		delFav(id){
			axios.delete('/api/ration/myfav/'+this.fav.id+'/delete')
			.then(res=>{
				this.getRation()
				this.myFav()
			})
			.catch(err=>{
				console.log(err)
			})
		}

	}
}
</script>