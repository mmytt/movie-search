<?php

namespace MovieSearch\RecommendationSelector;

use MovieSearch\Recommendations\FirstLetterAndEvenLengthTitleRecommendation;
use MovieSearch\Recommendations\MoviesRecommendation;
use MovieSearch\Recommendations\NumberOfWordsTitleRecommendation;
use MovieSearch\Recommendations\RandomMoviesRecommendation;
use MovieSearch\Helper\ShuffleService;

class RecommendationSelectorStrategy
{
    /**
     * @var int
     */
    const NUMBER_OF_MOVIES = 3;

    /**
     * @var string
     */
    const FIRST_LETTER = 'W';

    /**
     * @var int
     */
    const MINIMUM_NUMBER_OF_WORDS = 2;

    /**
     * @param RecommendationType $type
     * @return MoviesRecommendation
     */
    public function createRecommendationStrategy(RecommendationType $type): MoviesRecommendation
    {
        return match ($type) {
            RecommendationType::RANDOM_THREE_MOVIES => $this->getRandomMoviesRecommendation(),
            RecommendationType::FIRST_W_LETTER_AND_EVEN_LENGTH_TITLE => new FirstLetterAndEvenLengthTitleRecommendation(self::FIRST_LETTER),
            RecommendationType::MINIMUM_TWO_WORDS_TITLE => new NumberOfWordsTitleRecommendation(self::MINIMUM_NUMBER_OF_WORDS),
        };
    }

    /**
     * @return RandomMoviesRecommendation
     */
    private function getRandomMoviesRecommendation(): RandomMoviesRecommendation
    {
        $shuffleService = new ShuffleService();
        return new RandomMoviesRecommendation($shuffleService, self::NUMBER_OF_MOVIES);
    }
}
