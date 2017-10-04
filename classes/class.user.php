<?php

include('class.password.php');

class User extends Password{

    private $db;
    private $data = [];

	function __construct($db){
		parent::__construct();

		$this->_db = $db;

    // $query = $this->fetch_query();
$query = "select * from shop_items";

    $stmt = $db->prepare($query);
    $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        $item = [];
        $item['id'] = $row['Id'];
        $item['name'] = $row['Name'];
        $item['cost'] = $row['Price'];;
        $item['image'] = 'assets/uploads/'.$row['Image'];

        $this->data [] = $item;

    }

	}

  /**
   * Function.
   *
   * Get all array data sample
   *
   * @access public
   *
   * @return
   */
  public function getAllProducts(){
      return $this->data;
  }

  /**
   * Function.
   *
   * Get all array data sample
   *
   * @access public
   *
   * @param int $id ID of product.
   * @return array
   */
  public function getProduct( $id ) {
      foreach ($this->data as $key=>$item){
          if ($id == $item['id']){
              return $this->data[$key];
          }
      }
      return null;
  }

  /**
   * Function.
   *
   * Get all array data sample by id
   *
   * @access public
   *
   * @param array $id list id of product.
   * @return array
   */
  public function getListProductByListIds( $id = [] ) {
      $list = [];
      foreach ($this->data as $key=>$item){
          if ( in_array($item['id'], $id) ){
              $list[] = $this->data[$key];
          }
      }
      return $list;
  }

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
  public function get_user(){
			return $_SESSION['user'];
	}

	private function get_user_hash($user_email){

		try {

			$stmt = $this->_db->prepare('SELECT Password FROM profilemaster WHERE Email = :Email');
			$stmt->execute(array('Email' => $user_email));

			$row = $stmt->fetch();
			return $row['Password'];

		} catch(PDOException $e) {
		    echo '	<div class="alert alert-danger">'.$e->getMessage().'</div>';
		}
	}

	public function login($user_email,$password){

		$hashed = $this->get_user_hash($user_email);

		if($this->password_verify($password,$hashed) == 1){

		    $_SESSION['loggedin'] = true;
		    return true;
		}
	}

	public function logout(){
		session_destroy();
	}

  public function check_if_exists($user_email)
  {
    try {

      $stmt = $this->_db->prepare('SELECT Password FROM profilemaster WHERE Email = :user_email');
      $stmt->execute(array('user_email' => $user_email));
      $row = $stmt->fetch();

      return $stmt->rowCount();

    } catch(PDOException $e) {
        echo '<p class="error">'.$e->getMessage().'</p>';
    }
  }

  //// Send Email
  public function send_mail($email,$message,$subject)
  {
    require_once('mailer/class.phpmailer.php');

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->AddAddress($email);
    $mail->Username="karisjava2@gmail.com";
    $mail->Password="";
    $mail->SetFrom('karisjava2@gmail.com','Asset Manager');
    $mail->AddReplyTo("karisjava2@gmail.com","Asset Manager");
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
  }

  public function fetch_products($query){

    $stmt = $this->_db->prepare($query);
    $stmt->execute();

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    $this->data [] = $userData;


    return $userData;

  }
  public function fetch_single_product($id){

    $query = "select * from shop_items where Id =:id ";
    $stmt = $this->_db->prepare($query);
    $stmt->execute(array('id' => $id));

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    $this->data [] = $userData;


    return $userData;

  }
  public function fetch_brands(){

    $stmt = $this->_db->prepare("SELECT DISTINCT Brand, COUNT(Brand) as NUM FROM shop_items GROUP BY Brand");
    $stmt->execute();

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    return $userData;

  }
  public function display_brands(){

    $stmt = $this->_db->prepare("SELECT * FROM brands ORDER BY Id");
    $stmt->execute();

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    return $userData;

  }
  public function display_categories(){

    $stmt = $this->_db->prepare("SELECT * FROM categories ORDER BY Id");
    $stmt->execute();

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    return $userData;

  }
  public function fetch_categories(){

    $stmt = $this->_db->prepare("SELECT * FROM `categories`");
    $stmt->execute();

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    return $userData;

  }
  public function getCategory($CategoryId){

      $stmt = $this->_db->prepare('SELECT Name FROM categories WHERE Id = :Id');
      $stmt->execute(array('Id' => $CategoryId));
      $row = $stmt->fetch();

      return $row['Name'];

  }
  public function getBrand($BrandId){

      $stmt = $this->_db->prepare('SELECT Name FROM brands WHERE Id = :Id');
      $stmt->execute(array('Id' => $BrandId));
      $row = $stmt->fetch();

      return $row['Name'];

  }
  public function getQuantity($ItemId){

      $stmt = $this->_db->prepare('SELECT Quantity FROM shop_items WHERE Id = :Id');
      $stmt->execute(array('Id' => $ItemId));
      $row = $stmt->fetch();

      return $row['Quantity'];

  }
  public function dropdown_select( $name, $default=null,$id= '', $ItemId) {

    $itemQuantity = $this->fetch_product_quantity($ItemId);

      $output = "<select rel='$id' class='$name' name='" . $name.$id . "' id='" .$name.$id . "'>\n";
      for ($i=1 ; $i<=$itemQuantity; $i++) {
          if ($i != (int)$default) {
              $output .= "\t<option value=\"" . $i . '">' . $i . "</option>\n";
          } else {
              $output .= "\t<option selected='selected' value=\"" . $i . '">' . $i . "</option>\n";
          }
      }
      $output .= "</select>\n";

      return $output;
  }
  public function fetch_product_quantity($id){

    $query = "SELECT * FROM shop_items WHERE Id =:Id";

    $stmt = $this->_db->prepare($query);
    $stmt->execute(array('Id' => $id, 'Id' => $id));
    $row = $stmt->fetch();
    return $row['Quantity'];

  }
  public function countUnapprovedOrders()
  {
    $status = "1";
    try {

      $stmt = $this->_db->prepare('SELECT COUNT(Status) as orders FROM customer_orders WHERE Status =:Status');
      $stmt->execute(array('Status' => $status));
      $row = $stmt->fetch();

      return $row['orders'];
      //	return 0;
    } catch(PDOException $e) {
        echo '<p class="error">'.$e->getMessage().'</p>';
    }
  }

  public function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
  {

    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages)
    { //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link

        if($current_page > 1){
            $previous_link = $current_page - 1;
            $pagination .= '<li class="first"><a href="'.$page_url.'?page=1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="'.$page_url.'?page='.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
                    }
                }
            $first_link = false; //set first link to false
        }

        if($first_link){ //if current active page is first link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }

        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = $current_page + 1;
                $pagination .= '<li><a href="'.$page_url.'?page='.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="'.$page_url.'?page='.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
  }

  public function search($word){
    $search = "%".$word."%";

    $stmt = $this->_db->prepare("SELECT * FROM shop_items WHERE Name LIKE :search3");
    $stmt->bindValue(":search3", $search, PDO::PARAM_STR);
    $stmt->execute();
    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    return $userData;
  }

  public function fetch_users(){

    $stmt = $this->_db->prepare("select * from profilemaster");
    $stmt->execute();

    $userData = array();

    $row=$stmt->fetchAll();

    $userData = $row;

    $this->data [] = $userData;


    return $userData;

  }
  public function destinationAmount($ID){
    try {

      $stmt = $this->_db->prepare('SELECT Amount FROM deliverypoints WHERE  Id = :Id');
      $stmt->execute(array( 'Id' => $ID));
      $row = $stmt->fetch();

      return $row['Amount'];

    } catch(PDOException $e) {
        echo '<p class="error">'.$e->getMessage().'</p>';
    }
  //  return true;
  }
  public function countCartItems($CartId)
  {
    $status = "P";
    try {

			$stmt = $this->_db->prepare('SELECT COUNT(CartId) as Items FROM customer_orders WHERE CartId =:CartId');
			$stmt->execute(array('CartId' => $CartId));
      $row = $stmt->fetch();

			return $row['Items'];
      //	return 0;
		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
  }


}

?>
