<?php
class Mgroup_RoundPrice_Model_Order_Invoice_Total_Roundprice
extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
		$order=$invoice->getOrder();
        $orderRoundpriceTotal = $order->getRoundpriceTotal();
        if ($orderRoundpriceTotal&&count($order->getInvoiceCollection())==0) {
            $invoice->setGrandTotal($invoice->getGrandTotal()+$orderRoundpriceTotal);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal()+$orderRoundpriceTotal);
        }
        return $this;
    }
}