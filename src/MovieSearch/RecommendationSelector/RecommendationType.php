<?php

namespace MovieSearch\RecommendationSelector;

enum RecommendationType: string
{
    case RANDOM_THREE_MOVIES = 'random_three_movies';
    case FIRST_W_LETTER_AND_EVEN_LENGTH_TITLE = 'first_w_letter_and_even_length_title';
    case MINIMUM_TWO_WORDS_TITLE = 'minimum_two_words_title';
}
