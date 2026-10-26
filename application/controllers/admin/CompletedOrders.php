<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class CompletedOrders extends CI_Controller {

		// construct
        public function __construct()
		{
				parent::__construct();
				$this->load->database();
                $this->load->library('form_validation');
				$this->load->helper(array('form', 'url', 'text'));
                $this->load->model("Admin_model");
				//$this->pr_details=get_profile_details();
				$this->load->library('session');
				if(!$this->session->userdata('adminId'))
				{
					redirect(base_url().'admin/login');	
				}	

				$this->load->config('nzpost_config');

				$this->client_id = $this->config->item('client_id');

				$this->client_secret = $this->config->item('client_secret');

        }
		
       
		public function index($mode=0)
		{
			$fromdate="";
			$todate="";
			$order ="";    
			
			if(!empty($_POST['fromdate']))
			{
				$fromdate = $_POST['fromdate'];
			}
			if(!empty($_POST['todate']))
			{
				$todate = $_POST['todate'];
			}
			if(!empty($_POST['order']))
			{
				$order=$_POST['order'];
			}


			$data['all_orders']	=	$this->Admin_model->fetch_all_orders_completed($mode,$fromdate,$todate,$order);
						
			$data['seo_title'] 	=	"Completed Orders | D WALKER JEWELRY";
			
			$this->load->view('admin/view_orders_all',$data); 
		}




		public function ViewOrder($id)
		{

		$data['seo_title'] 	=	"View Order Details | D WALKER JEWELRY";

		$data['order'] = $this->Admin_model->fetch_single_order($id);

		$data['order_products'] = $this->Admin_model->fetch_data('dwalker_order_products',array('OrderID' => $id));

		$data['tracking'] = array();

		if($data['order']['orderLabelStatus']!=0)
		{

		$data['tracking'] = $this->trackParcel($id);

		}

		$this->load->view('admin/view_single_order',$data); 

		}
		

	
	
		public function export_excel()
		{
		
			$user_data 	 = 	$this->Admin_model->fetch_all_orders_completed();
			
			
					$this->load->library("excel");
					$object = new PHPExcel();
					
					$object->setActiveSheetIndex(0);	
					
					$object->getActiveSheet()->getColumnDimension('A')->setWidth(20);
					$object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
					$object->getActiveSheet()->getColumnDimension('C')->setWidth(40);
					$object->getActiveSheet()->getColumnDimension('D')->setWidth(20);
					$object->getActiveSheet()->getColumnDimension('E')->setWidth(50);
					$object->getActiveSheet()->getColumnDimension('F')->setWidth(20);
					$object->getActiveSheet()->getColumnDimension('G')->setWidth(10);
					$object->getActiveSheet()->getColumnDimension('H')->setWidth(20);
					$object->getActiveSheet()->getColumnDimension('I')->setWidth(20);
					
					$table_columns = array("Order ID", "User Name" , "Address", "Mobile", "Email", "Product Name", "Quantity", "Total Price", "Order Date");
					
					$object->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold( true );
					$object->getActiveSheet()->getStyle("A1:I1")->getFont()->setSize(12);

					$column = 0;
					
					foreach($table_columns as $field)
					{
						$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
					   	$column++;
					}	
						
					
					$excel_row = 2;
					
					if(!empty($user_data))
					{
						foreach($user_data as $row)
						{
					
			
							
							$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->payOrderID);
							$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->payName);
							$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->payAddress);
							$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->payPhone);
							$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->payEmail);
							$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->payProduct);
							$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->payQuantity);
							$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->payTotal);
							$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->payDate);
							$excel_row++;
						}
					}
					else
					{
						$object->getActiveSheet()->SetCellValue('A'.$excel_row,"no records");
					}
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="completed_orders.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Cache-Control: cache, must-revalidate'); 
        header ('Pragma: public'); 
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		ob_end_clean();
		ob_start();
        $objWriter->save('php://output');
		}
			
   
		public function export_excelOLD()
	{
		$spreadsheet = new Spreadsheet(); 

		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Gipsy Danger'); 
		$sheet->setCellValue('A2', 'Gipsy Avenger');
		$sheet->setCellValue('A3', 'Striker Eureka');
		$sheet->setCellValue('B1', 'Gipsy Danger'); 
		$sheet->setCellValue('B2', 'Gipsy Avenger');
		$sheet->setCellValue('B3', 'Striker Eureka');
		$writer = new Xlsx($spreadsheet); 
	 
		$filename = 'list-of-jaegers'; 
	 
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		
		$writer->save('php://output');	
	} 



	public function GenerateInvoice($id)
	{

		$order = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$id));		
		$cartproduct	=	$this->Admin_model->product_cart($id);
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Dwalker');
		$pdf->SetTitle('');
		$pdf->SetSubject('Invoice');		
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);	
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		$html = '

		<table cellpadding="10">

		<tr>
		
		<th width="20%">

		<img src="'.base_url().'assets/images/pdf.png">

		</th>

		<th width="40%"></th>

		<th width="40%" align="right">
		<b>64+ 092501890</b><br>
		<b>dwalkerjewels@gmail.com</b>
		</th>

		</tr>

		</table>

		<table cellpadding="10">
		<tr>
		
		<th><b>Order ID </b> : '.$order['OrderID'].'</th>

		<th><b>Billing Address</b></th>

		<th><b>Shipping Address</b></th>

		</tr>
		

		<tr>
		
		<th><b>Order Date</b> : '.date('d-m-Y',strtotime($order['payDate'])).'</th>

		<th>
						<br>
						'.$order['payName'].'<br>
						'.$order['payAddress'].'<br>									
						'.$order['payPhone'].'<br>
						'.$order['payEmail'].'
		</th>

		<th>
		<br>
		'.$order['payName'].'<br>
		'.$order['payAddress'].'<br>							
		'.$order['payPhone'].'<br>
		'.$order['payEmail'].'
		</th>
		
		</tr>

		</table>';

		$html .='

				<table cellpadding="10" style="border-top:.5px solid black;">
				
				<tr>

				<td align="center"></td>

				<td align="center"></td>
			  
			 </tr>			

				<tr>
				<td align="center"></td>
				<td align="center"></td>			  
			 </tr>
				</table>				
			';


			$item_sec = "";

			foreach($cartproduct as $itm)
			{
				$item_sec .="
				
				<tr>

				<td>{$itm->payProduct}</td>
				
				<td>{$itm->payQuantity}</td>

				<td align=\"right\">$ {$itm->payPrice} NZD</td>
				
				</tr>
				
				";
			}


			$ship_sec="";


			if(!empty($order['payShipping']))
			{

			$ship_sec .='
			
					<tr>
					
					<td align="right" colspan="2">Shipping Cost</td>
					<td align="right">$'.$order['payShipping'].' NZD</td>

					</tr>
			
			';

			}


			$discount_sec ="";

			if($order['promo_status']==1)
			{
				$Tamnt = $this->Admin_model->select_sum('dwalker_order_products',array('OrderID'=>$order['payID']),'payPrice');
				$before = (float)$order['payTotalbefore'] ?: (float)$Tamnt;
				$shipping = (float)$order['payShipping'];
				$tax = !empty($order['payTax']) ? (float)$order['payTax'] : 0;
				$actual_total = (float)$order['payTotal'];
				$computed_expected = $before + $shipping + $tax;

				if ($actual_total > 0 && abs(($computed_expected - (float)$order['promo_dis']) - $actual_total) < 0.05) {
					$damnt = (float)$order['promo_dis'];
				} else {
					$damnt = ($Tamnt * (float)$order['promo_dis']) / 100;
				}
				$discount_sec .='
				<tr style="color:red;">		
				<td align="right" colspan="2">Promocode Discount</td>			
					<td align="right">- $ '.number_format($damnt, 2).' NZD</td>
				</tr>
				';

			}


				$html .='

					<table cellpadding="10" border="1">

					<tr style="background-color:#071f75">
						
						<th width="60%;"><b style="color:white">Product</b></th>

						<th width="20%;color:white"><b style="color:white">Qty</b></th>

						<th width="20%;color:white"><b style="color:white">Price</b></th>
					
					</tr>
					

					'.$item_sec.'



					<tr>
					
					<td align="right" colspan="2" >Total</td>
					<td align="right">$ '.$order['payTotalbefore'].' NZD</td>

					</tr>


					'.$ship_sec.'

					'.$discount_sec.'


					<tr>
					
					<td align="right" colspan="2" style="font-size:16px;"><b>Grand Total</b></td>
					<td align="right" style="font-size:16px;"><b>$ '.$order['payTotal'].' NZD</b></td>

					</tr>

				</table>

				';
		

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("{$order['OrderID']}.pdf", "I");


}

public function ChangeStatus($stat,$id){ 

	if($stat==3)
	
	{

	$stat_cond = array('payID' => $id);     

	$stat_data = array('Codflag' => 1);

	$projet =  $this->Admin_model->update_all($stat_data,$stat_cond,'dwalker_payments');

	$this->session->set_flashdata('success','Status Updated Succesfully');
	
	redirect(base_url().'admin/CompletedOrders/3');
		
	}
		
	else
	{
		
	redirect(base_url());
	
	}


	}	





		//NZ Post API
		public function authenticate()
		{

		// Define the OAuth endpoint and credentials
		$url = $this->config->item('nz_auth_url');

		$grant_type = 'client_credentials';

		// Prepare POST fields
		$post_fields = http_build_query([
			'grant_type'    => $grant_type,
			'client_id'     => $this->client_id,
			'client_secret' => $this->client_secret
		]);

		// Initialize cURL
		$ch = curl_init($url);	

		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
		curl_setopt($ch, CURLOPT_POST, true);            // Use POST request
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);  // Attach POST data
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/x-www-form-urlencoded'
		]);

		// Execute cURL and get the response
		$response = curl_exec($ch);

		$response_data = json_decode($response,true);

		// Check for cURL errors
		if (curl_errno($ch)) {
			//echo 'Error:' . curl_error($ch);
																																																																																																																																												
		} else {
			//echo "Response: " . $response;
			
		}
		// Close cURL
		curl_close($ch);

		return $response_data['access_token'];

		}




		public function generateLabel($orderId)
		{

			$auth_token = $this->authenticate();

			$order_details = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$orderId));

			if(empty($consignmentId = $order_details['consID']))
			{

			$url = 'https://api.nzpost.co.nz/parcellabel/v3/labels';

			$headers = [
				'client_id: '.$this->client_id,
				'Content-Type: application/json',
				'Authorization: Bearer '.$auth_token
			];


				$street = !empty($order_details['payStreet']) ? trim($order_details['payStreet']) : '';
				$suburb = !empty($order_details['paySuburb']) ? trim($order_details['paySuburb']) : '';
				$city = !empty($order_details['payCity']) ? trim($order_details['payCity']) : '';
				$postcode = !empty($order_details['payPostCode']) ? trim($order_details['payPostCode']) : '';

				if (empty($street) && !empty($order_details['payAddress'])) {
					$parts = array_map('trim', explode(',', $order_details['payAddress']));
					if (count($parts) >= 4) {
						$street = $parts[0];
						$suburb = $parts[1];
						$city = $parts[2];
						$postcode = preg_replace('/[^0-9]/', '', $parts[3]);
					} elseif (count($parts) === 3) {
						$street = $parts[0];
						$suburb = $parts[1];
						$city = $parts[2];
					} elseif (count($parts) === 2) {
						$street = $parts[0];
						$city = $parts[1];
					} else {
						$street = $order_details['payAddress'];
					}
				}

				// Build delivery address
				$delivery_address = [
					"street" => $street,
					"suburb" => $suburb,
					"city" => $city,
					"postcode" => $postcode,
					"country_code" => "NZ",
				];

				// If an official NZ Post address_id is stored and non-zero, it can be passed or we use physical address
				if (!empty($order_details['payAddressId'])) {
					// Note: NZ Post API requires ONLY ONE of address_id or physical address
					// Using physical address is standard for CourierPost labels when components are populated
				}

				$data = [
					"carrier" => "COURIERPOST",
					"sender_reference_1" => $order_details['OrderID'],
					"sender_reference_2" => "Online Order",
					"account_number" => "92615295",
					"sender_details" => [
							"company_name" => "KRV Trading Limitted",
							"name" => "Vinod Nair",
							"phone" => "+0223750729",
							"site_code" => 76356,
							"email" => "bob@xyzwidgets.com"
					],
					"receiver_details" => [
							"name" => $order_details['payName'],
							"phone" => $order_details['payPhone'],
							"email" => $order_details['payEmail']
					],
					"pickup_address" => [
							"street" => "105 Flat Bush Road",
							"suburb" => "East Tamaki",
							"city" => "Auckland",
							"postcode" => "2023",
							"country_code" => "NZ"
					],
					"delivery_address" => $delivery_address,

					"parcel_details" => [[
						"service_code" => "CPOLP",
						"add_ons" => [],
						"return_indicator" => "OUTBOUND",
						"description" => "Medium Box",
						"dimensions" => [
								"length_cm" => 30,
								"width_cm" => 30,
								"height_cm" => 30,
								"weight_kg" => 2
					]
						]]
					];

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

				$response = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				$responseData = json_decode($response, true);
				
				if ($httpcode == 200) {
					//echo "Response: " . $response;
					if (isset($responseData['consignment_id'])) {

						$consignmentId = $responseData['consignment_id'];

						//Update consignment id

						$cons_cond = array('payID' => $orderId);     

						$cons_data = array(
						'orderLabelStatus' => 1,
						'consID' => $consignmentId
						);

						$this->Admin_model->update_all($cons_data,$cons_cond,'dwalker_payments');

					}  
					
					if(empty($order_details['orderTrackingRef'])){

						$track_ref = $order_details['orderTrackingRef'];

						$url = 'https://api.nzpost.co.nz/parcellabel/v3/labels/'.$consignmentId.'/status';

						$headers = [
						'client_id: '.$this->client_id,
						'Content-Type: application/json',
						'Authorization: Bearer '.$auth_token
						];


					$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_HTTPGET, true); 
						curl_setopt($ch, CURLOPT_POST, false);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
						$response = curl_exec($ch);
						$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						curl_close($ch);

						$responseData = json_decode($response, true); 

						$trackingid = $responseData['labels'][0]['tracking_reference'];

						$track_cond = array('payID' => $orderId);     

						$track_data = array(
						'orderLabelStatus' => 2,
						'orderTrackingRef' => $trackingid
						);
						
						$this->Admin_model->update_all($track_data,$track_cond,'dwalker_payments');

					}

				} else {

					echo "Error: " . $httpcode . " - " . $response;
					return;

				}

				}


				$url = 'https://api.nzpost.co.nz/parcellabel/v3/labels/'.$consignmentId.'?format=PDF&page=1';

				$headers = [
				'client_id: '.$this->client_id,
				'Authorization: Bearer '.$auth_token
				];

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

				$response = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				if ($httpcode == 200) {
					header('Content-Type: application/pdf');
					header('Content-Disposition: inline; filename="'.$orderId.'.pdf"');
					header('Content-Length: ' . strlen($response));
					
					// Output the PDF directly to the browser
					echo $response;
					exit;

				} else {

					echo "Error: " . $httpcode . " - " . $response;

				}


		}




		public function trackParcel($orderId)
		{

			$auth_token = $this->authenticate();

			$order_details = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$orderId));

			$track_ref = $order_details['orderTrackingRef'];

			$url = 'https://api.nzpost.co.nz/parceltrack/3.0/parcels/'.$track_ref;

			$headers = [
				'client_id: '.$this->client_id,
				'Content-Type: application/json',
				'Authorization: Bearer '.$auth_token
			];


			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPGET, true); 
				curl_setopt($ch, CURLOPT_POST, false);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				$response = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				$responseData = json_decode($response, true); 

				return $responseData;

		}



		public function sendToEship($orderId)
		{

		$order_details = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$orderId));

		$order_items = $this->Admin_model->product_cart($orderId);

		$items = [];
		foreach ($order_items as $product) {
			$items[] = [
				"description" => $product->payProduct,
				"sku"         => $product->payProduct,
				"quantity"    => $product->payQuantity,
				"weight"      => 0,
				"value"       => 0
			];
		}

		$payDate = $order_details["payDate"]; // e.g., "2025-07-15"
		$payTime = trim($order_details["payTime"] ?? '');

		if (empty($payTime)) {
			$payTime = '00:00';
		}

		// Final datetime for database (MySQL DATETIME format)
		$combinedDateTime = $payDate;

		$requestData = [
    	"order" => [
        "order_date"          => $combinedDateTime,
        "order_number"        => $orderId,
        "reference"           => "Online Order",
        "shipping_method"     => "Express Shipping",
        "signature_required"  => false,
        "destination"         => [
            "name"                  => $order_details["payName"],
            "phone"                 => $order_details["payPhone"],
            "street"                => $order_details["payStreet"],
            "suburb"                => $order_details["paySuburb"],
            "state"                 => "",
            "post_code"             => $order_details["payPostCode"],
            "country"               => $order_details["payCountry"],
            "delivery_instructions" => $order_details["payInstruction"]
        ],
        "items" => $items
    ]
	];

// Convert to JSON
			$jsonRequestData = json_encode($requestData, JSON_UNESCAPED_SLASHES);

			// echo "<pre>";
			// print_r($requestData); 
			// echo "</pre>";
			// exit;


			$ch = curl_init("https://api.starshipit.com/api/orders");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequestData);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
			// Set HTTP Header for POST request 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'StarShipIT-Api-Key: ad74871f7f7a4090ab4f8200463d5885',
			'Ocp-Apim-Subscription-Key: 47dae47c144c4a458e125d87de55cea6')
			);

			// Execute cURL and get the response
			$response = curl_exec($ch);

			$responseData = json_decode($response,true);

			$api_cond = array('payID' => $orderId);

			$api_data = array(
			'orderApiStatus' => 1,
			);

			$this->Admin_model->update_all($api_data,$api_cond,'dwalker_payments');

			$this->session->set_flashdata('success','Order sent to eship, You can view your order in eShip Dashboard');
		
			//redirect(base_url().'admin/CompletedOrders/ViewOrder/'.$orderId);

			redirect(base_url().'admin/CompletedOrders');

			//print_r($responseData);


		}






		public function initiatePickup($orderId)
		{

		$auth_token = $this->authenticate();

		$url = "https://api.nzpost.co.nz/parcelpickup/v3/bookings";

		$order_details = $this->Admin_model->fetch_one_row('dwalker_payments',array('payID'=>$orderId));

		$requestData = '  
			{
				"carrier": "COURIERPOST",
				"caller":"Vinod Nair",
				"phone":"0223750729",
				"pickup_date_time":"2025-02-24T10:00:00",
				"parcel_quantity":1,
				"pickup_address": {
				"suburb" : "Clover Park",
				"city" : "Auckland",
				"postcode" : "2023",
				"instructions": ""
      		}
  			}';

		// Prepare new cURL resource
		$ch = curl_init("{$url}");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		// Set HTTP Header for POST request 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'client_id:'.$this->client_id.'',
			'Authorization: Bearer '.$auth_token.'')
		);

		// Execute cURL and get the response
		$response = curl_exec($ch);

		$responseData = json_decode($response,true);

		if($responseData['results']['response_type']=="AP")
		{

		$api_cond = array('payID' => $orderId);     

		$api_data = array(
		'orderApiStatus' => 1,
		);
		$this->Admin_model->update_all($api_data,$api_cond,'dwalker_payments');
		}
		
		redirect(base_url().'admin/CompletedOrders/ViewOrder/'.$orderId);

		}



		    			
}