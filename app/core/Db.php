<?php


namespace app\core;


use PDO;

class Db
{
    private $config;
    private $dbh;

    public function __construct()
    {
        $this->getConfig();
        $this->dbh = new PDO(
            'mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['dbname'],
            $this->config['user'],
            $this->config['password']
        );
    }

    public function query(string $sql, $params = []): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    public function execute(string $sql, $params = []): bool
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }

    private function getConfig(): void
    {
        $this->config = require dirname(__DIR__) . '/config/db.php';
    }
}