<?php
class Mgroup_RoundPrice_Model_Order_Creditmemo_Total_Roundprice 
extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {

		return $this;

        $order = $creditmemo->getOrder();
        $orderRoundpriceTotal        = $order->getRoundpriceTotal();

        if ($orderRoundpriceTotal) {
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal()+$orderRoundpriceTotal);
			$creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal()+$orderRoundpriceTotal);
        }

        return $this;
    }
}