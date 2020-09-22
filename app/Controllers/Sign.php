<?php namespace App\Controllers;

class Sign extends CommController
{
    public function in()
    {
        return view('sign_in');
    }

    /**
     * 로그인 처리
     * @return mixed
     */
    public function actIn()
    {
        $aParams = $this->request->getPost();

        $aRespond = [
            'params' => $aParams
        ];

        $aSessionData = [];
        if ($aParams['user_id'] == 'admin' && $aParams['user_password'] == '1234') {
            $aSessionData = [
                'sess_id' => 'admin'
            ];

            $status = 200;
            $message = '성공';
        } else {
            $status = 400;
            $message = '등록되지 않은 아이디이거나, 비밀번호를 잘못 입력하셨습니다.';
        }

        $session = \Config\Services::session();
        $session->set($aSessionData);

        return $this->apiRespond($aRespond, $status, $message);
    }

    /**
     * 로그아웃
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function out()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
