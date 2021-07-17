<template>
	<div>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Profile</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">User Profile</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" :src="desc.image" :alt="user.slug">
									</div>
									<h3 class="profile-username text-center">{{user.name}}</h3>
									<p v-if="user.type=='user'" class="text-muted text-center">User</p>
									<p v-if="user.type=='verified'" class="text-success text-center">Verified User</p>
									<p v-if="user.type=='admin'" class="text-danger text-center">ADMIN</p>
									<p v-if="user.type=='moderator'" class="text-primary text-center">MODERATOR</p>
									<button data-toggle="modal" data-target="#editImage" v-if="userid==auth && auth" class="btn btn-primary btn-sm align-items-center w-100 mt-1 mb-2">
										<i class="fas fa-pen"></i> Edit Image
									</button>

									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b>Followers</b> <a class="float-right">{{user.follow_count}}</a>
										</li>
									</ul>
									<a v-if="isFollowed == false && user.id != auth" @click="follow()" class="btn btn-primary btn-block"><b>Follow</b></a>
									<a v-if="isFollowed == true && user.id != auth" @click="unfollow(isFollowId)" class="btn btn-primary btn-block"><b>Unfollow</b></a>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h3 class="card-title">About Me</h3>
									<button data-toggle="modal" data-target="#editAbout" v-if="userid==auth && auth" class="btn btn-primary btn-sm">
										<i class="fas fa-pen"></i>
									</button>
								</div>
								<div class="card-body" v-if="user.acctype=='public'">
									<p class="text-muted" v-html="desc.bio"></p>
									<hr>
									<strong v-if="desc.gender=='male'"><i class="fas fa-male"></i> Male</strong>
									<strong v-if="desc.gender=='female'"><i class="fas fa-female"></i> Female</strong>
									<strong v-if="desc.gender=='not'"> - </strong>
								</div>
							</div>
						</div>
						<div class="col-md-9">
						<content-component :userid="userid" :auth="auth"></content-component>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="modal fade" id="editAbout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit About Page</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div v-if="descMessage==true" class="alert alert-success">
							<span class="text-cener">Updated Successfully</span>
						</div>
						<form @submit.prevent="updateDesc">
							<div class="form-group">
								<label for="bio">Biograpy</label>
								<ckeditor v-model="form.bio" :config="editorConfig"></ckeditor>
								<span v-if="error.bio" class="text text-danger">{{ error.bio[0] }}</span><br>
							</div>
							<div class="form-group">
								<label for="gender">Gender</label>
								<select v-model="form.gender" class="form-control">
									<option :selected="desc.gender==gender" v-for="gender in genders" :value="gender" v-text="gender.toUpperCase()"></option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="editImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit About Page</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div v-if="descMessage==true" class="alert alert-success">
							<span class="text-cener">Updated Successfully</span>
						</div>
						<form @submit.prevent="updateImg">
							<div class="form-group">
								<img :src="desc.image"
								style="width: 150px; height: 150px;">
							</div>
							<div class="form-group">
								<input type="file" class="form-control-file"  @change="isUploaded">
							</div>
							<span v-if="error.image" class="text text-danger">{{ error.image[0] }}</span><br>
							<button type="submit" class="btn btn-primary btn-sm">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				user:[],
				desc:[],
				editorConfig:{},
				genders:['male','female','not'],
				form:{
					image:'',
					bio:'',
					gender:'',
				},
				descMessage:false,
				error:[],
				isFollowed:false,
				isFollowId:'',
			}
		},
		props:['userid','auth'],
		created(){
			this.getUser()
			this.createDesc()
			this.getDesc()
		},
		methods:{
			getUser(){
				axios.get('/api/profile/'+this.userid)
				.then(res=>{
					this.user = res.data
					for (var i = 0; i <= this.user.follow.length-1; i++) {
						if(this.user.follow[i].follower_id == this.auth){
							this.isFollowed = true
							this.isFollowId = this.user.follow[i].id
						}
					}
				})
				.catch(err=>{
					console.log(err)
				})
			},
			getDesc(){
				axios.get('/api/profile/'+this.userid+'/desc')
				.then(res=>{
					this.desc = res.data
					this.form.image = this.desc.image
					this.form.bio = this.desc.bio
					this.form.gender = this.desc.gender
					if(this.desc.length==0){
						this.createDesc()
					}
				})
				.catch(err=>{
					console.log(err)
				})
			},
			createDesc(){
				axios.post('/api/profile/'+this.userid+'/adddesc', {
					'user_id':this.userid,
					'image':'https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png',
					'bio':null,
					'gender':null,
				})
				.then(res=>{
					this.desc = res.data
					this.getDesc()
				})
				.catch(err=>{
					console.log(err)
				})
			},
			isUploaded(e){
				this.form.image = e.target.files[0]
			},
			updateDesc(){
				axios.post('/api/profile/'+this.userid+'/update',{
					'image':this.form.image,
					'bio':this.form.bio,
					'gender':this.form.gender,
				})
				.then(res=>{
					this.getDesc()
					this.error=[]
					this.descMessage = true
				})
				.catch(err=>{
					this.error=err.response.data.errors;
					console.log(err)
				})
			},
			updateImg(){
				const formData = new FormData
				formData.set('image', this.form.image)
				axios.post('/api/profile/'+this.userid+'/updateimg', formData)
				.then(res=>{
					this.getDesc();
					this.error=[]
					this.descMessage = true
				})
				.catch(err=>{
					this.error=err.response.data.errors;
					console.log(err)
				})
			},
			follow(){
				axios.post('/api/follow',{
					'following_id':this.user.id,
					'follower_id':this.auth,
				})
				.then(res=>{
					this.getUser()
					this.getDesc()
				})
				.catch(err=>{
					console.log(err)
				})
			},
			unfollow(){
				axios.delete('/api/unfollow/'+this.isFollowId)
				.then(res=>{
					this.getUser()
					this.getDesc()
					this.isFollowed = false
				})
				.catch(err=>{
					console.log(err)
				})
			}
		}
	}
</script>