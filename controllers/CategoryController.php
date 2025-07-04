<?php 

require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/CategoryService.php");
require(__DIR__ . "/../services/ResponseService.php");

class CategoryController{
    
    public function getAllCategories(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $categories = Category::all($mysqli);
            $categories_array = CategoryService::categoriesToArray($categories); 
            echo ResponseService::success_response($categories_array);
            return;
        }

        $id = $_GET["id"];
        $category = Category::find($mysqli, $id)->toArray();
        echo ResponseService::success_response($category);
        return;
    }

    public function addCategory() {
        global $mysqli;

        $data = [
            "name" => $_GET['name']
        ];

        if (!isset($data["name"])) {
            echo json_encode(["success" => false, "message" => "Missing name"]);
            exit;
        }

        $category = Category::create($mysqli, $data, "s");
    
        echo ResponseService::success_response($category);
        return;    
    }

    public function deleteCategories(){
        global $mysqli;

        if(!isset($_GET["id"])){
            $response = Category::deleteAll($mysqli);
            echo ResponseService::success_response($response);
            return;
        }

        $id = $_GET["id"];
        $category = Category::deleteByID($mysqli, $id);
        echo ResponseService::success_response($category);
        return;
    }

    public function updateCategory(){
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

        $updated_category = Category::update($mysqli, "si", $column_name, $new_value, $id);
        echo ResponseService::success_response($updated_category);
        return;
    }
}
