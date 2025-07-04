<?php
require("../connection/connection.php");
require("../models/Category.php");

$categories = [
    [
        "name" => "Politics"
    ],
    [
        "name" => "Sports"
    ],
    [
        "name" => "Sales"
    ],
    [
        "name" => "Discoveries"
    ],
    [
        "name" => "Nature"
    ]
];

foreach ($categories as $category) {
    $category = Category::Create($mysqli, $category, "s");
}