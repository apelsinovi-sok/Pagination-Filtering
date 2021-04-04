<?php
class Origin {

	public $filter;
	public $page;
	public $quantity = 15;
	public $request;


	public function __construct(){

		isset($_GET['filter']) ? $this->filter = $_GET['filter'] : $this->filter = NULL;
        intval($_GET['page']) > 0  ? $this->page = $_GET['page'] : $this->page = 1;

        $this->request = $this->create_request();
   
	} 

	public function build_object(){
        	return new Build($this->request, $this->page, $this->quantity, $this->filter);
        } 


	private function create_request(){

		switch ($this->filter) {
    case NULL:
        $request = NULL;
        break;
    case 'ASC':
        $request = 'ORDER BY id ASC';
        break;  
    case 'DESC':
        $request = 'ORDER BY id DESC';
        break;
    default:
         $request = NULL;
         break; } 

		return $request;
	}

  }



 class Build {

 public $request;
 public $page;
 public $quantity;
 public $count;
 public $dbname;
 public $table;
 public $buyers = array();
 private $page_array = array();

	public function __construct($request, $page, $quantity, $filter){
	   require_once (ROOT.'/db/rb-mysql.php');
       R::setup('mysql:host=localhost; dbname=clients', 'root', '');

       $this->request = $request;
       $this->page = $page;
       $this->quantity = $quantity;
       $this->filter = $filter;
       $this->count = R::count('buyers');
       $this->create_list_product();
	}

	private function create_list_product(){

		$right =  $this->page*$this->quantity;
        $left =  $right-$this->quantity;
        $buyers = R::getAll(" SELECT * FROM `buyers` $this->request LIMIT $left, $this->quantity ");
        if($buyers)
		$this->buyers = $buyers;
	    else $this->buyers = R::getAll(" SELECT * FROM `buyers` $this->request LIMIT 0, $this->quantity ");
	}


	public function pagination_view(){

         $number_of_pages = ceil($this->count/$this->quantity);
         $argument = array();//сборка url запроса

	     if(isset($this->request))//если в строке запроса указан фильтр, то добавить его в массив 
		 $argument['filter'] = $this->filter;

         if($number_of_pages>1){//если список занимает больше одной страницы, создать функцию вывода пагинации, в противном случае не отображать

		   for ($i=1; $i <= $number_of_pages; $i++) {

		     $argument['page'] = $i;//добавить номер страницы в массив 

		     $get_query = '?'.http_build_query($argument);

		     $this->page_array[$i] = $get_query;

		    }
		 }
          return $this->page_array;
	  }
}


?>