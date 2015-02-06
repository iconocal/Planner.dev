<!-- OBJECT: Filestore for dbtodo -->

<?php

class InvalidInputException extends Exception {}

class Filestore
{
    public $filename = '';
    protected $isCSV = false;


    public function __construct($filename)
    {
        $this->filename = $filename;

        if (!file_exists($filename)) {
            touch ($filename);
        }

        if (substr($filename, -3) == 'csv') {
            $this->isCSV = true;
        }
    }

    // Returns array of lines in $this->filename
    private function readLines()
    {
        $handle = fopen($this->filename, 'r');
        $contents = trim(fread($handle, filesize($this->filename)));
        $todo_array = explode("\n", $contents);
        fclose($handle);
        return $todo_array;
    }

    // Writes each element in $array to a new line in $this->filename
    private function writeLines($array)
    {
        $handle = fopen($this->filename, 'w');
        foreach ($array as $listItem) {
            fwrite($handle, $listItem . PHP_EOL);
            }
        fclose($handle);
    }
   
}