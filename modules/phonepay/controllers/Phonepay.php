<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phonepay extends AdminController
{
    public function __construct()
    {
        parent::__construct();

		$this->load->model('phonepay_model');
		// $this->load->helper('phonepay');
        $this->load->library('phonepay/phonepay_gateway');
	}

    public function link2() {
        $data['title'] = _l('roles');
        $this->load->view('link2', $data['title']);
    }

    public function success(){
        echo "Hello";
    }
}

/* End of file Phonepay.php */