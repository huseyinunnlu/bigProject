<template>
	<div>
		<loading :active.sync="isLoading" />
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Details Of {{type.name}}</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><router-link :to="{name: 'RationsList'}">Go Back</router-link></li>
							<li class="breadcrumb-item active">Food Detail</li>
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
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{type.drym}}<sup style="font-size: 20px">%</sup></h3>
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
												<h3>{{type.energy}}<sup style="font-size: 20px">mcal/kg</sup></h3>
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
												<h3>{{type.protein}}<sup style="font-size: 20px">gr</sup></h3>
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
												<h3>{{type.ca}}<sup style="font-size: 20px">%</sup></h3>
												<p>Calcium</p>
											</div>
											<div class="icon">		
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{type.p}}<sup style="font-size: 20px">%</sup></h3>
												<p>Phosfor</p>
											</div>
											<div class="icon">		
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{type.nacl}}<sup style="font-size: 20px">%</sup></h3>
												<p>Nacl</p>
											</div>
											<div class="icon">		
											</div>
										</div>
									</div>
									
								</div>
							</div>
							<div class="col-md-4">
								<div class="card card-danger">
									<div class="card-header">
										<h3 class="card-title">Edit Type</h3>
									</div>
									<div class="card-body">
										<div v-if="message == true" class="alert alert-success text-center">
											<span>Type Updated Successfully</span>
										</div>	
										<form @submit.prevent="updateType">
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
											<button type="submit" class="btn btn-success btn-sm">Update Ration Type</button>
										</form>
									</div>
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
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css';
	export default {
		components:{
			Loading
		},
		data(){
			return {
				type:[],
				typeForm:{
					'name':'',
					'drym':'',
					'energy':'',
					'protein':'',
					'ca':'',
					'p':'',
					'nacl':'',
				},
				message:false,
				error:[],
				isLoading:false,
				isSuccess:true,
			}
		},
		created(){
			this.getType()
		},
		methods:{
			getType(){
				this.isLoading = true
				axios.get('/api/rations/type/'+this.$route.params.id+'/details')
				.then(res=>{
					this.type = res.data
					this.typeForm = res.data
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.isLoading = false) 
			},
			updateType(){
				this.isLoading = true
				axios.post('/api/rations/type/'+this.$route.params.id+'/update',{
					'name':this.typeForm.name,
					'drym':this.typeForm.drym,
					'energy':this.typeForm.energy,
					'protein':this.typeForm.protein,
					'ca':this.typeForm.ca,
					'p':this.typeForm.p,
					'nacl':this.typeForm.nacl,
				})
				.then(res=>{
					this.message = true;
					this.getType()
					this.isSuccess = true
				})
				.catch(err=>{
					this.message = false
					this.error = err.response.data.errors;
				})
				.finally(()=>this.isLoading = false)
			}
		}
	}
</script>