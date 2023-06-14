<?php declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use App\Exceptions\ProductAlreadyExistsException;
use App\Models\Book;
use App\Models\Dvd;
use App\Models\Furniture;
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
        $productCollection = [];

        $products = $this->queryBuilder
            ->select('p.*', 'b.*', 'd.*', 'f.*')
            ->from('products', 'p')
            ->leftJoin('p', 'books', 'b', 'p.sku = b.products_sku')
            ->leftJoin('p', 'dvds', 'd', 'p.sku = d.products_sku')
            ->leftJoin('p', 'furniture', 'f', 'p.sku = f.products_sku')
            ->orderBy('id', 'ASC')
            ->fetchAllAssociative();

        if ($products) {
            foreach ($products as $product) {
                $productCollection[] = $this->buildModel($product['type'], $product);
            }
        }

        return $productCollection;
    }

    public function save(Product $product)
    {
        $this->authenticate($product->getSku());

        $this->queryBuilder
            ->insert('products')
            ->values([
                'sku' => ':sku',
                'name' => ':name',
                'price' => ':price',
                'type' => ':type',
            ])
            ->setParameter('sku', $product->getSku())
            ->setParameter('name', $product->getName())
            ->setParameter('price', $product->getPrice())
            ->setParameter('type', $product->getType())
            ->executeStatement();


        $productMap = [
            'Book' => 'saveBook',
            'Dvd' => 'saveDvd',
            'Furniture' => 'saveFurniture'
        ];

        $this->{$productMap[$product->getType()]}($product);

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
            throw new ProductAlreadyExistsException('Product with sku ' . $sku . 'already exists');
        }
    }

    private function buildModel(string $type, array $attributes)
    {
        $product = 'App\Models\\' . $type;
        return new $product($attributes, $type);
    }

    private function saveBook(Book $book)
    {
        $this->queryBuilder
            ->insert('books')
            ->values([
                'products_sku' => ':sku',
                'weight' => ':weight'
            ])
            ->setParameter('sku', $book->getSKU())
            ->setParameter('weight', $book->getWeight())
            ->executeStatement();
    }

    private function saveDvd(Dvd $dvd)
    {
        $this->queryBuilder
            ->insert('dvds')
            ->values([
                'products_sku' => ':sku',
                'size' => ':size'
            ])
            ->setParameter('sku', $dvd->getSKU())
            ->setParameter('size', $dvd->getSize())
            ->executeStatement();
    }

    private function saveFurniture(Furniture $furniture)
    {
        $this->queryBuilder
            ->insert('furniture')
            ->values([
                'products_sku' => ':sku',
                'height' => ':height',
                'width' => ':width',
                'length' => ':length',
            ])
            ->setParameter('sku', $furniture->getSKU())
            ->setParameter('height', $furniture->getHeight())
            ->setParameter('width', $furniture->getWidth())
            ->setParameter('length', $furniture->getLength())
            ->executeStatement();
    }
}