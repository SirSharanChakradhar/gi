<?php




require 'dbh.inc.php';


function show_menu(){
	global $conn;
	$menus = "";
	$menus .= gmm($conn);
	return $menus;
}


function gmm( $conn, $parent_id=NULL){
	
	$menu = "";
	$sql = "";
	$row="";
	if(is_null($parent_id) ) {
		 $sql="select * from `gi_kitting` where `parent_id` is null";
	}
	else{
		$sql="select * from `gi_kitting` where `parent_id`='$parent_id'";
	}
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	
	while($row = mysqli_fetch_assoc($result)){
		if( $row['page']){
			$menu .='<li><p><a href=./'.$row['page'].'>'.$row['title'].'</a></p></li>';
		}
		else{
			$menu .='<li><p><a href="#">'.$row['title'].'</a></p></li>';
		}
		$menu .= '<ul class="menu-list">'.gmm($conn, $row['id']).'</ul>';
		$menu .= '</li>';
	 }
	 return $menu;
	 
}


  ?>
