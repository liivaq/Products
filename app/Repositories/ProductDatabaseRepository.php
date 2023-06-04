<?php declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use App\Models\Product;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class ProductDatabaseRepository
{
    private QueryBuilder $queryBuilder;
    private Connection $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function all()
    {
        $products = $this->queryBuilder
            ->select('*')
            ->from('products')
            ->fetchAllAssociative();

        $productCollection = [];

        if ($products) {
            foreach ($products as $product) {
                $productCollection[] = $this->buildModel($product);
            }
        }

        return $productCollection;
    }

    public function save(Product $product)
    {
        $values = [];
        foreach ($product->allAttributes() as $key => $attribute) {
            if($attribute){
                $values[$key] = ':'.$key;
            }
        }

        $query = $this->queryBuilder
            ->insert('products')
            ->values($values
            );

        foreach ($product->allAttributes() as $key => $attribute) {
            $query->setParameter($key, $attribute ?? null);
        }
        $query->executeStatement();
    }

    private function buildModel(array $attributes)
    {
        $product = 'App\Models\\' . ucfirst($attributes['type']);
        return new $product($attributes);
    }
}