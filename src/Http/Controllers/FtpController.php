<?php

namespace Laravel\Cpanel\Http\Controllers;

use Cpanel\Client;
use Cpanel\Request\Uapi\Ftp;

class FtpController extends Controller
{
    protected $cpanelApiClient;
    protected $ftpClient;

    public function __construct(){
        $this->cpanelApiClient = new Client(config("cpanel.domain"));
        $this->cpanelApiClient->authenticateByUsernamePassword(config("cpanel.username"), config("cpanel.password"));

        $this->ftpClient = new Ftp($this->cpanelApiClient);
    }
    public function index()
    {
        return view('cpanel::ftp.index', [
            'ftpList' => $this->ftpClient->getFtpAccounts()
        ]);
    }

    public function store()
    {
    }
}
