<?php require('func/config.php'); ?>
<?php include('includes/front/header.php');?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php

            	//process login form if submitted
            	if(isset($_POST['submit_login'])){

            		$user_email = trim($_POST['user_email']);
            		$password = trim($_POST['password']);

            		if($user->login($user_email,$password))
                {
                  //check if account is activated
                  $stmt = $db->prepare('SELECT * FROM profilemaster WHERE Email = :user_email');
                  $stmt->execute(array(
                		':user_email' => $user_email
                	));
                  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    		          {
                    $status = $row['Status'];
										$_SESSION["username"] = $row['Email'];
										$_SESSION["Role"] = $row['Role'];
										$_SESSION["uid"] = $row['Id'];

                  }
                  if( $status=="Y")
                  {
                    //logged in return to index page
                    header('Location: index.php');
                    exit;

                  }else{
                    $user->logout();
                    $message = '
                      <div class="alert alert-danger">
                        Your account is not activated. Kindly visit your email address to activate it.
                      </div>
                    ';
                  }

            		} else {
            			$message = '
                  <div class="alert alert-danger">
                      Wrong username or password.
                  </div>
                  ';
            		}

            	}//end if submit

            	if(isset($message)){ echo $message; }
            	?>
							<form action="" method ='post'>
		            <input type="email" name ="user_email" placeholder="Email Address" value='<?php if(isset($message)){ echo $_POST['user_email'];}?>' required/>
								<input type="password" name="password" placeholder="Password" value='<?php if(isset($message)){ echo $_POST['password'];}?>' required/>
								<button type="submit" name ="submit_login" class="btn btn-default">Login</button>
							</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<?php

          	//if form has been submitted process it
          	if(isset($_POST['submit']))
            {

          		//collect form data
          		extract($_POST);

          		//very basic validation
          		if($customer_name ==''){
          			$error[] = '
                <div class="alert alert-danger">
                    Please enter your name.
                </div>
                ';
          		}

              if($phone ==''){
          			$error[] = '
                <div class="alert alert-danger">
                    Please enter your phone number.
                </div>
                ';
          		}

              if($idnumber ==''){
                $error[] = '
                <div class="alert alert-danger">
                    Please enter your ID number.
                </div>
                ';
              }

              if($email ==''){
          			$error[] = '
                <div class="alert alert-danger">
                    Please enter your email address.
                </div>
                ';
          		}

          		if($password ==''){
          			$error[] = '
                <div class="alert alert-danger">
                    Please enter the password.
                </div>
                ';
          		}

          		if($passwordConfirm ==''){
          			$error[] = '
                <div class="alert alert-danger">
                    Please confirm the password.
                </div>
                ';
          		}

          		if($password != $passwordConfirm){
          			$error[] = '
                <div class="alert alert-danger">
                    Passwords do not match.
                </div>
                ';
          		}
              if($user->check_if_exists($email) == true){

                $error[] = '
                <div class="alert alert-danger">
                    Account with the email provided already exists. Kindly use a different email address.
                </div>
                ';

              }


          		if(!isset($error)){
                $code = md5(uniqid(rand()));
              	$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);
                $role = 2;
								$status = "N";

          			try {

          				//insert into database $idnumber
          				$stmt = $db->prepare('INSERT INTO profilemaster(Name, Email, PhoneNumber, IdNumber, Password, Role, Status, tokenCode) VALUES (:Name, :Email, :PhoneNumber, :IdNumber, :Password, :Role, :Status, :tokenCode)') ;
          				$stmt->execute(array(
          					':PhoneNumber' => $phone,
          					':IdNumber' => $idnumber,
                    ':Name' => $customer_name,
          					':Email' => $email,
                    ':Password' => $hashedpassword,
                    ':Role' => $role,
										':Status' => $status,
                    ':tokenCode' => $code
          				));


                  $id = $user->getLastUserID();
                  $key = base64_encode($id);
  			          $id = $key;

                //  $emailmessage = ;
                  $message = '<!doctype html>';
									$message.= '<html xmlns="http://www.w3.org/1999/xhtml">';
										$message.='<head>';
										$message.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
										$message.='<meta name="viewport" content="initial-scale=1.0" />';
										$message.='<meta name="format-detection" content="telephone=no" />';
										$message.='<title></title>';
										$message.='<style type="text/css">';
										$message.='body {';
										$message.='	width: 100%;';
											$message.='margin: 0;';
											$message.='padding: 0;';
											$message.='-webkit-font-smoothing: antialiased;';
										$message.='}';
										$message.='@media only screen and (max-width: 600px) {';
											$message.='table[class="table-row"] {';
												$message.='float: none !important;';
												$message.='width: 98% !important;';
												$message.='padding-left: 20px !important;';
												$message.='padding-right: 20px !important;';
											$message.='}';
										$message.='	table[class="table-row-fixed"] {';
												$message.='float: none !important;';
												$message.='width: 98% !important;';
										$message.='	}';
											$message.='table[class="table-col"], table[class="table-col-border"] {';
												$message.='float: none !important;';
												$message.='width: 100% !important;';
												$message.='padding-left: 0 !important;';
												$message.='padding-right: 0 !important;';
												$message.='table-layout: fixed;';
											$message.='}';
											$message.='td[class="table-col-td"] {';
												$message.='width: 100% !important;';
											$message.='}';
											$message.='table[class="table-col-border"] + table[class="table-col-border"] {';
												$message.='padding-top: 12px;';
												$message.='margin-top: 12px;';
												$message.='border-top: 1px solid #E8E8E8;';
											$message.='}';
											$message.='table[class="table-col"] + table[class="table-col"] {';
												$message.='margin-top: 15px;';
											$message.='}';
											$message.='td[class="table-row-td"] {';
												$message.='padding-left: 0 !important;';
												$message.='padding-right: 0 !important;';
											$message.='}';
											$message.='table[class="navbar-row"] , td[class="navbar-row-td"] {';
												$message.='width: 100% !important;';
											$message.='}';
											$message.='img {';
												$message.='max-width: 100% !important;';
												$message.='display: inline !important;';
											$message.='}';
											$message.='img[class="pull-right"] {';
												$message.='float: right;';
												$message.='margin-left: 11px;';
															$message.='max-width: 125px !important;';
												$message.='padding-bottom: 0 !important;';
											$message.='}';
											$message.='img[class="pull-left"] {';
												$message.='float: left;';
												$message.='margin-right: 11px;';
												$message.='max-width: 125px !important;';
												$message.='padding-bottom: 0 !important;';
											$message.='}';
											$message.='table[class="table-space"], table[class="header-row"] {';
												$message.='float: none !important;';
												$message.='width: 98% !important;';
											$message.='}';
											$message.='td[class="header-row-td"] {';
												$message.='width: 100% !important;';
											$message.='}';
										$message.='}';
										$message.='@media only screen and (max-width: 480px) {';
											$message.='table[class="table-row"] {';
												$message.='padding-left: 16px !important;';
												$message.='padding-right: 16px !important;';
											$message.='}';
										$message.='}';
										$message.='@media only screen and (max-width: 320px) {';
											$message.='table[class="table-row"] {';
												$message.='padding-left: 12px !important;';
												$message.='padding-right: 12px !important;';
											$message.='}';
										$message.='}';
										$message.='@media only screen and (max-width: 458px) {';
											$message.='td[class="table-td-wrap"] {';
												$message.='width: 100% !important;';
											$message.='}';
										$message.='}';
										$message.='</style>';
										$message.='</head>';
										$message.='<body style="font-family: Arial, sans-serif; font-size:13px; color: #444444; min-height: 200px;" bgcolor="#E4E6E9" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">';
										$message.='<table width="100%" height="100%" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0">';
										$message.='<tr><td width="100%" align="center" valign="top" bgcolor="#E4E6E9" style="background-color:#E4E6E9; min-height: 200px;">';
									$message.='<table><tr><td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td';  $message.='class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table>';
									$message.='<table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="8" style="height: '; $message.='8px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>';

									$message.='<table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; '; $message.='font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">';
										$message.='<table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; '; $message.='width: 378px;" valign="top" align="left">';
											$message.=' <table class="header-row" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="header-row-td" width="378" style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; margin: 0px; font-size: 18px';  $message.='padding-bottom: 10px; padding-top: 15px;" valign="top" align="left">Thank you for signing up!</td></tr></tbody></table>';
											$message.='<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px;">';
												$message.='<b style="color: #777777;">We are excited to have you join Slimfit Collecton Kanya</b>';
												$message.='<br>';
												$message.='Please confirm your registration to continue';
											$message.='</div>';
										$message.='</td></tr></tbody></table>';
									$message.='</td></tr></tbody></table>';

									$message.='<table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height:';
									$message.='12px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>';
									$message.='<table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: ';
										$message.='12px; width: 450px; padding-left: 16px; padding-right: 16px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="center">&nbsp;<table bgcolor="#E8E8E8" height="0" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td bgcolor="#E8E8E8" height="1" '; $message.='width="100%" style="height: 1px; font-size:0;" valign="top" align="left">&nbsp;</td></tr></tbody></table></td></tr></tbody></table>';
									$message.='<table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: ';
										$message.='16px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>';

									$message.='<table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px;  ';$message.='font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">';
										$message.='<table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; '; $message.='width: 378px;" valign="top" align="left">';
											$message.='<div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">';
												$message.='<a href="#" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 15px; line-height: 21px; background-color: #6fb3e0;">&nbsp; Confirm &nbsp;</a>';
											$message.='</div>';
											$message.='<table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16"  ';$message.='style="height: 16px; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>';
										$message.='</td></tr></tbody></table>';
									$message.='</td></tr></tbody></table>';

									$message.='<table class="table-space" height="6" style="height: 6px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="6" style="height: '; $message.='6px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>';

									$message.='<table class="table-row-fixed" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-fixed-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: ';
										$message.='13px; font-weight: normal; padding-left: 1px; padding-right: 1px;" valign="top" align="left">';
										$message.='<table class="table-col" align="left" width="448" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="448" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;"  ';$message.='valign="top" align="left">';
											$message.='<table width="100%" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td width="100%" align="center" bgcolor="#f5f5f5" style="font-family: Arial, sans-serif; line-height: 24px; color: #bbbbbb; font-size: 13px; font-weight: normal; text-align: center;';
												$message.='padding: 9px; border-width: 1px 0px 0px; border-style: solid; border-color: #e3e3e3; background-color: #f5f5f5;" valign="top">';
												$message.='<a href="#" style="color: #428bca; text-decoration: none; background-color: transparent;">Slimfit Collection Kenya &copy; '.date('Y').'</a>';
												$message.='<br>';
												$message.='<a href="#" style="color: #478fca; text-decoration: none; background-color: transparent;">Twitter</a>';
												$message.='.';
												$message.='<a href="#" style="color: #5b7a91; text-decoration: none; background-color: transparent;">Facebook</a>';
												$message.='.';
												$message.='<a href="#" style="color: #dd5a43; text-decoration: none; background-color: transparent;">Google+</a>';
											$message.='</td></tr></tbody></table>';
										$message.='</td></tr></tbody></table>';
									$message.='</td></tr></tbody></table>';
									$message.='<table class="table-space" height="1" style="height: 1px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="1" style="height:  ';$message.='1px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>';
									$message.='<table class="table-space" height="36" style="height: 36px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="36" style="height: ';
										$message.='36px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table></td></tr></table>';
									$message.='</td></tr>';
										$message.='</table>';
										$message.='</body>';
										$message.='</html>';

            			$subject = "Confirm Registration";

            			$user->send_mail($email,$message,$subject);

                  $message = "<div class='alert alert-success'>
                    						<button class='close' data-dismiss='alert'>&times;</button>
                    						      <strong>Success!</strong>  We've sent an email to $email.
                                      Please click on the confirmation link in the email to create your account.
                  			  		</div>";

                  ;
          		  	if(isset($message)){ echo $message; }
          				exit;

          			} catch(PDOException $e) {
          			    echo $e->getMessage();
          			}

          		}

          	}

          	//check for any errors <input type="tel" pattern='[\+]\d{3}[\(]\d{3}[\)]\d{2}[\-]\d{2}[\-]\d{2}' title='Phone Number (Format: +254(xxx)xx-xx-xx)' >
          	if(isset($error)){
          		foreach($error as $error){
          			echo '<p class="error">'.$error.'</p>';
          		}
          	}
          	?>
						<form action="" method='post'>

							<input type="text" name ="customer_name" maxlength = '30' placeholder="Name" value='<?php if(isset($error)){ echo $_POST['customer_name'];}?>' required/>
              <input type="tel" pattern='(0|\+?254)7(\d){8}' title='Invalid phone number format' name ="phone" placeholder="Phone number" value='<?php if(isset($error)){ echo $_POST['phone'];}?>' required/>
              <input type="text"  name ="idnumber" pattern ="[0-9]*" maxlength = '8' placeholder="ID number" value='<?php if(isset($error)){ echo $_POST['idnumber'];}?>' required/>
						  <input type="email" name ="email" placeholder="Email Address" value='<?php if(isset($error)){ echo $_POST['email'];}?>' required/>
							<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" placeholder="Password" value='<?php if(isset($error)){ echo $_POST['password'];}?>' required/>
              <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="passwordConfirm" placeholder="Confirm your password" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>' required/>

							<button type="submit" name='submit' class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

<?php include('includes/front/footer.php');?>
