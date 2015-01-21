<?php

require_once 'filestore.php';

class AddressDataStore extends Filestore
 {

     function readAddressBook()
     {
         return $this->readCSV();
     }

     function writeAddressBook($addressesArray)
     {
         $this->writeCSV($addressesArray);
     }


 }


















 // function mergeBooks()
 //        {
            

 //            echo "File Uploaded";
 //            // $todo_array = array_merge($todo_array, $upload_array);
 //            // writeFile('data/todo.txt', $todo_array);
 //        }