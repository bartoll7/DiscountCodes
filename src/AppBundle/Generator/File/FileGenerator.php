<?php

namespace AppBundle\Generator\File;

interface FileGenerator
{
    /**
     * @param array $data
     * @param string $fileName
     */
    public function generateFile(array $data, string $fileName);
}