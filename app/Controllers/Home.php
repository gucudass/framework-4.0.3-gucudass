<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	//--------------------------------------------------------------------


    public function index_bak()
    {
//        return redirect()->to('/admin/comp');
        return view('main');
    }
}
