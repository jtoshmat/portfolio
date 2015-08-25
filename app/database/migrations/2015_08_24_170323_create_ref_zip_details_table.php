<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefZipDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_zip_details', function(Blueprint $table)
		{
			$table->integer('ref_zip_details_id')->primary();
			$table->string('city', 28);
			$table->char('state_cd', 2);
			$table->string('state_name', 32);
			$table->string('zip', 5)->index();
			$table->string('zpre', 3)->index();
			$table->char('area_code', 3);
			$table->string('county_fips', 5)->index();
			$table->string('county_name', 25)->index();
			$table->char('is_preferred', 1)->default('P');
			$table->string('time_zone', 5);
			$table->char('has_dst', 1);
			$table->float('latitude', 7,4)->default(0.0000);
			$table->float('longitude', 7,4)->default(0.0000);
			$table->string('msa', 4);
			$table->string('pmsa', 4);
			$table->string('city_abbreviation', 13);
			$table->char('market_area', 3);
			$table->char('zip_type', 1);
			$table->string('cong_dist', 8)->nullable()->index();
			$table->string('cong_dist_text', 6)->nullable()->index();
			$table->integer('cd_split')->nullable()->default(0);
			$table->decimal('cd_percent', 8,2)->nullable()->default(0.00);
		});

		DB::unprepared('ALTER TABLE ref_zip_details ADD COLUMN latlong POINT NOT NULL');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ref_zip_details');
	}

}