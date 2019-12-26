<?php
       global $wpdb;  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
		  case 'add':
				if(strlen($_FILES['file_products']['name'])>0 && $_FILES['file_products']['size']>0)
				{
					if(!file_exists(get_template_directory()."/products"))
					{ 
					   mkdir(get_template_directory()."/products",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_products']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_products']['name'])));
					}
					$filePath=get_template_directory()."/products/".$file;
					move_uploaded_file($_FILES['file_products']['tmp_name'],$filePath);
				}
               
				
				if(empty($_REQUEST['id']))
				{    $table_name = $wpdb->prefix."products";
					 $wpdb->insert($table_name, 
							array(
							      'file_products' => "products/".$file,
								  'brand_name' => stripslashes($_POST['brand_name']),
								  'price' => $_POST['price'],
								  'discount' => $_POST['discount'],
								  'description' => stripslashes($_POST['description']),
								  'date_created' => $_POST['date_created'],
								  'status'=>$_REQUEST['status']
								  )
							);
				}
				else
				{
					 $table_name = $wpdb->prefix."products";
					 $wpdb->update($table_name, 
							array(
							      'file_products' => "products/".$file,
								  'brand_name' => stripslashes($_POST['brand_name']),
								  'price' => $_POST['price'],
								  'discount' => $_POST['discount'],
								  'description' => stripslashes($_POST['description']),
								  'date_created' => $_POST['date_created'],
								  'status'=>$_REQUEST['status']
								  )  ,
								   array('id'=>$_REQUEST['id'])
								); 
				}
				include("products_list.php");						   
				break;    
		case "edit": 
				    $Id = $_REQUEST['id'];
					if( !empty($_REQUEST['id'] ))
					{
						global $wpdb;
						$table_name = $wpdb->prefix."products";
						$sql = "SELECT * from  ".$table_name."  WHERE id='".$_REQUEST['id']."'";
						$res =  $wpdb->get_results($sql, OBJECT);
						if($wpdb->num_rows === 1)
						{
							$Id        = $res[0]->id;  
							$file_products    = $res[0]->file_products;
							$brand_name    = $res[0]->brand_name;
							$price    = $res[0]->price;
							$discount    = $res[0]->discount;
							$description    = $res[0]->description;
							$date_created    = $res[0]->date_created;
							$status    = $res[0]->status;
						}
					 }
				include("products_editor.php");						  
				break;
						   
         case 'delete': 
					global $wpdb;					
				    $Id = $_REQUEST['id'];
					if( !empty($_REQUEST['id'] ))
					{
						global $wpdb;
						$table_name = $wpdb->prefix."products";
						$sql = "SELECT * from  ".$table_name."  WHERE id='".$_REQUEST['id']."'";
						$res =  $wpdb->get_results($sql, OBJECT);
						if($wpdb->num_rows === 1)
						{
							    $file_products = $res[0]->file_products;
								$file_products = get_template_directory()."/".$file_products;
								unlink($file_products);
						}
					 }
					 
					$table_name = $wpdb->prefix."products";
					$sql = "DELETE FROM  ".$table_name."  WHERE id='".$_REQUEST['id']."'";
					$res =   $wpdb->query($wpdb->prepare($sql));
					include("products_list.php");						   
				break; 						   
         case "list" :  
				include("products_list.php");
				break; 
      
	     default :  
		       include("products_list.php");
				break;          
	   }

//Protect same image name
 function getMaxId($db)
 {
	    
	global $wpdb;
	$table_name = $wpdb->prefix."products";
	$sql = "SELECT max(id) as maxid from  ".$table_name."'";
	$resmax =  $wpdb->get_results($sql, OBJECT);
	$max = 1;
	if($wpdb->num_rows >= 1)
	{
		
	    $max = $resmax[0]->maxid+1;
		
	}   
	   return $max;
 } 	 
?>
