<template>
	<div>
		<section class="content">
			<div class="container-fluid">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">0 animal found.
										<button data-toggle="modal" data-target="#addAnimal" class="ml-3 btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Animal</button></h3>
										<div class="card-tools">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control float-right" placeholder="Search name or email" style="width: 170px;">
												<div class="input-group-append">
													<button type="submit" class="btn btn-default" >
														<i class="fas fa-search"></i>
													</button>
													<button type="submit" class="btn btn-default">
														<i class="fas fa-undo"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
									<!-- /.card-header -->
									<div class="card-body table-responsive p-0">
										<table class="table table-hover text-nowrap">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name Surname</th>
													<th>Email</th>
													<th>Register Date</th>
													<th>Type / Account Type</th>
													<th>Opr.</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td>
														<button data-toggle="modal" data-target="#editUser" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></button>
														<button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.card -->
							</div>
						</div>
					</div>
					<div>
						<div class="modal fade" id="addAnimal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add Animal</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div v-if="message==true" class="alert alert-success text-center">
											<span>Animal Created Successfully</span>
										</div>	
										<form>
											<div class="form-group">
												<label for="earring">Earring Number</label>
												<input id="earring" type="text" class="form-control" placeholder="ex:TR201090, 2090">
											</div>
											<div class="form-group">
												<label for="strap">Strap Number</label>
												<input id="strap" type="number" class="form-control" placeholder="ex:12, 100, 02">
											</div>
											<div class="form-group">
												<label for="name">Name</label>
												<input id="name" type="text" class="form-control" placeholder="Name">
											</div>
											<div class="form-group">
												<label for="type">Type</label>
												<select class="form-control">
													<option :value="null">Select Type</option>
													<option v-for="type in types" :key="type" :value="type.value">{{type.name}}</option>
												</select>
											</div>
											<div class="form-group">
												<label for="gender">Gender</label>
												<select class="form-control">
													<option :value="null">Select Gender</option>
													<option v-for="gender in genders" :key="gender" :value="gender">{{gender.toUpperCase()}}</option>
												</select>
											</div>
											<div class="form-group">
												<label for="birth">Birth Date</label>
												<input id="birth" type="date" class="form-control">
											</div>
											<button type="submit" class="btn btn-success btn-sm">Add Animal</button>
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
		export default{
			data(){
				return {
					types:[{name:'Cattle',value:'cattle',},{name:'Sheeps And Goats',value:'shandgo',}],
					genders:['male','female'],
					message:false,
				}
			},

		}
	</script>