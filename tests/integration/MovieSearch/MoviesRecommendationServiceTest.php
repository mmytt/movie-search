<?php
declare(strict_types=1);

namespace Tests\Integration\MovieSearch;

use MovieSearch\MoviesRecommendationActionService;
use MovieSearch\RecommendationSelector\RecommendationType;
use PHPUnit\Framework\TestCase;

class MoviesRecommendationServiceTest extends TestCase
{
    /**
     * @var array
     */
    private array $movies;

    protected function setUp(): void
    {
        $this->movies = [
            "Lot nad kukułczym gniazdem",
            "Pożegnanie z Afryką",
            "Szczęki",
            "Whiplash",
            "Dzień świra",
            "Labirynt",
            "Władca Pierścieni: Dwie wieże"
        ];
    }

    /**
     * @return array[]
     */
    public static function suggestedMoviesProvider(): array
    {
        return [
            'Return Random Movies When RANDOM_THREE_MOVIES Value Is Given' => [
                RecommendationType::RANDOM_THREE_MOVIES->value,
                3
            ],
            'Return Movies With Minimum Two Words In Title When TWO_WORDS_TITLE Value Is Given' => [
                RecommendationType::MINIMUM_TWO_WORDS_TITLE->value,
                4
            ],
            'Return Movies With First W Letter And Length Title is Even When FIRST_W_LETTER_AND_EVEN_LENGTH_TITLE Value Is Given' => [
                RecommendationType::FIRST_W_LETTER_AND_EVEN_LENGTH_TITLE->value,
                2
            ]
        ];
    }

    public function testShouldReturnEmptyArrayWhenMoviesArrayIsEmpty() {
        // Given
        $movies = [];
        $moviesRecommendationServiceUnderTest = new MoviesRecommendationActionService($movies);

        // When
        $actual = $moviesRecommendationServiceUnderTest->suggestMovies("minimum_two_words_title");

        // Then
        $this->assertIsArray($actual);
        $this->assertEquals([], $actual);
        $this->assertCount(0, $actual);
    }

    public function testShouldThrowValueErrorExceptionWhenSelectionRecommendationTypeIsUndefined() {
        // Expect
        $this->expectException(\ValueError::class);

        // Given
        $movies = [];
        $moviesRecommendationServiceUnderTest = new MoviesRecommendationActionService($movies);

        // When
        $moviesRecommendationServiceUnderTest->suggestMovies("undefinded_type");
    }

    public function testShouldReturnMovieInArrayWhenTitleHasMinimumTwoWords() {
        // Given
        $movies = [
            "Pianista",
            "Doktor Strange",
        ];
        $moviesRecommendationServiceUnderTest = new MoviesRecommendationActionService($movies);

        // When
        $actual = $moviesRecommendationServiceUnderTest->suggestMovies("minimum_two_words_title");

        // Then
        $this->assertIsArray($actual);
        $this->assertEquals(["Doktor Strange"], $actual);
        $this->assertCount(1, $actual);
    }


    public function testShouldReturnUniqueMoviesWhenMovieTitlesAreRepeated() {
        // Given
        $movies = [
            "Pianista",
            "Pianista",
            "Doktor Strange",
            "Doktor Strange",
            "Doktor Strange",
        ];
        $moviesRecommendationServiceUnderTest = new MoviesRecommendationActionService($movies);

        // When
        $actual = $moviesRecommendationServiceUnderTest->suggestMovies("minimum_two_words_title");

        // Then
        $this->assertIsArray($actual);
        $this->assertEquals(["Doktor Strange"], $actual);
        $this->assertCount(1, $actual);
    }

    /**
     *
     * @dataProvider suggestedMoviesProvider
     *
     * @param string $recommendationTypeValue
     * @param int $numberExpected
     */
    public function testShouldReturnSuggestMoviesCorrectRecommendationsForDifferentTypes(string $recommendationTypeValue, int $numberExpected) {
        // Given
        $moviesRecommendationServiceUnderTest = new MoviesRecommendationActionService($this->movies);

        // When
        $actual = $moviesRecommendationServiceUnderTest->suggestMovies($recommendationTypeValue);

        // Then
        $this->assertIsArray($actual);
        $this->assertCount($numberExpected, $actual);
    }

}