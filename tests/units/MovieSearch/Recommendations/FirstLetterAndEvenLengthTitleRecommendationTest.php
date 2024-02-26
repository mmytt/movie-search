<?php
declare(strict_types=1);

namespace Tests\Units\MovieSearch\Recommendations;

use MovieSearch\Recommendations\FirstLetterAndEvenLengthTitleRecommendation;
use PHPUnit\Framework\TestCase;

class FirstLetterAndEvenLengthTitleRecommendationTest extends TestCase
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

    public function testShouldReturnMoviesWithFirstWLetterAndEvenLengthTitle() {
        // Given
        $firstLetterAndEvenLengthTitleRecommendationUnderTest = new FirstLetterAndEvenLengthTitleRecommendation("W");

        $expected = [
            "Whiplash",
            "Wyspa tajemnic"
        ];

        // When
        $actual = $firstLetterAndEvenLengthTitleRecommendationUnderTest->recommend($this->movies);

        // Then
        $this->assertCount(2, $actual);
        $this->assertSame($expected, $actual);
    }

    public function testShouldReturnEmptyArrayWhenNoMoviesWithFirstWLetter() {
        // Given
        $movies = [
            "Fight Club",
            "Pianista",
            "Doktor Strange",
            "Django"
        ];
        $firstLetterAndEvenLengthTitleRecommendationUnderTest = new FirstLetterAndEvenLengthTitleRecommendation("W");

        // When
        $actual = $firstLetterAndEvenLengthTitleRecommendationUnderTest->recommend($movies);

        // Then
        $this->assertCount(0, $actual);
        $this->assertSame([], $actual);
    }

    public function testShouldReturnEmptyArrayWhenNoMoviesWithEvenLength() {
        // Given
        $movies = [
            "Władca Pierścieni: Powrót króla",
            "Wielki Gatsby",
        ];
        $firstLetterAndEvenLengthTitleRecommendationUnderTest = new FirstLetterAndEvenLengthTitleRecommendation("W");

        // When
        $actual = $firstLetterAndEvenLengthTitleRecommendationUnderTest->recommend($movies);

        // Then
        $this->assertCount(0, $actual);
        $this->assertSame([], $actual);
    }

}