<template>
	<div>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>All Created Rations</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a v-bind:href="/dashboard/">Home</a></li>
							<li class="breadcrumb-item active">All Created Rations</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<section class="content">
			<div class="container-fluid row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-tools">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control float-right" placeholder="Search Food By Name" style="width: 200px;">
									<div class="input-group-append">
										<button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										</button>
										<button type="submit" class="btn btn-default">
											<i class="fas fa-undo"></i>
										</button>
									</div>
								</div>
							</div>
							<router-link :to="{name:'FrontRationsCreate'}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Ration
							</router-link>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<thead>
									<tr>
										<th>Name</th>
										<th>Dry Matter</th>
										<th>Energy</th>
										<th>Protein</th> 
										<th>Destroyable Protein</th>
										<th>Bypass Protein</th>
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
										<td></td>
										<td>
											<button class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></button>
											<button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
							<!-- <pagination class="ml-2" :show-disabled="true" :data="foods" @pagination-change-page="getFood"></pagination> -->
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<!-- /.card -->
				</div>
			</div>
		</section>
	</div>
</template>
<script>
export default {
	data(){
		return{

		}
	}
}
</script>