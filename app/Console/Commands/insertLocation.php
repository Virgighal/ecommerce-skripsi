<?php

namespace App\Console\Commands;

use App\Models\Location;
use Illuminate\Console\Command;

class insertLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert_location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    	$fileContents = file_get_contents('resources/csvs/lokasi_cod.csv');
        $fileContents = str_replace("\r", "", $fileContents);
        $rows = explode("\n", $fileContents);

        foreach($rows as $index => $row) {
        	if($index == 0) {
        		continue;
        	}

            $columns = str_getcsv($row, ';');
            try {
                $name = trim($columns[0]);
                $latitude = trim($columns[1]);
                $longitude = trim($columns[2]);
            } catch (\Exception $e) {
                $this->error($e->getMessage()." -- ".$row);
                continue;
            }

            $location = Location::where('name', $name)->first();
            if(empty($location)) {
                $location = new Location;
                $location->name = $name;
            }
            $location->latitude = $latitude;
            $location->longitude = $longitude;
            $location->save();

            $this->info('import location >> '.$location->name);
        }
    }
}
