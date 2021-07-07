<template>
	<div>
		<button data-toggle="modal" data-target="#listFood" class="btn btn-primary btn-sm">Nutritive Values Of Foods</button>
		<div class="modal fade" id="listFood" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Food Name</th>
									<th>DryMatter(%)</th>
									<th>Energy(mcal/kg)</th>
									<th>Protein(gr)</th>
									<th>Calcium(gr)</th>
									<th>Phosfor(gr)</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="food in foods" :key="food.id">
									<td>{{food.name}}</td>
									<td>{{food.drym}}</td>
									<td>{{food.energy}}</td>
									<td>{{food.protein}}</td>
									<td>{{food.ca}}</td>
									<td>{{food.p}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data(){
			return {
			}
		},
		props:['foods']
	}
</script>