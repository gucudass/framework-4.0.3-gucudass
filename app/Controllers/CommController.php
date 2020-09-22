<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class CommController extends BaseController
{
    use ResponseTrait;

    private $aJs = [];
    private $aWriteJs = [];
    private $aExternalJs = [];

    protected function apiRespond($data = null, int $status = null, string $message = '')
    {
        $result = $status == 200 ? true : false;

        $aRespond = [
            'result' => $result,
            'message' => $message,
            'data' => $data
        ];

        return $this->respond($aRespond);
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

    protected function getParams($sType = 'get', $bPage = false)
    {
        if ($sType == 'post') {
            $aParams = $this->request->getPost();
        } else {
            $aParams = $this->request->getGet();
        }

        if ($bPage === true) {
            if (empty($aParams['page']) === true) $aParams['page'] = 1;
            $aParams['limit'] = 20;
            $aParams['offset'] = ($aParams['page'] - 1) * $aParams['limit'];
        }

        return $aParams;
    }

    protected function unAuthorized()
    {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    protected function unAuthorizedAjax($sMessage = null)
    {
        $sExceptMessage = empty($sMessage) === false ? $sMessage : '잘못 된 접속입니다. 다시 시도해 주세요.';

        throw new \Exception($sExceptMessage);
    }
}
