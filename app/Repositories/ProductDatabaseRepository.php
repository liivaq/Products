<?php declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use App\Exceptions\ProductAlreadyExistsException;
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

    public function all(): array
    {
        $products = $this->queryBuilder
            ->select('*')
            ->from('products')
            ->fetchAllAssociative();

        $productCollection = [];

        if ($products) {
            foreach ($products as $product) {
                $productCollection[] = $this->buildModel($product['type'], $product);
            }
        }

        return $productCollection;
    }

    public function save(Product $product): void
    {
        $this->authenticate($product->getSku());

        $values = [];

        foreach ($product->getAllAttributes() as $key => $attribute) {
            if ($attribute) {
                $values[$key] = ':' . $key;
            }
        }

        $query = $this->queryBuilder
            ->insert('products')
            ->values($values);

        foreach ($product->getAllAttributes() as $key => $attribute) {
            $query->setParameter($key, $attribute ?? null);
        }

        $query->executeStatement();
    }

    public function delete(array $products): void
    {
        foreach ($products as $sku) {
            $this->queryBuilder
                ->delete('products')
                ->where('sku = :sku')
                ->setParameter('sku', $sku)
                ->executeStatement();
        }
    }

    public function authenticate(string $sku): void
    {
        $product = $this->queryBuilder
            ->select('*')
            ->from('products')
            ->where('sku = :sku')
            ->setParameter('sku', $sku)
            ->executeStatement();

        if ($product > 0) {
            throw new ProductAlreadyExistsException('Product with sku '. $sku .'already exists');
        }
    }

    private function buildModel(string $type, array $attributes)
    {
        $product = 'App\Models\\' . $type;
        return new $product($attributes, $type);
    }
}