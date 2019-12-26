     <table>
             <tr align="center">
		<?php
			$rowsPerPage = 10;
			$pageNum = 1;
			if(isset($_REQUEST['page1']))
			{
				$pageNum = $_REQUEST['page1'];
			}
			$offset = ($pageNum - 1) * $rowsPerPage;
			 
			global $wpdb;
			$table_name = $wpdb->prefix."products";
			$sql = "SELECT * from  ".$table_name."  ORDER BY id DESC LIMIT $offset, $rowsPerPage";
			$arr =  $wpdb->get_results($sql, OBJECT);
				
			if($wpdb->num_rows >= 1)
			{
					
				for($i=0;$i<count($arr);$i++)
				{
				  if($i%2==0)
				  {
				    echo "</tr><tr>";
				  }
		
		?>	
		     <td align="center">
		      <?php
			   $file_products = $arr[$i]->file_products;
			   $file_products = get_bloginfo('template_url')."/".$file_products;
			   //template_url template_directory
			  ?>
              <?php
			  echo  "<h3>".$arr[$i]->brand_name."</h3>";
		      echo "<img src=\"".$file_products."\" style=\"width:100px;height:100px;\"><br>";
			  echo  substr($arr[$i]->description,0,200)."...<br>";
			  ?>
              <a href="<?=$file_products?>">Download</a>
              <br />
              Discount: <strike><?=$arr[$i]->discount; ?></strike><br />
              Price: <?=$arr[$i]->price ; ?><br />
			  <?php 
				 $page =get_page_by_title('cart');
				 $guid = $page->guid; 
              ?>
              <form action="<?=$guid?>" method="post">
                  <input type="hidden" name="os0" value="<?=$arr[$i]->description ; ?>">
                  <input type="hidden" name="amount" value="<?=$arr[$i]->price ; ?>">
                  <input type="hidden" name="item_name" value="<?=$arr[$i]->brand_name; ?>">
                  <input type="hidden" name="item_number" value="<?=$arr[$i]->id ; ?>">
                  <input type="hidden" name="quantity" value="1">
                  <input type="submit" name="add_to_cart" value="Add to cart">
              </form>
		      </td>
	       <?php
				  }
			}
			?>
			
			  </tr>
			</table>
			 <div id="pagination">
			      <?php 	
				        $page =get_page_by_title('products');
				        $guid = $page->guid;
						 
				        global $wpdb;
						$table_name = $wpdb->prefix."products";
						$sql = "SELECT * from  ".$table_name;
						$arr =  $wpdb->get_results($sql, OBJECT);
						if($wpdb->num_rows >= 1)
						{  
							$numrows = count($arr);
							$maxPage = ceil($numrows/$rowsPerPage);
							$self = $guid.'&cmd=list&cmd=list';
							$nav  = '';
							
							$start    = ceil($pageNum/5)*5-5+1;
							$end      = ceil($pageNum/5)*5;
							
							if($maxPage<$end)
							{
							  $end  = $maxPage;
							}
							
							for($page = $start; $page <= $end; $page++)
							//for($page = 1; $page <= $maxPage; $page++)
							{
								if ($page == $pageNum)
								{
									$nav .= " $page "; 
								}
								else
								{
									$link = "$self&&page1=$page";
									$nav .= " <a href=\"$link\" class=\"current-item\">$page</a> ";
								} 
							}
							if ($pageNum > 1)
							{
								$page  = $pageNum - 1;
								$link = "$self&&page1=$page";
								$prev  = " <a href=\"$link\" style=\"color:#6600FF\">Prev</a> ";
								/*$link = "$self&&page=1";
							   $first = " <a href=\"$link\" style=\"color:#6600FF\">[First Page]</a> ";*/
							} 
							else
							{
								$prev  = '&nbsp;'; 
								$first = '&nbsp;'; 
							}
						
							if ($pageNum < $maxPage)
							{
								$page = $pageNum + 1;
								$link = "$self&&page1=$page";
								$next = " <a href=\"$link\" class=\"next-button\">Next</a> ";
								/*$link = "$self&&page=$maxPage";
								$last = " <a href=\"$link\" style=\"color:#6600FF\">[Last Page]</a> ";*/
							} 
							else
							{
								$next = '&nbsp;'; 
								$last = '&nbsp;'; 
							}
							
							if($numrows>1)
							{
							  //echo $first . $prev . $nav . $next . $last;
							  echo  $next .$nav .$prev ;
							}
						}	
						?> 
	