<?php



class Filestore
{
    public $filename = '';

    public function __construct($filename)
    {
        // Sets $this->filename
        $this->filename = $filename;
    }

    //
    // Returns array of lines in $this->filename
    public function readLines()
    {
        $handle = fopen($this->filename, 'r');
        $contents = trim(fread($handle, filesize($this->filename)));
        $todo_array = explode("\n", $contents);
        fclose($handle);
        return $todo_array;
    }

    //
    // Writes each element in $array to a new line in $this->filename
    public function writeLines($array)
    {
        $handle = fopen($this->filename, 'w');
        foreach ($array as $listItem) {
            fwrite($handle, $listItem . PHP_EOL);
            }
        fclose($handle);
    }

    
    // Reads contents of csv $this->filename, returns an array
     
    public function readCSV()
    {
        $handle = fopen($this->filename, 'r');
        $addressBook = [];

        while (!feof($handle)) {
            $row = fgetcsv($handle);

            if (!empty($row)) {
                $addressBook[] = $row;
            }
        }
    
        fclose($handle);
        return $addressBook;
    }

    
    // // Writes contents of $array to csv $this->filename
     
    public function writeCSV($array)
    {
        $handle = fopen($this->filename, 'w');

        foreach ($array as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }
}