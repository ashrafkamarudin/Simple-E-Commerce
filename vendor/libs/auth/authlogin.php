<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        //session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } if (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

            // check connection exist
            if ($this->db_connection) {

                $user_name = $_POST['user_name'];

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $query = "SELECT id, name, email, password, role
                        FROM users
                        WHERE name = :user_name OR email = :user_name";
                $stmt = $this->db_connection->prepare($query);
                $stmt->execute(array(':user_name' => $user_name));
                $result_of_login_check = $stmt->rowCount();

                // if this user exists 
                if ($result_of_login_check == 1) {

                    // get result row (as an object)
                    $result_user = $stmt->fetch();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_user['password'])) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_id'] = $result_user['id'];
                        $_SESSION['user_name'] = $result_user['name'];
                        $_SESSION['user_email'] = $result_user['email'];
                        $_SESSION['user_login_status'] = 1;
                        $_SESSION['user_role'] = $result_user['role'];

                        $this->messages[] = "You have login succesfully";

                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}