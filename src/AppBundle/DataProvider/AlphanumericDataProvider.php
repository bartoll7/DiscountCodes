<?php
namespace AppBundle\DataProvider;

class AlphanumericDataProvider implements DataProvider
{
    /**
     * @inheritdoc
     */
    public function getData(): string
    {
        $array =  array_merge(
            range(self::BEGIN_LOWER_CASE_LETTER, self::END_LOWER_CASE_LETTER),
            range(self::BEGIN_UPPER_CASE_LETTER, self::END_UPPER_CASE_LETTER),
            range(self::BEGIN_DIGIT, self::END_DIGIT)
        );

        return implode('', $array);
    }
}