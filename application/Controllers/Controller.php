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
     * @var LogRepository
     */
    private $logRepository;

    /**
     * Controller constructor.
     * @param LogRepository $logRepository
     */
    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function index()
    {
        $data = [];

        if ($this->isAjax()) {
            echo json_encode($this->dateService($_GET['dateInterval']));
            return;
        }

        if ($this->isPost()) {
            $data = $this->dateService($_POST['dateInterval']);
        }

        view($data);
    }

    /**
     * Work with date from client side
     * @param string $userData
     * @return string
     */
    private function dateService($userData)
    {
        $validator = new DateValidator();
        $validator->validate($userData);

        if ($validator->isValid()) {
            $date = new Date($validator->getStartDate(), $validator->getEndDate());

            $insertId = $this->logRepository->store($date);

            $data['result'] = $this->logRepository->getDateDiffById($insertId);
        } else {
            $data['errors'] = $validator->getErrors();
        }

        return $data;
    }

    /**
     * @return bool
     */
    private function isPost()
    {
        return ($_SERVER['REQUEST_METHOD'] === 'POST');
    }

    /**
     * @return bool
     */
    private function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }
}