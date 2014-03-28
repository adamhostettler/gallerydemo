<?php
session_start();

if(!isset($_SESSION["active"]))
	$_SESSION["active"] = "0";
if(!isset($_SESSION["atype"]))
	$_SESSION["atype"] = "";
if(!isset($_SESSION["catid"]))
	$_SESSION["catid"] = "";
if(empty($_SESSION["error"]))
	$_SESSION["error"] = "";
if(empty($_SESSION["success"]))
	$_SESSION["success"] = "";
if(empty($_SESSION["folder"]))
	$_SESSION["folder"] = "";
if(empty($_SESSION["infomsg"]))
	$_SESSION["infomsg"] = "";
if(empty($_SESSION["acctform_return_userid"]))
	$_SESSION["acctform_return_userid"] = "";
if(empty($_SESSION["acctform_return_accttype"]))
	$_SESSION["acctform_return_accttype"] = "";
if(empty($_SESSION["acctform_return_catid"]))
	$_SESSION["acctform_return_catid"] = "";
if(empty($_SESSION["catform_return_catid"]))
	$_SESSION["catform_return_catid"] = "";
if(empty($_SESSION["catform_return_catname"]))
	$_SESSION["catform_return_catname"] = "";
if(empty($_SESSION["catform_return_display"]))
	$_SESSION["catform_return_display"] = "";

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html>
<head>
	<title>Scenes of Purdue</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="js/lightbox-2.6.min.js"></script>
	<!--<script src="js/jquery.form.js"></script>-->
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/lightbox.css"/>
	<script src="js/extras.jquery.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
</head>
<body>
	<div id="wrapper"><!--white space left/right-->
	<div id="innerwrap"><!--centered bg to allow for container drop shadow-->
		
		<div id="top">
			<div id="loginbar"><!--this is what expands at the top when login button #loginlinkb in #banner is clicked-->
				<form id="loginForm" method="post" action="login.php">
					<?php 
						if(($_SESSION["active"]=="1")&&($_SESSION["atype"]=="super")){
							echo("<div id=\"editacct\" class=\"superbutton\">Add/Edit<br>Account</div><div id=\"editcat\" class=\"superbutton\">Add/Edit<br>Category</div><div id=\"upload\" class=\"superbutton\">Upload<br>Image</div><div id=\"editimg\" class=\"superbutton\">Edit/Delete<br>Image</div><div id=\"logout\" class=\"superbutton\">Logout</div>");
						}
						else if(($_SESSION["active"]=="1")&&($_SESSION["atype"]=="cat")){
							echo("<div id=\"editacct\" class=\"superbutton\">Edit<br>Account</div><div id=\"editcat\" class=\"superbutton\">Edit<br>Category</div><div id=\"upload\" class=\"superbutton\">Upload<br>Image</div><div id=\"editimg\" class=\"superbutton\">Edit/Delete<br>Image</div><div id=\"logout\" class=\"superbutton\">Logout</div>");
						}
						else{
							echo("<label for=\"userid\">Username: </label><input type=\"text\" name=\"userid\" id=\"userid\" length=\"30\"/><label for=\"pass\">Password: </label><input type=\"password\" name=\"pass\" id=\"pass\" length=\"30\"/><input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Login\"/>");
						};?>
				</form>
			</div><!--end loginbar-->

			<div id="banner"><!--header w/ logo and login button to expand #loginbar-->
				<div id="logo"></div><!--purdue logo here-->
				<div id="loginlink"><!--#loginbar expand button-->
					<?php 
						if($_SESSION["active"]=="1"){
							echo("Welcome, ".$_SESSION["admin"]." &nbsp;<span id=\"loginlinkb\" style=\"cursor:pointer;\">Open/Close Admin Menu</span></p>");
						} else{
							echo("<p>Administrator? <span id=\"loginlinkb\">Login Here</span></p>");
						};
					?>
				</div>
				<div id="bannertitle"><p>Scenes of Purdue</p></div>
			</div>
		</div>

		<div id="menus">
			<div id="menubar"><!--static menu bar-->
				<a id="home" class="menuitem" href="index.php">Home</a>
				<a id="gallery" class="menuitem" href="#gallerymenu">Galleries</a>
				<a id="about" class="menuitem" href="#footbar">About</a>
			</div>

			<div id="splash"></div><!--image displayed on home, maybe on about as well-->
		</div>

		<div id="container"><!--begin content-->

			<div id="gallerymenu"><!--thumbnail previews of each gallery present in system, links to respective gallery-->
				<div id="gmtitle">
					<h1>Galleries</h1>
				</div>
				<?php
					include("connectdb.php");

					$result = mysql_query("SELECT * FROM category");

					while ($row = mysql_fetch_array($result)){
						echo ("<div class=\"ctile\" id=".$row["catid"]." data-catname=".$row["catname"]." style=\"background:url(images/".$row["catname"]."/thumbs/".$row["catname"]."01.jpg)\"><p>".$row["displayname"]."</p></div>");
					}

					mysql_free_result($result);

					mysql_close($db);
				?>
			</div>
			
			<div id="pgleft"></div><!--click to page left (semi-transparent black bar w/left carrot)-->
			<div id="displaycase">
				<div id="displaygallery" data-origposition=""><!--gallery location, use js to populate-->
					<p id="galleryfiller">Click on a gallery above to view the images in each gallery, or select the all button to view all photos.</p>
				</div>
			</div>
			<div id="pgright"></div><!--click to page right-->

			<script type="text/javascript">
				$displayoffset = $('#displaygallery').offset();
				$('#displaygallery').attr("data-origposition", $displayoffset);
			</script>

			<!--make slider, hover over edges to page left and right (or click) and overflow:hidden-->

			<div id="readme">
				<p>Creator: Adam Hostettler</p>
				<p>For Class: Purdue University CGT 356</p>
				<p>Quirks in the System:<br>I had a hard time getting the array with image descriptions to work so there is no edit image functionality.<br>The image slider, when using the page left and right buttons, keeps scrolling. There is no failsafe to prevent user from scrolling too far. Ran out of time trying to fix it.</p>
			</div>

			<div id="footbar"></div><!--separator for footer from rest of content-->
			<footer>Created by Adam Hostettler for Purdue CGT 356; Images &copy; Ron Glotzbach</footer>
		
			<!--dialog boxes-->
			<div id="logoutdialog" style="display:none;">Are you sure you want to log out?</div>
			<div id="updialog" style="display:none">
				<form id="uploadform" action="upload.php" method="post" enctype="multipart/form-data">
					<label for="loc">Category:</label>
					<select id="loc" name="loc">
						<?php
							include("connectdb.php");
							$result = mysql_query("SELECT * FROM category");
							while ($row = mysql_fetch_array($result)){
								echo ("<option value=\"".$row["catname"]."\">".$row["displayname"]."</option>");
							}
							mysql_free_result($result);
							mysql_close($db);
						?>
					</select><br>
					<label for="uploadnum">Image Number</label>
					<input type="text" name="uploadnum" id="uploadnum" length="2" maxlength="2" maxvalue="99" value="<?php include("connectdb.php"); $result = mysql_query("SELECT * FROM image ORDER BY number DESC LIMIT 1"); $row = mysql_fetch_array($result); $num = $row["number"]+1; echo $num;?>"><br>
					<label for="file">Image file:</label>
					<input type="file" name="file" id="file"><br>
					<input type="submit" name="submit" value="Upload">
				</form>
			</div>
			<div id="uploadresult">
				<p><?php echo $_SESSION['infomsg']?><br><?php if(isset($_SESSION['success'])) echo $_SESSION['success']; else if(isset($_SESSION['error'])) echo $_SESSION['error'];?></p>
			</div>
			<div id="editaccount" style="display:none;">
				<?php
					if($_SESSION["atype"]=="cat"){
					echo "<form id=\"acctform\" action=\"editacct.php\" method=\"post\">
							<label for=\"acctform_userid\">User ID:</label>
							<input id=\"acctform_userid\" size=\"30\" length=\"30\" maxlength=\"30\" value=\""?><?php echo $_SESSION["admin"];?><?php echo "\"><br>
							<label for=\"acctform_pass\">Password:</label>
							<input id=\"acctform_pass\" size=\"30\" length=\"30\" maxlength=\"30\"><br>
							<input type=\"submit\" name=\"submit\" value=\"Confirm\">
						</form>";
					}
					else if($_SESSION["atype"]=="super"){
						
						echo "<p>Edit an existing admin account</p><br><form id=\"acctform\" action=\"getacct.php\" method=\"post\"><label for=\"acctform_userid\">Select account to edit:</label><select id=\"acctform_userid\" name=\"acctform_userid\">";
						include("connectdb.php");
						$result = mysql_query("SELECT * FROM user");
						while ($row = mysql_fetch_array($result)){
							echo ("<option value=\"".$row["userid"]."\">".$row["userid"]."</option>");
						}
						mysql_free_result($result);
						mysql_close($db);
						echo "</select><br><input type=\"submit\" name=\"submit\" value=\"Next\"></form><br><br><br>
							<p>Add an admin account</p><br>
							<form id=\"add_account_form\" action=\"addaccount.php\" method=\"post\">
							<label for=\"acctadd_userid\">User ID:</label>
							<input type=\"text\" id=\"acctadd_userid\" name=\"acctadd_userid\" size=\"30\" length=\"30\" maxlength=\"30\"><br>
							<label for=\"acctadd_pass\">Password:</label>
							<input type=\"password\" id=\"acctadd_pass\" name=\"acctadd_pass\" size=\"30\" length=\"30\" maxlength=\"30\"><br>
							<input type=\"radio\" id=\"acctadd_type_super\" name=\"acctadd_type\" value=\"super\">superadmin
							<input type=\"radio\" id=\"acctadd_type_cat\" name=\"acctadd_type\" value=\"cat\">categoryadmin<br><br>
							<label for=\"acctadd_catid\">Category for categoryadmin:</label>
							<select id=\"acctadd_catid\" name=\"acctadd_catid\"><option value=\"0\">superadmin</option>"
							?><?php
								include("connectdb.php");
								$result = mysql_query("SELECT * FROM category");
								while ($row = mysql_fetch_array($result)){
									echo ("<option value=\"".$row["catid"]."\">".$row["displayname"]."</option>");
								}
								mysql_free_result($result);
								mysql_close($db);
							?><?php echo "</select><br><br>
							<input type=\"submit\" name=\"submit\" value=\"Add Account\"></form>";
					}
				?>
			</div>
			<div id="editaccount2" style="display:none;">
				<?php
				echo "<form id=\"acctform_update\" action=\"editacct.php\" method=\"post\"><label for=\"acctform_return_userid\">User ID:</label>
				<input type=\"text\" id=\"acctform_return_userid\" name=\"acctform_return_userid\" size=\"30\" length=\"30\" maxlength=\"30\" readonly value=\""?><?php echo $_SESSION["acctform_return_userid"];?><?php echo "\"><br>
				<label for=\"acctform_return_accttype\">Account Type:</label>
				<input type=\"radio\" id=\"acctform_return_accttype_super\" name=\"acctform_return_accttype\" value=\"superadmin\""?><?php if(($_SESSION["acctform_return_accttype"])=="super") echo "checked=\"checked\"";?><?php echo " >Super Admin<br>
				<input type=\"radio\" id=\"acctform_return_accttype_cat\" name=\"acctform_return_accttype\" value=\"categoryadmin\""?><?php if(($_SESSION["acctform_return_accttype"])=="cat") echo "checked=\"checked\"";?><?php echo ">Category Admin<br>
				<label for=\"acctform_return_catid\">Category ID:</label>
				<select id=\"acctform_return_catid\" name=\"acctform_return_catid\"><option value=\"0\">superadmin</option>"
					?><?php
							include("connectdb.php");
							$result = mysql_query("SELECT * FROM category");
							while ($row = mysql_fetch_array($result)){
								if($row["catid"]=$_SESSION["acctform_return_catid"]){
									echo ("<option value=\"".$row["catid"]."\" selected>".$row["displayname"]."</option>");
								}
								else{
									echo ("<option value=\"".$row["catid"]."\">".$row["displayname"]."</option>");
								}
							}
							mysql_free_result($result);
							mysql_close($db);
					?><?php echo "</select><br>
				<input type=\"submit\" name=\"submit\" value=\"Save\"></form>"?>
			</div>
			<div id="editcategory" style="display:none;">
				<?php
					if($_SESSION["catid"] == 0){
						echo "<p>Edit existing category</p><br><form id=\"edit_category_all\" action=\"getcat.php\" method=\"post\">
							<label for=\"catedit_all_edit\">Select an existing category to edit:</label>
							<select id=\"catedit_all_edit\" name=\"catedit_all_edit\">"
							?><?php
								include("connectdb.php");
								$result = mysql_query("SELECT * FROM category");
								while ($row = mysql_fetch_array($result)){
									echo ("<option value=\"".$row["catid"]."\">".$row["displayname"]."</option>");
								}
								mysql_free_result($result);
								mysql_close($db);
							?><?php echo "</select><br><br>
							<input type=\"submit\" name=\"submit\" value=\"Edit\"></form>";

						echo "<p>Add a new category</p><form id=\"add_category\" action=\"addcat.php\" method=\"post\">
							<label for=\"add_category_catname\">Category name (used for filenaming):</label>
							<input type=\"text\" id=\"add_category_catname\" name=\"add_category_catname\"><br>
							<label for=\"add_category_catid\">Category ID:</label>
							<input type=\"text\" id=\"add_category_catid\" name=\"add_category_catid\"><br>
							<label for=\"add_category_catdisp\">Category display name:</label>
							<input type=\"text\" id=\"add_category_catdisp\" name=\"add_category_catdisp\"><br>
							<input type=\"submit\" name=\"submit\" value=\"Add\">
						</form>";
					}
					if(($_SESSION["catid"] != 0)){
						include("connectdb.php");
						$sql = mysql_query("SELECT * FROM category WHERE catid = '".$_SESSION["catid"]."'");
						$data = mysql_fetch_array($sql);
						mysql_close($db);
						echo "<form id=\"edit_category_one\" action=\"editcat.php\" method=\"post\">
							<label for=\"catedit_one_catname\">Category name (used for filenaming):</label>
							<input type=\"text\" id=\"catedit_one_catname\" name=\"catedit_one_catname\" value=\""?><?php echo $data["catname"]?><?php echo "\">
							<label for=\"catedit_one_catid\">Category ID:</label>
							<input type=\"text\" id=\"catedit_one_catid\" name=\"catedit_one_catid\" value=\""?><?php echo $data["catid"]?><?php echo "\">
							<label for=\"catedit_one_catdisp\">Category display name:</label>
							<input type=\"text\" id=\"catedit_one_catdisp\" name=\"catedit_one_catdisp\" value=\""?><?php echo $data["displayname"]?><?php echo "\">
							<input type=\"submit\" name=\"submit\" value=\"Save\">
						</form>";
					}
				?>
			</div>
			<div id="editcategory2" style="display:none;">
				<?php
				echo "<form id=\"catform_update\" action=\"editcat.php\" method=\"post\"><label for=\"catform_return_catid\">Category ID:</label>
				<input type=\"text\" id=\"catform_return_catid\" name=\"catform_return_catid\" size=\"2\" length=\"2\" maxlength=\"2\" readonly value=\""?><?php echo $_SESSION["catform_return_catid"];?><?php echo "\"><br>
				<label for=\"catform_return_catname\">Category Name:</label>
				<input type=\"text\" id=\"catform_return_catname\" name=\"catform_return_catname\" size=\"30\" length=\"30\" maxlength=\"30\" value=\""?><?php echo $_SESSION["catform_return_catname"];?><?php echo "\"><br>
				<label for=\"catform_return_catid\">Category Display Name:</label>
				<input type=\"text\" id=\"catform_return_display\" name=\"catform_return_display\" size=\"30\" length=\"30\" maxlength=\"30\" value=\""?><?php echo $_SESSION["catform_return_display"];?><?php echo "\"><br>
				<input type=\"submit\" name=\"submit\" value=\"Save\"></form>"?>
			</div>
			<div id="successmsg" style="display:none;">
				<p><?php echo $_SESSION["success"]?></p>
			</div>
			<div id="errormsg" style="display:none;">
				<p><?php echo $_SESSION["error"]?></p>
			</div>
			<!--end dialog boxes-->

		</div><!--container end-->
	</div><!--innerwrap end-->
	</div><!--outerwrap end-->

	<script type="text/javascript">
	$(document).ready(function(){
		//when a gallery tile is clicked, do this function
		$('.ctile').click(function(){
			//clear the gallery of previous images or text
			$('#displaygallery').html("");
			$('#displaygallery').css("background", "#fff");
			//$('#displaygallery').offset($('#displaygallery').attr("data-origposition"));
			//this line scrolls the page down to the gallery automatically after a short delay
			$('html, body').delay(500).animate({ scrollTop: $('#displaygallery').offset().top + 250 },1000);
			//store the clicked element into element var
			var element = $(this);
			//get the category id (which is a number) from the tile div (stored as the div id in the html)
			var catid = element.attr('id');
			//get the category name, this is used in the ajax function (I store the category name as a data attribute "data-catname" in each div when I create the category divs). I have to store it as a global variable (which is why it says window.) to access it in the ajax callback function
			window.folder = element.attr('data-catname');
			//create the variable id to pass into the ajax function, in order to know which category to get the images from. this variable looks like "id=1" when it is passed to ajax
			var id = 'id=' + catid;
			//create an array, which will later contain the array created in getimgs.php
			var currArray;
			//ajax function with 2 arguments - id (created above) and a callback function
			doajax(id, function(returnedData){
				//currArray = returnedData;
				//displayImages(0);
			});
		});

		//ajax function
		function doajax(info, callback){
			//pretty sure I don't need both of these vars creating the "currArray" but left them just in case
			var currArray;

			//the ajax
			$.ajax({
				//where to send the data
				url: "getimgs.php",
				//how to send the data
				type: "POST",
				//what data to send (in this case it is the id var, containing the category id)
				data: info,
				//data type javascript
				dataType: "json",
				//function which runs after ajax success, takes 1 argument which is the echoed data from getimgs.php
				success: function(data){
					//store the echoed data from getimgs.php into currArray var
					currArray = data;
					//start at 0 - this is not actually used anymore, just realized that
					start = 0;
					//get the path of the images, equal to the category name
					var path = window.folder;

					//this if-else calculates how wide my gallery will be, in order to maintain 2 rows of 4 (to simulate 8 images per page)
					if(currArray.length % 2 == 0){
						var width = ((currArray.length / 2) * 215) + "px";
					}
					else{
						var width = (((currArray.length + 1) / 2) * 215) + "px";
					}

					//set the gallery width
					$('#displaygallery').css("width", width);

					//this part here runs through the returned array from getimgs.php and created divs for each image, appending them to the div which is my gallery container
					//note that I don't really have pages of images, my images display in one giant horizontal div that users can scroll left and right.
					//so I don't really have "pagination", which is mentioned in the proj specs. I think this works just fine though
					$.each(currArray, function(index, value){
						$('#displaygallery').append('<div class="imgtile"><a href="images/' + window.folder + '/' + value + '" rel="lightbox2" style="background-image:url(images/' + window.folder + '/thumbs/' + value +'); display:inline-block; height:215px; width:215px;"></a><button value="Download" data-url="images/' + window.folder + '/' + value + '">Download</button></div>');
					});
				}
			});
			//not sure what this here is for.. think I added this for something but ended up changing things.. maybe
			return currArray;
		};
		//this is the end of the gallery code

		$(document).on({
			mouseenter: function(){
				$(this).css("opacity", "0.7");
				$(this).children("button").show();
			},
			mouseleave: function(){
				$(this).css("opacity", "1.0");
				$(this).children("button").hide();
			}
		}, '.imgtile');

		$(document).on({
			click: function(){
				var downurl = $(this).attr("data-url");
				window.location.href = downurl;
			}
		}, '.imgtile button');

		$('#logout').click(function(){
			$('#logoutdialog').dialog({
				title: "Logout",
				buttons: [
					{
						text: "Logout",
						click: function(){
							$.get("logout.php");
							setTimeout(function(){
								location.reload();
							},600);
							return false;
						}
					},
					{
						text: "Cancel",
						click: function(){
							$(this).dialog("close");
						}
					}
				]
			});
		});
		$('#upload').click(function(){
			$('#updialog').dialog({
				title: "Upload new image",
				buttons: [
					{
						text: "Cancel",
						click: function(){
							$(this).dialog("close");
						}
					}
				]
			})
		});

		$('#editacct').click(function(){
			$('#editaccount').dialog({
				title: "Edit account",
				buttons: [
					{
						text: "Cancel",
						click: function(){
							$(this).dialog("close");
						}
					}
				]
			})
		});

		$('#editcat').click(function(){
			$('#editcategory').dialog({
				title: "Edit category",
				buttons: [
					{
						text: "Cancel",
						click: function(){
							$(this).dialog("close");
						}
					}
				]
			})
		});

		if (<?php if(!empty($_SESSION['acctform_returned'])) echo "true"; else echo "false";?>){
			window.onload = function(){
				$('#editaccount2').dialog({
					title: "Edit account",
					buttons: [
						{
							text: "Cancel",
							click: function(){
								$(this).dialog("close");
							}
						}
					]
				});
			}
		}

		if (<?php if(!empty($_SESSION['infomsg'])) echo "true"; else echo "false";?>){
			window.onload = function(){
				$('#uploadresult').dialog({
					title: "Upload result",
					buttons: [
						{
							text: "Okay",
							click: function(){
								$(this).dialog("close");
							}
						}
					]
				});
			}
		}

		if(<?php if(!empty($_SESSION['success'])) echo "true"; else echo "false";?>){
			window.onload = function(){
				$('#successmsg').dialog({
					title: "Success",
					buttons: [
						{
							text: "Okay",
							click: function(){
								$(this).dialog("close");
							}
						}
					]
				});
			}
		}

		if(<?php if(!empty($_SESSION['error'])) echo "true"; else echo "false";?>){
			window.onload = function(){
				$('#errormsg').dialog({
					title: "Error",
					buttons: [
						{
							text: "Okay",
							click: function(){
								$(this).dialog("close");
							}
						}
					]
				});
			}
		}

		$(document).on({
			click: function(){
				$(document).getElementById('acctform_return_catid').disabled = true;
			}
		}, '#acctform_return_accttype_super');

		$(document).on({
			click: function(){
				$(document).getElementById('acctform_return_catid').disabled = false;
			}
		}, '#acctform_return_accttype_cat');

		$(document).on({
			mouseenter: function(){
				$(this).css({
					background: "#000",
					color: "#fff"
					}
				);
			},
			mouseleave: function(){
				$(this).css({
					background: "url(img/gbg.png) repeat",
					color: "#000"
					}
				);
			}
		}, '.superbutton');

		// $('#pgright').click(function(){
		// 	if (($('#displaygallery').length % 8) != 0){
		// 		$add = 8 - ($('#displaygallery').length % 8);
		// 		var $newlength = $('#displaygallery').length + $add;
		// 	}
		// 	else{
		// 		var $newlength = $('#displaygallery').length;
		// 	}
		// 	var $movegallery = $('#displaygallery'),
		// 		visible = 8,
		// 		index = 0,
		// 		endIndex = ( $newlength / visible ) - 1;
		// 	if(index < endIndex){
		// 		index++;
		// 		$('#displaygallery').animate({
		// 			'left': '-=860px'
		// 		});
		// 	}
		// });

		// $('#pgleft').click(function(){
		// 	if (($('#displaygallery').length % 8) != 0){
		// 		$add = 8 - ($('#displaygallery').length % 8);
		// 		var $newlength = $('#displaygallery').length + $add;
		// 	}
		// 	else{
		// 		var $newlength = $('#displaygallery').length;
		// 	}
		// 	var $movegallery = $('#displaygallery'),
		// 		visible = 8,
		// 		index = 0,
		// 		endIndex = ( $newlength / visible ) - 1;
		// 	if(index > 0){
		// 		index--;
		// 		$('#displaygallery').animate({
		// 			'left': '+=860px'
		// 		});
		// 	}
		// });

		$('#pgright').click(function(){
			$('#displaygallery').animate({
				'left': '-=860px'
			});
		});

		$('#pgleft').click(function(){
			$('#displaygallery').animate({
				'left': '+=860px'
			});
		});		

	});
	</script>

<?php
	$_SESSION['infomsg'] = "";
	$_SESSION['success'] = "";
	$_SESSION['error'] = "";
	$_SESSION['acctform_returned'] = "";
	$_SESSION["acctform_return_userid"] = "";
	$_SESSION["acctform_userid_accttype"] = "";
	$_SESSION["acctform_userid_catid"] = "";
?>
</body>
</html>

<!--copyright Adam Hostettler 2013-->