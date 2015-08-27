<?php

use \Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class BarImportSeeder extends Seeder
{

    public function run()
    {
        $this->createEmailReferenceTable();
        $this->createBadBarsTable();

        $barJson = json_decode(file_get_contents('app/database/seeds/import/bar_import.json'), TRUE);

        foreach($barJson['results'] as $bar) {
            if(isset($bar['name']) && isset($bar['zipcode']) && !empty($bar['name']) && !empty($bar['zipcode'])) {
                $extData = $this->getExtDataForBar(addslashes($bar['name']), addslashes($bar['zipcode']));
                if ($extData) {
                        $bar['email'] = $extData[0]->email;
                        $bar['description'] = $extData[0]->description;
                        $this->addBar($bar);
                }
                else{
                    $this->addToBadBars($bar['zipcode'], $bar['name'], $bar['city'],$bar['objectId']);
                }
            }
            else{
                $this->addToBadBars($bar['zipcode'], $bar['name'], $bar['city'],$bar['objectId']);
            }
        }
        Schema::dropIfExists("bad_bars");
        Schema::dropIfExists("tmp_emails");
    }

    public function addToBadBars($zipcode=null, $name=null, $city=null,$object_id=null) {
        \DB::insert("insert into bad_bars (barname, zipcode, city, object_id) values (?, ?, ?, ?)", array($name, $zipcode, $city, $object_id));
    }

    public function getExtDataForBar($name, $zip) {
        $bar = DB::select(DB::raw('
            #SELECT email, description FROM tmp_emails WHERE barname="'.$name.'" AND zip="'.$zip.'";
            SELECT email, description FROM tmp_emails WHERE barname="'.$name.'";
        '));

        return $bar ? $bar : false;
    }

    public function createBadBarsTable() {
        Schema::dropIfExists("bad_bars");
        Schema::create("bad_bars", function (Blueprint $table)
        {
            $table->string("barname")->nullable();
            $table->string("zipcode")->nullable();
            $table->string("city")->nullable();
            $table->string("object_id")->nullable();
        });
    }

    public function createEmailReferenceTable() {
        Schema::dropIfExists("tmp_emails");
        //create a db table
        Schema::create("tmp_emails", function (Blueprint $table)
        {
            $table->string("email");
            $table->string("city");
            $table->string("barname");
            $table->string("zip");
            $table->text('description');
        });

        $rows = array_map('str_getcsv', file('app/database/seeds/import/emaildata.csv'));
        $cols = array_shift($rows);
        foreach($rows as $row) {
            if(isset($row[1]) && isset($row[6]) && isset($row[4]) && isset($row[2])) {
                $desc = isset($row[9]) ? $row[9] : " ";
                \DB::insert("insert into tmp_emails (email, city, barname, zip, description) values (?, ?, ?, ?, ?)", array($row[1], $row[6], $row[4], $row[2], $desc));
            }
            else{
            }
        }
    }

    public function addBar($bar) {
        $newBar = new Bar();

        //create a new user for each email!
        try{
            $user = User::where('username', '=', $bar['email'])->firstOrFail();
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $user = User::create([
                "username" => $bar['email'],
                "password" => Hash::make("test"),
                "email"    => $bar['email'],
                "admin"    => 0,
                "imported" => 1
            ]);

        }

        $newBar->uid = $user->id;
        $newBar->status = 1;
        $newBar->barname = $bar['name'];
        $newBar->slug = $bar['key_name'];
        $newBar->address = $bar['address'];
        $newBar->city = $bar['city'];
        $newBar->state = $bar['state'];
        $newBar->timezone = $bar['timezone'];
        $newBar->dst_offset = $bar['dstOffset'];
        $newBar->gmt_offset = $bar['gmtOffset'];
        $newBar->phone = $bar['telephone'];
        $newBar->website = $bar['website'];
        $newBar->owner_email = $bar['email'];
        $newBar->description = $bar['description'];
        $newBar->zipcode = $bar['zipcode'];
        $newBar->latitude = $bar['geo']['latitude'];
        $newBar->longitude = $bar['geo']['longitude'];

        $newBar->save();
    }

}