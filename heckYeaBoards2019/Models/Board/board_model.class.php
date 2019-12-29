<?php
/**
 * Author: Tyler Jump
 * Date: 11/19/2019
 * File: board_model.class.php
 * Description:
 */

class BoardModel
{


    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblBoard;
    private $tblBoardBrand;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblBoard = $this->db->getBoardTable();
        $this->tblBoardBrand = $this->db->getBoardBrandTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        if (!isset($_SESSION['board_brand'])) {
            $brands = $this->get_board_brand();
            $_SESSION['board_brand'] = $brands;
        }
    }

    //static method to ensure there is just one BoardModel instance

    public static function getBoardModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new BoardModel();
        }
        return self::$_instance;
    }

//brand, production_date, price, length, width, wood_type.

    public function add_board()
    {

        try {
            if (!filter_has_var(INPUT_POST, 'brand') ||
                !filter_has_var(INPUT_POST, 'production_date') ||
                !filter_has_var(INPUT_POST, 'length') ||
                !filter_has_var(INPUT_POST, 'width') ||
                !filter_has_var(INPUT_POST, 'wood_type') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'price')) {

                return false;
            }

            //retrieve data for the new board; data are sanitized and escaped for security.
            $brand = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_STRING)));
            $production_date = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'production_date', FILTER_SANITIZE_STRING)));
            $length = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'length')));
            $width = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'width'));
            $wood_type = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'wood_type', FILTER_SANITIZE_STRING)));
            $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
            $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price')));
            /**$query1 = "INSERT INTO board_brand VALUES(NULL ,'$brand')";
            $query3 = "SELECT brand_id FROM " . $this->tblBoardBrand . " WHERE " . "brand_name =" . "'$brand'";
            $finalquery = "INSERT INTO board VALUES(NULL ,($query3),'$production_date', '$length', '$width','$wood_type','$image','$price')";
            $result = $this->dbConnection->query($finalquery);**/

            if ($brand == "") {
                throw new MissingDataException("All fields required Error: <br>Brand is required <br>");
            } elseif ($price == "") {
                throw new MissingDataException("All fields required Error: <br>Price is required <br>");
            }elseif ($wood_type == "") {
                throw new MissingDataException("All fields required Error: <br>Wood type is required <br>");
            }elseif ($production_date == "") {
                throw new MissingDataException("All fields required Error: <br>Production date is required <br>");
            } elseif ($length == "") {
                throw new MissingDataException("All fields required Error: <br>Length is required <br>");
            } elseif ($width == "") {
                throw new MissingDataException("All fields required Error: <br> Width is required <br>");
            }elseif ($image==""){
                throw new MissingDataException("All fields required Error: <br>Image is required<br>");
            }if(!is_numeric($length)==true){
                throw new DataTypeException("Data type error:<br>Length must be a number<br> ");
            }elseif (!is_numeric($width)==true){
                throw new DataTypeException("Data type error:<br>Width must be a number<br> ");
            }elseif (!is_numeric($price)==true){
                throw new DataTypeException("Data type error:<br>Price must be a number<br>");
            }

            //$query1 = "INSERT INTO board_brand VALUES(NULL ,'$brand')";
            $query3 = "SELECT brand_id FROM " . $this->tblBoardBrand . " WHERE " . "brand_name =" . "'$brand'";
            $finalquery = "INSERT INTO board VALUES(NULL ,($query3),'$production_date', '$length', '$width','$wood_type','$image','$price')";
            $result = $this->dbConnection->query($finalquery);
            //echo $result;

                //return Boolean to compare in view
            if ($result == true) {
                return "You have successfully added a new board";
            } else {
                throw new DbException("Database Error: <br> Database could not execute <br>");
            }


        } catch (MissingDataException $e) {
            $message = $e->getMessage();
            return $message;
        }catch(DataTypeException $e){
            $message = $e->getMessage();
            return$message;
        } catch (DbException $e) {
            $message = $e->getMessage();
            return $message;
        } catch (Exception $e) {
            $message = $e->getMessage();
            return $message;
        }
    }

    public function list_board()
    {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */
        $sql = "SELECT * FROM " . $this->tblBoard . "," . $this->tblBoardBrand .
            " WHERE " . $this->tblBoard . ".brand=" . $this->tblBoardBrand . ".brand_id";

        //execute the query
        $query = $this->dbConnection->query($sql);
        if (!$query)
            return false;

        //if the query succeeded, but no board was found.
        if ($query->num_rows == 0)
            return 0;
        //handle the result
        //create an array to store all returned boards
        $boards = array();

        //loop through all rows in the returned
        while ($obj = $query->fetch_object()) {
            $board = new Board(stripslashes($obj->brand_name), stripslashes($obj->production_date), stripslashes($obj->length), stripslashes($obj->width), stripslashes($obj->wood_type), stripslashes($obj->image), stripslashes($obj->price));

            //set the id for the brand
            $board->setId($obj->id);

            //add the boards into the array
            $boards[] = $board;
        }
        return $boards;
    }

    public function view_board($id)
    {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblBoard . "," . $this->tblBoardBrand .
            " WHERE " . $this->tblBoard . ".brand=" . $this->tblBoardBrand . ".brand_id" .
            " AND " . $this->tblBoard . ".id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a board object!!!!!!
            $board = new Board(stripslashes($obj->brand_name), stripslashes($obj->production_date), stripslashes($obj->length), stripslashes($obj->width), stripslashes($obj->wood_type), stripslashes($obj->image), stripslashes($obj->price));

            //set the id for the BOARD
            $board->setId($obj->id);

            return $board;
        }

        return false;
    }


    //search the database for boards that match words in titles. Return an array of boards if succeed; false otherwise.
    public function search_board($terms)
    {


        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND search
        $sql = "SELECT * FROM " . $this->tblBoard . "," . $this->tblBoardBrand .
            " WHERE " . $this->tblBoard . ".brand=" . $this->tblBoardBrand . ".brand_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND brand_name LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no board was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 board found.
        //create an array to store all the returned boards
        $boards = array();

        //loop through all rows in the returned record sets
        while ($obj = $query->fetch_object()) {
            $board = new Board(stripslashes($obj->brand_name), stripslashes($obj->production_date), stripslashes($obj->length), stripslashes($obj->width), stripslashes($obj->wood_type), stripslashes($obj->image), stripslashes($obj->price));

            //set the id for the board
            $board->setId($obj->id);

            //add the board into the array
            $boards[] = $board;
        }
        return $boards;
    }

    public function update_board($id)
    {
        try {
            //if the script did not received post data, display an error message and then terminate the script immediately
            if (!filter_has_var(INPUT_POST, 'brand') ||
                !filter_has_var(INPUT_POST, 'production_date') ||
                !filter_has_var(INPUT_POST, 'length') ||
                !filter_has_var(INPUT_POST, 'width') ||
                !filter_has_var(INPUT_POST, 'wood_type') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'price')) {

                return false;
            }

            //retrieve data for the new board; data are sanitized and escaped for security.
            //add the isbn connection from the database
            $brand = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_STRING)));
            $production_date = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'production_date', FILTER_SANITIZE_STRING)));
            $length = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'length')));
            $width = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'width'));
            $wood_type = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'wood_type')));
            $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image')));
            $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price')));

            if ($brand == "") {
                throw new MissingDataException("All fields required Error: <br>Brand is required <br>");
            } elseif ($price == "") {
                throw new MissingDataException("All fields required Error: <br>Price is required <br>");
            }elseif ($wood_type == "") {
                throw new MissingDataException("All fields required Error: <br>Wood type is required <br>");
            }elseif ($production_date == "") {
                throw new MissingDataException("All fields required Error: <br>Production date is required <br>");
            } elseif ($length == "") {
                throw new MissingDataException("All fields required Error: <br>Length is required <br>");
            }  elseif ($width == "") {
                throw new MissingDataException("All fields required Error: <br> Width is required <br>");
            }   elseif ($image==""){
                throw new MissingDataException("All fields required Error:<br>Image is required");
            }elseif (!is_numeric($length)==true) {
                throw new DataTypeException("Data Type Error: <br>Length must be a number<br>");
            }elseif (!is_numeric($width)==true) {
                throw new DataTypeException("Data Type Error: <br>Width must be a number<br>");
            }elseif (!is_numeric($price) == true) {
                throw new DataTypeException("Data Type Error: <br>Price must be a number<br>");
            } else {
                //query string for update
                $sql = "UPDATE " . $this->tblBoard .
                    " SET brand='$brand', production_date='$production_date', length='$length', width='$width', wood_type='$wood_type', "
                    . "image='$image', price='$price' WHERE id='$id'";

                //execute the query
                if ($this->dbConnection->query($sql) === TRUE) {
                    return "You have successfully updated a board";
                } else {
                    throw new DbException("Database Error: <br> Database could not execute <br>");
                }
            }
        } catch (MissingDataException $e) {
            $message = $e->getMessage();
            return $message;
        } catch (DataTypeException $e) {
            $message = $e->getMessage();
            return $message;
        } catch (DbException $e) {
            $message = $e->getMessage();
            return $message;
        } catch (Exception $e) {
            $message = $e->getMessage();
            return $message;
        }
    }


    //get all board brands
    private function get_board_brand()
    {
        $sql = "SELECT * FROM " . $this->tblBoardBrand;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $brands = array();
        while ($obj = $query->fetch_object()) {
            $brands[$obj->brand_name] = $obj->brand_id;
        }
        return $brands;
    }

    //delete the board
    public function deleteBoard($id)
    {
        try {
            $sql = "DELETE FROM " . $this->tblBoard . " WHERE id=" . $id;

            if ($this->dbConnection->query($sql) === TRUE) {
                return "You have successfully deleted a board";
            } else {
                throw new DbException("Database Error: <br> Database could not execute <br>");
            }
        }catch (DbException $e){
            $message=$e->getMessage();
            return $message;
        }
    }
}
