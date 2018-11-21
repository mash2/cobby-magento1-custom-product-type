<?php

use Mash2_Cobby_Model_Import_Entity_Product as Product;

class Cobby_CustomProductType_Model_Observer extends Mage_Core_Model_Abstract
{
    public function importBefore($observer)
    {
        $data = $observer->getTransport()->getData();
        $result = array();
        $entityIds = array();
        $existingProducts = array();
        $newProducts = array();

        $rows = $data['rows'];
        $typeModels = $data['type_models'];
        $usedSkus = $data['used_skus'];

        foreach ($rows as $row) {
            if (isset($row[Product::COL_ENTITY_ID])) {
                $entityIds[] = $row[Product::COL_ENTITY_ID];
                $existingProducts[] = $row;
            } else {
                $newProducts[] = $row;
            }
        }

        if ($existingProducts) {
            $collection = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToFilter('entity_id', array('in' => $entityIds));

            $productData = array();

            foreach ($collection as $item) {
                $productData[$item['entity_id']]['type_id'] = $item['type_id'];
            }

            foreach ($existingProducts as $index => $existingProduct) {
                //this switches the import product type with the value from the backend
                $productType = $productData[$existingProduct['_id']]['type_id'];
                $existingProduct['_type'] = $productType;
                $result['rows'][] = $existingProduct;

                if (!in_array($productType, $typeModels)) {
                    $typeModels[] = $productType;
                }
            }
        }

        if ($newProducts) {
            foreach ($newProducts as $index => $newProduct) {
                //here you can define, which product type should be set depending for example on the sku prefix
                //you can also use any other attribute and dependency
                if (strpos($newProduct['sku'], 'foo') !== false) {
                    $newProduct['_type'] = 'virtual';
                }

                if (!in_array('virtual', $typeModels)) {
                    $typeModels[] = 'virtual';
                }

                $result['rows'][] = $newProduct;
            }

        }

        $result['used_skus'] = $usedSkus;
        $result['type_models'] = $typeModels;

        $observer->getTransport()->setData($result);

        return $this;
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