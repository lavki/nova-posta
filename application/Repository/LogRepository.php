<?php

namespace NovaPosta\Application\Repository;

use NovaPosta\Application\Entity\Date;

/**
 * Class LogRepository
 * @package NovaPosta\Application\Repository
 */
class LogRepository extends DB_Model
{
    /**
     * Table name in database
     */
    const TABLE_NAME = 'logs';

    /**
     * @param Date $date
     * @return string
     * @throws \Exception
     */
    public function store(Date $date)
    {
        $sql  = "INSERT INTO " . self::TABLE_NAME . " (date_start, date_end, date_diff, ip_address, time_execution) ";
        $sql .= "VALUES (:date_start, :date_end, :date_diff, :ip_address, :time_execution)";
        $stmt = $this->db->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);

        try {
            $this->db->beginTransaction();

            $stmt->execute([
                ':date_start'     => $date->getStartDate(),
                ':date_end'       => $date->getEndDate(),
                ':date_diff'      => $date->getResultBetweenTwoDays(),
                ':ip_address'     => ip2long($_SERVER['REMOTE_ADDR']),
                ':time_execution' => time() - isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : 0,
            ]);

            $result = $this->db->lastInsertId();

            $this->db->commit();
        } catch(\PDOException $exception) {
            $this->db->rollBack();

            throw new \Exception($exception->getMessage());
        }

        return $result;
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function getDateDiffById($id)
    {
        $sql = "SELECT date_diff FROM " . self::TABLE_NAME . " WHERE id = :id";
        $stmt = $this->db->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return empty($row) ? null : $row['date_diff'];
    }
}