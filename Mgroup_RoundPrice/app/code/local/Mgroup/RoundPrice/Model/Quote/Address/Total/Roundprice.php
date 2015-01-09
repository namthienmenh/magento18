<?php

class Mgroup_RoundPrice_Model_Quote_Address_Total_Roundprice
    extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function __construct()
    {
        $this->setCode('roundprice_total');
    }

    /**
     * Collect totals information about roundprice
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Mage_Sales_Model_Quote_Address_Total_Shipping
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent:: collect($address);
        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }
        $quote = $address->getQuote();
        //amount definition
        $totals = $address->getTotals();
        $grandTotals = 0;
        foreach ($totals as $total) {
            $grandTotals += $total->getValue();
        }
        $roundprice = $this->roundprices($grandTotals);
        $roundpriceAmount = $roundprice-$grandTotals;

        //amount definition

        $roundpriceAmount = $quote->getStore()->roundPrice($roundpriceAmount);
        $this->_setAmount($roundpriceAmount)->_setBaseAmount($roundpriceAmount);
        $address->setData('roundprice_total', $roundpriceAmount);
        return $this;
    }

    /**
     * Add roundprice totals information to address object
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Mage_Sales_Model_Quote_Address_Total_Shipping
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        parent:: fetch($address);
        $amount = $address->getTotalAmount($this->getCode());
//        if ($amount != 0) {
//            $address->addTotal(array(
//                'code' => $this->getCode(),
//                'title' => $this->getLabel(),
//                'value' => $amount
//            ));
//        }

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return Mage:: helper('roundprice')->__('RoundPrice');
    }
    public function roundprices($price) {
        $acc = 0.05;
        $e = 0.0000001;
        $r = floor(($price+$acc-$e)/$acc)*$acc;
        return $r;
    }
}