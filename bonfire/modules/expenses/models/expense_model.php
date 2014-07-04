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
	
	public function get_for_all(){
		parent::where('deleted',0);
		return parent::find_all();
	}
	
	public function get_for_alal(){
		parent::where('deleted',0);
		parent::limit();
		return parent::find_all();
	}
	
	public function search($search_term  , $limit , $offset){
		//setting the limit
		parent::limit($limit , $offset);
		$this->search_core($search_term);
		$result =  parent::find_all();
		return $result;
		
	}
	
	public function count_search_result($search_term){
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
