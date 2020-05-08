<?php

namespace NovaPosta\Application\Entity;

/**
 * Class Date
 * @package NovaPosta\Application\Entity
 */
class Date
{
    /**
     * @var string
     */
    private $startDate;

    /**
     * @var string
     */
    private $endDate;

    /**
     * Date constructor.
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return mixed
     */
    public function getResultBetweenTwoDays()
    {
        return self::getDateDiff($this->startDate, $this->endDate);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @return string
     */
    private static function getDateDiff($startDate, $endDate)
    {
        $first    = new \DateTime($startDate);
        $secont   = new \DateTime($endDate);
        $interval = $first->diff($secont);

        return $interval->format('%a');
    }
}