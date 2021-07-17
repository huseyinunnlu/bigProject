<template>
	<div>
		<section class="content">
			<!-- Default box -->
			<div class="card">
				<div class="card-body row">
					<div class="col-md-10 offset-md-1">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Last Sended Messages
									<span v-if="sMessage == true" class="text-success">Message Answered Successfully</span>
								</h3>
							</div>

							<div class="card-body">
								<table class="table table-bordered table-hover table-responsive">
									<thead>
										<tr>
											<th>Subject</th>
											<th>Type</th>
											<th>Status</th>
											<th>Date</th>
											<th>Message</th>
										</tr>
									</thead>
									<tbody>
										<div v-if="messages" v-for="message in messages.data" :key="message.id" class="message">
											<tr data-widget="expandable-table" aria-expanded="false">
												<td>{{message.subject}}</td>
												<td>{{message.type}}</td>
												<td>
													<span v-if="message.status == 'answered'" class="badge badge-success">Answered <i class="fas fa-check"></i></span>
													<span v-else class="badge badge-danger">Unanswered <i class="fas fa-times"></i></span>
												</td>
												<td>{{message.created_at.slice(0,19)}}</td>
												<td v-if="message.message.length > 20" v-html="message.message.slice(0,20)"></td>
												<td v-else v-html="message.message"></td>
											</tr>
											<tr class="expandable-body">
												<td colspan="6">
													<div class="direct-chat-msg right">
														<div class="direct-chat-infos clearfix">
															<span class="direct-chat-name float-right">Me</span>
															<span class="direct-chat-timestamp float-left">{{message.created_at.slice(0,19)}}</span>
														</div>
														<img class="direct-chat-img" :src="userimg" :alt="useralt">
														<div class="direct-chat-text" v-html="message.message"></div>
													</div>

													<div v-if="message.answer" class="answer" v-for="answer in message.answer" :key="answer.key">
														<div v-if="answer.user_id == userid" class="direct-chat-msg right">
															<div class="direct-chat-infos clearfix">
																<span class="direct-chat-name float-right">Me</span>
																<span class="direct-chat-timestamp float-left">{{message.created_at.slice(0,19)}}</span>
															</div>
															<img class="direct-chat-img" :src="userimg" :alt="useralt">
															<div class="direct-chat-text" v-html="answer.message"></div>
														</div>	

														<div v-else class="direct-chat-msg">
															<div class="direct-chat-infos clearfix">
																<span class="direct-chat-name float-left">Admin or Moderator</span>
																<span class="direct-chat-timestamp float-right">{{message.created_at.slice(0,19)}}</span>
															</div>
															<img class="direct-chat-img" :src="userimg" :alt="useralt">
															<div class="direct-chat-text" v-html="answer.message"></div>
														</div>
													</div>
													<div class="card-footer">
														<form @submit.prevent="addAnswer(message.id)">
															<div class="input-group">
																<input type="text" placeholder="Type Message ..." class="form-control form-control-sm" v-model="form.message">
																<span v-if="error.message" class="text text-danger">{{ error.message[0] }}</span>
																<span class="input-group-append">
																	<button type="submit" class="btn btn-primary btn-sm">Send</button>
																</span>
															</div>
															<small class="text-danger"></small>
														</form>
													</div>
												</td>
											</tr>
										</div>
									</tbody>
								</table>
								<pagination class="ml-2 mt-2" :show-disabled="true" :data="messages" @pagination-change-page="getAdminContacts"></pagination>
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
			messages:{},
			form:{
				message:'',
			},
			sMessage:false,
			error:[],
			userimg:'https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png',
			useralt:'user-img',
		}
	},
	props:['userid'],
	created(){
		this.getAdminContacts()
	},
	methods:{
		getAdminContacts(page = 1){
			axios.get('/api/adminpanel/contact/get?page=' + page)
			.then(res=>{
				this.messages = res.data
			})
			.catch(err=>{
				console.log(err)
			})
		},
		addAnswer(id){
			axios.post('/api/adminpanel/contact/addAnswer',{
				'user_id':this.userid,
				'contact_id':id,
				'message':this.form.message,
			})
			.then(res=>{
				this.getAdminContacts()
				this.sMessage = true
			})
			.catch(err=>{
				this.error = err.response.data.errors
			})
		}
	}
}
</script>