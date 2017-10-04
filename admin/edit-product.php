<?php
	error_reporting( ~E_NOTICE );
	$pagetitle ="Add product";
	$activeProductsParent= "active open";
	$activeAddProduct = "active";

?>
  <?php include('../includes/back/header.php');?>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Products</a>
							</li>
							<li class="active">Edi Product</li>
						</ul><!-- /.breadcrumb -->

					<?php include('../includes/back/nav-setings.php');?>

						<div class="page-header">
							<h1>
								Edit Product

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat">

									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div id="fuelux-wizard-container">
												<div>
													<ul class="steps">
														<li data-step="1" class="active hidden">

														</li>

													</ul>
												</div>

												<div class="step-content pos-rel">
													<div class="step-pane active" data-step="1">
														<h3 class="lighter block green">Enter the following information</h3>
														<?php
							    				 if(isset($_POST['submit_btn'])){

														  $Name = $_POST['ProductName'];
															$Category = $_POST['Category'];
															$Brand = $_POST['Brand'];
															$Colour = $_POST['Colour'];

															$Description = $_POST['Description'];
														  $Price = $_POST['Price'];
														  $Quantity = $_POST['Quantity'];
														  $SetAsNew = $_POST['NewItem'];
														  $FeaturedItem = $_POST['featured'];

							    					 if(empty($Name)){
							    						 $errMSG = "Please give the Product's Name";
							    					 }else if(empty($Name)){
							    						 $errMSG = "Please give the Product's Category";
							    					 }else if(empty($Name)){
							    						 $errMSG = "Please give the Product's Brand";
							    					 }else if(empty($Name)){
							    						 $errMSG = "Please give the Product's Colour";
							    					 }else if(empty($Name)){
							    						 $errMSG = "Please give the Product's Description";
							    					 }else if(empty($Name)){
							    						 $errMSG = "Please give the Product's Price";
							    					 }else if(empty($Name)){
							    						 $errMSG = "Please give the Product's Quantity";
							    					 }else
							          		 {
							                //  $imagedata = file_get_contents($_FILES["animal_images"]["tmp_name"]);

							                  $imgFile = $_FILES['ProductPhoto']['name'];
							                  $tmp_dir = $_FILES['ProductPhoto']['tmp_name'];
							                  $imgSize = $_FILES['ProductPhoto']['size'];

							            			$upload_dir = '../assets/uploads/'; // upload directory

							            			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

							            			// valid image extensions
							            			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

							            			// rename uploading image
							            			$productImage = rand(1000,1000000).".".$imgExt;

							            			// allow valid image file formats
							            			if(in_array($imgExt, $valid_extensions)){
							            				// Check file size '5MB'
							            				if($imgSize < 5000000)				{
							            					move_uploaded_file($tmp_dir,$upload_dir.$productImage);
							            				}
							            				else{
							            					$errMSG = "Sorry, your file is too large.";
							            				}
							            			}
							            			else{
							            				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							            			}
							          		 }

							    					 if(!isset($errMSG))
							    					 {
							    							$stmt = $db->prepare('UPDATE shop_items
																											SET Category=:Category,
																											Brand=:Brand,
																											Name=:Name,
																											Image=:Image,
																											Colour=:Colour,
																											Description=:Description,
																											Price=:Price,
																											Quantity=:Quantity,
																											SetAsNew=:SetAsNew,
																											FeaturedItem=:FeaturedItem WHERE
																											Id=:Id');

							                    $stmt->bindParam(':Category', $Category);
							                    $stmt->bindParam(':Brand', $Brand);
							    								$stmt->bindParam(':Name', $Name);
							                    $stmt->bindParam(':Image', $productImage);
							    								$stmt->bindParam(':Colour', $Colour);
							                    $stmt->bindParam(':Description', $Description);
							                    $stmt->bindParam(':Price', $Price);
																	$stmt->bindParam(':Quantity', $Quantity);
							                    $stmt->bindParam(':SetAsNew', $SetAsNew);
							                    $stmt->bindParam(':FeaturedItem', $FeaturedItem);
																	$stmt->bindParam(':Id', $_GET['id']);
							    								if($stmt->execute())
							    								{
							    									$message = "The product has been succesfully updated";
							    									//header("refresh:5;index.php"); // redirects image view page after 5 seconds.
							    								}
							    								else
							    								{
							    									$errMSG = "An error occured while inserting....";
							    								}

							    					 }
							    				 }
							    				 if(isset($message)){
							    					 echo "<div class='alert alert-success' role='alert'>
							    										<strong>Well done!</strong> $message.
							    								 </div>
							    								 <div class='clearfix'> </div>
							    								 " ;
							    				 }else if(isset($errMSG)) {
							    					echo "<div class='alert alert-danger' role='alert'>
							    									 <strong> Oh snap!</strong> $errMSG.
							    								</div>
							    								<div class='clearfix'> </div>
							    								";
							    				 }
							    				 ?>
													 <form class="form-horizontal" id="my-form" method="post" action="" enctype="multipart/form-data">
														 <?php
														 	  $itemId = $_GET['id'];

					 											$products = $user->fetch_single_product($itemId);

																?>
																<?php foreach ($products as $item_fetched) :?>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="ProductName"> Name:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="ProductName" id="ProductName" class="col-xs-12 col-sm-6" value="<?php if(isset($_GET)) { echo $item_fetched['Name']; } ?>" />
																	</div>
																</div>
															</div>
															<div class="space-2"></div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Category"> Category:</label>
															<?php $categories = $user->fetch_categories(); ?>
																<div class="col-xs-12 col-sm-9">
																	<select id="Category" name="Category" class="select2" data-placeholder="Click to Choose...">
																		<option value="">&nbsp;</option>
																		<?php foreach ($categories as $item) :?>
																		<option value="<?php echo $item['Id'];?>"  <?php if(isset($_GET['id'])){ if($item_fetched['Category']==$item['Id']){echo "selected";}} ?>> <?php echo $item['Name'];?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</div>
															<div class="space-2"></div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Brand"> Brand:</label>
															<?php $categories = $user->display_brands(); ?>
																<div class="col-xs-12 col-sm-9">
																	<select id="Brand" name="Brand" class="select2" data-placeholder="Click to Choose...">
																		<option value="">&nbsp;</option>
																		<?php foreach ($categories as $item) :?>
																		<option value="<?php echo $item['Id']; ?>" <?php if(isset($_GET['id'])){ if($item_fetched['Brand']==$item['Id']){echo "selected";}} ?> > <?php echo $item['Name']; ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="ProductName">Photo:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="file" name="ProductPhoto" accept="image/*" class="col-xs-12 col-sm-6" />
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Colour"> Colour:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="Colour" id="Colour" class="col-xs-12 col-sm-6" value="<?php if(isset($_GET)){echo $item_fetched['Colour'];} ?>" />
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right">
																	<span class="inline space-24 hidden-480"></span>
																	Description:
																</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<textarea id="Description" class="autosize-transition form-control" name="Description"><?php if(isset($_GET)){echo htmlspecialchars($item_fetched['Description']);}  ?></textarea>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Price"> Price:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="Price" id="Price" class="col-xs-12 col-sm-6" value="<?php if(isset($_GET)) { echo $item_fetched['Price']; } ?>" />
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Quantity">Quantity:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" class="input-sm" id="Quantity" name="Quantity" value="<?php if(isset($_GET)) { echo $item_fetched['Quantity']; } ?>"/>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right">Set as new</label>

																<div class="col-xs-12 col-sm-9">
																	<div>
																		<label class="line-height-1 blue">
																			<input name="NewItem" value="1" type="radio" class="ace" <?php if(isset($_GET['id'])){ if($item_fetched['SetAsNew']=="1"){echo "checked ='checked'";}} ?>/>
																			<span class="lbl"> Yes</span>
																		</label>
																	</div>

																	<div>
																		<label class="line-height-1 blue">
																			<input name="NewItem" value="2" type="radio" class="ace" <?php if(isset($_GET['id'])){ if($item_fetched['SetAsNew']=="2"){echo "checked ='checked'";}} ?> />
																			<span class="lbl"> No</span>
																		</label>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right">Set as featured</label>

																<div class="col-xs-12 col-sm-9">
																	<div>
																		<label class="line-height-1 blue">
																			<input name="featured" value="1" type="radio" class="ace"<?php if(isset($_GET['id'])){ if($item_fetched['FeaturedItem']=="1"){echo "checked ='checked'";}} ?> />
																			<span class="lbl"> Yes</span>
																		</label>
																	</div>

																	<div>
																		<label class="line-height-1 blue">
																			<input name="featured" value="2" type="radio" class="ace"<?php if(isset($_GET['id'])){ if($item_fetched['FeaturedItem']=="2"){echo "checked ='checked'";}} ?> />
																			<span class="lbl"> No</span>
																		</label>
																	</div>
																</div>
															</div>

														<?php endforeach; ?>
													</div>


												</div>
											</div>

											<hr />
											<div class="wizard-actions center">

												<button class="btn btn-white btn-info btn-bold" name="submit_btn" type="submit">
													<i class="ace-icon fa fa-floppy-o bigger-120 green"></i>
													Save
												</button>

												<button class="btn btn-white btn-default btn-bold">
													<i class="ace-icon fa fa-times red2"></i>
													Cancel
												</button>


											</div>
										 </form>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div>
							 <!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

		<?php include('../includes/back/footer.php');?>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {

				$('[data-rel=tooltip]').tooltip();

				autosize($('textarea[class*=autosize]'));

				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')

					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});

				$('.select2').css('width','200px').select2({allowClear:true})
				.on('change', function(){
					$(this).closest('form').validate().element($(this));
				});

				$('#Quantity').ace_spinner({value:0,min:1,max:10000,step:1, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});



				var $validation = true;
				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1 && $validation) {

					}
				})
				//.on('changed.fu.wizard', function() {
				//})
				.on('finished.fu.wizard', function(e) {
					$.post('../custom/addbrand.php',
				  {
				    // ProductName: $('[name=ProductName]').val()
				  },
					function(data){
					 bootbox.dialog({
						 message: data,
						 buttons: {
							 "success" : {
								 "label" : "OK",
								 "className" : "btn-sm btn-primary"
							 }
						 }
					 });

				 });
				}).on('stepclick.fu.wizard', function(e){
				  //e.preventDefault();//this will prevent clicking and selecting steps
				});

				$('#brands-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						ProductName: {
				      required: true
				    }
					},

					messages: {

				    ProductName: "Please enter the brand's name"
					},


					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},

					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},

					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},

					submitHandler: function (form) {
					},
					invalidHandler: function (form) {
					}
				});

				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					$('[class*=select2]').remove();
				});
				//override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));

			});
		</script>
	</body>
</html>
