<?php

namespace AppBundle\DataProvider;

interface DataProvider
{
    const BEGIN_UPPER_CASE_LETTER = 'A';
    const END_UPPER_CASE_LETTER = 'Z';
    const BEGIN_LOWER_CASE_LETTER = 'a';
    const END_LOWER_CASE_LETTER = 'z';
    const BEGIN_DIGIT = 0;
    const END_DIGIT = 9;

    /**
     * @return string
     */
    public function getData(): string;
}