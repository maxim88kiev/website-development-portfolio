<?php echo $header; ?>
<?php $activated=1; ?>
	<style>
		.help:after{content:'';display:none!important;}
		.help{font-weight:400;display:block;}
		.license_ok{display:inline-block;width:24px;height:24px;line-height:20px;color:green;border:2px solid green;border-radius:12px;text-align:center;}
		#content{padding:20px;}
		.activate_steeps{margin-bottom:100px;}
		.mdp_heading{border-bottom:2px solid #00a3d9;margin-bottom:30px;}
		h1.heading_title{font:500 34px 'Arial';display:inline-block;vertical-align:top;}
		.mdp_buttons{float:right;}		
		.mdp_button{text-decoration:none;border:0px;border-bottom:1px solid #fff;display:inline-block;padding:10px 20px;cursor:pointer;font:16px/20px 'Arial';color:#fff!important;}
		.yellow{background:#ffbf00;}
		.green{background:#00a3d9;}
		.red{background:#ff4c4d;}
		.mdp_button:hover{border-bottom:1px solid #111; color:#fff;}
		.activate_steeps>div{display:block;border-left:4px solid #ffbf00;position:relative;padding:0px 20px 0 60px;margin-left:30px;}
		.activate_steeps>div span{display:block;border:4px solid #ffbf00;color:#00a3d9;position:absolute;top:20px;left:-25px;background:#fff;width:46px;height:46px;border-radius:23px;font:bold 22px/38px 'Arial';text-align:center;}
		h2.sh2{font:500 18px/32px 'Arial';color:#555;}
		input.s_input{display:block;margin:10px 0 10px 0;width:500px;border:1px solid #ccc;padding:5px 10px;font:14px/20px 'Arial';color:#333;border-radius:0px;}
		textarea.textarea{width:500px;margin:10px 0 10px 0;border:1px solid #00a3d9;padding:10px;height:90px;}
		input.s_input:focus, input.s_input:active{border-color:#00a3d9;}
		.mdp_table{display:table;}
		.inputs_data, .send_button_box{display:table-cell;vertical-align:top;padding-top:30px;}
		#s2 span{top:100px;}
		.mpd_load{display:inline-block;position:absolute;margin:0px 0 10px;width:31px;height:23px;background:url('data:image/gif;base64,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');}
		.mdp_success{display:none;margin-top:-30px;margin-bottom:30px;background:#00a3d9;text-align:center;font:16px/30px Arial;height:30px;color:#fff;}
		.mdp_tabs{height:36px;}
		.mdp_tabs:after{display:block;content:'';float:none;clear:both;}
		.mdp_tabs>div{cursor:pointer;border:1px solid #00a3d9;border-bottom:0;float:left;height:36px;font:16px/36px Arial;text-align:center;padding:0 20px;}
		.mdp_tabs>div+div{border-left:0;}
		.mdp_tabs>div.active{background:#00a3d9;color:#fff;height:36px;}
		.mdp_tabs_data{padding:20px;border:1px solid #00a3d9;font-size:14px;margin-bottom: 60px;}
		.mdp_tabs_data>div{display:none;}
		.mdp_tabs_data>div.active{display:block;}
		.mdp_tabs_data table td{border-bottom:1px solid #eee;padding:10px;}
		.mdp_tabs_data table td table{width:400px;}
		.mdp_tabs_data table td table tr:last-child td{border:0;}
		.mdp_tabs_data table td table input{width:100%;}
		.mdp_tabs_data table tr td:first-child{width:30%;}	
		.mdp_tabs_data label{font-weight:400;cursor:pointer;}
		.mdp_tabs_data label+label{margin-left:16px;}		
		.mdp_tabs_data label input{margin-right:6px;vertical-align:top;}		
		.mdp_tabs_data select, .mdp_tabs_data input[type="text"], .mdp_tabs_data textarea{width:400px;border:1px solid #ccc;}
		.mdp_tabs_data select{height:40px;line-height:40px;}
		.mdp_tabs_data input[type="text"]{padding:10px;}		
		.mdp_tabs_data textarea{padding:10px;height:80px;}
		.mdp_tabs_data td span.help{display:block;color:#777;font-size:12px;padding:10px;border-left:2px solid #eee;}
		#clear_old{cursor:pointer;border-bottom:1px dashed #00a3d9;color:#00a3d9;display:inline-block;}
		#clear_old:hover{border-color:#fff;}
		.info{width:16px;height:16px;vertical-align:top;display:inline-block;background:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABXklEQVR42p1TPUsDQRScUgsRLKy00VJ/ibWtjWBlCpXk9rayTn6D/oBT0MLC/yFIOhHFIpK7jUQNguGcWXPmclkhZGG4d+9j7r23c0DppBHWsgh7mUHiLB5Si68sxifRJs7fLHaej7GC0OnF2GBhk4WOyAURCMW7YsrpNbAZKk7SeJycGjzRd8iOarL//MzpWSSdgsS3TdbKl/LM4pL+ZQ/a5ZgfzaLJcRahmZ0Zt12AXXX45QPXwL7satyPU8c2RgubCLKrVy7t1sW46hrc8PkSIMiZ04K2PRU0eHQRjvp1rKYnWPckAQIS36E6+ygw5GgXxQ44ynWQwGIA3XMoqKJZCdpzE2gEKWxeAr9EyTN0jTMQ/F6jtD0lJOnf4CyPsCTIdqVdTQgpJGW2dk/UKNldQbZ8QSkHf6YY37zGDxa9e9CW79+fqTj5KRb6BlssaHW5YRYPBG/Tp5hyyjU/HrTx2IoBnlgAAAAtdEVYdFNvZnR3YXJlAGJ5LmJsb29kZHkuY3J5cHRvLmltYWdlLlBORzI0RW5jb2RlcqgGf+4AAAAASUVORK5CYII=');}
		.placeholder_name{width:400px;overflow:hidden;position:absolute;font-size:11px;background:#ddd;padding:2px 4px;color:#000;height:19px;}
		div.ib{display:inline-block;vertical-align:top;}
		div.ib textarea, div.ib input[type="text"]{padding-top:20px;}
		.info_multistore{color:#777;padding:10px;border:2px dashed #888;}
		.mdp_box_size *{box-sizing: border-box;}
		.mdp_form{margin-bottom:50px;}
	</style> 
	<?php if($template_for_2){ ?><?php echo $column_left; ?><?php } ?>

	<div id="content" class="mdp_box_size">
	  <a href="<?php echo $modules_link; ?>">&larr; <?php echo $text_module; ?></a>
	  <div class="md_box">
		<div class="mdp_heading">
		  <h1 class="heading_title"><?php echo $heading_title; ?></h1> 
		  <?php if($activated){ ?>
		  <div class="mdp_buttons">
			<a onclick="$('#form').submit();" class="green mdp_button"><?php echo $button_save; ?></a>
			<a href="<?php echo $cancel; ?>" class="red mdp_button"><?php echo $button_cancel; ?></a>
		  </div>
		  <?php } ?>
		</div>
		<div class="content">
		  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		  <?php if(!$activated){ ?>	
			<div class="activate_steeps">
			  <h2 class="sh2"><?php echo $text_activation; ?></h2>			  
			</div>
		<?php } ?>	
		<?php if($activated){ ?>
			<div class="mdp_tabs">
				<div id="mdp_general" class="active"><?php echo $text_tab_main; ?></div>
				<div id="mdp_company"><?php echo $text_tab_company; ?></div>
				<div id="mdp_product"><?php echo $text_tab_product; ?></div>
				<div id="mdp_category"><?php echo $text_tab_category; ?></div>
				<div id="mdp_manufacturer"><?php echo $text_tab_manufacturer; ?></div>
				<div id="mdp_special"><?php echo $text_tab_special; ?></div>
				<div id="mdp_information"><?php echo $text_tab_article; ?></div>				
			</div>		

			<div class="mdp_tabs_data">
				<div class="mdp_general active">
					<?php if($activated){foreach ($layouts as $key => $layout) { ?>
					  <?php if($layout['layout_id'] != 0) { ?>
						<input type="hidden" name="microdatapro_module[<?php echo $key; ?>][layout_id]" value="<?php echo $layout['layout_id']; ?>" >
						<input type="hidden" name="microdatapro_module[<?php echo $key; ?>][position]" value="content_bottom" >
						<input type="hidden" name="microdatapro_module[<?php echo $key; ?>][status]" value="1" >
						<input type="hidden" name="microdatapro_module[<?php echo $key; ?>][sort_order]" value="3274" >
					  <?php } ?>
					<?php }} ?>
					<input type="hidden" name="config_microdata_registration_email" value="<?php echo $config_microdata_registration_email; ?>" >
					<input type="hidden" name="config_microdata_registration_nikname" value="<?php echo $config_microdata_registration_nikname; ?>" >
					<input type="hidden" name="microdatapro_status" value="1" >
					<table class="mdp_form">
						<?php if($activated){ ?>
						<tr>
						  <td><?php echo $text_microdata_status; ?></td>
						  <td><?php if ($config_microdata_status) { ?>
							<label><input type="radio" name="config_microdata_status" value="1" checked="checked" /><?php echo $text_on; ?></label>
							<label><input type="radio" name="config_microdata_status" value="0" /><?php echo $text_off; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_status" value="1" /><?php echo $text_on; ?></label>
							<label><input type="radio" name="config_microdata_status" value="0" checked="checked" /><?php echo $text_off; ?></label>
							<?php } ?></td>
						</tr>
						<?php } ?>
						<tr>
							<td><?php echo $text_twitter_account; ?></td>
							<td><input type="text" name="config_microdata_twitter_account" placeholder="@account" value="<?php echo $config_microdata_twitter_account; ?>"></td>
						</tr>
						<tr>
						  <td><?php echo $text_opengraph; ?></td>
							  <td><?php if ($config_microdata_opengraph) { ?>
							<label><input type="radio" name="config_microdata_opengraph" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_opengraph" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_opengraph" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_opengraph" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>
						<?php if($old_microdata){ ?> 
							<tr id="old_microdata_block">
								<td><?php echo $text_old_microdata; ?></td>
								<td>
									<?php foreach($old_microdata as $file){ ?>
										<?php echo $file; ?><br>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>
				<div class="mdp_company">
					<table class="mdp_form">
						<?php if($stores){ ?>
							<tr><td colspan="2" style="padding:10px 0;"><div class="info_multistore"><?php echo $text_multistore_info; ?></div></td></tr>
						<?php } ?>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_config_company; ?></a></td>
							  <td><?php if ($config_company) { ?>
							<label><input type="radio" name="config_company" value="1" checked="checked" /><?php echo $text_on; ?></label>
							<label><input type="radio" name="config_company" value="0" /><?php echo $text_off; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_company" value="1" /><?php echo $text_on; ?></label>
							<label><input type="radio" name="config_company" value="0" checked="checked" /><?php echo $text_off; ?></label>
							<?php } ?></td>
						</tr>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_company_syntax; ?></a></td>
						  <td>
							<select name="config_company_syntax">
								<option value="all" <?php if($config_company_syntax == 'all'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_all; ?></option>
								<option value="ld" <?php if($config_company_syntax == 'ld'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_ld; ?></option>
								<option value="md" <?php if($config_company_syntax == 'md'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_md; ?></option>
							</select>
						  </td>
						</tr>				
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_telephone; ?></td>
						  <td>
							<div class="ib">
							<span class="placeholder_name"><?php echo $store_name; ?></span>
							<textarea name="config_microdata_phones" cols="40" rows="5" placeholder="+12-345-678-90-00,+34-555-678-11-11"><?php echo $config_microdata_phones; ?></textarea></div>
							<?php if($stores){ ?>
								<?php foreach($stores as $store){ ?>
									<div class="ib">
									<span class="placeholder_name"><?php echo $store['name']; ?></span>
									<textarea name="config_microdata_phones<?php echo $store['store_id']; ?>" cols="40" rows="5" placeholder="+12-345-678-90-00,+34-555-678-11-11"><?php echo $store['config_microdata_phones']; ?></textarea></div>
								<?php } ?>
							<?php } ?>
						  </td>
						</tr>				
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_group; ?></a></td>
						  <td>
							<div class="ib">
							<span class="placeholder_name"><?php echo $store_name; ?></span>
							<textarea name="config_microdata_groups" cols="40" rows="5" placeholder="https://vk.com/group, https://twitter.com/group"><?php echo $config_microdata_groups; ?></textarea></div>
							<?php if($stores){ ?>
								<?php foreach($stores as $store){ ?>
									<div class="ib">
									<span class="placeholder_name"><?php echo $store['name']; ?></span>
									<textarea name="config_microdata_groups<?php echo $store['store_id']; ?>" cols="40" rows="5" placeholder="https://vk.com/group, https://twitter.com/group"><?php echo $store['config_microdata_groups']; ?></textarea></div>
								<?php } ?>
							<?php } ?>
						  </td>
						</tr>
						<tr>
							<td><a title="<?php echo $text_info_title; ?>"><?php echo $text_city; ?></a></td>
							<td>
							<div class="ib">
							<span class="placeholder_name"><?php echo $store_name; ?></span>
							<input type="text" name="config_microdata_address_1" placeholder="<?php echo $placeholder_city; ?>" value="<?php echo $config_microdata_address_1; ?>">
							</div>
							<?php if($stores){ ?>
								<?php foreach($stores as $store){ ?>
									<div class="ib">
									<span class="placeholder_name"><?php echo $store['name']; ?></span>
									<input type="text" name="config_microdata_address_1<?php echo $store['store_id']; ?>" placeholder="<?php echo $placeholder_city; ?>" value="<?php echo $store['config_microdata_address_1']; ?>"></div>
								<?php } ?>
							<?php } ?>
							</td>
						</tr>
						<tr>
							<td><a title="<?php echo $text_info_title; ?>"><?php echo $text_code; ?></a></td>
							<td>
							<div class="ib">
							<span class="placeholder_name"><?php echo $store_name; ?></span>
							<input type="text" name="config_microdata_address_2" placeholder="012345" value="<?php echo $config_microdata_address_2; ?>">
							</div>
							<?php if($stores){ ?>
								<?php foreach($stores as $store){ ?>
									<div class="ib">
									<span class="placeholder_name"><?php echo $store['name']; ?></span>
									<input type="text" name="config_microdata_address_2<?php echo $store['store_id']; ?>" placeholder="012345" value="<?php echo $store['config_microdata_address_2']; ?>"></div>
								<?php } ?>
							<?php } ?>
							</td>
						</tr>						
						<tr>
							<td><a title="<?php echo $text_info_title; ?>"><?php echo $text_street; ?></a></td>
							<td>
							<div class="ib">
							<span class="placeholder_name"><?php echo $store_name; ?></span>
							<input type="text" name="config_microdata_address_3" placeholder="<?php echo $placeholder_street; ?>" value="<?php echo $config_microdata_address_3; ?>">
							</div>
							<?php if($stores){ ?>
								<?php foreach($stores as $store){ ?>
									<div class="ib">
									<span class="placeholder_name"><?php echo $store['name']; ?></span>
									<input type="text" name="config_microdata_address_3<?php echo $store['store_id']; ?>" placeholder="<?php echo $placeholder_street; ?>" value="<?php echo $store['config_microdata_address_3']; ?>"></div>
								<?php } ?>
							<?php } ?>
							</td>
						</tr>						
						<tr>
							<td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_email; ?></a></td>
							<td>
							<div class="ib">
							<span class="placeholder_name"><?php echo $store_name; ?></span>
							<input type="text" name="config_microdata_email" value="<?php echo $config_microdata_email; ?>">
							</div>
							<?php if($stores){ ?>
								<?php foreach($stores as $store){ ?>
									<div class="ib">
									<span class="placeholder_name"><?php echo $store['name']; ?></span>
									<input type="text" name="config_microdata_email<?php echo $store['store_id']; ?>" value="<?php echo $store['config_microdata_email']; ?>"></div>
								<?php } ?>
							<?php } ?>
							</td>
						</tr>
					</table>		  	
				</div>				
				<div class="mdp_product">
					<table class="form">
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_page; ?></a></td>
						  <td><?php if ($config_product_page) { ?>
							<label><input type="radio" name="config_product_page" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_page" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_product_page" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_page" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>			
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_breadcrumb; ?></a></td> 
						  <td><?php if ($config_product_breadcrumb) { ?>
							<label><input type="radio" name="config_product_breadcrumb" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_breadcrumb" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_product_breadcrumb" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_breadcrumb" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_reviews; ?></a></td> 
						  <td><?php if ($config_product_reviews) { ?>
							<label><input type="radio" name="config_product_reviews" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_reviews" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_product_reviews" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_reviews" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_related; ?></a></td>
						  <td><?php if ($config_product_related) { ?>
							<label><input type="radio" name="config_product_related" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_related" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_product_related" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_related" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>	
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_attribute; ?></a></td>
						  <td><?php if ($config_product_attribute) { ?>
							<label><input type="radio" name="config_product_attribute" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_attribute" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_product_attribute" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_attribute" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_in_stock; ?></a></td>
						  <td><?php if ($config_product_in_stock) { ?>
							<label><input type="radio" name="config_product_in_stock" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_in_stock" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_product_in_stock" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_product_in_stock" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_in_stock_status; ?></a></td>
							  <td>
								  <select name="config_in_stock_status_id">
									<option value="0" <?php if(!$stock_status_id){ ?>selected="selected"<?php } ?>>---</option>
									<?php foreach ($stock_statuses as $stock_status) { ?>
									<?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
									<option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
									<?php } ?>
									<?php } ?>
								  </select>							  
							  </td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_sku; ?></a></td>
						  <td><?php if ($config_microdata_sku) { ?>
							<label><input type="radio" name="config_microdata_sku" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_sku" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_sku" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_sku" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_upc; ?></a></td>
						  <td><?php if ($config_microdata_upc) { ?>
							<label><input type="radio" name="config_microdata_upc" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_upc" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_upc" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_upc" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_ean; ?></a></td>
						  <td><?php if ($config_microdata_ean) { ?>
							<label><input type="radio" name="config_microdata_ean" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_ean" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_ean" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_ean" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>							
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_isbn; ?></a></td>
						  <td><?php if ($config_microdata_isbn) { ?>
							<label><input type="radio" name="config_microdata_isbn" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_isbn" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_isbn" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_isbn" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_mpn; ?></a></td>
						  <td><?php if ($config_microdata_mpn) { ?>
							<label><input type="radio" name="config_microdata_mpn" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_mpn" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_microdata_mpn" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_microdata_mpn" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_syntax; ?></a></td>
						  <td>
							<select name="config_product_syntax">
								<option value="all" <?php if($config_product_syntax == 'all'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_all; ?></option>
								<option value="ld" <?php if($config_product_syntax == 'ld'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_ld; ?></option>
								<option value="md" <?php if($config_product_syntax == 'md'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_md; ?></option>
							</select>
						  </td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_product; ?></a></td>
						  <td><textarea name="config_microdata_product_description" cols="40" rows="5"><?php echo $config_microdata_product_description; ?></textarea></td>
						</tr>				
					</table>
				</div>
				<div class="mdp_category">
					<table class="form">
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_page; ?></a></td>
						  <td><?php if ($config_category_page) { ?>
							<label><input type="radio" name="config_category_page" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_category_page" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_category_page" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_category_page" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>				
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_breadcrumb; ?></a></td>
						  <td><?php if ($config_category_breadcrumb) { ?>
							<label><input type="radio" name="config_category_breadcrumb" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_category_breadcrumb" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_category_breadcrumb" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_category_breadcrumb" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_syntax; ?></a></td>
						  <td>
							<select name="config_category_syntax">
								<option value="all" <?php if($config_category_syntax == 'all'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_all; ?></option>
								<option value="ld" <?php if($config_category_syntax == 'ld'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_ld; ?></option>
								<option value="md" <?php if($config_category_syntax == 'md'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_md; ?></option>
							</select>
						  </td>
						</tr>				
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_category; ?></a></td>
						  <td><textarea name="config_microdata_category_description" cols="40" rows="5"><?php echo $config_microdata_category_description; ?></textarea></td>
						</tr>				
					</table>		
				</div>
				<div class="mdp_manufacturer">
					<table class="form">
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_page; ?></a></td>
						  <td><?php if ($config_manufacturer_page) { ?>
							<label><input type="radio" name="config_manufacturer_page" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_manufacturer_page" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_manufacturer_page" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_manufacturer_page" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>				
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_breadcrumb; ?></a></td>
						  <td><?php if ($config_manufacturer_breadcrumb) { ?>
							<label><input type="radio" name="config_manufacturer_breadcrumb" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_manufacturer_breadcrumb" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_manufacturer_breadcrumb" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_manufacturer_breadcrumb" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_syntax; ?></a></td>
						  <td>
							<select name="config_manufacturer_syntax">
								<option value="all" <?php if($config_manufacturer_syntax == 'all'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_all; ?></option>
								<option value="ld" <?php if($config_manufacturer_syntax == 'ld'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_ld; ?></option>
								<option value="md" <?php if($config_manufacturer_syntax == 'md'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_md; ?></option>
							</select>
						  </td>
						</tr>				
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_manufacturer; ?></a></td>
						  <td><textarea name="config_microdata_manufacturer_description" cols="40" rows="5"><?php echo $config_microdata_manufacturer_description; ?></textarea></td>
						</tr>
					</table>		
				</div>
				<div class="mdp_special">
					<table class="form">
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_page; ?></a></td>
						  <td><?php if ($config_special_page) { ?>
							<label><input type="radio" name="config_special_page" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_special_page" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_special_page" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_special_page" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>			
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_breadcrumb; ?></a></td>
						  <td><?php if ($config_special_breadcrumb) { ?>
							<label><input type="radio" name="config_special_breadcrumb" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_special_breadcrumb" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_special_breadcrumb" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_special_breadcrumb" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_syntax; ?></a></td>
						  <td>
							<select name="config_special_syntax">
								<option value="all" <?php if($config_special_syntax == 'all'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_all; ?></option>
								<option value="ld" <?php if($config_special_syntax == 'ld'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_ld; ?></option>
								<option value="md" <?php if($config_special_syntax == 'md'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_md; ?></option>
							</select>
						  </td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_entry_special; ?></a></td>
						  <td><textarea name="config_microdata_special_description" cols="40" rows="5"><?php echo $config_microdata_special_description; ?></textarea></td>
						</tr>						
					</table>
				</div>				
				<div class="mdp_information">
					<table class="form">
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_page; ?></a></td>
						  <td><?php if ($config_information_page) { ?>
							<label><input type="radio" name="config_information_page" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_information_page" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_information_page" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_information_page" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_breadcrumb; ?></a></td>
						  <td><?php if ($config_information_breadcrumb) { ?>
							<label><input type="radio" name="config_information_breadcrumb" value="1" checked="checked" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_information_breadcrumb" value="0" /><?php echo $text_no; ?></label>
							<?php } else { ?>
							<label><input type="radio" name="config_information_breadcrumb" value="1" /><?php echo $text_yes; ?></label>
							<label><input type="radio" name="config_information_breadcrumb" value="0" checked="checked" /><?php echo $text_no; ?></label>
							<?php } ?></td>
						</tr>						
						<tr>
						  <td><a title="<?php echo $text_info_title; ?>"><?php echo $text_syntax; ?></a></td>
						  <td>
							<select name="config_information_syntax">
								<option value="all" <?php if($config_information_syntax == 'all'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_all; ?></option>
								<option value="ld" <?php if($config_information_syntax == 'ld'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_ld; ?></option>
								<option value="md" <?php if($config_information_syntax == 'md'){ ?>selected="selected"<?php } ?>><?php echo $text_company_syntax_md; ?></option>
							</select>
						  </td>
						</tr>
					</table>
				</div>		
			</div>
		<?php } ?>	
			  
		  </form>
		</div>
	  </div>
	</div>
	<script>
		function sub() {      
			$('#old_microdata_block').slideUp('600');   
		}		
		
		$('#clear_old').click(function(){
 			$.ajax({
				url: 'index.php?route=module/microdatapro/clear_old&token=<?php echo $token; ?>',
				type: 'post',
				dataType: 'json',
				beforeSend: function() {
					$('#clear_old').after("<div class='mpd_load'></div>");
				},
				success: function(succ){
					$('.mpd_load').remove();
					$('#clear_old').text("<?php echo $text_success_removed_old; ?>");
					setTimeout(sub, 5000);
				}
			});			
		});

		$('.mdp_tabs>div').click(function(){
			$('.mdp_tabs>div').removeClass("active");
			$(this).addClass("active");
			$('.mdp_tabs_data>div').hide().removeClass('active');
			$('.'+$(this).attr('id')).fadeIn(200).addClass('active');				
		});
	</script>
<?php echo $footer; ?>