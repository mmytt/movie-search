<?php
declare(strict_types=1);

namespace Tests\Units\MovieSearch\RecommendationSelector;

use MovieSearch\Recommendations\FirstLetterAndEvenLengthTitleRecommendation;
use MovieSearch\Recommendations\MoviesRecommendation;
use MovieSearch\Recommendations\NumberOfWordsTitleRecommendation;
use MovieSearch\Recommendations\RandomMoviesRecommendation;
use MovieSearch\RecommendationSelector\RecommendationSelectorStrategy;
use MovieSearch\RecommendationSelector\RecommendationType;
use PHPUnit\Framework\TestCase;

class RecommendationSelectorStrategyTest extends TestCase
{
    private RecommendationSelectorStrategy $recommendationSelectorStrategyUnderTest;

    protected function setUp(): void
    {
        $this->recommendationSelectorStrategyUnderTest = new RecommendationSelectorStrategy();
    }

    /**
     * @return array[]
     */
    public static function recommendationsProvider(): array
    {
        return [
            'Return RandomMoviesRecommendation Object When RANDOM_THREE_MOVIES Is Given' => [
                RecommendationType::RANDOM_THREE_MOVIES,
                RandomMoviesRecommendation::class
            ],
            'Return NumberOfWordsTitleRecommendation Object When TWO_WORDS_TITLE Is Given' => [
                RecommendationType::MINIMUM_TWO_WORDS_TITLE,
                NumberOfWordsTitleRecommendation::class
            ],
            'Return FirstLetterAndEvenLengthTitleRecommendation Object When FIRST_W_LETTER_AND_EVEN_LENGTH_TITLE Is Given' => [
                RecommendationType::FIRST_W_LETTER_AND_EVEN_LENGTH_TITLE,
                FirstLetterAndEvenLengthTitleRecommendation::class
            ]
        ];
    }

    /**
     *
     * @dataProvider recommendationsProvider
     *
     * @param RecommendationType $recommendationType
     * @param string $expected
     */
    public function testShouldReturnAppropriateRecommendationObjectWhenTypePassed(RecommendationType $recommendationType, string $expected)
    {
        // When
        $actual = $this->recommendationSelectorStrategyUnderTest->createRecommendationStrategy($recommendationType);

        // Then
        $this->assertInstanceOf($expected, $actual);
        $this->assertInstanceOf(MoviesRecommendation::class, $actual);
    }
}