<?php
include 'assets/db.php';
$_SESSION['online'] = "project";
$pro = $_GET['pro'];
$_SESSION['pro'] = $pro;
if ($_SESSION['check'] == "loggedOut") {
    header("location: index.php");
}
$sql = mysql_query("SELECT * FROM project WHERE id='$pro'");
while ($dis = mysql_fetch_array($sql)) {
  $id = $dis['id'];
  $title = $dis['title'];
  $image = $dis['img'];
  $video = $dis['video'];
  $owner = $dis['owner'];
  $back = $dis['backers'];
  $location = $dis['location'];
  $duration = $dis['duration'];
  $descr = $dis['descr'];
  $background = $dis['back'];
  $goals = $dis['goal'];
  $skills = $dis['skills'];
}
$skill = explode(',', $skills);
$skills = ' ';
foreach ($skill as $key) {
  $skills = $key.' '.$skills;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projects</title>
    <link rel="shortcut icon"  href="images/invented.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"  href="css/font-awesome.min.css">
    <link href="css/projectPage.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">



    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css"  href="css/backProject.css">
    <link rel="stylesheet" type="text/css" href="css/projectThumbnail.css">

</head>

<body>


<!-- Navbar goes here -->
<?php
if ($_SESSION['check'] == "loggedIn") {
  include'assets/navbar.php';
} else {
  include'assets/navigation.php';
}
?>
<?php include 'assets/search.php';?>
 <!-- body -->

<br>
 <div class="container" id="contentTabs">
      <div class="col-md-12">
            <div class="tabbable" id="navs">
                <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#tabOne" data-toggle='tab'><i class="fa fa-newspaper-o" aria-hidden="true"></i> Project Description
                        </a>
                      </li>
                      <li>
                        <a href="#tabTwo" data-toggle='tab'><i class="fa fa-comments-o" aria-hidden="true"></i> Chat room
                        </a>
                      </li>
                      <li>
                        <a href="#tabThree" data-toggle='tab'><i class="fa fa-link" aria-hidden="true"></i> Links
                        </a>
                      </li>
                      <li>
                        <a href="#tabFour" data-toggle='tab'><i class="fa fa-github" aria-hidden="true"></i> GitHub 
                        </a>
                      </li>
                </ul> 
                <div class="tab-content">
                      <div class='tab-pane fade in active' id="tabOne">
                      
  <div class="container fluid" id="body1">
 <div class="row" id="searchRow">
 <div class="col-lg-12 col-md-12 col-sm-12 ">
 <h1><?php echo $title;?></h1>
 <h4>By: <?php
  $sql = mysql_query("SELECT * FROM users WHERE id='$owner'");
  while ($dis = mysql_fetch_array($sql)) {
    echo $dis['firstname'].' '.$dis['lastname'];
  }
  $uploadDir = 'images/uploads/project/'.$id.'/';
  if (!file_exists($uploadDir)) {
    $profile = 'images/default/project/default.jpg';
  } else {
    $profile = 'images/uploads/project/'.$id.'/avatar.jpg';
  }
?></h4>
 <br>

 </div>
 </div>

 <!--- end of first row  -->


  <div class="row" id="videoHolder" >
 <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
 <div class="embed-responsive embed-responsive-16by9" id="video">
    <!-- <iframe class="embed-responsive-item" src="videos/Why.mp4"></iframe> -->
    <img src="<?php echo $profile;?>" class="embed-responsive-item"/>
</div>
 </div>
 </div>

 <!-- end of second row  -->

<div class="row">
<div class="col-lg-2">
<h3 class="titles">Description </h3>
</div>
</div>


<div class="row">
<div class="col-lg-6" >
<p>
<?php echo $descr;?>
</p>
</div>
</div>
<!-- end of row  --> 
<!-- social share tags row -->

<div class="row">
  <div class="col-lg-6">
  <br>
  <span style="color:#ff9800;" >Share on</span> 
  &nbsp;
  <a href="http://www.facebook.com/"><span class="fa fa-facebook">&nbsp;</span></a>
   &nbsp;
  <a href="http://www.twitter.com/"><span class="fa fa-twitter">&nbsp;</span></a>
  </div>
</div> 
<!-- tabs for navigating the project -->

<div class="row">
<div class="titles">
</div>
</div><br>
<!-- project about -->
<div class="row">
<div class="col-lg-3">
<h3 class="titles">Project Background </h3>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<p><?php echo $background;?></p>

</div>
</div>

<div class="row">
<div class="col-lg-2">
<h3 class="titles">Goals </h3>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<p><?php echo $goals;?></p>

</div>
</div>

</div>

                      </div> <!-- end of tab1 tab -->

                      <div class='tab-pane fade' id="tabTwo">

    <div class="row">
    <h3 class="rowTitle">&nbsp;Chat group for project</h3>
            <div class="panel panel-default" >
                <div class="panel-heading" style="background: #ff9800;color: white;">
                    <span class="fa fa-comment"></span> Conversation room for <?php echo $title;?>
                   
                </div>
                <div class="panel-body">
                <?php
                    $a=mysql_query("SELECT * FROM message WHERE project='$pro'");
                    while ($e1=mysql_fetch_array($a)) {
                      $text1 = $e1["user"];
                      $text2 = $e1["timep"];
                      $text3 = $e1["content"];
                      $b=mysql_query("SELECT * FROM users WHERE username='$text1'");
                        while ($dis = mysql_fetch_array($b)) {
                            $id = $dis['id'];
                        }
                        if ($_SESSION['userkey'] == $id) {
                            $floater="floater-right";
                        } else {
                            $floater="floater-left";
                        }
                       echo'
                    <ul class="chat '.$floater.'" style="width:70%; list-style:none;">
                        <li>
                            <div class="chat-body">
                                <div class="header">
                                    <strong class="primary-font">'.$text1.'</strong>
                                </div>
                                <p>'.$text3.'</p>
                                <small class="text-muted"><span class="glyphicon glyphicon-time"></span>'.$text2.'</small>
                            </div>
                        </li><hr>
                        
                    </ul>
                    ';}
                    ?>
                </div>
                <div class="panel-footer">
                <form action="assets/script.php" method="POST">
                    <div class="input-group">
                        <input  type="text" name="message" class="form-control" placeholder="Type your message here...">
                        <input type="hidden" value="<?php echo $_SESSION['user'];?>" name="guy">
                        <span class="input-group-btn">
                            <button class="btn btn-active"  type="submit" name="chat">
                                Send</button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
    </div>




                      </div><!-- end of tab2 tab -->

                                            <div class='tab-pane fade' id="tabThree">

    <div class="row">


    <div class="col-lg-8 col-md-8">
    <h3 class="rowTitle">&nbsp; Membership requests</h3>
        <table class="table">
            <form action="assets/script.php" method="POST">
            <tr>
                <th><input type="checkbox" class="selectAll" onclick="check()"></th>
                <th>Names</th>
                <th>Actions</th>
            </tr>
                <?php
                    $mysql = mysql_query("SELECT * FROM users JOIN backed ON users.id=backed.user WHERE response=0");
                    $rows = mysql_num_rows($mysql);
                    if (!$rows==0) {
                        while($se = mysql_fetch_array($mysql)){
                            $person=$se['user'];
                            echo '<tr><td>
                                    <!--<input type="checkbox" name="person[]" value="'.$person.'" class="demo">-->
                                    <input type="hidden" name="person[]" value="'.$person.'">
                                  </td>';
                            echo '<td>'.$se['firstname'].' '.$se['lastname'].'</td>';
                            echo '<td><a class="btn btn-active" href="assets/script.php?approve='.$person.'" class="one"/>Approve</a></td></tr>';
                        }
                    } else {
                        echo "<tr style='text-align:center;'>
                                <td colspan='3'>No user requested to join...</td>
                              </tr>";
                    }
                ?>
            <tr>
                <td></td><td></td>
                <td><input type="submit" name="approve" value="Approve all" class="all" /></td>
            </tr>
            </form>
        </table>
    </div>
            <div class="col-lg-4 col-md-4">
     <center><h3 class="rowTitle">&nbsp;Ressources</h3></center> 

      <br>
      <br>
      <center><a href="" class="btn btn-active">Github</a></center>
      <br>
      <center><a href="" class="btn btn-default">facebook</a></center>
      <br>
      <center><a href="" class="btn btn-opaque">twitter</a></center><br>
      <center><a href="" class="btn btn-danger">Google+</a></center>


<!-- 
<iframe src="https://drive.google.com/embeddedfolderview?id=0B1iqp0kGPjWsNDg5NWFlZjEtN2IwZC00NmZiLWE3MjktYTE2ZjZjNTZiMDY2
#list" style="width:100%; height:600px; border:0;"></iframe> -->

    </div> 





    </div>






                      </div><!-- end of tab3 tab -->
                      
                      
<!-- ______________________________BEGIN OF TAB 4_____________________________________________ -->


			<div class='tab-pane fade' id="tabFour">
        
      <table class="table">
            
        <div class="container" id="contentTabs">
             <div class="col-md-12">
                   <div class="tabbable" id="navs">
                       <ul class="nav nav-tabs">
                       	     <li>
                               <a href="#tabProj" data-toggle='tab'><i class="fa fa-folder-open-o" aria-hidden="true"></i> Project
                               </a>
                             </li>
                             <li>
                               <a href="#tabMngr" data-toggle='tab'><i class="fa fa-user" aria-hidden="true"></i> Collab Manager
                               </a>
                             </li>
                             <li>
                               <a href="#tabContri" data-toggle='tab'><i class="fa fa-users" aria-hidden="true"></i> Collaborators
                               </a>
                             </li>
                             <li>
                               <a href="#tabFile" data-toggle='tab'><i class="fa fa-file-o" aria-hidden="true"></i> Files
                               </a>
                             </li>
                             
                       </ul> 
        <div class="tab-content">
        
        <div class='tab-pane fade' id="tabProj">
        	<form>
        		<legend><a href="https://github.com/testh3h3labs/<?php echo $title?>">Project Link For GitHub: https://github.com/testh3h3labs/<?php echo $title?></a></legend>
        	</form>
        	
        </div>
        

        <div class='tab-pane fade' id="tabMngr">
        
    		    
    		    <form action="assets/script.php" method="POST">
    		    
    		    	<legend>Add A Collaborator:</legend>
    		    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--<label for="username1"><strong>Add A Collaborator</strong></label>-->
                                    <input type="text" name="username1" class="form-control" id="username1" placeholder="Username" required>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <button type="submit" class="btn tf-btn btn-opaque" name="addcont">Submit</button><br><br>
                    </form>
                    
                    
                    <form action="assets/script.php" method="POST">
                    <legend>Remove A Collaborator:</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--<label for="username1"><strong>Remove A Collaborator</strong></label>-->
                                    <input type="text" name="username1" class="form-control" id="username1" placeholder="Username" required>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <button type="submit" class="btn tf-btn btn-opaque" name="remcont">Submit</button><br><br>
                    </form>
        </div>
        
        <div class='tab-pane fade' id="tabContri">
        
          <form>
    	      
    	      	    
    		
    			
    		    <legend>Collaborator Usernames: <br></legend>
    		    <?php	
      			/*
      			    START OF LISTING CollaboratorS
      			*/
      			
      			//Username : Can be changed
      			$user = 'testh3h3labs';
      			
      			//Acess token that can be attained from the application settings.
      			//For InventEd Purposes a sample account has been created. It can be changed by changing the username and token.
      			$token = 'cdd165e62ce42f7f2d5d5c38cfe45869bea4bef2';
      			
      			//the API URL that should be called. Always remember to start with 
      			//https://api.github.com/ then move on to the URL as said in the GITHUB API V3 Documentation
      			$curl_url = 'https://api.github.com/repos/' . $user . '/' .$title. '/collaborators';
      			
      			$curl_token_auth = 'Authorization: token ' . $token;
    	
    	                $chc = curl_init($curl_url);
    			
    	                curl_setopt($chc, CURLOPT_RETURNTRANSFER, 1);
    	                
    	                curl_setopt($chc, CURLOPT_HTTPHEADER, array('User-Agent: jsonp_encoder', $curl_token_auth));
    	
    	                $outputCont = curl_exec($chc);
    	
      		        //$outputCont;
    			
    	                //Close the cURL instance     
    	                curl_close($chc);
    	                
    	                $outputCont = json_decode($outputCont);
    			
    			if (!empty($outputCont)) {
                           
    	                  //For-Each through the decoded array to find key words and display ther data
    	                  foreach ($outputCont as $repos) {
    	             	   
    	                            
    	                    echo '<a href="' . $repos->html_url . '">' . $repos->login . '</a><br />';
    	                    
    	                  }
    	                }
    	                else{
    	                    echo "ERROR NO CollaboratorS FOUND IN REPOSITORY!";
    	                }
    			   /*
    			        End OF LISTING CollaboratorS
    			   */
    	
    	        ?>   
    	
          </form> 
        


      
    </div>


      <div class='tab-pane fade' id="tabFile">
        

        
        <form>
        	<legend>Files:</legend>
	         <?php
	                
	                /*
	                   DISLAYING THE PROJECT REPOSITORY
	                */
	                
	                //Tet account username testh3h3labs
	                $user = 'testh3h3labs';
	
	                //This is the token for the test account testh3h3labs and it acts similar to a username + password.
	                $token = 'cdd165e62ce42f7f2d5d5c38cfe45869bea4bef2';
	
	                // We generate the url for curl
	                $curl_url = 'https://api.github.com/repos/' . $user . '/' .$title. '/contents';
	                
	                //$curl_url = 'https://api.github.com/user/repos';
	
	                //Generates Toke HTTP header for authorization
	                $curl_token_auth = 'Authorization: token ' . $token;
	
	                //Instantiate the cURL
	                $ch = curl_init($curl_url);
	
            			//$post =json_encode(array('name' => 'testRepoAPI', 'description' => 'This is a test', 'homepage' => 'invented.hehelabs.com'),true);
            				
            				
            			//curl_setopt($ch,CURLOPT_URL,$curl_url);	
	                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	                //curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
	                
	
	                // We set the right headers: any user agent type, and then the custom token header part that we generated
	                curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: jsonp_encoder', $curl_token_auth));
	
	                //Execute the cURL
	                $output = curl_exec($ch);
	
			            //echo $output;
			
	                //Close the cURL instance     
	                curl_close($ch);
	
	                //Decode the data using json_decode to get an array of items.
	                $output = json_decode($output);
	
	                if (!empty($output)) {
	                  //For-Each through the decoded array to find key words and display ther data
	                  foreach ($output as $repo) {
	             	   
	                            
	                    echo '<a href="' . $repo->html_url . '">' . $repo->name . '</a><br />';
	                    
	                  }
	                }
	                else{
	                    echo "ERROR NO FILES FOUND IN REPOSITORY!";
	                }
	
			/*
			    END OF REPOSITORY DISPLAY
			*/
		?>
	</form>

</div>
		
		
            
       
            </form>
        </table>    

      </div>
      </div>
    </div>
  </div>
        
    </div><!-- end of tab4 tab -->
                      
                      
                      
                </div><!-- end of tab-content --> 
            </div><!-- end of tabbable-->
      </div><!-- end of column-->
 </div><!--of tabs container-->


<nav id="footer" class="navbar-bottom">
<?php include 'assets/footer.php';?>
</nav>
    <!-- jQuery (necessary for Bootstra'ps JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
    <script src="js/repo.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/SmoothScroll.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script>
        var a = 0;
        $(".all").hide();
        $(".selectAll").click(function(){
            $(".all").toggle();
            $(".one").toggle();
        });
        function check() {
            if (a === 0) {
                var x = document.getElementsByClassName("demo");
                x.checked = true;
                a = 1;
            } else {
                var x = document.getElementsByClassName("demo");
                x.checked = false;
                a = 0;
            }
        }
    </script>
</body>

</html>