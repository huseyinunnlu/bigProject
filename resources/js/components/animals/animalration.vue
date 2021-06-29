<template>
	<div>
		<div class="row">
			<h3 class="text-center">How The Calculate Animal's Live Weight with chest circumference.</h3>
			<div class="col-md-8">
				<p>
					The table below has been prepared to give a general idea. Precise weight estimation is only possible by weighing. This table is important in terms of monitoring nutritional performance.
					<br>
					<span class="text danger">><h4>Important Note:</h4> For measurement, the animal must be standing on all fours and its head in a normal position.
					</span><br>
					<img class="mt-4 mb-4" :src="images[0]">
					<img :src="images[1]">
				</p>
			</div>
			<div class="col-md-3">
				<div v-if="!isdeath">
				<form @submit.prevent="addWeight">
					<div class="form-group">
						<label for="weight">Weight</label>
						<input type="number" class="form-control form-control-sm" v-model="weight">
					</div>
					<div class="form-group">
						<label for="weight">Date: </label>
						<input v-if="istoday == false" type="date" class="form-control form-control-sm" v-model="date">
						<label>Todays Date:</label> <input type="checkbox" @change="istoday=!istoday">
					</div>
					<button type="submit" class="btn btn-success btn-sm">Add Weight</button>
				</form>
				</div>
				<div>
					<ul>
						<li v-for="weight in animalWeight">{{weight.weight}}(Kg) - {{weight.date}}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return {
				animalWeight:[],
				weight:'',
				date:null,
				istoday:false,
				images:['http://www.abmgrup.com.tr/images/icerik_resimleri/canli_agirlik_tahmin_cetveli.jpg','https://www.esk.gov.tr/upload/Node/10487/pics/c4eae0.450px.jpg'],
			}
		},
		props:['animalid','isdeath'],
		created(){
			this.getWeight()
		},
		methods:{
			getWeight(){
				axios.get('/api/animals/'+this.animalid+'/weight')
				.then(res=>{
					this.animalWeight = res.data
				})
				.catch(err=>{
					console.log(err)
				})
			},
			addWeight(){
				axios.post('/api/animals/'+this.animalid+'/create',{
					'weight':this.weight,
					'date':this.date,
					'istoday':this.istoday,
				})
				.then(res=>{
					this.getWeight()
				})
				.catch(err=>{
					console.log(err)
				})
			}
		}
	}
</script>