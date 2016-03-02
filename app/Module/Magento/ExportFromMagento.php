<?php
/**
 * Export data from magento database trainee in the products table
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Magento;

use Cgi\Connection;
use Cgi\Models\Products;

class ExportFromMagento
{
    private $_conn = null;

    /**
     * @return \PDO
     */
    protected function getConnection()
    {
        if (null === $this->_conn) {
            try {
                $this->_conn = Connection::getInstance()->getConnection();
                $this->_conn->setAttribute(
                    \PDO::ATTR_ERRMODE,
                    \PDO::ERRMODE_EXCEPTION
                );
            } catch (\PDOException $e) {
                $e->getMessage();
            }
        }
        return $this->_conn;
    }


    /**
     * @param $data
     */
    public function setData($data)
    {
        $i = 1;
        foreach ($data as $key => $item) {
            $product = new Products();
            $productData = [];
            if (!empty($product->findByAttribute(['sku' => $item['sku']]))) {
                $productData[] = "name = '" . $item['name'] . "'";
                $productData[] = "sku = '" . $item['sku'] . "'";
                $productData[] = "status = " . $item['is_saleable'];
                $productData[] = "description = '" . $item['description'] . "'";
                $productData[] = "price = " . $item['final_price_without_tax'];
                $productData[] = "image = '" . $item['image_url'] . "'";
                $productData[] = "last_updated = '" . date('Y-m-d H:i:s') . "'";

                $sql = 'UPDATE ' . $product->getTableName()
                    . ' SET ' . implode(', ', $productData)
                    . " WHERE sku = '" . $item['sku'] . "'";
                $this->getConnection()->prepare($sql)->execute();
            } else {
                $productData['name'] = $item['name'];
                $productData['sku'] = $item['sku'];
                $productData['status'] = $item['is_saleable'];
                $productData['description'] = $item['description'];
                $productData['price'] = $item['final_price_without_tax'];
                $productData['last_updated'] = date('Y-m-d H:i:s');
                $productData['date_create'] = date('Y-m-d H:i:s');
                $productData['image'] = $item['image_url'];

                $sql = 'INSERT INTO ' . $product->getTableName()
                    . ' (' . implode(', ', $product->_field) . ') '
                    . " VALUES ('" . implode("', '", $productData) . "')";
                $this->getConnection()->prepare($sql)->execute();
            }
            $i++;
        }
    }
}