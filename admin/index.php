<?php
$pagetitle = "Dashboard";
 include('../includes/back/header.php');?>
			<!-- /section:basics/sidebar -->
			<div class="main-content">
						<div class="main-content-inner">
							<div class="breadcrumbs ace-save-state" id="breadcrumbs">
								<ul class="breadcrumb">
									<li>
										<i class="ace-icon fa fa-home home-icon"></i>
										<a href="#">Home</a>
									</li>
									<li class="active">Dashboard</li>
								</ul><!-- /.breadcrumb -->

							<?php include('../includes/back/nav-setings.php');?>
								<div class="page-header">
									<h1>
										Dashboard

									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div class="alert alert-block alert-success">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>

											<i class="ace-icon fa fa-check green"></i>

											Welcome to
											<strong class="green">
												Slimfit Collections Kenya
											</strong>

										</div>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4 class="center">Pending Customer Orders</h4>
                        <?php
                        $query = "select DISTINCT `customer_orders`.`CartId`,
                                       `customer_orders`.`DatePlaced`,
                                       `profilemaster`.`IdNumber`,
                                       `deliverypoints`.`Name` as `deliverypoints_Name`
                                  from (((`customer_orders` `customer_orders`
                                  inner join `deliverycarts` `deliverycarts`
                                       on (`deliverycarts`.`CartId` = `customer_orders`.`CartId`))
                                  inner join `profilemaster` `profilemaster`
                                       on (`profilemaster`.`Id` = `customer_orders`.`CustomerId`))
                                  inner join `deliverypoints` `deliverypoints`
                                       on (`deliverypoints`.`Id` = `customer_orders`.`Destination`))
                                  where (`customer_orders`.`Status` = 1)
                                ";

                          $customer_orders = $user->fetch_products($query);
                          ?>

                      </div>

                    </div>
                    <div class="row">
											<div class="col-sm-12">
												<div class="widget-box transparent">
													<div class="widget-body">
														<div class="widget-main no-padding">
															<table class="table table-bordered table-striped">
																<thead class="thin-border-bottom">
																	<tr>
																		<th>
																			<i class="ace-icon fa fa-user"></i>User
																		</th>
																		<th>
		 																	<i class="ace-icon fa fa-shopping-cart"></i>Cart Id
																		</th>
																		<th>
																			 <i class="ace-icon fa fa-calendar"></i>Date Placed
																		</th>
																		<th>
																			 <i class="ace-icon fa fa-calculator"></i>Cart Items
																		</th>
																		<th>
																			<i class="ace-icon fa fa-taxi"></i>Delivery Destination
																		</th>

																		<th class="hidden-480">
																			Action
																		</th>
																	</tr>
																</thead>

																<tbody>
																<?php foreach ($customer_orders as $item) :?>
																	 <tr>
		 																<td><?php echo $item['IdNumber'];?></td>

		 																<td>
		 																	<a href="view-cart.php?id=<?php echo $item['CartId']; ?>"><?php echo $item['CartId']; ?></a>
		 																</td>
		 																<td>
		 																	<?php echo $item['DatePlaced']; ?>
		 																</td>
		 																<td>
		 																	<?php echo $user->countCartItems($item['CartId']); ?>
		 																</td>
		 																<td>
		 																	<?php echo $item['deliverypoints_Name']; ?>
		 																</td>

		 																<td class="hidden-480">
                                      <div class="hidden-sm hidden-xs btn-group">
    																		<a class="btn btn-xs btn-success approve_order" title="Confirm this Order" data-id="<?php echo $item['CartId']; ?>" href="javascipt:void(0)">
    																			<i class="ace-icon fa fa-check bigger-120"></i>
    																		</a>


    																		<a class="btn btn-xs btn-danger cancel_order" data-id="<?php echo $item['CartId']; ?>" href="javascipt:void(0)">
    																			<i class="ace-icon fa fa-ban bigger-120" title="Cancel this Order"></i>
    																		</a>
    																	</div>
		 																</td>
		 															</tr>
																	<?php endforeach; ?>
																</tbody>
															</table>
															</div><!-- /.widget-main -->
													</div><!-- /.widget-body -->
												</div><!-- /.widget-box -->
											</div><!-- /.col -->
										</div><!-- /.row -->
                    <div class="row">
                      <div class="col-sm-12">
                        <h4 class="center">System Users</h4>

                      </div>

                    </div>
                    <!-- users able -->

										<div class="row">
											<div class="col-sm-12">
												<div class="widget-box transparent">
													<div class="widget-body">
														<div class="widget-main no-padding">
															<table class="table table-bordered table-striped">
																<thead class="thin-border-bottom">
																	<tr>
																		<th>
																			<i class="ace-icon fa fa-caret-right blue"></i>Name
																		</th>
																		<th>
		 																	Email
																		</th>
																		<th>
																			 Phone
																		</th>
																		<th>
																			 ID Number
																		</th>

																	</tr>
																</thead>

																<tbody>
																<?php  $myusers = $user->fetch_users();?>

																	<?php foreach ($myusers as $item) :?>
																	 <tr>
		 																<td>
                                      <?php echo $item['Name'];?>
                                    </td>
                                    <td>
		 																	<?php echo $item['Email'];?>
		 																</td>
		 																<td>
		 																	<?php echo $item['PhoneNumber']; ?>
		 																</td>
		 																<td>
		 																	<?php echo $item['IdNumber']; ?>
		 																</td>
		 															</tr>
                                  <?php endforeach; ?>
																</tbody>
															</table>
															</div><!-- /.widget-main -->
													</div><!-- /.widget-body -->
												</div><!-- /.widget-box -->
											</div><!-- /.col -->
										</div><!-- /.row -->

										<div class="hr hr32 hr-dotted"></div>
										<!-- PAGE CONTENT ENDS -->
									</div><!-- /.col -->
								</div><!-- /.row -->
							</div><!-- /.page-content -->
						</div>
					</div><!-- /.main-content -->

		<?php include('../includes/back/footer.php');?>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">

    $(document).ready(function(){

      $('.cancel_order').click(function(e){

        e.preventDefault();

        var pid = $(this).attr('data-id');
        var parent = $(this).parent("td").parent("tr");

        bootbox.dialog({
          message: "Are you sure you want to cancel this order?",
          title: "<i class='glyphicon glyphicon-remove'></i> Cancel?",
          buttons: {
          success: {
            label: "No",
            className: "btn-success",
            callback: function() {
             $('.bootbox').modal('hide');
            }
          },
          danger: {
            label: "Yes",
            className: "btn-danger",
            callback: function() {


              $.post('../custom/cancel-order.php', { 'OrderId':pid })
              .done(function(response){
                bootbox.alert(response);
                parent.fadeOut('slow');
              })
              .fail(function(){
                bootbox.alert('Something Went Wrog ....');
              })

            }
          }
          }
        });


      });

      $('.approve_order').click(function(e){

        e.preventDefault();

        var pid = $(this).attr('data-id');
        var parent = $(this).parent("td").parent("tr");

        bootbox.dialog({
          message: "Are you sure you want to approve this order?",
          title: "<i class='glyphicon glyphicon-ok'></i> Approve Order?",
          buttons: {
          success: {
            label: "No",
            className: "btn-success",
            callback: function() {
             $('.bootbox').modal('hide');
            }
          },
          danger: {
            label: "Yes",
            className: "btn-danger",
            callback: function() {


              $.post('../custom/confirm-order.php', { 'OrderId':pid })
              .done(function(response){
                bootbox.alert(response);
                parent.fadeOut('slow');
              })
              .fail(function(){
                bootbox.alert('Something Went Wrong ....');
              })

            }
          }
          }
        });


      });

    });
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})

				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});


			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;

			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne",
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);

			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);


			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;

			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}

			 });

				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});




				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}

				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}

				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}


				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});


				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}


				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });


				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});

				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});


				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();

					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});

			})
		</script>

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="../assets/css/ace.onpage-help.css" />
		<link rel="stylesheet" href="../docs/assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="../assets/js/ace/elements.onpage-help.js"></script>
		<script src="../assets/js/ace/ace.onpage-help.js"></script>
		<script src="../docs/assets/js/rainbow.js"></script>
		<script src="../docs/assets/js/language/generic.js"></script>
		<script src="../docs/assets/js/language/html.js"></script>
		<script src="../docs/assets/js/language/css.js"></script>
		<script src="../docs/assets/js/language/javascript.js"></script>
	</body>
</html>
