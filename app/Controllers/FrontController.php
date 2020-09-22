<?php

use App\Controllers\BaseController;

class FrontController extends BaseController
{
    // 로그인 여부 체크
    protected $bSession = true;

    protected $aSessUser = [];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        if ($this->bSession === true) {
            $this->initSession();
        }
    }

    private function initSession()
    {
        $sUri = $_SERVER['REQUEST_URI'];

        $aUriPass = [
            '/sign/in',
            '/sign/actIn'
        ];

        $this->aSessUser = session()->get();

        if (in_array($sUri, $aUriPass) === false && $this->isAuthSession() === false) {
            $this->setLocation('/sign/in');
        }
    }

    private function isAuthSession()
    {
        if (empty($this->aSessUser['sess_id']) === false) {
            return true;
        } else {
            return false;
        }
    }

    protected function setLocation($sURL)
    {
//        $sURL = '/admin' . $sURL;
        header('Location: ' . $sURL);
        exit;
    }
}
