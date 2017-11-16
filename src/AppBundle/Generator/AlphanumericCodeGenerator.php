<?php

namespace AppBundle\Generator;

use AppBundle\DataProvider\DataProvider;
use InvalidArgumentException;

class AlphanumericCodeGenerator implements CodeGenerator
{
    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * @param DataProvider $dataProvider
     */
    public function __construct(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @inheritdoc
     */
    public function generateCodes(int $quantity, int $length): array
    {
        $result = [];

        for ($i = 0; $i < $quantity; $i++) {
            $token = $this->generateRandomToken($length);
            $result[] = $token;
        }

        if (!$this->isUnique($result)) throw new InvalidArgumentException(
            "Values are not unique or collision occurred. Try to generate again or with other parameters"
        );

        return $result;
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomToken(int $length): string
    {
        $token = '';
        $alphanumericData = $this->dataProvider->getData();

        $shuffledString = str_shuffle($alphanumericData);
        $index = strlen($shuffledString) - 1;

        for ($i = 0; $i < $length; $i++) {
            $token .= $shuffledString[mt_rand(0, $index)];
        }

        return $token;
    }

    /**
     * @param array $result
     * @return bool
     */
    private function isUnique(array $result): bool
    {
        $unique = array_unique($result);

        return count($result) === count($unique);
    }
}