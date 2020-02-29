<?php 

declare(strict_types=1);

namespace App;

use App\Database;

class Storage extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function all(SQLQueryBuilder $queryBuilder): array {

        $query = $queryBuilder
            ->select('public.images', ['image, url'])
            ->getSQL();

        $stmt = $this->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetchAll();

        $stmt->closeCursor();
    
        return $result ?? [];

    }

    public function save(array $credentials, string $filename, SQLQueryBuilder $queryBuilder): void {

        $title = "'" . $credentials['title'] . "'";
        $slug = str_replace(' ', '-', $title);
        $description = "'" . $credentials['description'] . "'";

        $file = "'" . $filename ."'" ;

        $query = $queryBuilder
            ->insert('public.images', ['title', 'description', 'url', 'image'], [$title, $description, $slug, $file])
            ->getSQL();
        
        $stmt = $this->prepare($query);
        $stmt->execute();

        $stmt->closeCursor();

    }

    public function show(SQLQueryBuilder $queryBuilder, string $slug): array {
        
        $query = $queryBuilder
            ->select('public.images', ['*'])
            ->where('url', $slug, '=')
            ->limit(1, 0)
            ->getSQL();
        
        $stmt = $this->prepare($query);
        $stmt->execute();
            
        $result = $stmt->fetchAll();
    
        $stmt->closeCursor();
        
        return $result ?? [];

    }

    public function delete(SQLQueryBuilder $queryBuilder, string $id): void {

        $file_query = $queryBuilder
            ->delete('public.images', [])
            ->where('id', $id, '=')
            ->getSQL();

        $file_stmt = $this->prepare($file_query);
        $file_stmt->execute();
                    

        $file_stmt->closeCursor();
        
    }

    public function getId(SQLQueryBuilder $queryBuilder, string $id): string {

        $query = $queryBuilder
            ->select('public.images', ['image'])
            ->where('id', $id, '=')
            ->limit(1, 0)
            ->getSQL();

        $stmt = $this->prepare($query);
        $stmt->execute();
                    
        $file = $stmt->fetch(\PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        return $file['image'];

    }

}