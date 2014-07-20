<section>
	<div class="page-header">
		<h1>Expense repor</h1>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-info fade in">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Manage expense.</h4>
				you can generate report in pdf and csv format.[Only 500 record limit]					
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<?php echo form_open('expenses/manager/report', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
				<fieldset>
					<legend>Report filter</legend>
					<div class="control-group">
						<label for="stringer_name" class="control-label"><b>Stringer name</b></label>
						<div class="controls">
							<input type="text" value="<?php echo set_value('stringer_name'); ?>" placeholder="Eg: Dominic torreto" class="input-xlarge" id="stringer_name" name="stringer_name">
						</div>
					</div>
				</fieldset>
				<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-primary" value="Pdf" name="submit">
						<input type="submit" class="btn btn-primary" value="Csv" name="submit">
						<a href="<?php echo site_url('expenses/manager')?>" class="btn">Cancel</a>
					</div>
				</div>

			</form>
		</div>
	</div>
	
</section>
