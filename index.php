<?php

    require __DIR__ . "/src/helpers/file.php";

    $filePath = "database/db.json";
    // $data = [
    //     ["email" => "abcddadfdfasdfaa@gmail.com", "password" => "password1245453"],
    //     ["email" => "abcd@gmail.com", "password" => "password1245453"],
    //     ["email" => "abcde@gmail.com", "password" => "password1245453"],
    // ];

    // write($filePath, $data);

    $abcd = read($filePath);
    printA($abcd);

    // echo __DIR__;

    /***
     * username or email -> form
     * password -> form
     * 
     * 
     * username or email -> database 
     * password -> database
     * 
     * 
     * json or text -> database
     * 
     * validation 
     * 
     * session
     * 
     */

