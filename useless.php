<?php
    $array = '{"name":"Hydrangeas.jpg","full_path":"Hydrangeas.jpg","type":"image\/jpeg","tmp_name":"C:\\Users\\ravi\\AppData\\Local\\Temp\\php4BD2.tmp","error":0,"size":595284}';
    $abc = html_entity_decode($array);
    echo $array."<br>";
    echo gettype($array)."<br>";
    // echo gettype($image)."<br>";
    echo $abc."<br>";
    print_r(json_decode($abc, true));
    // echo $image[0]."<br>";
    // echo $image['type']."<br>";
    // echo $image['name']."<br>";
    // echo $image['tmp_name']."<br>";
?>