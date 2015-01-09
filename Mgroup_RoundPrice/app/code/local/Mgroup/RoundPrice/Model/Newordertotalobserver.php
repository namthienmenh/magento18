<?php
class Mgroup_RoundPrice_Model_Newordertotalobserver
{
	 public function saveRoundpriceTotal(Varien_Event_Observer $observer)
    {
         $order = $observer -> getEvent() -> getOrder();
         $quote = $observer -> getEvent() -> getQuote();
         $shippingAddress = $quote -> getShippingAddress();
         if($shippingAddress && $shippingAddress -> getData('roundprice_total')){
             $order -> setData('roundprice_total', $shippingAddress -> getData('roundprice_total'));
             }
        else{
             $billingAddress = $quote -> getBillingAddress();
             $order -> setData('roundprice_total', $billingAddress -> getData('roundprice_total'));
             }
         $order -> save();
     }
    
     public function saveRoundpriceTotalForMultishipping(Varien_Event_Observer $observer)
    {
         $order = $observer -> getEvent() -> getOrder();
         $address = $observer -> getEvent() -> getAddress();
         $order -> setData('roundprice_total', $shippingAddress -> getData('roundprice_total'));
		 $order -> save();
     }
}