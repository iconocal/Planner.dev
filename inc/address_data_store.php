<?php

require_once 'filestore.php';

class AddressDataStore extends Filestore
 {

    function readAddressBook()
        {
            $handle = fopen($this->csvFile, 'r');

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

    function writeAddressBook($array)
        {
            $handle = fopen($this->csvFile, 'w');

            foreach ($array as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }

    function mergeBooks()
        {
            

            echo "File Uploaded";
            // $todo_array = array_merge($todo_array, $upload_array);
            // writeFile('data/todo.txt', $todo_array);
        }

 }