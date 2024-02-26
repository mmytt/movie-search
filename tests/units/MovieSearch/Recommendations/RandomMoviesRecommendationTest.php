<?php
declare(strict_types=1);

namespace Tests\Units\MovieSearch\Recommendations;

use MovieSearch\Helper\ShuffleService;
use MovieSearch\Recommendations\RandomMoviesRecommendation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RandomMoviesRecommendationTest extends TestCase
{
    /** @var MockObject | ShuffleService */
    private MockObject|ShuffleService $shuffleServiceMock;

    /**
     * @var RandomMoviesRecommendation
     */
    private RandomMoviesRecommendation $randomMoviesRecommendationUnderTest;

    protected function setUp(): void
    {
        $this->shuffleServiceMock = $this->createMock(ShuffleService::class);
        $this->randomMoviesRecommendationUnderTest = new RandomMoviesRecommendation($this->shuffleServiceMock,3);
    }

    public function testShouldReturnThreeRandomMovies() {
        // Given
        $movies = [
            "Milczenie owiec",
            "Dzień świra",
            "Blade Runner",
            "Labirynt"
        ];
        $expected = array_slice(array_reverse($movies), 0, 3);

        $this->shuffleServiceMock->expects($this->once())
            ->method('shuffle')
            ->willReturn(array_reverse($movies));

        // When
        $actual = $this->randomMoviesRecommendationUnderTest->recommend($movies);

        // Then
        $this->assertCount(3, $actual);
        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnAllMoviesWhenNumberOfMoviesIsLowerThanExpectedNumberOfSuggest() {
        // Given
        $movies = [
            "Milczenie owiec",
            "Labirynt"
        ];
        $expected = array_reverse($movies);

        $this->shuffleServiceMock->expects($this->once())
            ->method('shuffle')
            ->willReturn(array_reverse($movies));

        // When
        $actual = $this->randomMoviesRecommendationUnderTest->recommend($movies);

        // Then
        $this->assertCount(2, $actual);
        $this->assertEquals($expected, $actual);
    }

}