<section>
	<div class="page-header">
		<h1>Manage expense</h1>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-info fade in">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Manage expense.</h4>
				You can Add, Update and Delete expense here.					
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class=" pull-right"style="margin-bottom: 10px;">
				<a class="btn btn-primary" href="#">
					<i class="icon-white icon-list-alt"></i>	
					Export to PDF
				</a>
				<a class="btn btn-primary" href="#">
					<i class="icon-white icon-file"></i>	
					Export to CSV
				</a>
				<?php if (has_permission('App.Expenses.Add')):?>
				<a class="btn btn-primary" href="<?php echo site_url('expenses/manager/add')?>">
					<i class="icon-white icon-plus"></i>	
					Add new
				</a>
				<?php endif;?>
				TODO : DELETE PERMISIIION.
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<table id="excel_sheet" class="table table-condensed table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Stringer Name</th>
						<th>Costs</th>
						<th>Description</th>
						<th>Released from recieved</th>
						<th>Paid Date</th>		
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($expenses as $expense) :?>
						<tr>
							
							<td><?php echo $expense -> expense_date; ?></td>
							<td><?php echo $expense -> stringer_name; ?></td>
							<td><?php echo $expense -> costs; ?></td>
							<td><?php echo $expense -> description; ?></td>
							<td><?php echo $expense -> released_from_received; ?></td>
							<td><?php echo $expense -> paid_date; ?></td>
							<td>
								<a href="<?php echo site_url('expenses/manager/delete/'.$expense -> id)?>">Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<script>
			function page_init() {
				$('#excel_sheet').dataTable();
			}
		</script>
		<?php Assets::add_js('page_init();', 'inline'); ?>
	</div>
</section>
