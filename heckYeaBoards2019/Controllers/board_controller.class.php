<?php
/**
 * Author: Tyler Faircloth
 * Date: 11/18/2019
 * File: board_controller.class.php
 * Description:
 */

class BoardController
{
    private $board_model;

    public function __construct()
    {
        $this->board_model = BoardModel::getBoardModel();
    }

    public function index(){
        //retrieve all boards and store them in an array
        $boards = $this->board_model->list_board();

        if (!$boards) {
            //display an error
            $message = "There was a problem displaying boards.";
            $this->error($message);
            return;
        }

        // display all boards
        $view = new BoardIndex();
        $view->display($boards);
    }
    public function add()
    {
        $message=$this->board_model->add_board();
        $view = new NewBoard();
        $view->display($message);
    }

    public function addboard()
    {
        $result = $this->board_model->add_board();
        $newBoard = new NewBoard();
        $newBoard->display($result);
    }

    public function detail($id) {
        //retrieve the specific board
        $board = $this->board_model->view_board($id);

        if (!$board) {
            //display an error
            $message = "There was a problem displaying the board id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display board details
        $view = new BoardDetail();
        $view->display($board);
    }

    public function edit($id) {
        //retrieve the specific board
        $board = $this->board_model->view_board($id);

        if (!$board) {
            //display an error
            $message = "There was a problem displaying the board id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new BoardEdit();
        $view->display($board);
    }

    public function update($id) {
        //update the board
        $update = $this->board_model->update_board($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the board id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updated board details
        $confirm = $this->board_model->update_board($id);
        $board = $this->board_model->view_board($id);

        $view = new BoardDetail();
        $view->display($board, $confirm);
    }

    //search books
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all boards
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching boards
        $boards = $this->board_model->search_board($query_terms);

        if ($boards === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched board
        $search = new BoardSearch();
        $search->display($query_terms, $boards);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $boards = $this->board_model->search_board($query_terms);

        //retrieve all brands and store them in an array
        $titles = array();
        if ($boards) {
            foreach ($boards as $board) {
                $titles[] = $board->getBrand();
            }
        }

        echo json_encode($titles);
    }

    public function error($message) {
        //create an object of the Error class
        $error = new BoardError();

        //display the error page
        $error->display($message);
    }

    public function delete($id){
        $message=$this->board_model->deleteBoard($id);
        $view= new DeleteConfirmation();
        $view->display($message);
    }


}