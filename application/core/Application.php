<?php


class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var array URL parameters */
    private $url_params = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        // check for controller: no controller given ? then load start-page
        if (!$this->url_controller) {

            require APP . 'controller/HomeController.php';  
            # In this case this is our default controller File (starting page) 
            # You can change it to home controller or any other page to start with
            
            $page = new HomeController();  
            $page->index();

        } elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) {
            // here we did check for controller: does such a controller exist ?

            // if so, then load this file and create this controller
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require_once APP . 'controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {

                if (!empty($this->url_params)) {
                  
                    # call_user_func_array function takes a callback method and pass an array of parameters to it.
                    # So this method takes 2 arguments - 1) a callback function and 2) an array.
                    # But why are we passing an array as a callback function ?? 
                    # Well the reason is: If you want to call a method of an instantiated object within a php callback function, then you have to pass this as an array.
                    # Hence we are creating an array containing an object($this->url_controller) at index 0 and the method ($this->url_action) name at index 1.
                    # So the first parameters of call_user_func_array function is an arry (here working as a callback function) containing an object reference and a method name. 
                    # Finally second argument for our call_user_func_array is our url_params array.

                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}(); # Converting an Object of class Application using {} (inline parsing)
                    
                }

            } else {
                if (strlen($this->url_action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    
                    $this->url_controller->index();
                }
                else {
                    header('location: ' . URL . 'error');
                }
            }
        } else {
            header('location: ' . URL . 'error');
        }
    }



    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

        
            if(isset($url[0])){
                $this->url_controller = ucfirst($url[0])."Controller";
             
            } else {
                 $this->url_controller = null;
            }

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->url_action = isset($url[1]) ? $url[1] : null;

            # Remove (unset) controller and method element from the url array -
            # so we can only assign what was left of url array to url_params parameter -
            # otherwise $url[0] (which is controller) and $url[1] (which is method) will be set as parameters -
            # resulting no such parameter found and an error will be displayed.

            unset($url[0], $url[1]);

            # Rebase array keys and store the URL params
            # array_value function return all the values of an array (not the keys)-
            # and indexes the array numerically.
            $this->url_params = array_values($url);

            # for debugging. uncomment this if you have problems with the URL
            // echo 'Controller: ' . $this->url_controller . '<br>';
            // echo 'Action: ' . $this->url_action . '<br>';
            // echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }
}
?>