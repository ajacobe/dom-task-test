<?php
require_once __DIR__.'/vendor/autoload.php';
use dom\codingChallenge\TaskController;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//fetch all tasks
Flight::route('/', function(){
    $tasks = TaskController::getAll();
    $completedTaskCount = TaskController::getCompletedTaskCount();
    $pendingTaskCount = TaskController::getPendingTaskCount();
    Flight::render("tasks", ["success" => true] + compact('tasks','completedTaskCount','pendingTaskCount'), "body_content");
    Flight::render("header", ['title' => 'Tasks'], "header_content");
    Flight::render("layout", []);
});

//create new task
Flight::route("POST /create-task", function(){
    $task = Flight::request()->data;
    $status = TaskController::create($task);
    if($status){
        Flight::redirect("/");exit;
    }
    Flight::redirect("/create-task");
});

Flight::route("/create-task", function(){
    Flight::render("create-task",[], "body_content");
    Flight::render("header", ["showAddBtn" => false,'title' => 'Create Task'], "header_content");
    Flight::render("layout", []);
});

Flight::route("/task/@id/view", function($id){
    $task = TaskController::getById($id);
    Flight::render("view-task",['task' => $task], "body_content");
    Flight::render("header", ["showAddBtn" => false,'title' => $task->Name], "header_content");
    Flight::render("layout", []);
});

//remove
Flight::route('/task/@id/remove', function($id){
    $status = TaskController::remove($id);
    Flight::json(["success" => $status]);exit;
});

//|complete task
Flight::route('/task/@id/complete', function($id){
    $status = TaskController::complete($id);
    Flight::json(["success" => $status]);exit;
});

//complete task
Flight::route("POST /task/@id/update-priority/@priority", function($id, $priority){
    $status = TaskController::updatePriority($id, $priority);
    Flight::json(["success" => $status]);
});

Flight::start();