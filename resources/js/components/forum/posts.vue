<template>
	<div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Striped Full Width Table</h3>
			</div>
			<div class="card-body p-0 m-0">
				<sync-loader v-if="loading" class="custom-class text-center m-5" :color="'#f00000'" :loading="loading" :size="20" :sizeUnit="px"></sync-loader>
				<table v-if="!loading" class="table table-striped">
					<tbody>
						<tr v-for="(post,index) in posts" :key="post.id">
							<td>{{index}}</td>
							<td><img :src="post.user.desc.image" style="width:30px; height:30px; border-radius:50%;"> <a v-bind:href="'/profile/'+post.user_id+'-'+post.user.slug">{{post.user.name}}</a></td>
							<td><a v-bind:href="'forum/posts/'+post.slug+'/post='+post.id">{{post.title}}</a></td>
							<td data-toggle="tooltip" data-placement="top" title="Category Name">{{post.postcat.altcatname.title}}</td>
							<td data-toggle="tooltip" data-placement="top" title="Message Count">0</td>
							<td>{{post.created_at.slice(0,19)}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	export default {
		data(){
			return {
				posts:{},
				loading : false,
			}
		},
		created(){
			this.getPosts()
		},
		methods:{
			getPosts(){
				this.loading = true
				axios.get('/api/forum/getposts/')
				.then(res=>{
					this.posts = res.data
					this.loading = false
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>this.loading = false)
			},
		},
	}
</script>