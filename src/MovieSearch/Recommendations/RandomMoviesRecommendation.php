<?php
declare(strict_types=1);

namespace MovieSearch\Recommendations;

use MovieSearch\Helper\ShuffleService;

class RandomMoviesRecommendation implements MoviesRecommendation
{

    /**
     * @param ShuffleService $shuffleService
     * @param int $numberOfRecommendations
     */
    public function __construct(
        private ShuffleService $shuffleService,
        private readonly int $numberOfRecommendations = 3
    ) {}


    /**
     * @param array $movies
     * @return array
     */
    public function recommend(array $movies): array
    {
        $movies = $this->shuffleService->shuffle($movies);
        return array_slice($movies, 0, $this->numberOfRecommendations);
    }
}