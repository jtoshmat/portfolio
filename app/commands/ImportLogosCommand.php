<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportLogosCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'import:logos';

    protected $baseUrl = 'https://packerseverywhere.appspot.com/api/venues/';

    protected $addedCount = 0;

    protected $skippedCount = 0;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial import of Bar Logos';

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
    public function fire()
    {
        $bars = Bar::all();
        $i = 1;
        foreach($bars as $bar) {
            $this->info('Checking ' . $i . ' of ' . $bars->count());
            $logo = $this->getLogo($bar->slug);
            if($logo && !empty($logo)) {
                $this->info('importing logo');
                $this->addLogoToBar($bar, $logo);
                $this->addedCount++;
            }
            else {
                $this->error('no logo');
                $this->skippedCount++;
            }
            $i++;
        }

        $this->info('Finished! Added ' . $this->addedCount . ', Skipped ' . $this->skippedCount);
    }

    private function getLogo($slug) {
        try {
            $data = file_get_contents($this->baseUrl . $slug);
            $json = json_decode($data, true);
            return isset($json['location']['logo']) ? $json['location']['logo'] : false;
        }
        catch(ErrorException $e) {
            $this->error($e->getMessage());
            return false;
        }
    }

    private function addLogoToBar($bar, $url) {
        $Upload = new Upload();
        $Upload->addUploadedImage($url, $bar->id, $bar->uid);
        return true;
    }
}
