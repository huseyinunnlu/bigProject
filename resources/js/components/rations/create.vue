<template>
	<div>
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
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="ration-header">
										<h3 class="text-center">Create Ration</h3>
										<form>
											<div style="display: inline-block; width: 100%; text-align: center; margin-bottom: 10px;">
												<label>Ration Name</label><br>
												<input type="text" style="width:30%;" v-model="form.name"><br>
												<span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span>

											</div>
											<div style="display: inline-block; width: 100%; text-align: center; margin-bottom: 10px;">
												<label>Ration Type</label><br>
												<select style="width:30%;" v-model="rat_type_id" @change="getSelectedType()"><br>
													<option :value="null">Select Type</option>
													<option v-for="type in types" :value="type.id">{{type.name}}</option>
												</select>
												<span v-if="error.rat_type_id" class="text text-danger">{{ error.rat_type_id[0] }}</span>
											</div>
										</form>
										<!-- /.card-header -->
										<table class="table table-bordered">
											<thead>
												<tr>
													<th></th>
													<th>In Ration</th>
													<th>Animals Need</th>
													<th style="width: 40px">Enought</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td style="width: 300px">Energy (Kcal)</td>
													<td>
														<span class="badge bg-primary">{{form.energy}}%</span>
													</td>
													<td><span class="badge bg-primary">{{selectedType.energy}} Kcal</span></td>
													<td>
														<span class="text-danger">Too Much</span>
														
													</td>
												</tr>
												<tr>
													<td style="width: 300px">Protein</td>
													<td>
														<span class="badge bg-primary">{{form.protein}}%</span>
													</td>
													<td><span class="badge bg-primary">{{selectedType.protein}} %</span></td>
													<td>
														<span class="text-danger">Too Much</span>
													</td>
												</tr>
												<tr>
													<td style="width: 300px">DryMatter</td>
													<td>
														<span class="badge bg-primary">{{form.drym}}%</span>
													</td>
													<td><span class="badge bg-primary">{{selectedType.drym}} %</span></td>
													<td>
														<span class="text-danger">Too Much</span>
													</td>
												</tr>
												<tr>
													<td style="width: 300px">Calcium</td>
													<td>
														<span class="badge bg-primary">{{form.ca}}%</span>
													</td>
													<td><span class="badge bg-primary">{{selectedType.ca}} %</span></td>
													<td>
														<span class="text-danger">Too Much</span>
													</td>
												</tr>
												<tr>
													<td style="width: 300px">Phosphor</td>
													<td>
														<span class="badge bg-primary">{{form.p}}%</span>
													</td>
													<td><span class="badge bg-primary">{{selectedType.p}} %</span></td>
													<td>
														<span class="text-danger">Too Much</span>
													</td>
												</tr>
												<tr>
													<td style="width: 300px">Nacl</td>
													<td>
														<span class="badge bg-primary">{{form.nacl}}%</span>
													</td>
													<td><span class="badge bg-primary">{{selectedType.p}} %</span></td>
													<td>
														<span class="text-danger">Too Much</span>
													</td>
												</tr>
												<tr>
													<td style="width: 300px">Ration's sum Amount(Kg)</td>
													<td><span class="badge bg-primary">{{sumfood}} Kg</span>
														<span v-if="error.sumfood" class="text text-danger">{{ error.sumfood[0] }}</span>
													</td>
												</tr>
												<tr>
													<td style="width: 300px">Ration's 1kg price</td>
													<td>
														<span class="badge bg-primary">
															{{avgPrice}} Tl
														</span>
														<span v-if="error.price" class="text text-danger">{{ error.price[0] }}</span>
													</td>
												</tr> 
											</tbody>
										</table>
									</div>
									<div class="ration-body mt-5" v-if="rat_type_id">
										<list-food class="m-4" :foods="foods"></list-food>
										<div class="food-body d-flex justify-content-around justify-content-center">
											<div class="d-flex flex-column">
												<div>Opr.</div>
												<button :disabled="!form.food1" @click="form.food1 = null,form.foodAmount1='0',form.foodPrice1 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food2" @click="form.food2 = null,form.foodAmount2='0',form.foodPrice2 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food3" @click="form.food3 = null,form.foodAmount3='0',form.foodPrice3 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food4" @click="form.food4 = null,form.foodAmount4='0',form.foodPrice4 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food5" @click="form.food5 = null,form.foodAmount5='0',form.foodPrice5 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food6" @click="form.food6 = null,form.foodAmount6='0',form.foodPrice6 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food7" @click="form.food7 = null,form.foodAmount7='0',form.foodPrice7 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food8" @click="form.food8 = null,form.foodAmount8='0',form.foodPrice8 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food9" @click="form.food9 = null,form.foodAmount9='0',form.foodPrice9 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food10" @click="form.food10 = null,form.foodAmount10='0',form.foodPrice10 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food11" @click="form.food11 = null,form.foodAmount11='0',form.foodPrice11 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
												<button :disabled="!form.food12" @click="form.food12 = null,form.foodAmount12='0',form.foodPrice12 = '0',sumFood(),price()" class="mt-2 mb-2 btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
											</div>
											<div class="d-flex flex-column">
												<div>Food Name</div>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food1">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food2">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food3">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food4">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food5">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food6">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food7">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food8">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food9">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food10">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food11">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
												<select class="form-control form-control-sm mt-2 mb-2" v-model="form.food12">
													<option :value="null">Select Food</option>
													<option v-for="food in foods" :key="food.id" :value="food.id">{{food.name}}</option>
												</select>
											</div>
											<div class="d-flex flex-column">
												<div>Amount(Kg)</div>
												<input :disabled="!form.food1" v-model="form.foodAmount1" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food2" v-model="form.foodAmount2" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food3" v-model="form.foodAmount3" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food4" v-model="form.foodAmount4" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food5" v-model="form.foodAmount5" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food6" v-model="form.foodAmount6" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food7" v-model="form.foodAmount7" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food8" v-model="form.foodAmount8" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food9" v-model="form.foodAmount9" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food10" v-model="form.foodAmount10" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food11" v-model="form.foodAmount11" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
												<input :disabled="!form.food12" v-model="form.foodAmount12" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="sumFood()">
											</div>
											<div class="d-flex flex-column">
												<div>Price(Tl or $)</div>
												<input :disabled="!form.food1" v-model="form.foodPrice1" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food2" v-model="form.foodPrice2" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food3" v-model="form.foodPrice3" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food4" v-model="form.foodPrice4" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food5" v-model="form.foodPrice5" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food6" v-model="form.foodPrice6" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food7" v-model="form.foodPrice7" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food8" v-model="form.foodPrice8" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food9" v-model="form.foodPrice9" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food10" v-model="form.foodPrice10" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food11" v-model="form.foodPrice11" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
												<input :disabled="!form.food12" v-model="form.foodPrice12" type="text" class="form-control form-control-sm mt-2 mb-2" style="width:50px;" @change="price()">
											</div>
										</div>
										<div class="form-group">
											<label>Desc</label>
											<textarea class="form-control" v-model="form.desc"></textarea>
										</div>
										<button @click="addRation()" type="submit" class="btn btn-success btn-sm m-4 justify-content-center">Create Ration</button>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button @click="resetFields()" type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body row d-flex flex-column">
								<span class="text-success text-center h1"><i class="fas fa-check-circle"></i></span><br>
								<h3 class="text-success text-center">Ration Created Successfully</h3>

								<ul class="list-group mt-4 mb-4 col-md-6 offset-md-3">
									<li class="list-group-item active">Ration Content</li>
									<li class="list-group-item"><strong class="text-primary">Ration Name:</strong><span class="float-right">{{form.name}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Energy(Kcal):</strong><span class="float-right">{{form.energy}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Protein(%):</strong><span class="float-right">{{form.protein}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Dry Matter(%):</strong><span class="float-right">{{form.drym}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Calcium(%):</strong><span class="float-right">{{form.ca}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Phosfor(%):</strong><span class="float-right">{{form.p}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Nacl(%):</strong><span class="float-right">{{form.nacl}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Sum Food:</strong><span class="float-right">{{sumfood}}</span></li>
									<li class="list-group-item"><strong class="text-primary">Ration's 1kg price:</strong><span class="float-right">{{avgPrice}}</span></li>
								</ul>
							</div>
							<div class="modal-footer">
								<router-link :to="{name :'FrontRationsList'}"><button type="button" class="btn btn-primary">Go To Rations Page</button></router-link>
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
				types:[],
				foods:[],
				selectedType:[],
				rat_type_id:null,
				form:{
					name:'',
					energy:0,
					protein:0,
					drym:0,
					ca:0,
					p:0,
					nacl:0,
					desc:'',
					food1:null,
					food2:null,
					food3:null,
					food4:null,
					food5:null,
					food6:null,
					food7:null,
					food8:null,
					food9:null,
					food10:null,
					food11:null,
					food12:null,
					foodAmount1:0,
					foodAmount2:0,
					foodAmount3:0,
					foodAmount4:0,
					foodAmount5:0,
					foodAmount6:0,
					foodAmount7:0,
					foodAmount8:0,
					foodAmount9:0,
					foodAmount10:0,
					foodAmount11:0,
					foodAmount12:0,
					foodPrice1:0,
					foodPrice2:0,
					foodPrice3:0,
					foodPrice4:0,
					foodPrice5:0,
					foodPrice6:0,
					foodPrice7:0,
					foodPrice8:0,
					foodPrice9:0,
					foodPrice10:0,
					foodPrice11:0,
					foodPrice12:0,
				},
				sumfood:0,
				avgPrice:0,
				message: false,
				error:[],
			}
		},
		props:['userid'],
		created(){
			this.getType()
			this.getFood()
		},
		methods:{
			getType(){
				axios.get('/api/rations/gettype')
				.then(res=>{
					this.types = res.data
				})
				.catch(err=>{
					console.log(err)
				})
			},
			getFood(){
				axios.get('/api/rations/getfood')
				.then(res=>{
					this.foods = res.data
				})
				.catch(err=>{
					console.log(err)
				})
			},
			getSelectedType(){
				axios.get('/api/rations/selectedtype',{
					params:{
						id:this.rat_type_id,
					}
				})
				.then(res=>{
					this.selectedType = res.data
				})
				.catch(err=>{
					console.log(err)
				})
			},
			sumFood(){
				this.sumfood = parseInt(this.form.foodAmount1) + parseInt(this.form.foodAmount2) + parseInt(this.form.foodAmount3) + parseInt(this.form.foodAmount4) + parseInt(this.form.foodAmount5) + parseInt(this.form.foodAmount6) + parseInt(this.form.foodAmount7) + parseInt(this.form.foodAmount8) + parseInt(this.form.foodAmount9) + parseInt(this.form.foodAmount10) + parseInt(this.form.foodAmount11) + parseInt(this.form.foodAmount12);
			},
			price(){
				var sumPrice = parseInt(this.form.foodPrice1) + parseInt(this.form.foodPrice2) + parseInt(this.form.foodPrice3) + parseInt(this.form.foodPrice4) + parseInt(this.form.foodPrice5) + parseInt(this.form.foodPrice6) + parseInt(this.form.foodPrice7) + parseInt(this.form.foodPrice8) + parseInt(this.form.foodPrice9) + parseInt(this.form.foodPrice10) + parseInt(this.form.foodPrice11) + parseInt(this.form.foodPrice12);
				this.avgPrice = parseInt(this.sumfood) / sumPrice;
			},
			addRation(){
				if(this.sumfood == 0){
					this.sumfood = null
				}
				axios.post('/api/rations/addration',{
					'name':this.form.name,
					'user_id':this.userid,
					'rat_type_id':this.rat_type_id,
					'desc':this.form.desc,
					'energy':this.form.energy,
					'protein':this.form.protein,
					'drym':this.form.drym,
					'ca':this.form.ca,
					'p':this.form.p,
					'nacl':this.form.nacl,
					'sumfood':this.sumfood,
					'price':this.avgPrice,
					'food1':this.form.food1,
					'food2':this.form.food2,
					'food3':this.form.food3,
					'food4':this.form.food4,
					'food5':this.form.food5,
					'food6':this.form.food6,
					'food7':this.form.food7,
					'food8':this.form.food8,
					'food9':this.form.food9,
					'food10':this.form.food10,
					'food11':this.form.food11,
					'food12':this.form.food12,
					'foodAmount1':this.form.foodAmount1,
					'foodAmount2':this.form.foodAmount2,
					'foodAmount3':this.form.foodAmount3,
					'foodAmount4':this.form.foodAmount4,
					'foodAmount5':this.form.foodAmount5,
					'foodAmount6':this.form.foodAmount6,
					'foodAmount7':this.form.foodAmount7,
					'foodAmount8':this.form.foodAmount8,
					'foodAmount9':this.form.foodAmount9,
					'foodAmount10':this.form.foodAmount10,
					'foodAmount11':this.form.foodAmount11,
					'foodAmount12':this.form.foodAmount12,
					'foodPrice1':this.form.foodPrice1,
					'foodPrice2':this.form.foodPrice2,
					'foodPrice3':this.form.foodPrice3,
					'foodPrice4':this.form.foodPrice4,
					'foodPrice5':this.form.foodPrice5,
					'foodPrice6':this.form.foodPrice6,
					'foodPrice7':this.form.foodPrice7,
					'foodPrice8':this.form.foodPrice8,
					'foodPrice9':this.form.foodPrice9,
					'foodPrice10':this.form.foodPrice10,
					'foodPrice12':this.form.foodPrice12,
					'foodPrice12':this.form.foodPrice12,
				})
				.then(res=>{
					$('#successModal').modal('show');
				})
				.catch(err=>{
					this.error = err.response.data.errors;
					console.log(err)
				})
			},
			resetFields(){
				this.form.name = ''
				this.form.energy = 0
				this.form.protein = 0
				this.form.drym = 0
				this.form.ca = 0
				this.form.p = 0
				this.form.nacl = 0
				this.form.desc = ''
				this.form.food1 = null
				this.form.food2 = null
				this.form.food3 = null
				this.form.food4 = null
				this.form.food5 = null
				this.form.food6 = null
				this.form.food7 = null
				this.form.food8 = null
				this.form.food9 = null
				this.form.food10 = null
				this.form.food11 = null
				this.form.food12 = null
				this.form.foodAmount1 = 0
				this.form.foodAmount2 = 0
				this.form.foodAmount3 = 0
				this.form.foodAmount4 = 0
				this.form.foodAmount5 = 0
				this.form.foodAmount6 = 0
				this.form.foodAmount7 = 0
				this.form.foodAmount8 = 0
				this.form.foodAmount9 = 0
				this.form.foodAmount10 = 0
				this.form.foodAmount11 = 0
				this.form.foodAmount12 = 0
				this.form.foodPrice1 = 0
				this.form.foodPrice2 = 0
				this.form.foodPrice3 = 0
				this.form.foodPrice4 = 0
				this.form.foodPrice5 = 0
				this.form.foodPrice6 = 0
				this.form.foodPrice7 = 0
				this.form.foodPrice8 = 0
				this.form.foodPrice9 = 0
				this.form.foodPrice10 = 0
				this.form.foodPrice11 = 0
				this.form.foodPrice12 = 0
				this.sumfood = 0
				this.avgPrice = 0
			}
		}
	}
</script>