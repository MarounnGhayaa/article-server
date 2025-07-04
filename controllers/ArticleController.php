<?php 

require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");

class ArticleController{
    
    public function getAllArticles(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $articles = Article::all($mysqli);
            $articles_array = ArticleService::articlesToArray($articles); 
            echo ResponseService::success_response($articles_array);
            return;
        }

        $id = $_GET["id"];
        $article = Article::find($mysqli, $id)->toArray();
        echo ResponseService::success_response($article);
        return;
    }

    public function addArticle() {
        global $mysqli;

        $data = [
            "name" => $_GET['name'],
            "author" => $_GET['author'],
            "description" => $_GET['description'],
            "category_id" => $_GET['category_id']
        ];

        if (!isset($data["name"]) || !isset($data["author"]) || !isset($data["description"]) || !isset($data["category_id"])) {
            echo json_encode(["success" => false, "message" => "Missing data"]);
            exit;
        }

        $article = Article::create($mysqli, $data, "sssi");
    
        echo ResponseService::success_response($article);
        return;    
    }

    public function deleteArticles(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $response = Article::deleteAll($mysqli);
            echo ResponseService::success_response($response);
            return;
        }

        $id = $_GET["id"];
        $article = Article::deleteByID($mysqli, $id);
        echo ResponseService::success_response($article);
        return;
    }

    public function updateArticle(){
        global $mysqli;

        $data = [
            "column_name" => $_GET['column_name'],
            "new_value" => $_GET['new_value'],
            "id" => $_GET['id']
        ];

        if (!isset($data["column_name"]) || !isset($data["new_value"]) || !isset($data["id"])) {
            echo json_encode(["success" => false, "message" => "Missing data"]);
            exit;
        }

        $column_name = $data["column_name"];
        $new_value = $data["new_value"];
        $id = $data["id"];

        $updated_article = Article::update($mysqli, "si", $column_name, $new_value, $id);
        echo ResponseService::success_response($updated_article);
        return;
    }

    public function findByCategoryID() {
        global $mysqli;

        $category_id = $_GET['category_id'];

        $articles = Article::findByCategoryID($mysqli, $category_id);
        echo ResponseService::success_response($articles);
        return;
    }

    public function findCategoryByArticleID() {
        global $mysqli;

        $id = $_GET['id'];
        
        $foundCategory = Article::findCategoryByArticleID($mysqli, $id);
        echo ResponseService::success_response($foundCategory);
        return;
    }
}
