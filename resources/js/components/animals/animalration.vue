<template>
	<div>
		<loading :active.sync="isLoading" />
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Active Ration
					</div>
					<div class="card-body">
						<strong v-if="activeRation.id"><h3 class="card-title">Name: {{activeRation.name.name}} 
							<router-link :userid="userid" :to="{
								name: 'FrontRationsDetails',
								params: {id:activeRation.name.id}
							}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Details</router-link>
							<button @click="delActiveRation(activeRation.id)" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></h3>
						</strong>
					</div>
				</div>

			</div>
			<div class="col-md-8">
				<div class="alert alert-success" v-if="message == true">
					<span>Ration Updated Successfully</span>
				</div>
				<button @click="getMyRations() , getFavRations()" class="btn btn-primary btn-sm float-right mt-1 mb-1">Get Rations</button>
				<table class="table table-bordered mt-2 mb-2">
					<thead>
						<tr>
							<th>Name</th>
							<th>Type Name</th>
							<th>Energy</th>
							<th>Dry Matter</th>
							<th>Protein</th>
							<th>Opr</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="rat in myRats" :key="rat.id">
							<td>{{rat.name}}</td>
							<td>{{rat.type.name}}</td>
							<td>{{rat.energy}}</td>
							<td>{{rat.drym}}</td>
							<td>{{rat.protein}}</td>
							<td><button @click="updateRation(rat.id)" class="btn btn-primary btn-sm">Active</button></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Type Name</th>
							<th>Energy</th>
							<th>Dry Matter</th>
							<th>Protein</th>
							<th>Opr</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="fav in favRats" :key="fav.id">
							<td>{{fav.fav_name.name}}</td>
							<td>{{fav.fav_name.type.name}}</td>
							<td>{{fav.fav_name.energy}}</td>
							<td>{{fav.fav_name.drym}}</td>
							<td>{{fav.fav_name.protein}}</td>
							<td><button @click="updateRation(fav.ration_id)" class="btn btn-primary btn-sm">Active</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
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
				myRats:[],
				favRats:[],
				activeRation:[],
				message :false,
				isLoading: false,
				isSuccess: false,
			}
		},
		props:['userid','animalid','isdeath'],
		created(){
			this.getMyRations()
			this.getFavRations()
			this.getActiveRation()
		},
		methods:{
			getMyRations(){
				this.isLoading = true
				axios.get('/api/myRats',{
					params:{
						user_id:this.userid,
					}
				})
				.then(res=>{
					this.myRats = res.data
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.isLoading = false)
			},
			getFavRations(){
				this.isLoading = true
				axios.get('/api/favRats',{
					params:{
						user_id:this.userid,
					}
				})
				.then(res=>{
					this.favRats = res.data
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.isLoading = false)
			},
			getActiveRation(){
				this.isLoading = true
				axios.get('/api/animals/'+this.$route.params.id+'/activerat')
				.then(res=>{
					this.activeRation = res.data
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.isLoading = false)

			},
			updateRation(id){
				this.isLoading = true
				axios.post('/api/animals/'+this.$route.params.id+'/addRat',{
					'ration_id':id
				})
				.then(res=>{
					this.getActiveRation()
					this.message = true
					this.isSuccess = true
				})
				.catch(err=>{
					this.message = false
					console.log(err)
				})
				.finally(()=>this.isLoading = false)
			},
			delActiveRation(id){
				this.isLoading = true
				axios.delete('/api/activerat/'+id+'/delete')
				.then(res=>{
					this.getActiveRation()
					this.getMyRations()
					this.getFavRations()
					this.message = true
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
					this.message = false
				})
				.finally(()=>this.isLoading = false)
			}
		}
	}
</script>