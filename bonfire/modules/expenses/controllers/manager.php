<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Expense Manager controller
 *
 * Various tools to manage the Database tables.
 *
 * @package    Expense
 * @subpackage Modules_Database
 * @category   Controllers
 * @author     Interface88 Team
 * @link       http://interface88.com
 *
 */
class Manager extends Authenticated_Controller {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		if (!class_exists('Expense_model')) {
			$this -> load -> model('Expense_model', 'expense_model');
		}

	}//end __construct()

	public function index() {
		$expenses = $this -> expense_model -> get_for_all();
		Template::set('expenses', $expenses);
		Template::render();

	}//end index()

	public function add() {

		if (has_permission('App.Expenses.Add')) {
			if ($_POST) {
				$post = $this -> input -> post();
				if ($this -> validate()) {
					 if($this->expense_model->insert($post)){
					 	Template::set_message('Expense successfully added','success');
						Template::redirect('expenses/manager');
					 }else{
						Template::set_message('Error adding expense.','error'); 	
					 }
				}
 			}
			Template::render();
		} else {
			Template::set_message('You don\'t have permission to add expense','error');
			Template::redirect('expenses/manager');
			
		}

	}//end add()

	public function update($id = false) {
		if($id){
			$expense = $this->expense_model->find($id);
			if($expense){
				if($_POST){
					$post = $this -> input -> post();
					if ($this -> validate()) {
						 if($this->expense_model->update($id, $post)){
						 	Template::set_message('Expense successfully updated.','success');
							Template::redirect('expenses/manager');
						 }else{
							Template::set_message('Error updating expense.','error'); 	
						 }
					}			
				}
				Template::set('expense',$expense);
				Template::render();
				
			} else {
				Template::set_message('Record doesn\'t exist or has been deleted.','error');
				Template::redirect('expenses/manager');
			}
		}else{
			Template::redirect('expenses/manager');
		}

	}//end update()

	public function delete($id = false) {
		if (has_permission('App.Expenses.Delete')) {
			if ($id) {
				if ($this -> expense_model -> find($id)) {
					$this -> expense_model -> delete($id);
					Template::set_message('Record deleted successfully','success');
				} else {
					Template::set_message('Record doesn\'t exist','error');
				}
			}
		} else {
			Template::set_message('You don\'t have permission to delete a record','error');
		}
		redirect('expenses/manager');

	}//end delete()
	
	public function report() {
		
		if($_POST){
			
			$post = $this -> input -> post();
			if(strtolower($post['submit']) == 'pdf'){
				// PDF CODE GOES HERE @gitesh
			}elseif(strtolower( $post['submit']) == 'csv'){
				$this->load->dbutil();
				$query_obj = $this -> expense_model -> report_csv($post);
				$this->load->helper('download');
				force_download('expense.csv', $this->dbutil->csv_from_result($query_obj)); 
				return;
			}
		}else{
			Template::render();
		}
		
	}//end report()

	private function validate() {

		//--------------------- validating data -------------------------------
		$this -> form_validation -> set_rules('stringer_name', 'Stringer name', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('costs', 'Costs', 'required|trim|is_numeric|xss_clean');
		$this -> form_validation -> set_rules('expense_date', 'Expense date', 'required|trim|date|xss_clean');
		if (has_permission('App.Expenses.PaidDate')){
			$this -> form_validation -> set_rules('paid_date', 'Paid date', 'required|trim|date|xss_clean');
		}
		$this -> form_validation -> set_rules('description', 'Description', 'trim|xss_clean');
		$this -> form_validation -> set_rules('released_from_received', 'Stringer name', 'trim|xss_clean');

		return $this -> form_validation -> run();
		
	}//end validate()

}//end class
