<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2012, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * User Model
 *
 * The central way to access and perform CRUD on users.
 *
 * @package    Bonfire
 * @subpackage Modules_Users
 * @category   Models
 * @author     Bonfire Dev Team
 * @link       http://cibonfire.com
 */
class Expense_model extends BF_Model
{

	protected $table = 'expenses';

	protected $soft_deletes = TRUE;

	protected $date_format = 'datetime';

	protected $set_created = TRUE;
	
	protected $set_modified = FALSE;


	//--------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

	}//end __construct()
	
	public function insert($post){
		/*
		 * DATE FORMATE CONVERSION WILL GOES HERE
		 * */
		//$data['expense_date'] =  date('Y-m-d H:i:s', $data['expense_date']);
		//$data['paid_date'] =  date('Y-m-d H:i:s', $data['paid_date']);
		
		$data = array(
			'stringer_name' =>  $post['stringer_name'],
			'description' =>  $post['description'],
			'paid_date' =>  $post['paid_date'],
			'expense_date' =>  $post['expense_date'],
			'released_from_received' =>  $post['released_from_received'],
			'costs' =>  $post['costs']
		);
		return parent::insert($data);
	}
	
	public function update($id , $post){
		/*
		 * DATE FORMATE CONVERSION WILL GOES HERE
		 * */
		//$data['expense_date'] =  date('Y-m-d H:i:s', $data['expense_date']);
		//$data['paid_date'] =  date('Y-m-d H:i:s', $data['paid_date']);
		$data = array(
			'stringer_name' =>  $post['stringer_name'],
			'description' =>  $post['description'],
			'expense_date' =>  $post['expense_date'],
			'released_from_received' =>  $post['released_from_received'],
			'costs' =>  $post['costs']
		);
		
		if (has_permission('App.Expenses.PaidDate')){
			$data['paid_date'] = $post['paid_date'];
		}
		return parent::update($id, $data);
	}
	
	public function get_for_all(){
		parent::where('deleted',0); //Not deleted record
		parent::order_by('created_on','desc'); //getting latest record
		return parent::find_all();
	}
	
	public function search($search_term  , $limit , $offset){
		//setting the limit
		parent::limit($limit , $offset);
		$this->search_core($search_term);
		$result =  parent::find_all();
		return $result;
		
	}
	
	// wrapper function for checking deleted object	
	public function find($id){
		return parent::find_by(array('id' => $id, 'deleted' => 0));
		
	}
	
	public function count_search_result($search_term){
		parent::select('COUNT(*) AS count');
		$this->search_core($search_term);
		$result = parent::find_all();
		return $result[0]->count;
	}

	public function report_csv($post){
		$where = 'WHERE 1 ';		
		if(!empty($post['stringer_name'])){
			$where .= " AND stringer_name LIKE '%".$post['stringer_name']."' ";
		}
		
		$query = "SELECT
			`id`, `stringer_name`, `description`, `expense_date`, `paid_date`, `costs`, `released_from_received`
			FROM ".$this->db->dbprefix($this->table).'  '.$where;
		return $this->db->query($query);
	}

	public function report_pdf($post){
		
		if($post['stringer_name']){
			
		}
		parent::select('COUNT(*) AS count');
		$this->search_core($search_term);
		$result = parent::find_all();
		return $result[0]->count;
	}
	
	private function search_core($search_term){
		if(!empty($search_term)){
			$this->expense_model->where('stringer_name LIKE ' , '%'.$search_term.'%');
			$this->expense_model->where('description LIKE ' , '%'.$search_term.'%');
		}
	}

	//--------------------------------------------------------------------

}//end User_model
