<?php

$apis = [
    '/articles'               => ['controller' => 'ArticleController', 'method' => 'getAllArticles'],
    '/add_article'            => ['controller' => 'ArticleController', 'method' => 'addArticle'],
    '/delete_articles'        => ['controller' => 'ArticleController', 'method' => 'deleteArticles'],
    '/update_article'         => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
    '/articles_by_category'   => ['controller' => 'ArticleController', 'method' => 'findByCategoryID'],
    '/category_by_article'    => ['controller' => 'ArticleController', 'method' => 'findCategoryByArticleID'],

    '/categories'         => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],
    '/add_category'       => ['controller' => 'CategoryController', 'method' => 'addCategory'],
    '/delete_categories'  => ['controller' => 'CategoryController', 'method' => 'deleteCategories'],


    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'      => ['controller' => 'AuthController', 'method' => 'register'],

];