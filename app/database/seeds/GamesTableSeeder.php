<?php

class GamesTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
	  //DB::table('user')->truncate();
    $tz = 'US/Central';

	  $games = [
      [
        "gid"       => "101",
        "matchup"   => "New England Patriots",
        "slug"      => Str::slug("New England Patriots"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 8, 13, 18, 30, 0, $tz),
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "102",
        "matchup"   => "Pittsburgh Steelers",
        "slug"      => Str::slug("Pittsburgh Steelers"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 8, 23, 12, 0, 0, $tz),
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "103",
        "matchup"   => "Philadelphia Eagles",
        "slug"      => Str::slug("Philadelphia Eagles"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 8, 29, 19, 0, 0, $tz),
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "104",
        "matchup"   => "New Orleans Saints",
        "slug"      => Str::slug("New Orleans Saints"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 9, 3, 18, 00, 0, $tz),
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "105",
        "matchup"   => "Chicago Bears",
        "slug"      => Str::slug("Chicago Bears"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 9, 13, 12, 00, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "106",
        "matchup"   => "Seattle Seahawks",
        "slug"      => Str::slug("Seattle Seahawks"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 9, 20, 19, 30, 0, $tz),
        "tv"        => "NBC"
      ],
      [
        "gid"       => "107",
        "matchup"   => "Kansas City Chiefs",
        "slug"      => Str::slug("Kansas City Chiefs"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 9, 28, 19, 30, 0, $tz),
        "tv"        => "ESPN"
      ],
      [
        "gid"       => "108",
        "matchup"   => "San Francisco 49ers",
        "slug"      => Str::slug("San Francisco 49ers"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 10, 4, 15, 25, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "109",
        "matchup"   => "St. Louis Rams",
        "slug"      => Str::slug("St. Louis Rams"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 10, 11, 12, 0, 0, $tz),
        "tv"        => "CBS"
      ],
      [
        "gid"       => "110",
        "matchup"   => "San Diego Chargers",
        "slug"      => Str::slug("San Diego Chargers"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 10, 18, 15, 25, 0, $tz),
        "tv"        => "CBS"
      ],
      [
        "gid"       => "111",
        "matchup"   => "Denver Broncos",
        "slug"      => Str::slug("Denver Broncos"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 11, 1, 19, 30, 0, $tz),
        "tv"        => "NBC"
      ],
      [
        "gid"       => "112",
        "matchup"   => "Carolina Panthers",
        "slug"      => Str::slug("Carolina Panthers"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 11, 8, 12, 0, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "113",
        "matchup"   => "Detroit Lions",
        "slug"      => Str::slug("Detroit Lions"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 11, 15, 12, 0, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "114",
        "matchup"   => "Minnesota Vikings",
        "slug"      => Str::slug("Minnesota Vikings"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 11, 15, 12, 0, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "115",
        "matchup"   => "Chicago Bears",
        "slug"      => Str::slug("Chicago Bears"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 11, 26, 19, 30, 0, $tz),
        "tv"        => "NBC"
      ],
      [
        "gid"       => "116",
        "matchup"   => "Detroit Lions",
        "slug"      => Str::slug("Detroit Lions"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 12, 3, 19, 25, 0, $tz),
        "tv"        => "CBS"
      ],
      [
        "gid"       => "117",
        "matchup"   => "Dallas Cowboys",
        "slug"      => Str::slug("Dallas Cowboys"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2015, 12, 13, 15, 25, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "118",
        "matchup"   => "Oakland Raiders",
        "slug"      => Str::slug("Oakland Raiders"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 12, 20, 15, 5, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "119",
        "matchup"   => "Arizona Cardinals",
        "slug"      => Str::slug("Arizona Cardinals"),
        "location"  => "away",
        "game_time" => \Carbon\Carbon::create(2015, 12, 27, 15, 25, 0, $tz),
        "tv"        => "FOX"
      ],
      [
        "gid"       => "120",
        "matchup"   => "Minnesota Vikings",
        "slug"      => Str::slug("Minnesota Vikings"),
        "location"  => "home",
        "game_time" => \Carbon\Carbon::create(2016, 1, 3, 12, 0, 0, $tz),
        "tv"        => "FOX"
      ],
    ];

    foreach ($games as $game) {
      Game::create($game);
    }
  }
}