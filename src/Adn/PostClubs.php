<?php namespace Purplapp\Adn;

class PostClubs
{
    private static $clubs = [
        [
            "url"       => "RollClub",
            "count"     => "500"
        ],
        [
            "url"       => "CrumpetClub",
            "count"     => "1000"
        ],
        [
            "url"       => "NoonClub",
            "count"     => "1200"
        ],
        [
            "url"       => "BitesizeCookieClub",
            "count"     => "2000"
        ],
        [
            "url"       => "CrunchClub",
            "count"     => "2600"
        ],
        [
            "url"       => "MysteryScienceClub",
            "count"     => "3000"
        ],
        [
            "url"       => "LDRClub",
            "count"     => "5000"
        ],
        [
            "url"       => "IBMPCClub",
            "count"     => "8088"
        ],
        [
            "url"       => "CookieClub",
            "count"     => "10000"
        ],
        [
            "url"       => "SpinalTapClub",
            "count"     => "11000"
        ],
        [
            "url"       => "BreakfastClub",
            "count"     => "20000"
        ],
        [
            "url"       => "CaratClub",
            "count"     => "24000"
        ],
        [
            "url"       => "PeshawarClub",
            "count"     => "25000"
        ],
        [
            "url"       => "MileHighClub",
            "count"     => "30000"
        ],
        [
            "url"       => "PiClub",
            "count"     => "31416"
        ],
        [
            "url"       => "TowelClub",
            "count"     => "42000"
        ],
        [
            "url"       => "HitmanClub",
            "count"     => "47000"
        ],
        [
            "url"       => "BaconClub",
            "count"     => "50000"
        ],
        [
            "url"       => "BrowncoatClub",
            "count"     => "57000"
        ],
        [
            "url"       => "CommodoreClub",
            "count"     => "64000"
        ],
        [
            "url"       => "MotorolaClub",
            "count"     => "68000"
        ],
        [
            "url"       => "TromboneClub",
            "count"     => "76000"
        ],
        [
            "url"       => "WiFiClub",
            "count"     => "80211"
        ],
        [
            "url"       => "PajamaClub",
            "count"     => "90000"
        ],
        [
            "url"       => "TowerOfBabbleClub",
            "count"     => "100000"
        ],
        [
            "url"       => "OrbitClub",
            "count"     => "110000"
        ],
        [
            "url"       => "MacClub",
            "count"     => "128000"
        ],
        [
            "url"       => "TwitterLeaverClub",
            "count"     => "140000"
        ],
        [
            "url"       => "GetALifeNoSrslyClub",
            "count"     => "200000"
        ],
        [
            "url"       => "MeaninglessPostCountClub",
            "count"     => "231568"
        ],
        [
            "url"       => "ADNClub",
            "count"     => "256000"
        ],
        [
            "url"       => "PensionersClub",
            "count"     => "401000"
        ],
        [
            "url"       => "LaughterClub",
            "count"     => "555000"
        ],
        [
            "url"       => "GatesClub",
            "count"     => "640000"
        ],
        [
            "url"       => "JoyLuckClub",
            "count"     => "888000"
        ],
        [
            "url"       => "MillionairesClub",
            "count"     => "1000000"
        ],
    ];

    private $isInitialized = false;

    private $achievedClubs = [];

    private $unachievedClubs = [];

    private $user;

    public static function forUser(User $user)
    {
        return new static($user);
    }

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function memberClubs()
    {
        if (!$this->isInitialized) {
            $this->init($this->user);
        }

        return $this->achievedClubs;
    }

    public function nextClubs()
    {
        if (!$this->isInitialized) {
            $this->init($this->user);
        }

        return $this->unachievedClubs;
    }

    private function init(User $user)
    {
        $count = $user->counts->posts;

        foreach ($this->getPossibleClubs() as $club) {
            if ($count >= $club["count"]) {
                $this->achievedClubs[] = PostClub::wrap($club);
            } else {
                $this->unachievedClubs[] = PostClub::wrap($club);
            }
        }

        $this->isInitialized = true;
    }

    private function getPossibleClubs()
    {
        $clubs = static::$clubs;

        // whatever logic charl is using
        $clubs[] = [
            "url"   => "OrphanBlackClub",
            "count" => $this->user->id,
        ];


        return $clubs;
    }
}
