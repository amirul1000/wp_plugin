<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<b><?=ucwords(str_replace("_"," ","products"))?></b><br />
<table cellspacing="3" cellpadding="3" border="0" align="center" width="98%" class="bdr">
 <tr>
  <td>  
     <a href="admin.php?page=products&cmd=list" class="nav3">List</a>
	 <form name="frm_wp_wp_products" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
            <tr>
                 <td>Brand name</td>
                 <td>
                    <input type="text" name="brand_name" id="brand_name"  value="<?=$brand_name?>" class="textbox">
                 </td>
             </tr>
               <tr>
                 <td>Price</td>
                 <td>
                    <input type="text" name="price" id="price"  value="<?=$price?>" class="textbox">
                 </td>
             </tr>
               <tr>
                 <td>Discount</td>
                 <td>
                    <input type="text" name="discount" id="discount"  value="<?=$discount?>" class="textbox">
                 </td>
             </tr>
              <tr>
                 <td valign="top">Description</td>
                 <td>
                    <textarea name="description" id="description" class="textbox"><?=$description?></textarea>
                 </td>
             </tr>
             <tr>
                 <td>Image File</td>
                 <td><input type="file" name="file_products" id="file_products"  value="<?=$file_products?>" class="textbox">
                 </td>
             </tr>
             <tr>
                 <td>Date Created</td>
                 <td>
                    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="textbox">
                    <?php
						wp_enqueue_script('jquery-ui-datepicker');
						wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
					?>
                    <script language="javascript">
						jQuery(document).ready(function() {
							jQuery('#date_created').datepicker({
								dateFormat : 'yy-mm-dd'
							});
						});
					</script>
                 </td>
             </tr>
              <tr>
                 <td valign="top">Status</td>
                 <td>
                    <select name="status" id="status">
                      <option value="active" <?php if($status=="active") { echo "selected"; } ?>>Active</option>
                      <option value="inactive" <?php if($status=="inactive") { echo "selected"; } ?>>Inactive</option>
                    </select>
                 </td>
             </tr>
             <tr> 
                 <td align="right"></td>
                 <td>
                    <input type="hidden" name="cmd" value="add">
                    <input type="hidden" name="id" value="<?=$Id?>">			
                    <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
                 </td>     
             </tr>
		</table>
	</form>
  </td>
 </tr>
</table>