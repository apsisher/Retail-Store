<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prints extends CI_Controller
{
	//Prints
	public function index()
	{
		redirect('homepage');
	}


	//Prints/purchase_order 
	//USED TO PRINT PURCHASE DETAILS 
	function purchase_order($order_id)
	{	
		$this->load->model('Crud_model');
		$data['default_data'] = $this->Crud_model->fetch_record_by_id('mp_langingpage',1); 

		$data['estimate_data'] = $this->Crud_model->fetch_record_by_id('mp_estimate',$order_id); 

		$data['sales_data'] = $this->Crud_model->fetch_product_estimate($order_id); 

		$data['user_data'] = $this->Crud_model->fetch_record_by_id('mp_payee',$data['estimate_data'][0]->payee_id); 

		// DEFINES PAGE TITLE
		$data['title'] = 'Purchase order';

		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/po';

		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}

	// Prints/debit_voucher
	// USED TO PRINT DEBIT VOUCHER DETAILS
	function debit_voucher($transaction_id)
	{
		$this->load->model('Crud_model');
		$data['default_data'] = $this->Crud_model->fetch_record_by_id('mp_langingpage', 1);
		$data['receipt_data'] = $this->Crud_model->fetch_single_voucher($transaction_id, 0);
		$data['trans_data'] = $this->Crud_model->get_single_child_trans($data['receipt_data'][0]->transaction_id,0);
		$data['user_data'] = $this->Crud_model->fetch_record_by_id('mp_payee', $data['receipt_data'][0]->payee_id);
		// DEFINES PAGE TITLE
		$data['title'] = 'Debit Voucher';
		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/debit_voucher';
		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}

	// Prints/estimate
	// USED TO PRINT INVOICE DETAILS
	function estimate($estimate_id)
	{
		$this->load->model('Crud_model');
		$data['default_data'] = $this->Crud_model->fetch_record_by_id('mp_langingpage', 1);
		$data['estimate_data'] = $this->Crud_model->fetch_record_by_id('mp_estimate', $estimate_id);
		$data['sales_data'] = $this->Crud_model->fetch_product_estimate($estimate_id);
		$data['user_data'] = $this->Crud_model->fetch_record_by_id('mp_payee', $data['estimate_data'][0]->payee_id);
		// DEFINES PAGE TITLE
		$data['title'] = 'Estimate print';
		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/estimate';
		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}
	
	// Prints/creditnote
	// USED TO PRINT CREDIT NOTE DETAILS
	function creditnote($credit_id)
	{
		$this->load->model('Crud_model');
		$data['default_data'] = $this->Crud_model->fetch_record_by_id('mp_langingpage', 1);
		$data['credit_data'] = $this->Crud_model->fetch_record_by_id('mp_credit_note', $credit_id);
		$data['sales_data'] = $this->Crud_model->fetch_product_credit($credit_id);
		$data['user_data'] = $this->Crud_model->fetch_record_by_id('mp_payee', $data['credit_data'][0]->payee_id);
		// DEFINES PAGE TITLE
		$data['title'] = 'Credit print';
		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/credit_note';
		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}

	// Prints/journal_voucher
	// USED TO PRINT JOURNAL VOUCHER DETAILS
	function journal_voucher($transaction_id,$v_id = 2)
	{
		$this->load->model('Crud_model');
		$data['default_data'] = $this->Crud_model->fetch_record_by_id('mp_langingpage', 1);
		$data['receipt_data'] = $this->Crud_model->fetch_single_voucher($transaction_id, $v_id);
		
		$data['trans_data'] = $this->Crud_model->get_single_child_trans($data['receipt_data'][0]->transaction_id,'');
		$data['user_data'] = $this->Crud_model->fetch_record_by_id('mp_payee', $data['receipt_data'][0]->payee_id);
		// DEFINES PAGE TITLE
		$data['title'] = 'Journal Voucher';
		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/journal_voucher';
		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}

	// USED TO PRINT CREDIT VOUCHER DETAILS
	function credit_voucher($transaction_id)
	{
		$this->load->model('Crud_model');
		$data['default_data'] = $this->Crud_model->fetch_record_by_id('mp_langingpage', 1);
		$data['receipt_data'] = $this->Crud_model->fetch_single_voucher($transaction_id, 1);
		$data['trans_data'] = $this->Crud_model->get_single_child_trans($data['receipt_data'][0]->transaction_id, 1);
		$data['user_data'] = $this->Crud_model->fetch_record_by_id('mp_payee', $data['receipt_data'][0]->payee_id);
		// DEFINES PAGE TITLE
		$data['title'] = 'Credit Voucher';
		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/credit_voucher';
		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}

	//USED TO PRINT DEPOSIT
	public function bank_collection($trans_id)
	{
		$this->load->model('Crud_model');

		//USED TO FETCH BANK TRANSACTION 
		$data['trans_data'] = $this->Crud_model->get_single_bank_collection($trans_id,1);

		// DEFINES PAGE TITLE
		$data['title'] = 'Bank Collection';

		// DEFINES WHICH PAGE TO RENDER
		$data['main_view'] = 'print/bank_collection';

		// DEFINES GO TO MAIN FOLDER FOND INDEX.PHP  AND PASS THE ARRAY OF DATA TO THIS PAGE
		$this->load->view('main/index.php', $data);
	}


	public function transaction($tran_id)
	{
		$this->load->model('Crud_model');

		$transa_data = $this->Crud_model->fetch_record_by_id('mp_generalentry',$tran_id); 
		$source = $transa_data[0]->generated_source;

		//FIND THE SOURCE AND GETTING THE ID		
		if($source == 'sales_receipt')
		{
			$result =  $this->Crud_model->fetch_attr_record_by_id('mp_sales_receipt','transaction_id',$tran_id);

			$this->sales($result[0]->id);
		}
		else if($source == 'refund_receipt')
		{
			$result =  $this->Crud_model->fetch_attr_record_by_id('mp_refund','transaction_id',$tran_id);
			
			$this->refund($result[0]->id);
		}
		else if($source == 'credit_note')
		{
			$result =  $this->Crud_model->fetch_attr_record_by_id('mp_credit_note','transaction_id',$tran_id);
			
			$this->creditnote($result[0]->id);
		}
		else if($source == 'expense')
		{
			$result =  $this->Crud_model->fetch_attr_record_by_id('mp_expense','transaction_id',$tran_id);
			
			$this->expense($result[0]->id);
		}
		else if($source == 'received_payments')
		{
			$result =  $this->Crud_model->fetch_attr_record_by_id('mp_payee_payments','transaction_id',$tran_id);
			
			$this->receive_receipt($result[0]->id);
		}
		else if($source == 'invoice')
		{
			$result =  $this->Crud_model->fetch_attr_record_by_id('mp_invoices','transaction_id',$tran_id);
			
			$this->invoice_print($result[0]->id);
		}
		else if($source == 'cheque')
		{
			$this->cheque($tran_id);
		}		
		else if($source == 'deposit')
		{
			$this->deposit($tran_id);
		}
	}
}	