<?php

namespace Laravel\Cpanel\Http\Controllers;

use Cpanel\Client;
use Cpanel\Exception\CpanelErrorException;
use Cpanel\Request\Uapi\Ftp;

class FtpController extends Controller
{
    protected $cpanelApiClient;
    protected $ftpClient;

    public function __construct()
    {
        try {
            $this->cpanelApiClient = new Client(config("cpanel.domain"));
            $this->cpanelApiClient->authenticateByUsernamePassword(config("cpanel.username"), config("cpanel.password"));

            $this->ftpClient = new Ftp($this->cpanelApiClient);
        } catch (CpanelErrorException $ex) {
            abort(500, $ex->getMessage());
        }
    }

    public function index()
    {
        try {
            $ftpList = $this->ftpClient->getFtpAccounts();

            return view('cpanel::ftp.index', [
                'ftpList' => $ftpList['data'],
            ]);
        } catch (CpanelErrorException $ex) {
            abort(500, $ex->getMessage());
        }
    }

    public function store()
    {
    }
}
