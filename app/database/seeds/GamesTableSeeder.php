<?php

class GamesTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
	  //DB::table('user')->truncate();

	  $games = [
      [
        "gid"       => "101",
        "title"     => "New England Patriots",
        "matchup"   => "AT New England",
        "location"  => "Away",
        "game_time" => "08/13/2015 6:30PM Central Time",
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "102",
        "title"     => "Pittsburgh Steelers",
        "matchup"   => "AT Pittsburgh",
        "location"  => "Away",
        "game_time" => "08/23/2015 12:00PM Central Time",
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "103",
        "title"     => "Philadelphia Eagles",
        "matchup"   => "VS Philadelphia",
        "location"  => "Home",
        "game_time" => "08/23/2015 7:00PM Central Time",
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "104",
        "title"     => "New Orleans Saints",
        "matchup"   => "VS New Orleans",
        "location"  => "Home",
        "game_time" => "09/03/2015 6:00PM Central Time",
        "tv"        => "Packers TV Network"
      ],
      [
        "gid"       => "105",
        "title"     => "Chicago Bears",
        "matchup"   => "AT Chicago",
        "location"  => "Away",
        "game_time" => "09/13/2015 12:00PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "106",
        "title"     => "Seattle Seahawks",
        "matchup"   => "VS Seattle",
        "location"  => "Home",
        "game_time" => "09/20/2015 7:30PM Central Time",
        "tv"        => "NBC"
      ],
      [
        "gid"       => "107",
        "title"     => "Kansas City Chiefs",
        "matchup"   => "VS Kansas",
        "location"  => "Home",
        "game_time" => "09/28/2015 7:30PM Central Time",
        "tv"        => "ESPN"
      ],
      [
        "gid"       => "108",
        "title"     => "San Francisco 49ers",
        "matchup"   => "AT San Francisco",
        "location"  => "Away",
        "game_time" => "10/04/2015 3:25PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "109",
        "title"     => "St. Louis Rams",
        "matchup"   => "VS St. Louis",
        "location"  => "Home",
        "game_time" => "10/11/2015 12:00PM Central Time",
        "tv"        => "CBS"
      ],
      [
        "gid"       => "110",
        "title"     => "San Diego Chargers",
        "matchup"   => "VS San Diego",
        "location"  => "Home",
        "game_time" => "10/18/2015 3:25PM Central Time",
        "tv"        => "CBS"
      ],
      [
        "gid"       => "111",
        "title"     => "Denver Broncos",
        "matchup"   => "AT Denver Broncos",
        "location"  => "Away",
        "game_time" => "11/01/2015 7:30PM Central Time",
        "tv"        => "NBC"
      ],
      [
        "gid"       => "112",
        "title"     => "Carolina Panthers",
        "matchup"   => "AT Carolina Panthers",
        "location"  => "Away",
        "game_time" => "11/08/2015 12:00PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "113",
        "title"     => "Detroit Lions",
        "matchup"   => "VS Detroit Lions",
        "location"  => "Home",
        "game_time" => "11/15/2015 12:00PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "114",
        "title"     => "Minnesota Vikings",
        "matchup"   => "AT Minnesota Vikings",
        "location"  => "Away",
        "game_time" => "11/15/2015 12:00PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "115",
        "title"     => "Chicago Bears",
        "matchup"   => "VS Chicago Bears",
        "location"  => "Home",
        "game_time" => "11/26/2015 7:30PM Central Time",
        "tv"        => "NBC"
      ],
      [
        "gid"       => "116",
        "title"     => "Detroit Lions",
        "matchup"   => "AT Detroit Lions",
        "location"  => "Away",
        "game_time" => "12/03/2015 7:25PM Central Time",
        "tv"        => "CBS"
      ],
      [
        "gid"       => "117",
        "title"     => "Dallas Cowboys",
        "matchup"   => "VS Dallas Cowboys",
        "location"  => "Home",
        "game_time" => "12/13/2015 3:25PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "118",
        "title"     => "Oakland Raiders",
        "matchup"   => "AT Oakland Raiders",
        "location"  => "Away",
        "game_time" => "12/20/2015 3:05PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "119",
        "title"     => "Arizona Cardinals",
        "matchup"   => "AT Arizona Cardinals",
        "location"  => "Away",
        "game_time" => "12/27/2015 3:25PM Central Time",
        "tv"        => "FOX"
      ],
      [
        "gid"       => "120",
        "title"     => "Minnesota Vikings",
        "matchup"   => "VS Minnesota Vikings",
        "location"  => "Home",
        "game_time" => "01/03/2016 12:00PM Central Time",
        "tv"        => "FOX"
      ],
    ];

    foreach ($games as $game) {
      Game::create($game);
    }
  }
}