<?php

namespace AppBundle\Generator\File;

class TextFileGenerator implements FileGenerator
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    /**
     * @inheritdoc
     */
    public function generateFile(array $data, string $fileName)
    {
        $dir = $this->directory . $fileName;

        if(file_exists($dir)) unlink($dir);
        $file = fopen($dir,"x+");

        foreach ($data as $code) {
            fwrite($file, $code . PHP_EOL);
        }

        fclose($file);
    }
}