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
     * Contains snowboard tricks videos
     *
     * @var string[]
     */
    private const TRICK_VIDEOS = [
        'https://www.youtube.com/embed/SFYYzy0UF-8',
        'https://www.youtube.com/embed/V9xuy-rVj9w',
        'https://www.youtube.com/embed/dSZ7_TXcEdM',
        'https://www.youtube.com/embed/L4bIunv8fHM',
    ];

    /**
     * Contains name of snowboard trick pictures
     *
     * @var string[]
     */
    private const TRICK_IMAGES = [
        'figure-16b.jpg',
        'figure-36r.jpg',
        'figure-42j.jpg',
        'figure-81p.jpg',
    ];

    /**
     * @return array[]
     */
    public static function getTricksSortedByCategories(): array
    {
        return static::TRICKS_BY_CATEGORIES;
    }

    /**
     * @return string[]
     */
    public static function getTrickVideos(): array
    {
        return static::TRICK_VIDEOS;
    }

    /**
     * @return string[]
     */
    public static function getTrickImages(): array
    {
        return static::TRICK_IMAGES;
    }
}
