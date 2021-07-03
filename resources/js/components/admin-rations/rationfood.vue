<template>
	<div>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Details Of {{food.name}}</h1>
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
												<h3>{{food.drym}}<sup style="font-size: 20px">%</sup></h3>
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
												<h3>{{food.energy}}<sup style="font-size: 20px">mcal/kg</sup></h3>
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
												<h3>{{food.fat}}<sup style="font-size: 20px">%</sup></h3>
												<p>Fat</p>
											</div>
											<div class="icon">		
											</div>
										</div>
									</div>
									<div class="col-3">
										<div class="small-box bg-info">
											<div class="inner">
												<h3>{{food.protein}}<sup style="font-size: 20px">gr</sup></h3>
												<p>Protein</p>
											</div>
											<div class="icon">
												<i class="fas fa-dna"></i>		
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="card card-danger">
											<div class="card-header">
												<h3 class="card-title">Protein Statics</h3>
												<div class="card-tools"></div>
											</div>
											<div class="card-body">
												<canvas id="proteinChart"></canvas>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card card-danger">
											<div class="card-header">
												<h3 class="card-title">Mineral Statics</h3>
												<div class="card-tools"></div>
											</div>
											<div class="card-body">
												<canvas id="pieChart1"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card card-danger">
									<div class="card-header">
										<h3 class="card-title">Edit Food</h3>
									</div>
									<div class="card-body">
										<div v-if="message == true" class="alert alert-success text-center">
											<span>Food Updated Successfully</span>
										</div>	
										<form @submit.prevent="updateFood">
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
											<button type="submit" class="btn btn-success btn-sm">Update Food</button>
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
	export default {
		data(){
			return {
				food:[],
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
				message:false,
				error:[],
			}
		},
		created(){
			this.getfood()
		},
		methods:{
			getfood(){
				axios.get('/api/rations/food/'+this.$route.params.id+'/details')
				.then(res=>{
					this.food = res.data
					this.foodForm = res.data
					var ctxP = document.getElementById("proteinChart").getContext('2d');
					var myproteinChart = new Chart(ctxP, {
						type: 'pie',
						data: {
							labels: ["Destroyable protein "+(this.food.dp), "BypassProtein "+(this.food.bp),],
							datasets: [{
								data: [this.food.dp, this.food.bp],
								backgroundColor: ["#F7464A", "#46BFBD",],
								hoverBackgroundColor: ["#FF5A5E", "#5AD3D1",]
							}]
						},
						options: {
							responsive: true
						}
					});
					var ctxP = document.getElementById("pieChart1").getContext('2d');
					var myPieChart1 = new Chart(ctxP, {
						type: 'pie',
						data: {
							labels: ["Ash "+(this.food.ash), "Calcium "+(this.food.ca), "Cellulose "+(this.food.cel), "Clor "+(this.food.cl), "Potasium "+(this.food.k), "Sodium "+(this.food.na) ,"Phospor "+(this.food.p), "Sulfur "+(this.food.s)],
							datasets: [{
								data: [this.food.ash, this.food.ca, this.food.cel, this.food.cl, this.food.k, this.food.na, this.food.p, this.food.s],
								backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#142459", "#19AADE", "#290668"],
								hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774", "#176BA0", "#1AC9E6", "#7D3AC1"]	
							}]
						},
						options: {
							responsive: true
						}
					});

				})
				.catch(err=>{
					console.log(err)
				})
			},
			updateFood(){
				axios.post('/api/rations/food/'+this.$route.params.id+'/update',{
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
					this.message = true;
					this.getFood()
				})
				.catch(err=>{
					this.message = false
					this.error = err.response.data.errors;
				})
			}
		}
	}
</script>