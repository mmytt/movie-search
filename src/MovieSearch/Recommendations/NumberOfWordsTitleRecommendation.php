<?php
declare(strict_types=1);

namespace MovieSearch\Recommendations;

class NumberOfWordsTitleRecommendation implements MoviesRecommendation
{
    /**
     * @param int $minimumNumberOfWords
     */
    public function __construct(
        private readonly int $minimumNumberOfWords = 2
    ) {}

    /**
     * @param array $movies
     * @return array
     */
    public function recommend(array $movies): array
    {
        $filteredMovies = array_filter($movies, function ($movie) {
            return $this->isMetMinimumWordNumbers($movie, $this->minimumNumberOfWords);
        });
        return array_values($filteredMovies);
    }

    /**
     * @param string $name
     * @param int $numberOfWords
     * @return bool
     */
    private function isMetMinimumWordNumbers(string $name, int $numberOfWords): bool
    {
        $nameWords = explode(" ", $name);
        return count($nameWords) >= $numberOfWords;
    }
}