<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomPackagesDiscover extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $moduleFolder = 'modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $manifestPackages = $this->laravel->getCachedPackagesPath();
        //base_path() . '/bootstrap/cache/packages.php';
        $modulesPath = base_path() . DIRECTORY_SEPARATOR . $this->moduleFolder;

        $discoverPackages = array();
        $currentDir = opendir($modulesPath);
        while (($filename = readdir($currentDir)) !== false) {
            $subDir = $modulesPath . DIRECTORY_SEPARATOR . $filename;
            if ($filename == '.' || $filename == '..') {
                continue;
            } else if (is_dir($subDir)) {
                $composerFile = $subDir . DIRECTORY_SEPARATOR . 'composer.json';
                $composer = json_decode(file_get_contents($composerFile), true);
                if (isset($composer['extra']['laravel'])) {
                    $this->line("<info>Custom Discovered Package:</info> {$composer['name']}");
                    $discoverPackages[$composer['name']] = $composer['extra']['laravel'];
                }
            }
        }

        $manifest = include "{$manifestPackages}";
        $manifest = array_merge($manifest, $discoverPackages);
        file_put_contents($manifestPackages, '<?php return ' . var_export($manifest, true) . ';');
    }
}
