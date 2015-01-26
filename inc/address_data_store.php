<?php

require_once 'filestore.php';

class AddressDataStore extends Filestore
 {
    public function __construct($filename)
    {
        $filename = strtolower($filename);
        parent::__construct($filename);
        // or you could do 
        // parent::__construct(strtolower($filename));
                
    }

    function readAddressBook()
    {
        return $this->read();
    }

    function writeAddressBook($addressesArray)
    {
        $this->write($addressesArray);
    }


 }

















 // function mergeBooks()
 //        {
            

 //            echo "File Uploaded";
 //            // $todo_array = array_merge($todo_array, $upload_array);
 //            // writeFile('data/todo.txt', $todo_array);
 //        }