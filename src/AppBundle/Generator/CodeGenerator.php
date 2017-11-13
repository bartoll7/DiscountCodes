<?php

namespace AppBundle\Generator;

interface CodeGenerator
{
    /**
     * @param int $quantity
     * @param int $length
     * @return array
     */
    public function generateCodes(int $quantity, int $length): array;
}