<template>
	<div>
		<loading :active.sync="isLoading" />
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Edit Ration</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><router-link :to="{name:'FrontRationsList'}">Go Back</router-link></li>
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
						<div class="col-md-6 offset-md-3">
							<div class="card">
								<div class="card-body">
									<div v-if="message == true" class="alert alert-success">
										<span>Ration Updated Succesfully</span>
									</div>
									<form @submit.prevent="updateRation">
										<div class="form-group">
											<label for="name">Name</label>
											<input id="name" type="text" class="form-control" v-model="form.name">
											<span v-if="error.name" class="text text-danger">{{ error.name[0] }}</span>

										</div>
										<div class="form-group">
											<label for="desc">Desc</label>
											<textarea id="desc" class="form-control" v-model="form.desc"></textarea>
											<span v-if="error.error" class="text text-danger">{{ error.desc[0] }}</span>
										</div>
										<button class="btn btn-primary" type="submit">Update Ration</button>
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
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css';
	export default {
		components:{
			Loading
		},
		data(){
			return {
				form:{
					name:'',
					desc:'',
				},
				message:false,
				error:[],
				isLoading: false,
				isSuccess: false,
			}
		},
		created(){
			this.getRation()
		},
		methods:{
			getRation(){
				this.isLoading = true
				axios.get('/api/ration/'+this.$route.params.id+'/get')
				.then(res=>{
					this.form= res.data
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.isLoading = false)
			},
			updateRation(){
				this.isLoading = true
				axios.post('/api/ration/'+this.$route.params.id+'/update',{
					'name':this.form.name,
					'desc':this.form.desc,
				})
				.then(res=>{
					this.getRation()
					this.message = true
					this.isSuccess = true
				})
				.catch(err=>{
					this.error = err.response.data.errors
					this.message = false 
				})
				.finally(()=>this.isLoading = false)
			}
		}
	}
</script>