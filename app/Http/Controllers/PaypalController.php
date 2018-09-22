<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\Habitat;

use PayPal\Api\Amount; 
use PayPal\Api\Details; 
use PayPal\Api\Item; 
use PayPal\Api\ItemList; 
use PayPal\Api\Payer; 
use PayPal\Api\Payment; 
use PayPal\Api\PaymentExecution; 
use PayPal\Api\RedirectUrls; 
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaypalController extends Controller
{
    private $api_context;

    public function __construct() {
    	$paypal_conf = \Config::get('paypal');

    	$this->api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );

        $this->api_context->setConfig($paypal_conf['settings']);
    }


    public function payWithpaypal(Request $request, Habitat $habitat)
    {
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');

		$item_1 = new Item();

		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('montant')); /** unit price **/

		$item_list = new ItemList();
        $item_list->setItems(array($item_1));

		$montant = new Amount();
        $montant->setCurrency('USD')
            ->setTotal($request->get('montant'));

		$transaction = new Transaction();
        $transaction->setAmount($montant)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status', $habitat)) /** Specify return URL **/
            ->setCancelUrl(URL::route('status', $habitat));

		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        
        try {
			$payment->create($this->api_context);

		} catch (\PayPal\Exception\PPConnectionException $ex) {

			if (\Config::get('app.debug')) {
				\Session::put('error', 'Connection timeout');
			    return Redirect::route('habitat.show', $habitat->id);

			} else {
				\Session::put('error', 'Some error occur, sorry for inconvenient');
				return Redirect::route('habitat.show', $habitat->id);
			}
		}

		foreach ($payment->getLinks() as $link) {

			if ($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

		if (isset($redirect_url)) {
			/** redirect to paypal **/
			return Redirect::away($redirect_url);

		}

		\Session::put('error', 'Unknown error occurred');
        return Redirect::route('habitat.show', $habitat->id);
	}


	public function getPaymentStatus($habitat)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

		/** clear the session payment ID **/
		Session::forget('paypal_payment_id');

		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

			\Session::put('error', 'Payment failed');
		    return Redirect::route('habitat.show', $habitat);
		}

		$payment = Payment::get($payment_id, $this->api_context);
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));

		/**Execute the payment **/
		$result = $payment->execute($execution, $this->api_context);

		if ($result->getState() == 'approved') {

			\Session::put('success', 'Payment success');
			return Redirect::route('habitat.show', $habitat)->with(['ok' => __("Paiement réussi")]);
		}

		\Session::put('error', 'Payment failed');
		return Redirect::route('habitat.show', $habitat)->with(['ok' => __("Paiement refusé")]);

	}
}
