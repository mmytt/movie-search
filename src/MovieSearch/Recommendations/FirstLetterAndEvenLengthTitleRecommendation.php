<?php
declare(strict_types=1);

namespace MovieSearch\Recommendations;

class FirstLetterAndEvenLengthTitleRecommendation implements MoviesRecommendation
{

    /**
     * @param string $firstLetter
     */
    public function __construct(
        private readonly string $firstLetter
    ) {}

    /**
     * @param array $movies
     * @return array
     */
    public function recommend(array $movies): array
    {
        $filteredMovies = array_filter($movies, function ($movie) {
           return $this->isEventLength($movie) && $this->isStartWithLetter($movie, $this->firstLetter);
        });

        return array_values($filteredMovies);
    }

    /**
     * @param string $name
     * @return bool
     */
    private function isEventLength(string $name): bool
    {
        return strlen($name) % 2 === 0;
    }

    /**
     * @param string $firstLetter
     * @return bool
     */
    private function isStartWithLetter(string $name, string $firstLetter): bool
    {
        return stripos($name, $firstLetter) === 0;
    }
}