<?php

declare(strict_types=1);

namespace PrestaShop\Module\WnBlocks\Repository;

use Doctrine\DBAL\Connection;

class ProductRepository
{
    /**
     * @var Connection the Database connection.
     */
    private $connection;

    /**
     * @var string the Database prefix.
     */
    private $databasePrefix;

    public function __construct(Connection $connection, $databasePrefix)
    {
        $this->connection = $connection;
        $this->databasePrefix = $databasePrefix;
    }

    /**
     * @param int $categoryID is category ID from  configuration
     * @return array the list of products
     */
    public function findProductByCategoryId(int $categoryID)
    {
        $prefix = $this->databasePrefix;

        $query = "SELECT * FROM ${prefix}product_lang p LEFT JOIN ps_category_product c ON p.id_product = c.id_product LEFT JOIN ${prefix}product pp ON p.id_product = pp.id_product WHERE c.id_category = :categoryID ORDER BY c.position ASC LIMIT 10";
        $statement = $this->connection->prepare($query);
        $statement->bindValue("categoryID", $categoryID);
        $statement->execute();

        return $statement->fetchAll();
    }
}
