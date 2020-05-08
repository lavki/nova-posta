<?php

namespace NovaPosta\Application\Repository;

/**
 * Class DB_Model
 * @package NovaPosta\Application\Repository
 */
class DB_Model
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * DB_Model constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (!file_exists(DB_CONFIG )) {
            throw new \Exception('Configuration file does not exists');
        } else if (!is_readable(DB_CONFIG )) {
            throw new \Exception('Configuration file is not readable');
        } else {
            $file = file_get_contents(DB_CONFIG );
            $params = json_decode($file);

            if (!isset($params->param->dsn) || !isset($params->param->user) || !isset($params->param->password)) {
                throw new \Exception('Wrong params on configuration file');
            }

            try {
                $pdo = new \PDO($params->param->dsn, $params->param->user, $params->param->password);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->db = $pdo;
            } catch (\PDOException $e) {
                echo 'Error connection: ' . $e->getMessage();
            }
        }
    }
}