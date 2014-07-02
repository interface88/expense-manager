<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Database Tools controller
 *
 * Various tools to manage the Database tables.
 *
 * @package    Bonfire
 * @subpackage Modules_Database
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Expenses extends Front_Controller
{

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		if (!class_exists('Expense_model'))
		{
			$this->load->model('expenses/Expense_model', 'expense_model');
		}
		

	}//end __construct()

	
	public function index()
	{
		$expenses = $this->expense_model->get_for_all();
		Template::set('expenses',$expenses);
		Template::render();

	}//end index()
	
	public function search()
	{
		//search functionality code goes here

	}//end index()
	
	
	
}//end class
