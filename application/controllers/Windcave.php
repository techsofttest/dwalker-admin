<?php defined('BASEPATH') OR exit('No direct script access allowed');



require_once(FCPATH.'windcave_lib/mockDb.php');
require_once(FCPATH.'windcave_lib/utils/enum.php');
require_once(FCPATH.'windcave_lib/utils/helper.php');
require_once(FCPATH.'windcave_lib/WindcavePayments/vendor/autoload.php');

use Enum\WindcaveTransactionStatus;
use Enum\WindcaveTransactionType;
use Enum\WindcaveSessionState;

use WindcavePayments\Enum\HttpStatusCode;
use WindcavePayments\Enum\ApiUrl;
use WindcavePayments\Enum\TransactionResult;
use WindcavePayments\Enum\CreateSessionResult;
use WindcavePayments\Enum\QuerySessionResult;
use WindcavePayments\Model\CreateSessionResponse;
use WindcavePayments\Model\QuerySessionResponse;
use WindcavePayments\WindcaveLogger;
use WindcavePayments\WindcavePayments;



class Windcave extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        //$this->load->library('paypal_lib');
		$this->load->model('Admin_model');
		$this->load->library('cart');
		$this->load->helper('url');
        $this->load->database();
        
        
        $this->data = array(
            
            'approved' => base_url().'Windcave/Approved',
            
            'declined' => base_url().'Windcave/Declined',
            
            'pending' => base_url().'Windcave/Pending',
            
            'failed' => base_url().'Windcave/Failed',
            
            'duplicate' => base_url().'Windcave/Duplicate',
           
        );
        
        
        
        if (empty($_SESSION['memoryStorage'])) {
//if (1==1) {
        $w_cfg = function_exists('get_windcave_config') ? get_windcave_config() : array();
        $_SESSION['memoryStorage'] = [
            'config' => [
                'url' => 'http://www.dwalker.co.nz/',
                'apiUsername' => !empty($w_cfg['username']) ? $w_cfg['username'] : '',
                'apiKey' => !empty($w_cfg['api_key']) ? $w_cfg['api_key'] : '',
                'environment' => (!empty($w_cfg['mode']) && $w_cfg['mode'] === 'live') ? 'live' : 'uat',
                'paymentType' => 'auth',
                'saveCards' => false,
                'paymentOptions' => ['card'],
            ],

        'products' => [
            1 => [
                'name' => 'Item 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => '21.95',
            ],
            2 => [
                'name' => 'Item 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => '1.00',
            ],
            3 => [
                'name' => 'Item 3',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => '1054.11',
            ]
        ],

        'cartItems' => [],

        'orderId' => 1,
    ];
}
        
$config = $_SESSION['memoryStorage']['config'];
WindcavePayments::setConfig($config['url'], $config['apiUsername'], $config['apiKey']);
        
        
        
    }
     
     
     
     
     
     public function index()
     {
         
         
    $this->load->view('user/windcave');

    
    /*
 $json = array(
        
        'customer' => array(
                    
                    'firstName' => 'Joe',
                    'lastName' => 'Doe',
                    'email' => 'test@gmail.com',
                    'phoneNumber' => '123'
                    ),
        
        'shippingAddress' => array(
            
                    'name' => 'Joee',
                    'address1' => 'loremm',
                    'address2' => 'ppp',
                    'address3' => 'qqq',
                    'city' => 'qqq',
                    'postalCode' => 'qqq',
                    'countryCode' => 'qqq',
                    'phoneNumber' => 'qqq',
                    'state' => 'qqq',
            
            ),
        
        'billingAddress' => array(
            
                    'name' => 'Joee',
                    'address1' => 'loremm',
                    'address2' => 'ppp',
                    'address3' => 'qqq',
                    'city' => 'qqq',
                    'postalCode' => 'qqq',
                    'countryCode' => 'qqq',
                    'phoneNumber' => 'qqq',
                    'state' => 'qqq',
            ),
        
        'payment' => "CARD",
        
        );
    
    
  //  $this->processPostPayment($json);
  
  
  
        $this->load->view('user/payment');
         
         */
         
         
     }
     
     
     
     
     
    
/*
abstract class RedirectUrlEnum
{
    const approved = "result?message=Transaction+approved";
    const declined = "checkout?message=Transaction+declined";
    const pending = "result?message=Transaction+result+pending";
    const failed = "result?message=Payment+failed";
    const duplicate = "result?message=Payment+already+made";
};

abstract class ContentTypeEnum
{
    const html = 'text/html';
    const css = 'text/css';
    const png = 'image/jpg';
    const js = 'text/javascript';
    const json = 'application/json';
};

*/

function clearCart()
{
    $_SESSION['memoryStorage']['cartItems'] = [];
    $_SESSION['memoryStorage']['orderId']++;
}

/**
 * Save transaction result in the database.
 * @param string $orderId
 * @param TransactionResult | CreateSessionResult | QuerySessionResult $response
 * @param string $parentTransactionId
 */
function processSuccessTransaction(string $orderId, mixed $response, string $parentTransactionId = NULL)
{
    $logger = WindcaveLogger::getInstance();

    $transaction = $response->transaction;
    $transactionType = $transaction['type'];

    if ($transaction['authorised']) {
        $logger->log("Transaction approved. Type: $transactionType. Adding transaction record.");
        acceptTransaction($orderId, $transaction, $parentTransactionId);
    } else if ($transactionType == WindcaveTransactionType::Void) {
        $logger->log("Transaction declined. Type: $transactionType");
    } else {
        $logger->log("Transaction declined. Type: $transactionType. Adding transaction record.");
        errorTransaction($orderId, $transaction, $parentTransactionId);
    }
}

/**
 * Save session, transaction and card in the database based on response.
 * @param string $orderId
 * @param CreateSessionResponse | QuerySessionResponse $response
 * @param mixed[] $windcaveSessionObject
 */
function processSuccessSession(string $orderId, mixed $response, array $windcaveSessionObject)
{
    processSuccessTransaction($orderId, $response, NULL);
    $transaction = $response->transaction;

    if ($transaction['authorised']) {
        if ($response->storeCard && isset($transaction['card']) && $_SESSION['memoryStorage']['config']['saveCards']) {
            saveCard($transaction['card']);
        }

        setSessionState($windcaveSessionObject, WindcaveSessionState::Approved);
        clearCart();
    } else {
        setSessionState($windcaveSessionObject, WindcaveSessionState::Declined);
    }
}

/**
 * Query Windcave session, update the session in the database, and redirect the customer based on the result.
 * @param string $sessionId
 * @param int $retries
 * @return string redirect url
 */
function handleCallback(string $sessionId, int $retries)
{
    $logger = WindcaveLogger::getInstance();
    $mockDb = MockDb::getInstance();

    $windcaveSessionObject = $mockDb->getSession($sessionId);
    $orderId = $windcaveSessionObject['orderId'];
    $approved = false;

    $logger->log("Callback triggered. Session ID: $sessionId. Order ID: $orderId. Retries: $retries");

    $retryUrl = "callback?sessionId=$sessionId&retries=$retries";
    $retryUrlIncrement = "callback?sessionId=$sessionId&retries=" . $retries + 1;

    $logger->log('Attempting to get lock.');
    // Use mutex to ensure a callback and a notification are not processed at the same time.
    $lock = createLock($sessionId);
    if ($lock) {
        $logger->log('Got lock. Session state: ' . $windcaveSessionObject['sessionState']);

        // If session is not pending, then notification must have triggered first.
        if ($windcaveSessionObject['sessionState'] == WindcaveSessionState::Pending) {
            setSessionState($windcaveSessionObject, WindcaveSessionState::Processing);

            $logger->log('Querying Session.');
            $response = WindcavePayments::querySession($sessionId, $retries);

            if ($response->result == QuerySessionResult::Succeded) {
                processSuccessSession($orderId, $response, $windcaveSessionObject);
                $approved = $response->transaction['authorised'];
            } else if ($response->result == QuerySessionResult::Failed) {
                setSessionState($windcaveSessionObject, WindcaveSessionState::Declined);
                $logger->log('Redirecting back to cart.');
                removeLock($lock, $sessionId);
                return RedirectUrlEnum::declined;
            } else if ($response->result == QuerySessionResult::Retry) {
                setSessionState($windcaveSessionObject, WindcaveSessionState::Pending);
                sleep(5000);
                $logger->log('Retrying.');
                removeLock($lock, $sessionId);
                return $retryUrlIncrement;
            } else {
                setSessionState($windcaveSessionObject, WindcaveSessionState::Pending);
                clearCart();
                $logger->log('Redirecting to error page.');
                removeLock($lock, $sessionId);
                return RedirectUrlEnum::pending;
            }
        } else {
            if ($windcaveSessionObject['sessionState'] == WindcaveSessionState::Processing) {
                $logger->log('Retrying.');
                removeLock($lock, $sessionId);
                return $retryUrl;
            }
            $approved = $windcaveSessionObject['sessionState'] == WindcaveSessionState::Approved;
        }

        if ($approved) {
            $logger->log('Approved. Redirecting to order confirmation page.');

            removeLock($lock, $sessionId);
            return RedirectUrlEnum::approved;
        } else {
            $logger->log('Declined. Redirecting back to cart.');

            removeLock($lock, $sessionId);
            return RedirectUrlEnum::declined;
        }
    } else {
        $logger->log('Failed to get lock.');
        sleep(5000);
        $logger->log('Retrying');
        return $retryUrl;
    }
}

/**
 * Query Windcave session and update the session in the database.
 * @param string $sessionId
 * @return int HttpStatusCode
 */
function handleSessionNotification(string $sessionId)
{
    $logger = WindcaveLogger::getInstance();
    $mockDb = MockDb::getInstance();

    $windcaveSessionObject = $mockDb->getSession($sessionId);
    $orderId = $windcaveSessionObject['orderId'];
    $result = HttpStatusCode::OK;

    $logger->log("Notification triggered. Session ID: $sessionId. Order ID: $orderId");

    $logger->log('Attempting to get lock.');
    // Use mutex to ensure a callback and a notification are not processed at the same time.
    $lock = createLock($sessionId);
    if ($lock) {
        $logger->log('Got lock. Session state: ' . $windcaveSessionObject['sessionState']);

        // If session is not pending, then callback must have triggered first.
        if ($windcaveSessionObject['sessionState'] == WindcaveSessionState::Pending) {
            setSessionState($windcaveSessionObject, WindcaveSessionState::Processing);

            $logger->log('Querying Session.');
            $response = WindcavePayments::querySession($sessionId, 0);
            if ($response->result == QuerySessionResult::Succeded) {
                processSuccessSession($orderId, $response, $windcaveSessionObject);
            } else if ($response->result == QuerySessionResult::Failed) {
                setSessionState($windcaveSessionObject, WindcaveSessionState::Declined);
            } else if ($response->result == QuerySessionResult::Retry) {
                setSessionState($windcaveSessionObject, WindcaveSessionState::Pending);
                $result = HttpStatusCode::InternalServerError;
            }
        }

        $logger->log("Setting response: ${result}");
        removeLock($lock, $sessionId);
        return $result;
    } else {
        $logger->log('Failed to get lock.');
        sleep(5000);
        $logger->log('Retrying');
        return HttpStatusCode::InternalServerError;
    }
}

/**
 * Query Windcave transaction and update the transaction in the database.
 * @param string $parentTransactionId
 * @param string $transactionId
 * @return int HttpStatusCode
 */
function handleTransactionNotification(string $parentTransactionId, string $transactionId)
{
    $logger =  WindcaveLogger::getInstance();
    $mockDb = MockDb::getInstance();

    $windcaveParentTransactionObject = $mockDb->getTransaction($parentTransactionId);
    $windcaveTransactionObject = $mockDb->getTransaction($transactionId);
    $orderId = $windcaveParentTransactionObject['orderId'];
    $result = HttpStatusCode::OK;

    $logger->log("Notification triggered. Transaction ID: $transactionId. Order ID: $orderId");
    $logger->log('Transaction state: ' . $windcaveTransactionObject['status']);

    if ($windcaveTransactionObject['status'] == WindcaveTransactionStatus::Pending) {
        $logger->log('Querying Transaction.');
        $response =  WindcavePayments::queryTransaction($transactionId);
        if ($response->result == TransactionResult::Succeeded) {
            processSuccessTransaction($orderId, $response, $parentTransactionId);
        } else if ($response->result == TransactionResult::Failed || $response->result == TransactionResult::Pending) {
            $result = HttpStatusCode::InternalServerError;
        }
    }

    $logger->log("Setting response: ${result}.");

    return $result;
}

function respondWithFile(string $path, string $contentType)
{
    $absolutePath = __DIR__ . $path;
    header("Content-Type: $contentType");
    $fh = fopen($absolutePath, 'r');
    fpassthru($fh);
    fclose($fh);
}

function respondWithJson(mixed $object)
{
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($object);
}

/**
 * Add or remove item from cart.
 * @param mixed[] $json
 */
function processPostCart(mixed $json)
{
    $id = $json['id'];

    if ($json['action'] == 'add') {
        if (!empty($_SESSION['memoryStorage']['cartItems'][$id])) {
            $_SESSION['memoryStorage']['cartItems'][$id]++;
        } else {
            $_SESSION['memoryStorage']['cartItems'][$id] = 1;
        }
    } else if ($json['action'] == 'remove') {
        if ($_SESSION['memoryStorage']['cartItems'][$id]) {
            if ($_SESSION['memoryStorage']['cartItems'][$id] == 1) {
                unset($_SESSION['memoryStorage']['cartItems'][$id]);
            } else {
                $_SESSION['memoryStorage']['cartItems'][$id]--;
            }
        }
    }

    $this->respondWithJson([]);
}

/**
 * Delete saved card.
 * @param mixed[] $json
 */
function processPostCards(mixed $json)
{
    $mockDb = MockDb::getInstance();

    $mockDb->deleteCard($json['id']);
    respondWithJson([]);
}

/**
 * Process payment request and create a Windcave session.
 * @param mixed[] $json
 */
function processPostPayment(mixed $json)
{
    
    
    
    $json['customer'] =  array(
                    
                    'firstName' => 'Joe',
                    'lastName' => 'Doe',
                    'email' => 'test@gmail.com',
                    'phoneNumber' => '123'
                    );
                    
    $json['shippingAddress']=array(
            
                    'name' => 'Joee',
                    'address1' => 'loremm',
                    'address2' => 'ppp',
                    'address3' => 'qqq',
                    'city' => 'qqq',
                    'postalCode' => 'qqq',
                    'countryCode' => 'qqq',
                    'phoneNumber' => 'qqq',
                    'state' => 'qqq',
            
            );
            
    $json['payment']= array();
            
            
    $json['billingAddress'] = array(
            
                    'name' => 'Joee',
                    'address1' => 'loremm',
                    'address2' => 'ppp',
                    'address3' => 'qqq',
                    'city' => 'qqq',
                    'postalCode' => 'qqq',
                    'countryCode' => 'qqq',
                    'phoneNumber' => 'qqq',
                    'state' => 'qqq',
            );
            
    
    
    $logger =  WindcaveLogger::getInstance();
    $mockDb = MockDb::getInstance();

    $redirectUrl = '';
    
   // $cartEntries = $_SESSION['memoryStorage']['cartItems'];
   
     $cartEntries = array('1' => 1);

    if (count($cartEntries) != 0) {
       
        //$orderId = $_SESSION['memoryStorage']['orderId'];
        
        $orderId=rand (10,100);
    
        $amount = 100;
        
        /*
        foreach ($cartEntries as $k => $v) {
            $amount += floatval($_SESSION['memoryStorage']['products'][$k]['price']) * $v;
        }
        */
        
        $amount = number_format($amount, 2, '.', '');

        $json['order'] = ['amount' => $amount, 'currency' => 'NZD', 'orderId' => $orderId];
        
        $xId = getXID($orderId, $_SESSION['memoryStorage']['config']['paymentType']);
        
        $payload = getSessionJson($_SESSION['memoryStorage']['config'], $json);
        
        $response = WindcavePayments::createSession($payload, $xId);
        
        
        if ($response->result == CreateSessionResult::Finished) {
            $windcaveSessionObject = $mockDb->getSession($response->sessionId);
            $this->processSuccessSession($orderId, $response, $windcaveSessionObject);
            $redirectUrl = $response->transaction->authorised ? $this->data['duplicate'] : $this->data['denied'];
        } else if ($response->result == CreateSessionResult::Created) {
       
            $windcaveSessionObject = [
                'sessionId' => $response->sessionId,
                'sessionState' => WindcaveSessionState::Pending,
                'orderId' => $orderId,
                'hppUrl' => $response->links['hpp']['url'],
            ];
            $mockDb->saveSession($windcaveSessionObject);
            $logger->log('Redirecting to ' . $windcaveSessionObject['hppUrl']);
            $redirectUrl = $windcaveSessionObject['hppUrl'];
        } else {
            $logger->log('Payment failed.');
            $redirectUrl = $this->data['failed'];
        }
    }

    $this->respondWithJson($redirectUrl);
}

/**
 * Process request from callback page to confirm session outcome.
 * @param mixed[] $json
 */
function processPostCallback(mixed $json)
{
    $response = handleCallback($json['sessionId'], $json['retries']);
    

    $this->respondWithJson($response);
}

/**
 * Process a session or transaction FPRN from Windcave.
 * @param mixed[] $json
 */
function processPostNotification(mixed $json)
{
    $response = HttpStatusCode::InternalServerError;

    if ($json['sessionId']) {
        $response = handleSessionNotification($json['sessionId']);
    } else if ($json['id']) {
        $parentLinkParts = explode('/', extractLink($json, 'parent', 'GET')['href']);
        $parentTransactionId = $parentLinkParts[count($parentLinkParts) - 1];
        $response = handleTransactionNotification($parentTransactionId, $json['id']);
    }

    http_response_code($response);
}

/**
 * Updates the Windcave configuration.
 * @param mixed[] $json
 */
function processPostConfig(array $json)
{
    $url = '';

    switch ($json['environment']) {
        case 'sec':
            $url = ApiUrl::Sec;
            break;

        case 'uat':
            $url = ApiUrl::Uat;
            break;

        case 'dev':
            $url = ApiUrl::Dev;
            break;
    }

    $_SESSION['memoryStorage']['config']['url'] = $url;
    $_SESSION['memoryStorage']['config']['apiUsername'] = $json['apiUsername'];
    $_SESSION['memoryStorage']['config']['apiKey'] = $json['apiKey'];
    $_SESSION['memoryStorage']['config']['environment'] = $json['environment'];
    $_SESSION['memoryStorage']['config']['paymentType'] = $json['paymentType'];
    $_SESSION['memoryStorage']['config']['saveCards'] = $json['saveCards'];
    $_SESSION['memoryStorage']['config']['paymentOptions'] = $json['paymentOptions'];
    respondWithJson([]);
}

/**
 * Process a void, complete, or refund request.
 * @param mixed[] $json
 */
function processPostTransactions(mixed $json)
{
    $logger = WindcaveLogger::getInstance();
    $mockDb = MockDb::getInstance();

    $transactionId = $json['transactionId'];
    $transactionType = $json['transactionType'];
    $amount = $json['amount'];

    $windcaveParentTransactionObject = $mockDb->getTransaction($transactionId);
    $orderId = $windcaveParentTransactionObject['orderId'];
    $result = '';

    $title = ucfirst($transactionType);

    $logger->log($title . ' attempt triggered. Order ID: ' . $orderId);
    $xId = getXID($orderId, $transactionType);
    $payload = getTransactionJson($windcaveParentTransactionObject, $transactionType, $amount);
    $response = WindcavePayments::createTransaction($payload, $xId, 0);

    if ($response->result == TransactionResult::Succeeded) {
        processSuccessTransaction($orderId, $response, $windcaveParentTransactionObject['transactionId']);
        $result = $response->transaction['authorised'] ? 'approved' : 'declined';
    } else if ($response->result == TransactionResult::Failed) {
        $logger->error($title . ' failed: Error occurred during the transaction.');

        $result = 'failed';
    } else {
        $logger->error($title . ' outcome unknown.');

        $result = 'pending';
    }

    $this->respondWithJson(['result' => $result]);
}

/**
 * Finds a transaction, checks if it is void or complete, and calculates the remaining balance.
 */
function processGetTransaction()
{
    $mockDb = MockDb::getInstance();

    $id = $_GET['id'];
    $transaction = $mockDb->getTransaction($id);
    $childTransactions = $mockDb->queryTransactions(['parentTransactionId' => $id, 'status' => WindcaveTransactionStatus::Approved]);

    $transaction['amountRefunded'] = 0;

    foreach ($childTransactions as $childTransaction) {
        if ($childTransaction['transactionType'] === WindcaveTransactionType::Void) {
            $transaction['isVoid'] = true;
        } else if ($childTransaction['transactionType'] === WindcaveTransactionType::Complete) {
            $transaction['isComplete'] = true;
        } else if ($childTransaction['transactionType'] === WindcaveTransactionType::Refund) {
            $transaction['amountRefunded'] += floatval($childTransaction['amount']);
        }
    }

    $transaction['amountRefunded'] = number_format($transaction['amountRefunded'], 2, '.', '');

    $this->respondWithJson($transaction);
}

function processGet()
{
    $mockDb = MockDb::getInstance();

    $url = explode('?', $_SERVER['REQUEST_URI'])[0];
    
    if ($url === '/storefront' || $url === '/admin') {
        respondWithFile("/frontend/html$url$url.html", ContentTypeEnum::html);
    } else if ($url === '/admin/getTransaction') {
        processGetTransaction();
    } else if ($url === '/admin/getTransactions') {
        respondWithJson($mockDb->getTransactions());
    } else if ($url === '/storefront/getCards') {
        respondWithJson($mockDb->getCards());
    } else if (preg_match('/^(\/storefront\/(cart|cards|checkout|callback|result)|\/admin\/transactions)$/', $url)) {
        respondWithFile("/frontend/html$url.html", ContentTypeEnum::html);
    } else if (preg_match('/^(\/storefront\/(products|cartItems)|\/admin\/config)$/', $url)) {
        $id = explode('/', $url)[2];
        respondWithJson($_SESSION['memoryStorage'][$id]);
    } else if (preg_match('/^\/storefront\/product\/[0-9]*$/', $url)) {
        $id = explode('/', $url)[3];
        respondWithJson($_SESSION['memoryStorage']['products'][$id]);
    } else if (preg_match('/^\/css\/[a-z]*.css$/', $url)) {
        respondWithFile("/frontend/$url", ContentTypeEnum::css);
    } else if (preg_match('/^\/images\/[a-z-]*.png$/', $url)) {
        respondWithFile("/frontend/$url", ContentTypeEnum::png);
    } else if (preg_match('/^\/js\/[a-z]*.js$/', $url)) {
        respondWithFile("/frontend/$url", ContentTypeEnum::js);
    } else {
        respondWithFile('/frontend/html/index.html', ContentTypeEnum::html);
    }
}

function processPost()
{
    //$url = $_SERVER['REQUEST_URI'];
    //  $url ='';
    $json = json_decode(file_get_contents('php://input'), true);
    
    $this->processPostPayment($json);
    
    /*
    if ($url === '/storefront/cart') { 
        $this->processPostCart($json);
    } else if ($url === '/storefront/cards') {
        $this->processPostCards($json);
    } else if ($type === 'payment') {
        $this->processPostPayment($json);
    } else if ($url === '/storefront/callback') {
        $this->processPostCallback($json);
    } else if ($url === '/storefront/notification') {
        $this->processPostNotification($json);
    } else if ($url === '/admin/config') {
        $this->processPostConfig($json);
    } else if ($url === '/admin/transactions') {
        $this->processPostTransactions($json);
    } else {
        http_response_code(HttpStatusCode::BadRequest);
    }
    */
    
}




}