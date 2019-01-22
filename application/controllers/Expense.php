<?php
/*
*  @author    : Muhammad Ibrahim
*  @Mail      : aliibrahimroshan@gmail.com
*  @Created   : 14th August, 2017
*  @Developed : Team Gigabyte
*  @URL       : www.gigabyteltd.net
*  @Envato    : https://codecanyon.net/user/gb_developers
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Expense extends CI_Controller
{
	// Expense
	function index($date1 = '', $date2 = '')
	{
		$date1 = date('Y-m').'-1';

		$date2 = date('Y-m').'-31';

		// DEFINES PAGE TITLE
		$data['title'] = 'Expense List';

		// DEFINES NAME OF TABLE HEADING
		$data['table_name'] = 'Expense report  from '.$date1.' to '.$date2;

		// DEFINES BUTTON NAME ON THE TOP OF THE TABLE
		$data['page_add_button_name'] = 'Add New Expense';

		// DEFINES THE TITLE NAME OF THE POPUP
		$data['page_title_model'] = 'Add New Expense';

		// DEFINES THE NAME OF THE BUTTON OF POPUP MODEL
		$data['page_title_model_button_save'] = 'Save Expense';

		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'expenselist';

		// DEFINES THE TABLE HEAD
		$data['table_heading_names_of_coloums'] = array(
			'No',
			'Expense',
			'Payee',
			'Method',
			'Date',
			'User',
			'Description',
			'Total Bill',
			'Total Paid'
		);

		// PARAMETER 0 MEANS ONLY FETCH THAT RECORD WHICH IS VISIBLE 1 MEANS FETCH ALL
		$this->load->model('Crud_model');
		$data['expense_record_list'] = $this->Crud_model->fetch_record_expense($date1,$date2);

		$data['payee_list'] = $this->Crud_model->fetch_record('mp_payee',NULL);

		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}


	//Expense/save_bank_expense
	//USED TO SAVE BANK EXPENSE INTO TABLE 
	function save_bank_expense()
	{	

		$user_name = $this->session->userdata('user_id');
		$added_by = $user_name['name'];
		// DEFINES READ medicine details FORM medicine FORM
		$save_available_balance = html_escape($this->input->post('save_available_balance'));

		$payee_id = html_escape($this->input->post('payee_id'));
		$date = html_escape($this->input->post('date'));
		$bank_id = html_escape($this->input->post('bank_id'));

		//ARRAY OF INPUTS 
		$head_id = html_escape($this->input->post('head_id'));
		$description = html_escape($this->input->post('description'));
		$expense_total = html_escape($this->input->post('expense_total'));


		if(count($head_id) > 0 AND $expense_total > 0)
		{
			// $picture = html_escape($this->input->post('picture'));
			// DEFINES LOAD CRUDS_MODEL FORM MODELS FOLDERS
			$this->load->model('Transaction_model');

			// ASSIGN THE VALUES OF TEXTBOX TO ASSOCIATIVE ARRAY
			$args = array(
				'date' 	  	 => ($date == NULL ? date('Y-m-d') : $date ),
				'bank_id'  	 => $bank_id,
				'payee_id' 	 => $payee_id,
				'user' 		 => $added_by,
				'account_head' => $head_id,
				'total_bill' 	=> $expense_total,
				'memo' 		 => $description,
				'credithead' => 16
			);

			// DEFINES CALL THE FUNCTION OF insert_data FORM Crud_model CLASS
			$result = $this->Transaction_model->add_bank_expense_transaction($args);
			if ($result != NULL)
			{
				$array_msg = array(
					'msg' => '<i style="color:#fff" class="fa fa-check-circle-o" aria-hidden="true"></i> Created Successfully',
					'alert' => 'info'
				);
				$this->session->set_flashdata('status', $array_msg);
			}
			else
			{
				$array_msg = array(
					'msg' => '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i>  Cannot Created',
					'alert' => 'danger'
				);
				$this->session->set_flashdata('status', $array_msg);
			}
		}
		else
		{
			$array_msg = array(
					'msg' => '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i> Empty expense !!',
					'alert' => 'danger'
				);
			$this->session->set_flashdata('status', $array_msg);
		}

		redirect('expense/bank_expense');
	}

	// Expense/bank_expense
	function bank_expense($date1 = '', $date2 = '')
	{

		$date1 = html_escape($this->input->post('date1'));
		$date2 = html_escape($this->input->post('date2'));

		if($date1 == "" OR $date2 == "")
		{
			$date1 = date('Y-m').'-1';
			$date2 = date('Y-m').'-31';
		}

		// DEFINES PAGE TITLE
		$data['title'] = 'Bank Expense List';

		// DEFINES NAME OF TABLE HEADING
		$data['table_name'] = 'Expense  from '.$date1.' to '.$date2;

		// DEFINES BUTTON NAME ON THE TOP OF THE TABLE
		$data['page_add_button_name'] = 'Add Expense';

		// DEFINES THE TITLE NAME OF THE POPUP
		$data['page_title_model'] = 'Add Bank Expense';

		// DEFINES THE NAME OF THE BUTTON OF POPUP MODEL
		$data['page_title_model_button_save'] = 'Save Expense';

		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'bank_expense_list';

		// DEFINES THE TABLE HEAD
		$data['table_heading_names_of_coloums'] = array(
			'No',
			'Expense',
			'Date',
			'Bank',
			'Total',
			'Created by',
			''
		);

		// PARAMETER 0 MEANS ONLY FETCH THAT RECORD WHICH IS VISIBLE 1 MEANS FETCH ALL
		$this->load->model('Crud_model');
		$data['expense_record_list'] = $this->Crud_model->fetch_record_bankexpense($date1,$date2);

		//DEFINE TO FETCH THE LIST OF SUPPLIER
		$data['payee_list'] = $this->Crud_model->fetch_attr_record_by_id('mp_payee','cus_status','0');

		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}




	//expense/edit_bank_expense
	function edit_bank_expense($expense_id)
	{
		$this->load->model('Crud_model');

		// DEFINES PAGE TITLE
		$data['title'] = 'Update Expense';

		// DEFINES TO LOAD THE CATEGORY LIST FROM DATABSE TABLE mp_supplier
		$data['head_list'] = $this->Crud_model->fetch_attr_record_by_id('mp_head','nature','Expense');

		// DEFINES TO LOAD THE CATEGORY LIST FROM DATABSE TABLE mp_bank
		$data['bank_list'] = $this->Crud_model->fetch_record('mp_banks',NULL);

		//PARENT DATA OF REFUND	
		$data['parent_row'] = $this->Crud_model->fetch_record_by_id('mp_expense',$expense_id);
		
		//CHILD DATA OF REFUND	
		$data['child_row'] = $this->Crud_model->fetch_attr_record_by_id('mp_sub_expense','expense_id',$expense_id);
		
		//BANK TRANSACTION ID IF FOUND 
		$data['bank_row'] = $this->Crud_model->fetch_attr_record_by_id('mp_bank_transaction','transaction_id',$data['parent_row'][0]->transaction_id);

		if($data['bank_row'] != NULL)
		{
			$data['bank_balance'] = $this->Crud_model->check_available_balance($data['bank_row'][0]->bank_id);

		}
		else
		{
			$data['bank_balance'] = NULL;
			$data['bank_row'] = 0 ;
		}
		

		//DEFINE TO FETCH THE LIST OF SUPPLIER
		$data['payee_list'] = $this->Crud_model->fetch_attr_record_by_id('mp_payee','cus_status','0');

		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'edit_bank_expense';

		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}

	function generate_expense()
	{
		$date1 = html_escape($this->input->post('date1'));
		$date2 = html_escape($this->input->post('date2'));

		// DEFINES PAGE TITLE
		$data['title'] = 'Expense List';

		// DEFINES NAME OF TABLE HEADING
		$data['table_name'] = 'Expense report  from '.$date1.' to '.$date2;

		// DEFINES BUTTON NAME ON THE TOP OF THE TABLE
		$data['page_add_button_name'] = 'Add New Expense';

		// DEFINES THE TITLE NAME OF THE POPUP
		$data['page_title_model'] = 'Add New Expense';

		// DEFINES THE NAME OF THE BUTTON OF POPUP MODEL
		$data['page_title_model_button_save'] = 'Save Expense';

		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'expenselist';

		// DEFINES THE TABLE HEAD
		$data['table_heading_names_of_coloums'] = array(
			'No',
			'Head',
			'Method',
			'Date',
			'User',
			'Description',
			'Total Bill',
			'Total Paid'
		);

		// PARAMETER 0 MEANS ONLY FETCH THAT RECORD WHICH IS VISIBLE 1 MEANS FETCH ALL
		$this->load->model('Crud_model');
		$expense_record = $this->Crud_model->fetch_record_expense($date1,$date2);
		$data['expense_record_list'] = $expense_record;

		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}
	
	//Expense/popup
	//DEFINES A POPUP MODEL OG GIVEN PARAMETER
	function popup($page_name = '',$param = '')
	{
		$this->load->model('Crud_model');

		if($page_name  == 'add_expense_model')
		{
			 
			// DEFINES TO LOAD THE CATEGORY LIST FROM DATABSE TABLE mp_supplier
			$data['head_list'] = $this->Crud_model->fetch_attr_record_by_id('mp_head','nature','Expense');
			//DEFINE TO FETCH THE LIST OF SUPPLIER
			$data['payee_list'] = $this->Crud_model->fetch_record('mp_payee',NULL);

			//DEFINES TO FETCH THE LIST OF BANK ACCOUNTS 
			$data['bank_list'] = $this->Crud_model->fetch_record('mp_banks','status');

			//model name available in admin models folder
			$this->load->view('admin_models/add_models/add_expense_model.php',$data);
		}

		else if($page_name  == 'add_bank_expense_model')
		{
			 
			 // DEFINES TO LOAD THE CATEGORY LIST FROM DATABSE TABLE mp_supplier
			$data['head_list'] = $this->Crud_model->fetch_bank_expense_heads();

			// DEFINES TO LOAD THE CATEGORY LIST FROM DATABSE TABLE mp_bank
			$data['bank_list'] = $this->Crud_model->fetch_record('mp_banks','status');
			
			//DEFINE TO FETCH THE LIST OF SUPPLIER
			$data['payee_list'] = $this->Crud_model->fetch_record('mp_payee',NULL);

			//DEFINES TO FETCH THE LIST OF BANK ACCOUNTS 
			$data['bank_list'] = $this->Crud_model->fetch_record('mp_banks','status');

			//model name available in admin models folder
			$this->load->view('admin_models/add_models/add_bank_expense_model.php',$data);
		}	
		else if($page_name  == 'edit_expense_model')
	    {

	    	// DEFINES TO LOAD THE CATEGORY LIST FROM DATABSE TABLE mp_supplier
			$data['head_list'] = $this->Crud_model->fetch_attr_record_by_id('mp_head','nature','Expense');

			//DEFINE TO FETCH THE LIST OF SUPPLIER
			$data['payee_list'] = $this->Crud_model->fetch_record('mp_payee',NULL);

			//DEFINES TO FETCH THE LIST OF BANK ACCOUNTS 
			$data['bank_list'] = $this->Crud_model->fetch_record('mp_banks','status');

	    	$data['single_expense'] = $this->Crud_model->fetch_record_by_id('mp_expense',$param);

	    	if($data['single_expense'][0]->method == 'Cheque' )
	    	{
	    		$data['single_transaction'] = $this->Crud_model->fetch_attr_record_by_id('mp_bank_transaction','transaction_id',$data['single_expense'][0]->transaction_id);
	    	}

	    	//model name available in admin models folder
	     	$this->load->view('admin_models/edit_models/edit_expense_model.php',$data);
	    }
	}

	//Expense/add_expense
	function add_expense()
	{	

		$credithead = 0;
		$user_name = $this->session->userdata('user_id');
		$added_by = $user_name['name'];

		// DEFINES READ medicine details FORM medicine FORM
		$head_id = html_escape($this->input->post('head_id'));
		$method_id = html_escape($this->input->post('payment_id'));
		$total_bill = html_escape($this->input->post('bill_total'));
		$total_paid = html_escape($this->input->post('bill_paid'));
		$date = html_escape($this->input->post('date'));
		$description = html_escape($this->input->post('description'));
		$bank_id = html_escape($this->input->post('bank_id'));
		$payee_id = html_escape($this->input->post('payee_id'));
		$ref_no = html_escape($this->input->post('ref_no'));
		$save_available_balance = html_escape($this->input->post('save_available_balance'));

		if(($save_available_balance-$total_paid) <= 0 AND $method_id == 'Cheque' )
		{
			$array_msg = array(
				'msg' => '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i> Insufficient balance available ',
				'alert' => 'danger'
			);
			$this->session->set_flashdata('status', $array_msg);
		}
		else
		{
			// $picture = html_escape($this->input->post('picture'));
			// DEFINES LOAD CRUDS_MODEL FORM MODELS FOLDERS
			$this->load->model('Transaction_model');

			// ASSIGN THE VALUES OF TEXTBOX TO ASSOCIATIVE ARRAY
			$args = array(
				'head_id' => $head_id,
				'method' => $method_id,
				'total_bill' => $total_bill,
				'total_paid' => $total_paid,
				'date' => $date,
				'description' => $description,
				'user' => $added_by,
				'payee_id' => $payee_id,
				'bank_id' => $bank_id,
				'credithead' => ($method_id == 'Cash' ? '2' : '16'),
				'ref_no' => $ref_no
			);

			// DEFINES CALL THE FUNCTION OF insert_data FORM Crud_model CLASS
			$result = $this->Transaction_model->add_expense_transaction($args);
			if ($result != NULL)
			{
				$array_msg = array(
					'msg' => '<i style="color:#fff" class="fa fa-check-circle-o" aria-hidden="true"></i> Expense added Successfully',
					'alert' => 'info'
				);
				$this->session->set_flashdata('status', $array_msg);
			}
			else
			{
				$array_msg = array(
					'msg' => '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error expense cannot be added',
					'alert' => 'danger'
				);
				$this->session->set_flashdata('status', $array_msg);
			}
		}

		redirect('expense');
	}
}