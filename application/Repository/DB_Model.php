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
        $file_config = DB_CONFIG . "/config/enviroment.json";

        if (!file_exists($file_config )) {
            throw new \Exception('Configuration file does not exists');
        } else if (!is_readable($file_config )) {
            throw new \Exception('Configuration file is not readable');
        } else {
            $file = file_get_contents($file_config );
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