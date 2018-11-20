<?php
/**
 * Created by PhpStorm.
 * User: mash2
 * Date: 20.11.18
 * Time: 09:09
 */

class Cobby_CustomProductType_Model_Observer extends Mage_Core_Model_Abstract
{
    const VIRTUAL = 'virtual';
    const SIMPLE = 'simple';

    public function importBefore($observer)
    {
        $data = $observer->getTransport()->getData();
        $rows = $data['rows'];
        $typeModels = $data['typeModels'];
        $usedSkus = $data['usedSkus'];


    }

    public function exportAfter($observer)
    {
        $data = $observer->getTransport()->getData();
        $rows = $data['rows'];
        $result = array();

        foreach ($rows as $productId => $productData) {
            if ($productData['_type'] == self::VIRTUAL) {
                $productData['_type'] = self::SIMPLE;
            }

            $result[$productId] = $productData;
        }

        $observer->getTransport()->setRows($result);

        return $this;
    }
}