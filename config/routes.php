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
    'students/update/'.$id=> [
        'controller' => 'students',
        'action' => 'update'
    ],
    'students/delete/'.$id=> [
        'controller' => 'students',
        'action' => 'delete'
    ],
    '' => [
        'controller' => 'students',
        'action' => 'index'
    ]
];