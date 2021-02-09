<?php


namespace App\DataFixtures\Providers;


class TrickProvider
{
    /**
     * Contains all figures sorted by categories
     *
     * @var array[]
     */
    private const TRICKS_BY_CATEGORIES = [
        'Straight air'         => [
            'Ollie',
            'Nollie',
            'Switch ollie',
            'Fakie ollie',
            'Shifty',
            'Air-to-fakie',
            'Poptart',
        ],
        'Grab'                 => [
            'One-Two',
            'A B',
            'Beef Carpaccio',
            'Beef Curtains',
            'Bloody Dracula',
            'Canadian Bacon',
            'Cannonball/UFO',
            'Chicken salad',
            'China air',
            'Crail',
            'Cross-rocket',
            'Drunk Driver',
            'Frontside grab/indy',
            'Gorilla',
            'Japan air',
            'Lien air',
            'Korean bacon',
            'Melon',
            'Watermelon',
            'Mindly, super',
            'Mule kick',
            'Mute',
            'Nose Grab',
            'Nuclear',
            'Pickpocket',
            'Perfect',
            'Roast beef',
            'Rocket Air',
            'Rusty Trombone',
            'Seatbelt',
            'Slob',
            'Stiffy',
            'Stalefish',
            'Squirrel',
            'Swiss cheese air',
            'Tailfish',
            'Tail Grab',
            'Taipan air',
            'Tindy',
            'Truck driver',
        ],
        'Spin'                 => [
            '180 degree',
            '270 degree',
            '360 degree',
            '540 degree',
            '720 degree',
        ],
        'Flip'                 => [
            'Back flip',
            'Front flip',
            'Wildcat',
            'Tamedog',
            'Cork',
            'Lando-Roll',
            'Backside Misty',
            'Frontside Misty',
            'Chicane',
            'Underflip',
            'Frontside Rodeo',
            'Backside Rodeo flip',
            'Ninety Roll',
            'Rippey flip',
            'Crippler',
            'McTwist',
            'Haakon flip',
            'Michalchuk',
            'Sato flip',
        ],
        'Slide'                => [
            '50-50',
            'Boardslide',
            'Lipslide',
            'Bluntslide',
            'Noseblunt',
            'Nodeslide',
            'Tailslide',
            'Nosepress',
            'Tailpress',
            'MJ',
            'HJ',
            'Zeach',
            'The Gutterball',
        ],
        'Inverted hand plants' => [
            'Invert',
            'Handplant',
            'Sad plant',
            'Elguerial',
            'Eggplant',
            'Eggflip',
            'McEgg',
            'Andrecht',
            'Miller flip',
            'Layback',
            'HoHo',
            'Killer Stand',
            'Fresh',
            'J-Tear',
        ],
        'Stalls'               => [
            'Nose-pick',
            'Board-stall',
            'Nose-stall',
            'Tail-stall',
            'Blunt-stall',
            'Tail-block',
            'Nose-block'
        ],
    ];

    /**
     * @return array[]
     */
    public static function getTricksSortedByCategories(): array
    {
        return static::TRICKS_BY_CATEGORIES;
    }
}
