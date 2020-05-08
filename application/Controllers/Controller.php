<?php

namespace NovaPosta\Application\Controllers;

use NovaPosta\Application\Entity\Date;
use NovaPosta\Application\Validator\DateValidator;
use NovaPosta\Application\Repository\LogRepository;

/**
 * Class Controller
 * @package NovaPosta\Application\Controllers
 */
class Controller
{
    /**
     * @var DateValidator
     */
    private $validator;

    /**
     * @var LogRepository
     */
    private $logRepository;

    /**
     * Controller constructor.
     * @param DateValidator $validator
     * @param LogRepository $logRepository
     */
    public function __construct(DateValidator $validator, LogRepository $logRepository)
    {
        $this->validator = $validator;
        $this->logRepository = $logRepository;
    }

    public function index()
    {
        $data = [];

        if ($this->isPost()) {
            $this->validator->validate($_POST['dateInterval']);

            if ($this->validator->isValid()) {
                $date = new Date($this->validator->getStartDate(), $this->validator->getEndDate());

                $insertId = $this->logRepository->store($date);

                $data['result'] = $this->logRepository->getDateDiffById($insertId);
            } else {
                $data['errors'] = $this->validator->getErrors();
            }
        }

        view($data);
    }

    /**
     * @return bool
     */
    private function isPost()
    {
        return ($_SERVER['REQUEST_METHOD'] === 'POST');
    }
}