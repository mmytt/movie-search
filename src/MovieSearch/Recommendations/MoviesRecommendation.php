<?php

namespace MovieSearch\Recommendations;

interface MoviesRecommendation
{
    public function recommend(array $movies): array;
}