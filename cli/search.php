<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../public/movies.php';
global $movies;

$moviesRecommendationActionService = new \MovieSearch\MoviesRecommendationActionService($movies);

$selectionType = "random_three_movies";
//$selectionType = "first_w_letter_and_even_length_title";
//$selectionType = "minimum_two_words_title";

$suggestedMovies = $moviesRecommendationActionService->suggestMovies($selectionType);

echo " -- suggested movies -- " . PHP_EOL;
foreach ($suggestedMovies as $key => $movie) {
    echo $key+1 . ". " . $movie . PHP_EOL;
}