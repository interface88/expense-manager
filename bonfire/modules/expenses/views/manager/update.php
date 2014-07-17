
<section>
	<div class="page-header">
		<h1>Update expense</h1>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-info fade in">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Manage expense.</h4>
				you can new update expense from here.<br>
				Label marked as bold are required			
			</div>
		</div>
	</div>
	<?php if (validation_errors()) : ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="alert alert-error fade in">
					<a data-dismiss="alert" class="close">&times;</a>
					<ul>
						<?php echo validation_errors('<li>','</li>'); ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="span12">
			
			<?php echo form_open('expenses/manager/update/'.$expense->id, array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
			<form style="margin: 0;" autocomplete="off" class="form-horizontal" accept-charset="utf-8" method="post" action="http://localhost/expense-manager/login">
				<div class="control-group">
					<label for="stringer_name" class="control-label"><b>Stringer name</b></label>
					<div class="controls">
						<input type="text" value="<?php echo set_value('stringer_name',$expense->stringer_name); ?>" placeholder="Eg: Dominic torreto" class="input-xlarge" id="stringer_name" name="stringer_name">
					</div>
				</div>
				
				<div class="control-group">
					<label for="expense_date" class="control-label"><b>Expense date</b></label>
					<div class="controls">
						<input type="text" value="<?php echo set_value('expense_date',$expense->expense_date); ?>" placeholder="Eg : 1/10/2010" class="date_picker input-xlarge" id="expense_date" name="expense_date">
					</div>
				</div>
				<?php if (has_permission('App.Expenses.PaidDate')):?>
				<div class="control-group">
					<label for="paid_date" class="control-label"><b>Paid date</b></label>
					<div class="controls">
						<input type="text" value="<?php echo set_value('paid_date',$expense->paid_date); ?>" placeholder="Eg : 1/10/2010" class="date_picker input-xlarge" id="paid_date" name="paid_date">
					</div>
				</div>
				<?php endif;?>
				<div class="control-group">
					<label for="costs" class="control-label"><b>Costs</b></label>
					<div class="controls">
						<input type="text" value="<?php echo set_value('costs',$expense->costs); ?>" placeholder="Eg: 1000" class="input-medium" id="costs" name="costs">
					</div>
				</div>
				<div class="control-group">
					<label for="released_from_received" class="control-label">Released from received</label>
					<div class="controls">
						<input type="text" value="<?php echo set_value('released_from_received',$expense->released_from_received); ?>" placeholder="Received from " class="input-xlarge" id="released_from_received" name="released_from_received">
					</div>
				</div>
				<div class="control-group">
					<label for="description" class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" id="description" placeholder="Expense description goes here"><?php echo set_value('description',$expense->description); ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-primary" value="Save" name="submit">
						<a href="<?php echo site_url('expenses/manager')?>" class="btn">Cancel</a>
					</div>
				</div>

			</form>
		</div>
	</div>
</section>