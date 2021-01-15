<?php

$id = substr($_SERVER['REQUEST_URI'],-1);
return [
    'students/add' => [
        'controller' => 'students',
        'action' => 'stud'
    ],
    'students/read/'.$id=> [
        'controller' => 'students',
        'action' => 'read'
    ],
    '' => [
        'controller' => 'students',
        'action' => 'index'
    ]
];