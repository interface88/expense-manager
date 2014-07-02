
<section>
	<div class="page-header">
		<h1>Manage expense</h1>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-info fade in">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Manage expense.</h4>
				you can manage add, update and delete expense here.					
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<table id="excel_sheet" class="handsontable">
				<thead>
					<tr>
						<th></th>
						<th>Date</th>
						<th>Stringer Name</th>
						<th>Costs</th>
						<th>Description</th>
						<th>Released from recieved</th>
						<th>Paid Date</th>		
					</tr>
				</thead>
				<tbody>
					<?php foreach ($expenses as $expense) :?>
						<tr>
							
							<td data-id="<?php echo  $expense->id; ?>">
								<?php if(has_permission('App.Expenses.Delete ')):?>
									<button class="btn-small btn delete"><i class="icon-trash"></i></button>
								<?php endif?>
							</td>
							<td class="editable" data-property="expense_date"><?php echo  $expense->expense_date; ?></td>
							<td class="editable" data-property="stringer_name"><?php echo  $expense->stringer_name; ?></td>
							<td class="editable" data-property="costs"><?php echo  $expense->costs; ?></td>
							<td class="editable" data-property="description"><?php echo  $expense->description; ?></td>
							<td class="editable" data-property="released_from_received"><?php echo  $expense->released_from_received; ?></td>
							<?php if(has_permission('App.Expenses.PaidDate ')):?>
								<td class="editable" data-property="paid_date"><?php echo  $expense->paid_date; ?></td>
							<?php else:?>
								<td><?php echo  $expense->paid_date; ?></td>
							<?php endif?>
						</tr>
						<?php ?>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		<?php if(has_permission('App.Expenses.Add ')):?>
			<div class="span12">
				<button type="button" id="add_btn">Add new row</button>
			</div>
		<?php endif?>
		<style>
			.handsontableInput{
				height: 19px !important;
			    overflow-y: hidden;
			    resize: none;
			    width: 100%;
			    padding:0 !important;
			    margin:0 !important;
			}
		</style>
		<script>
			function page_init(){
				var $excelsheet = $('#excel_sheet');
				var original_value = "";
				
				$('#excel_sheet').on('click','tbody td.editable',function(){
					var $this = $(this);
					if(!$this.find('input').length){
						var text = $this.text();
						original_value = text; 
						var txt_bx = $('<input type="text" id="edit_box" class="handsontableInput">').val(text);
						$this.html(txt_bx);
						txt_bx.focus();
					}
				});
				
				$('#excel_sheet').on('focusout','#edit_box',function(){
					var $this = $(this);
					var new_val = $this.val();
					if(original_value != new_val){
						var tr = $this.parent().parent();
						var td = $this.parent();
						var id = tr.find('td:first').data('id');
						var obj = {};
						obj.id = id;
						obj[td.data('property')] = new_val;
						$this.parent().html(new_val);
						
						// TODO : MAKE THE AJAX REQUEST TO POST FOR SECUIRTY 
						$.get('<?php echo site_url('expenses/update');?>',obj,function(response){
							
						});
						
						// TODO : Reset old value if not update on server side.
						//$this.remove();
					}
				});
				
				<?php if(has_permission('App.Expenses.Delete ')):?>
				$('#excel_sheet').on('click','.delete',function(){
					if(confirm('are you sure you want to delete ?')){
						var id = $(this).parent().data('id');
						var url = '<?php echo site_url('expenses/delete');?>/' + id;
						// TODO CHECK IF DATA SUCCESSFULLY DELETED.
						$.get(url,function(response){
							alert('DELETED');
						});
						$(this).parent().parent().remove();
					}
				});
				<?php endif?>
				<?php if(has_permission('App.Expenses.Add ')):?>
					$('#add_btn').click(function(){
						$.get('<?php echo site_url('expenses/insert')?>',function(response){
							if(response != 'false' || response!= false ){
								var tr = '<tr data-id="'+response+'">';
								tr += '<td><button class="btn-small btn delete"><i class="icon-trash"></i></button></td>';
								tr += '<td class="editable"></td>';
								tr += '<td class="editable"></td>';
								tr += '<td class="editable"></td>';
								tr += '<td class="editable"></td>';
								tr += '<td class="editable"></td>';
								tr += '<td class="editable"></td>';
								$('#excel_sheet tbody').append($(tr));
							}else{
								alert('Error adding new row');
							}
						});
					})
				<?php endif?>
			}
		</script>
		<?php Assets::add_js('page_init();','inline');?>
	</div>
</section>
