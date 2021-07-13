<template>
	<div>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Animal Details</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><router-link :to="{name: 'AnimalsList'}">Go Back</router-link></li>
							<li class="breadcrumb-item active">Animal Details</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<!-- Profile Image -->
						<div class="card card-primary card-outline">
							<div class="card-body box-profile">
								<div class="text-center">
									<img class="profile-user-img img-fluid img-circle" style="width:100px; height:100px;" :src="animal.image">
								</div>
								<h3 class="profile-username text-center">{{animal.earring}} - {{animal.strap}}</h3>
								<p v-if="animal.name" class="text-muted text-center">{{animal.name}}</p>
								<p v-else="" class="text-muted text-center">No Name Animal</p>
								<ul class="list-group list-group-unbordered mb-3">
									<li class="list-group-item">
										<b>Birth Date:</b>
										<a class="float-right">{{animal.birth}}</a><br>
										<b>Age:</b>
										<span v-if="!animal.death" class="float-right badge badge-success">{{animal.age}} Years Old</span> 
										<span v-else="" class="float-right badge badge-danger">Animal Dead</span> 
									</li>
									<li class="list-group-item">
										<b>Type:</b>
										<a v-if="animal.type=='cattle'" class="float-right">Cattle</a>
										<a v-else="" class="float-right">Sheep And Goats</a>
									</li>
									<li class="list-group-item">
										<b>Gender:</b>
										<a v-if="animal.gender=='male'" class="float-right">Male</a>
										<a v-else="" class="float-right">Female</a>
									</li>
									<li v-if="animal.death" class="list-group-item">
										<b>Death Date:</b> <a class="float-right">{{animal.death}}</a>
									</li>
									<li v-else="" class="list-group-item">
										<b>Death Date:</b>
										<a class="float-right">Animal is living!</a>
									</li>
									<li class="list-group-item">
										<b>Last Milk Amount:</b> 
										<a v-if="animal.gender == 'female' && lastMilk" class="float-right">{{lastMilk.milk}}(L) - {{lastMilk.date}}</a>
										<a v-else="" class="float-right">No Milk</a>
									</li>
									<li class="list-group-item">
										<b>Last Avg Weight:</b>
										<a class="float-right" v-if="animal.weight">{{animal.weight.weight}}(KG) - {{animal.weight.date}}</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- About Me Box -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">About Animal</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<p class="text-muted" v-html="animal.desc"></p>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
					<div class="col-md-9">
						<div class="card">
							<div class="card-header p-2">
								<ul class="nav nav-pills">
									<li v-if="animal.gender == 'female'" class="nav-item">
										<a class="nav-link" href="#milk" data-toggle="tab">Milk Manage</a>
									</li>
									<li v-if="!animal.death" class="nav-item">
										<a class="nav-link" href="#ration" data-toggle="tab">Ration</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#weight" data-toggle="tab">Weight</a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" href="#settings" data-toggle="tab">Edit Animal</a>
									</li>
								</ul>
							</div><!-- /.card-header -->
							<div class="card-body">
								<div class="tab-content">

									<div v-if="animal.gender == 'female'" class="tab-pane" id="milk">
										<div v-if="delMessage==true" class="alert alert-success text-center">
											<span>Milk Deleted Successfully</span>
										</div>	
										<div class="card-header">
											<div class="card-tools">
												<div class="input-group input-group-sm">
													<input :disabled="select != null || date2<date1" type="date" class="form-control float-right" v-model="date1"><br>
													<input :disabled="select != null || date2>date1" type="date" class="form-control float-right" v-model="date2"><br>
													<select :disabled="date1 || date2" class="form-control" v-model="select">
														<option v-for="select in selects" :value="select.value">{{select.name}}</option>
													</select>
													<div class="input-group-append">
														<button @click="getAnimal" type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
														<button @click="resetFilter" type="submit" class="btn btn-default"><i class="fas fa-undo"></i></button>
													</div>
												</div>
											</div>
											<button v-if="!animal.death" data-toggle="modal" data-target="#addMilk" class="btn btn-primary btn-sm mr-3"><i class="fas fa-plus"></i> Add Milk Data</button>
											<small v-if="!date1" class="text-danger">Small Date First Bigger Date Second</small>
										</div>

										<div class="card-body table-responsive p-0">
											<table class="table table-hover text-nowrap">
												<thead>
													<tr>
														<th>Milk 
															<a v-if="order==true" @click="orderr" style="cursor: pointer; margin-left: 5px;" class="text-primary"><i class="fas fa-sort-numeric-up-alt"></i></a>
															<a v-if="order==false" @click="orderr" style="cursor: pointer; margin-left: 5px;" class="text-primary"><i class="fas fa-sort-numeric-up"></i></a>
														</th>
														<th>Protein(%) / Fat(%)</th>
														<th>Date</th>
														<th>Opr.</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="milk in milks" :key="milk.id">
														<td>{{milk.milk}}</td>
														<td>{{milk.protein}}(%) - {{milk.fat}}(%)</td>
														<td>{{milk.date}}</td>
														<td>
															<button @click="deleteMilk(milk.id)" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
														</td>
													</tr>
												</tbody>
											</table>
											<div class="row mt-5">
												<div class="col-md-3">
													<!-- small card -->
													<div class="small-box bg-success">
														<div class="inner">
															<span>Selected Date's <h3 class="mb-5"> {{milkStat}}<sup style="font-size: 20px">L</sup></h3></span>
															<p class="">
																<div class="form-group">
																	<label>From</label>
																	<input type="date" v-model="statdate1" class="float-right" style="height 10px;"><br> 
																</div>
																<div class="form-group">
																	<label>To</label>
																	<input type="date" v-model="statdate2" class="float-right" style="height 10px;"><br> 
																</div>
																<div class="form-group">
																	<label>Calculation</label>
																	<select v-model="statselect" style="height 10px;" class="float-right">
																		<option v-for="qtype in querrytypes" :value="qtype.value">{{qtype.name}}</option>
																	</select>
																</div>
																<button class="btn btn-success btn-sm" @click="getAnimal">Get</button>
																<button class="btn btn-success btn-sm" @click="resetStat">Reset</button>
															</p>
														</div>
														<div class="icon">
															<i class="ion ion-stats-bars"></i>
														</div>
													</div>
												</div>
												<div class="col-md-9">
													<div class="card card-danger">
														<div class="card-header">
															<h3 class="card-title">Milk Statics Of this mounth</h3>
															<div class="card-tools"></div>
														</div>
														<div class="card-body">
															<canvas id="lineChart"></canvas>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>



									<div class="tab-pane" id="weight">
										<animalweight :animalid="animal.id" :isdeath="animal.death"></animalweight>
									</div>
									<div class="tab-pane" id="ration">
										<animalration v-if="!animal.death" :userid="animal.user_id" :animalid="animal.id" :isdeath="animal.death"></animalration>
									</div>
									<div class="tab-pane active" id="settings">
										<div v-if="message==true" class="alert alert-success">
											<span class="text-cener">Updated Successfully</span>
										</div>
										<form class="form-horizontal" @submit.prevent="updateAnimal">
											<div class="form-group row">
												<label for="image" class="col-sm-2 col-form-label">Image</label>
												<div class="col-sm-5">
													<input type="file" class="form-control-file" id="image" placeholder="Earring" @change="isUploaded">
												</div>
												<span v-if="error.image" class="text text-danger">{{ error.image[0] }}</span>
												<button @click="updateImage" class="btn btn-primary btn-sm">Update Image</button>
											</div>
											<div class="form-group row">
												<label for="earring" class="col-sm-2 col-form-label">Earring</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="earring" placeholder="Earring" v-model="form.earring">
													<span v-if="error.earring" class="text text-danger">{{ error.earring[0] }}</span>
												</div>
											</div>
											<div class="form-group row">
												<label for="strap" class="col-sm-2 col-form-label">Strap</label>
												<div class="col-sm-5">
													<input type="number" class="form-control" id="strap" placeholder="Strap" v-model="form.strap">
													<span v-if="error.strap" class="text text-danger">{{ error.strap[0] }}</span>
												</div>
											</div>
											<div class="form-group row">
												<label for="name" class="col-sm-2 col-form-label">Name</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="name" placeholder="Name" v-model="form.name"> <span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span>
												</div>
											</div>
											<div class="form-group row">
												<label for="bio" class="col-sm-2 col-form-label">Bio</label>
												<ckeditor v-model="form.desc" :config="editorConfig"></ckeditor>
												<span v-if="error.desc" class="text text-danger">{{ error.desc[0] }}</span>
											</div>
											<div class="form-group row">
												<label for="name" class="col-sm-2 col-form-label">Type</label>
												<div class="col-sm-5">
													<select class="form-control" v-model="form.type">
														<option v-for="type in types " :value="type.value">{{type.name}}</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label for="name" class="col-sm-2 col-form-label">Gender</label>
												<div class="col-sm-5">
													<select class="form-control" v-model="form.gender">
														<option v-for="gender in genders " :value="gender">{{gender.toUpperCase()}}</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label for="birth" class="col-sm-2 col-form-label">Birth Date</label>
												<div class="col-sm-5">
													<input type="date" class="form-control" id="birth" v-model="form.birth">
													<span v-if="error.birth" class="text text-danger">{{ error.birth[0] }}</span>
												</div>
											</div>
											<div class="form-group row">
												<label for="death" class="col-sm-2 col-form-label">Death Date</label>
												<div class="col-sm-5">
													<input type="date" class="form-control" id="death" v-model="form.death">
													<span v-if="error.death" class="text text-danger">{{ error.death[0] }}</span>
													<button class="btn btn-danger btn-sm" @click="resetDeath"><i class="fas fa-undo"></i></button>
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
				</div>
			</div>
			<div>
				<div class="modal fade" id="addMilk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add Milk Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div v-if="milkMessage==true" class="alert alert-success text-center">
									<span>Milk Added Successfully</span>
								</div>	
								<form @submit.prevent="addMilk">
									<div class="form-group">
										<label for="milk">Milk</label>
										<input id="milk" type="text" class="form-control" placeholder="ex:TR201090, 2090" v-model="form.milk">
										<span v-if="error.milk" class="text text-danger">{{ error.milk[0] }}</span>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label for="protein">Protein(%)</label>
											<input id="protein" type="number" class="form-control" placeholder="Enter Protein(%) Amount" v-model="form.protein">
											<span v-if="error.protein" class="text text-danger">{{ error.protein[0] }}</span>
										</div>
										<div class="form-group col-md-6">
											<label for="fat">Fat(%)</label>
											<input id="fat" type="number" class="form-control" placeholder="Enter Fat(%) Amount" v-model="form.fat">
											<span v-if="error.fat" class="text text-danger">{{ error.fat[0] }}</span>
										</div>
									</div>
									<div class="form-group">
										<label for="birth">Milking Time</label>
										<input id="bidaterth" type="datetime-local" class="form-control" v-model="form.date">
										<span v-if="error.date" class="text text-danger">{{ error.date[0] }}</span>
									</div>
									<button type="submit" class="btn btn-success btn-sm">Add Milk</button>
								</form>
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
				animal:[],
				milks:[],
				lastMilk:[],
				milkStat:[],
				mounthMilk:[],
				milk:[],
				date:[],
				form:{
					image:'',
					earring:'',
					strap:'',
					name:'',
					desc:'',
					type:'',
					gender:'',
					birth:'',
					death:'',
					milk:'',
					protein:'',
					fat:'',
					date:'',
				},
				select:null,
				date1:null,
				date2:null,
				order:true,
				statselect:'sum',
				statdate1:null,
				statdate2:null,
				querrytypes:[{name:'Sum',value:"sum"},{name:'Average',value:"avg"}],
				editorConfig:{},
				types:[{name:'Cattles',value:'cattle',},{name:'Sheeps And Goats',value:'shandgo',}],
				genders:['male','female'],
				selects:[{name:'Select',value:null},{name:'Today',value:'today'},{name:'yesterday',value:'Today -1 Day'},{
					name:'A week',value:'Today -1 Week'},{name:'A mounth',value:'Today -1 Mounth'}],
					error:[],
					message:false,
					milkMessage:false,
					delMessage:false,
				}
			},
			created(){
				this.getAnimal()
			},
			methods:{
				getAnimal(){
					var today = new Date();
					var yyyy = today.getFullYear();
					axios.get('/api/animals/'+this.$route.params.id,{
						params:{
							'select':this.select,
							'date1':this.date1,
							'date2':this.date2,
							'order':this.order,
							'statselect':this.statselect,
							'statdate1':this.statdate1,
							'statdate2':this.statdate2,
						}
					})
					.then(res=>{
						this.animal = res.data[0]

						if(this.animal.weight == null){
							this.animal.weight = null;
						}
						this.milks = res.data[1]
						this.lastMilk = res.data[2]
						this.milkStat = res.data[3]
						if (this.animal.gender == 'female' && !this.animal.death) {
							this.mounthMilk = []
							this.milk = []
							this.date = []
							this.mounthMilk = res.data[4]
							for (var i = 0; i<=this.mounthMilk.length - 1; i++) {
								this.milk.push(this.mounthMilk[i].milk)
								this.date.push(this.mounthMilk[i].date.slice(0,10))
							}
						}
						if(!this.animal.image){
							this.animal.image = 'https://www.allianceplast.com/wp-content/uploads/2017/11/no-image.png'
						}
						var year = this.animal.birth.slice(0,4)
						this.animal.age = yyyy-year
						this.form.earring = res.data[0].earring;
						this.form.strap = res.data[0].strap;
						this.form.name = res.data[0].name;
						this.form.desc = res.data[0].desc;
						this.form.type = res.data[0].type;
						this.form.gender = res.data[0].gender;
						this.form.birth = res.data[0].birth;
						this.form.death = res.data[0].death;
					//line
					var ctxL = document.getElementById("lineChart").getContext('2d');
					var myLineChart = new Chart(ctxL, {
						type: 'line',
						data: {
							labels: this.date,
							datasets: [{
								label: "Milk Amount:",
								data: this.milk,
								backgroundColor: [
								'rgba(105, 0, 132, .2)',
								],
								borderColor: [
								'rgba(200, 99, 132, .7)',
								],
								borderWidth: 2
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
				orderr(){
					if(this.order == true){
						this.order = false
					}else{
						this.order = true
					}
					this.getAnimal()
				},
				isUploaded(e){
					this.form.image = e.target.files[0]
				},
				updateAnimal(){
					axios.post('/api/animals/'+this.$route.params.id+'/edit',{
						'image':this.form.image,
						'earring':this.form.earring,
						'strap':this.form.strap,
						'name':this.form.name,
						'desc':this.form.desc,
						'type':this.form.type,
						'gender':this.form.gender,
						'birth':this.form.birth,
						'death':this.form.death,
					})
					.then(res=>{
						this.getAnimal()
						this.message = true
						this.error = []
					})
					.catch(err=>{
						this.message = false
						this.error=err.response.data.errors;
					})
				},
				updateImage(){
					const formData = new FormData
					formData.set('image', this.form.image)
					axios.post('/api/animals/'+this.$route.params.id+'/edit',formData)
					.then(res=>{
						this.getAnimal()
						this.message = true
						this.error = []
					})
					.catch(err=>{
						this.message = false
						this.error=err.response.data.errors;
					})
				},
				resetDeath(){
					this.form.death = ''
				},
				resetFilter(){
					this.select = null
					this.date1 = null
					this.date2 = null
					this.getAnimal()
				},
				resetStat(){
					this.statselect = null
					this.statdate1 = null
					this.statdate2 = null
				},
				addMilk(){
					axios.post('/api/animals/'+this.$route.params.id+'/addmilk',{
						'user_id':this.animal.user_id,
						'animal_id':this.animal.id,
						'milk':this.form.milk,
						'protein':this.form.protein,
						'fat':this.form.fat,
						'date':this.form.date,
					})
					.then(res=>{
						this.getAnimal()
						this.milkMessage = true
						this.error = []
					})
					.catch(err=>{
						this.message = false
						this.error=err.response.data.errors;
					})
				},
				deleteMilk(id){
					axios.delete('/api/animals/'+id+'/deleteMilk')
					.then(res=>{
						this.getAnimal()
						this.delMessage = true
					})
					.catch(err=>{
						this.delMessage = false
						console.log(err)
					})
				},
			}
		}


	</script>