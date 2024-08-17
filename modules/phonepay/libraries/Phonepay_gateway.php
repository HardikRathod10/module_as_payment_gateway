<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Phonepay_gateway extends App_gateway
{
	public function __construct()
	{
		/**
		 * Call App_gateway __construct function
		 */
		parent::__construct();
		/**
		 * REQUIRED
		 * Gateway unique id
		 * The ID must be alpha/alphanumeric
		 */
		$this->setId('phone_pay');

		/**
		 * REQUIRED
		 * Gateway name 
		 */
		$this->setName('Phone Pay');

		/**
		 * Add gateway settings
		 */
		$this->setSettings(
			[
				[
					'name' => 'merchant_id',
					'encrypted' => false,
					'label' => _l('phonepe_merchant_id'),
				],
				[
					'name' => 'env',
					'encrypted' => false,
					'label' => _l('phonepe_merchant_env'),
				],
				[
					'name' => 'salt_index',
					'encrypted' => false,
					'label' => _l('phonepe_salt_index'),
				],
				[
					'name' => 'user_id',
					'encrypted' => false,
					'label' => _l('phonepe_merchant_user_id'),
				],
				[
					'name' => 'salt_key',
					'encrypted' => false,
					'label' => _l('phonepe_salt_key'),
				],
				[
					'name' => 'currencies',
					'label' => 'settings_paymentmethod_currencies',
					'default_value' => 'INR',
				],

			]
		);

		/**
		 * REQUIRED
		 * Hook gateway with other online payment modes
		 */
		hooks()->add_filter('app_payment_gateways', [$this, 'initMode']);
		//\modules\phonepay\core\Apiinit::the_da_vinci_code(CC_AVENUE_MODULE);
	}

	// PhonePay url will go here
	function getUrl()
	{
		if ($this->getSetting('test_mode_enabled')) {
			return "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
		} else {
			return "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
		}
	}
	public function process_payment($data)
	{
		;
		$api_key = 'be3d1059-e680-4736-96a3-59efee736ec4';
		$merchant_id = 'M22BUCZCVDRL3';
		$order_id = rand(11111, 99999);
		$payLoad = array(
			'merchantId' => $merchant_id,
			'merchantTransactionId' => $order_id, // test transactionID
			"merchantUserId" => "M-" . uniqid(),
			'amount' => $data['amount'], // phone pe works on paise
			'redirectUrl' => admin_url('phonepay/phonepay/success'),
			'redirectMode' => "POST",
			'callbackUrl' => admin_url('phonepay/phonepay/success'),
			"paymentInstrument" => array(
				"type" => "PAY_PAGE",
			)
		);
		$salt_index = 1;
		$payload_json = json_encode($payLoad);

		$payload_base_64 = base64_encode($payload_json);

		$payload = $payload_base_64 . "/pg/v1/pay" . $api_key;
		$sha256 = hash('sha256', $payload);
		$final_x_header = $sha256 . "###" . $salt_index;

		$request = json_encode(['request' => $payload_base_64]);

		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $request,
			CURLOPT_HTTPHEADER => [
				"Content-Type: application/json",
				"X-VERIFY: " . $final_x_header,
				"accept: application/json"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$res = json_decode($response);

			if (isset($res->success) && $res->success == '1') {

				$paymentCode = $res->code;
				$paymentMsg = $res->message;
				$payUrl = $res->data->instrumentResponse->redirectInfo->url;
				redirect($payUrl);
				//			header('Location:' . $payUrl);
			}
		}


		// header('location: ' . $redirect_url);
	}
}
