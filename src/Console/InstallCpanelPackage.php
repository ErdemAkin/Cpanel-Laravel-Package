<?php

namespace Laravel\Cpanel\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCpanelPackage extends Command
{
    /**
     * Signature
     *
     * @var string
     */
    protected $signature = 'cpanelpackage:install';

    /**
     * Description
     *
     * @var string
     */
    protected $description = 'Install the Cpanel Laravel Package';

    /**
     * Handle
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Installing Cpanel Laravel Package');

        $this->info('Publishing Cpanel Laravel Package configuration');

        if (!$this->configExists('cpanel.php')) {
            $this->publishConfiguration();
            $this->info('Published Cpanel Laravel Package configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting Cpanel Laravel Package configuration File...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing Cpanel Laravel Package configuration was not overwritten');
            }
        }

        $this->info('Installed Cpanel Laravel Package');
    }

    /**
     * Check Config Exists
     *
     * @param string $fileName
     * @return void
     */
    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    /**
     * Should Overwrite Config
     *
     * @return boolean
     */
    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    /**
     * Publish Configuration
     *
     * @param boolean $forcePublish
     * @return void
     */
    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Laravel\Cpanel\CpanelServiceProvider",
            '--tag'      => "config",
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
