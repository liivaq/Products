<?php declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use Doctrine\DBAL\Connection;

class ProductDatabaseRepository
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }




}