<?php

namespace NovaPosta\Application\Validator;

/**
 * Class DateValidator
 * @package NovaPosta\Application\Validator
 */
class DateValidator extends AbstractValidator
{
    /**
     * @var array
     */
    private static $dates = [];

    /**
     * @param string $date
     */
    public function validate($date)
    {
        if (empty($date)) {
            array_push($this->errors, 'Поле не муже бути пустим');
        }

        if (!self::isDayMonthYerOrderValidator($date) && !self::isYearMonthDayOrderValidator($date)) {
            array_push($this->errors, 'Невірний формат дат');
        }

        if (!self::isRightLengthOfString($date)) {
            array_push($this->errors, 'Вказаний інтервал дат хибний');
        }

        if (!self::isCorrectStartAndEndDays($date)) {
            array_push($this->errors, 'Вказані дати не вірні');
        }
    }

    /**
     * @param string $date
     * @return int
     */
    private static function isDayMonthYerOrderValidator($date)
    {
        return preg_match('#^\d{2}\/?\.?\d{2}\/?\.?\d{4}\s?-\s?\d{2}\/?\.?\d{2}\/?\.?\d{4}$#', $date);
    }

    /**
     * @param string $date
     * @return int
     */
    private static function isYearMonthDayOrderValidator($date)
    {
        return preg_match('#^\d{4}\/?\.?\d{2}\/?\.?\d{2}\s?-\s?\d{4}\/?\.?\d{2}\/?\.?\d{2}$#', $date);
    }

    /**
     * @param string $date
     * @return bool
     */
    private static function isRightLengthOfString($date)
    {
        return (strlen($date) != 21 || strlen($date) != 23);
    }

    /**
     * @param string $date
     * @return bool
     */
    public static function isCorrectStartAndEndDays($date)
    {
        $explode = self::explodeDate($date);
        self::setStartAndEndDates($explode);

        return (count(self::$dates) === 2) ? true : false;
    }

    /**
     * If the first element equal 4 then date format should to be YYYY-MM-DD
     * otherwhere the date format should be DD-MM-YYYY
     *
     * @param string $dateItems
     * @return bool
     */
    private static function dateIsCorrect($dateItems)
    {
        $dateChunk = explode('-', $dateItems);

        if (strlen($dateChunk[0]) === 4) {
            $result = checkdate($dateChunk[1], $dateChunk[2], $dateChunk[0]);
        } else {
            $result = checkdate($dateChunk[1], $dateChunk[0], $dateChunk[2]);
        }

        return $result;
    }

    /**
     * Set data into array with 2 indexes of start and end dates
     * The format is YYYY-MM-DD
     *
     * @param array $dates
     */
    private static function setStartAndEndDates(array $dates)
    {
        foreach ($dates as $date) {
            if(preg_match('#\/#', $date) === 1) {
                self::setDates($date, '/');
            } else if (preg_match('#\.#', $date) === 1) {
                self::setDates($date, '.');
            }
        }
    }

    /**
     * @param string $data
     * @param string $search
     * @param string $replace
     */
    private static function setDates($data, $search, $replace = '-')
    {
        $replacer = str_replace($search, $replace, $data);

        if (self::dateIsCorrect($replacer)) {
            self::$dates[] = date('Y-m-d', strtotime($replacer));
        }
    }

    /**
     * Exploding given string to array with start end end dates
     * Array with index[0] it is start date
     * Array with index[1] it is end date
     *
     * @param string $date
     * @return array
     */
    private static function explodeDate($date)
    {
        return explode('-', str_replace(' ', '', $date));
    }

    // GETTERS

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return self::$dates[0];
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return self::$dates[1];
    }
}