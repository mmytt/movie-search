<?php
declare(strict_types=1);

namespace MovieSearch;

use MovieSearch\RecommendationSelector\RecommendationSelectorStrategy;
use MovieSearch\RecommendationSelector\RecommendationType;

class MoviesRecommendationActionService
{
    /**
     * @param array $movies
     */
    private readonly array $movies;


    public function __construct(array $movies)
    {
        $this->movies = $this->removeDuplicates($movies);
    }

    /**
     * @param string $selectionType
     * @return array
     */
    public function suggestMovies(string $selectionType): array
    {
        $selectionType = RecommendationType::from($selectionType);
        $recommendationSelectorStrategy = new RecommendationSelectorStrategy();
        $recommendation = $recommendationSelectorStrategy->createRecommendationStrategy($selectionType);
        return $recommendation->recommend($this->movies);
    }

    /**
     * @param array $movies
     * @return array
     */
    private function removeDuplicates(array $movies): array
    {
        return array_unique($movies);
    }
}