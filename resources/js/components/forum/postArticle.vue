<template>
	<div>
		<loading :active.sync="isLoading" />
		<section class="messages">
			<div class="card row col-md-12" v-for="(message,index) in messages.data" :key="message.id">
				<div class="card-body row">
					<div class="col-sm-2 d-flex flex-column align-items-center border-right">
						<img v-if="message.user.desc.image" class="img-circle" :src="message.user.desc.image" :alt="message.user.desc.image" style="width:110px; height:110px;">
						<img v-else class="img-circle" :src="message.user.profile_photo_url" :alt="message.user.profile_photo_url" style="width:110px; height:110px;">
						<strong class="text-center text-default mt-3 text-success">{{message.user.name}}</strong>
						<span class="text-center text-default mb-3 text-success">{{message.user.type}}</span>
						<ul class="list-group" style="width:160px;">
							<li class="list-group-item p-1 m-1">
								<b>Followers:</b> <a class="float-right">{{message.user.followCount}}</a>
							</li>
							<li class="list-group-item p-1 m-1">
								<b>Join Date:</b> <a class="float-right">{{message.user.created_at.slice(0,19)}}</a>
							</li>
							<li class="list-group-item p-1 m-1">
								<b>Followers:</b> <a class="float-right">30 Temmuz</a>
							</li>
						</ul>
					</div>
					<div class="col-sm-10">
						<div class="content-header d-flex justify-content-between">
							<small class="text-muted">{{message.created_at.slice(0,19)}}</small>
							<span>
								<a type="button" data-toggle="modal" data-target="#addReport" class="text-muted">Report</a>
								<small class="text-muted">#{{index}}</small>
							</span>
						</div>
						<div class="content-body" style="height:75%;">
							<p v-html="message.content"></p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<pagination class="ml-2" :show-disabled="true" :data="messages" @pagination-change-page="getMessages"></pagination>

		<section class="create-message">
			<div class="card row col-md-12">
				<div class="card-header">
					Add Message
				</div>		
				<div class="card-body">
					<form @submit.prevent="addMessage()">
						<div class="form-group">
							<ckeditor v-model="form.content" :config="editorConfig"></ckeditor>
							<span v-if="error.content" class="text text-danger">{{ error.content[0] }}</span>
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Add Message</button>
					</form>
				</div>
			</div>
		</section>
	</div>
</template>
<script>
	import Loading from 'vue-loading-overlay'
	import 'vue-loading-overlay/dist/vue-loading.css';
	export default{
		components:{
			Loading
		},
		data(){
			return{
				messages:{},
				image:'http://localhost:8000/uploads/BuvVQuaipe.jpg',
				form:{
					content:'',
				},
				editorConfig:{},
				message: false,
				error: [],
				isLoading:false,
				isSuccess:false,
			}
		},
		props:['auth','post'],
		created(){
			this.getMessages()
		},
		methods:{
			getMessages(page = 1){
				this.isLoading = true
				axios.get('/api/forum/'+this.post.id+'/getmessages?page=' + page)
				.then(res=>{
					this.messages = res.data
					this.isSuccess = true
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.isLoading = false)
			},
			addMessage(){
				this.isLoading = true
				axios.post('/api/forum/'+this.post.id+'/addmesage',{
					'user_id':this.auth.id,
					'content':this.form.content,
				})
				.then(res=>{
					this.message = true
					this.getMessages()
					this.isSuccess = true
				})
				.catch(err=>{
					this.error = err.response.data.errors;
				})
				.finally(()=>this.isLoading = false)
			}
		}
	}
</script>