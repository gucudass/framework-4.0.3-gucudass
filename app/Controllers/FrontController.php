<?php

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class FrontController extends BaseController
{
    use ResponseTrait;

    protected $bSession = true;
    protected $aSessUser = [];

    private $aJs = [];
    private $aWriteJs = [];
    private $aExternalJs = [];

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

    protected function js($sJs)
    {
        if (empty($sJs) === false) {
            array_push($this->aJs, $sJs);
        }
    }

    protected function writeJs($sJs)
    {
        if (empty($sJs) === false) {
            array_push($this->aWriteJs, $sJs);
        }
    }

    protected function externalJs($sJs)
    {
        if (empty($sJs) === false) {
            array_push($this->aExternalJs, $sJs);
        }
    }

    /**
     * view 대체
     * @param string $name
     * @param array $data
     */
    protected function display(string $name, array $data = [])
    {
        $aAssignJs = [
            'aJs' => $this->aJs,
            'aWriteJs' => $this->aWriteJs,
            'aExternalJs' => $this->aExternalJs
        ];

        $aAssignCustom = [
        ];

        echo view('template/header', $aAssignCustom);
        echo view($name, $data);
        echo view('template/footer', $aAssignJs);
    }

    /**
     * ajax respond
     *
     * @param null $data
     * @param int|null $status
     * @param string $message
     * @return mixed
     */
    protected function ajaxRespond($data = null, int $status = 200, string $message = '')
    {
        $result = $status == 200 ? true : false;

        $aRespond = [
            'result' => $result,
            'message' => $message,
            'data' => $data
        ];

        return $this->respond($aRespond);
    }

    protected function unAuthorized()
    {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    protected function unAuthorizedAjax($errorCode = 400)
    {
        $sExceptMessage = '잘못 된 요청 입니다. 잠시 후에 다시 시도해 주세요.';
        if ($errorCode == 401) {
            $sExceptMessage = '일시적으로 에러가 발생했습니다. 잠시 후에 다시 시도해 주세요.';
        }

        throw new \Exception($sExceptMessage);
    }
}
