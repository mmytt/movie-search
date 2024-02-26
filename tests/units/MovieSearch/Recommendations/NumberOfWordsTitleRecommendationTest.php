<?php
declare(strict_types=1);

namespace Tests\Units\MovieSearch\Recommendations;

use MovieSearch\Recommendations\NumberOfWordsTitleRecommendation;
use PHPUnit\Framework\TestCase;

class NumberOfWordsTitleRecommendationTest extends TestCase
{
    /**
     * @var array|string[]
     */
    private array $movies;

    protected function setUp(): void
    {
        $this->movies = [
            "Władca Pierścieni: Powrót króla",
            "Fight Club",
            "Pianista",
            "Doktor Strange",
            "Whiplash",
            "Wyspa tajemnic",
            "Django"
        ];
    }
    
    public function testShouldReturnMoviesWithTitleMinimumTwoWords() {
        // Given
        $numberOfWordsTitleRecommendationUnderTest = new NumberOfWordsTitleRecommendation(2);

        $expected = [
            "Władca Pierścieni: Powrót króla",
            "Fight Club",
            "Doktor Strange",
            "Wyspa tajemnic",
        ];

        // When
        $actual = $numberOfWordsTitleRecommendationUnderTest->recommend($this->movies);

        // Then
        $this->assertCount(4, $actual);
        $this->assertSame($expected, $actual);
    }

    public function testShouldReturnEmptyArrayWhenAllMoviesHasOneWord() {
        // Given
        $numberOfWordsTitleRecommendationUnderTest = new NumberOfWordsTitleRecommendation(2);

        $movies = [
            "Pianista",
            "Whiplash",
            "Django"
        ];

        // When
        $actual = $numberOfWordsTitleRecommendationUnderTest->recommend($movies);

        // Then
        $this->assertCount(0, $actual);
        $this->assertSame([], $actual);
    }
}