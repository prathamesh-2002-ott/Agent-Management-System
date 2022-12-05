<style>
ul {
  list-style: none;
  padding: 0;
  margin: 0;
  background: #1b82a2;
}

ul li {
  display: block;
  position: relative;
  float: left;
  background: #1b82a2;
}

/* This hides the dropdowns */


li ul { display: none; }

ul li a {
  display: block;
  padding: 1em;
  text-decoration: none;
  white-space: nowrap;
  color: #fff;
}

ul li a:hover { background: #1b82a2; }

/* Display the dropdown */


li:hover > ul {
  display: block;
  position: absolute;
}

li:hover li { float: none; }

li:hover a { background: #1b82a2; }

li:hover li a:hover { background: #2c3e50; }

.main-navigation li ul li { border-top: 0; }

/* Displays second level dropdowns to the right of the first level dropdown */


ul ul ul {
  left: 100%;
  top: 0;
}

/* Simple clearfix */



ul:before,
ul:after {
  content: " "; /* 1 */
  display: table; /* 2 */
}

ul:after { clear: both; }
</style>

<?php
//create a mysql connection 
$con=mysqli_connect("localhost","root","","textile");// we have used db name test you can change your db name
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<?php
function get_menu_tree($parent_id) 
{
	global $con;
	$menu = "";
    $sqlquery = " SELECT * FROM menu where status='1' and parent_id='$parent_id' ";
   // echo $sqlquery;
	$res=mysqli_query($con,$sqlquery);
    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
	{
           $menu .="<li><a href='".$row['link']."'>".$row['menu_name']."</a>";
		   
		   $menu .= "<ul>".get_menu_tree($row['menu_id'])."</ul>"; //call  recursively
		   
 		   $menu .= "</li>";
 
    }
    
    return $menu;
} 
?>

<ul class="main-navigation">
<?php echo get_menu_tree(0);//start from root menus having parent id 0 ?>
</ul> 
<?php mysqli_close($con); ?>