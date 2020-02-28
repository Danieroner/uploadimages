<?php 

declare(strict_types=1);

namespace App;

use App\Database;

class Storage {

    protected object $dbh;

    public function __construct() {
        $this->dbh = new Database();
    }

    public function show(SQLQueryBuilder $queryBuilder) {
        $query = $queryBuilder
            ->select('public.images', ['image'])
            ->getSQL();

        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetchAll();

        $stmt->closeCursor();
    
        return $result;
    }

    public function save(array $credentials, string $filename, SQLQueryBuilder $queryBuilder): void {

        $title = "'" . $credentials['title'] . "'";
        $slug = str_replace(' ', '-', $title);
        $description = "'" . $credentials['description'] . "'";

        $file = "'" . $filename ."'" ;

        $query = $queryBuilder
            ->insert('public.images', ['title', 'description', 'url', 'image'], [$title, $description, $slug, $file])
            ->getSQL();
        
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        $stmt->closeCursor();

    }

}