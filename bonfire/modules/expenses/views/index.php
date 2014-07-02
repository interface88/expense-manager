<section>
	<div class="page-header">
		<h1>Expenses List</h1>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-info fade in">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Expenses list viewer.</h4>
				You can search and export expenses list. Only registered user can add, edit and delete expenses.				
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<table id="data-table" class="table table-condensed table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Stringer Name</th>
						<th>Costs</th>
						<th>Description</th>
						<th>Released from recieved</th>
						<th>Paid Date</th>		
					</tr>
				</thead>
				<tbody>
				<?php if($expenses):?>
					<?php foreach($expenses as $expense):?>
						<tr>
							<td><?php echo $expense->expense_date?></td>
							<td><?php echo $expense->stringer_name?></td>
							<td><?php echo $expense->costs?></td>
							<td><?php echo $expense->description?></td>
							<td><?php echo $expense->released_from_received?></td>
							<td><?php echo $expense->paid_date?></td>
						</tr>
					<?php endforeach;?>
				<?php endif;?>
				</tbody>
			</table>
			
		</div>
	</div>
</section>