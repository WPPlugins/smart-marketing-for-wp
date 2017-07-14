<?php 
defined( 'ABSPATH' ) or exit;

$Egoi4WpBuilderObject = new Egoi_For_Wp('');
	
	if( isset($_POST['egoi_wp_createlist']) && (!empty($_POST['egoi_wp_title'])) ) {
	
		$name = $_POST['egoi_wp_title'];
		$lang = $_POST['egoi_wp_lang'];
		$new_list = $Egoi4WpBuilderObject->createList($name,$lang);

		update_option('Egoi4WpBuilderObject',$Egoi4WpBuilderObject);

	}else{
		if( isset($_POST['egoi_wp_createlist']) && (empty($_POST['egoi_wp_title'])) ) {
			echo "<div class='div-error'>Dados Vazios</div>";
		}
	}?>

	<h1 class="logo">Smart Marketing - <?php echo __( 'Lists', 'egoi-for-wp' ); ?></h1>
		<p class="breadcrumbs">
			<span class="prefix"><?php echo __( 'You are here: ', 'egoi-for-wp' ); ?></span>
			<strong>Smart Marketing &rsaquo;
			<span class="current-crumb"><?php echo __( 'Lists', 'egoi-for-wp' ); ?></strong></span>
		</p>
	<hr/>
	<div class='wrap'>
		<div id="icon-egoi-wp-lists" class="icon32"></div>
		<h4><br><?php echo __( 'Your E-goi Account Lists follows below:', 'egoi-for-wp' ); ?></h4>
		
		<?php

			$result = $Egoi4WpBuilderObject->getLists();
			$list_name = '';
			foreach($result as $key_value => $list) {
        		
        		$title = $list->title;
        		//$array .= $list->listnum.' - '.$list->title.' - '.$list->subs_activos.' - '.$list->subs_total.' - '.$list->idioma;
        		$list_name .= $title.' - ';

			}

			$total_lists = count(array_filter(explode(' - ', $list_name)));			
			update_option('Egoi4WpBuilderObject',$Egoi4WpBuilderObject);
				
					$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
					$limit = 10;
					$offset = ( $pagenum - 1 ) * $limit;

					$num_of_pages = ceil( $total_lists / $limit );
					$page_links = paginate_links( array(
					    'base' => add_query_arg( 'pagenum', '%#%' ),
					    'format' => '',
					    'prev_text' => '&laquo;',
					    'next_text' => '&raquo;',
					    'total' => $num_of_pages,
					    'current' => $pagenum
					) );
				?>
				<table border='0' class="widefat striped">
				<thead>
					<tr>
						<th><?php echo _e('List ID', 'egoi-for-wp');?></th>
						<th><?php echo _e('Title', 'egoi-for-wp');?></th>
						<th><?php echo _e('Internal Title', 'egoi-for-wp');?></th>
						<th><?php echo _e('Active Subscribers', 'egoi-for-wp');?></th>
						<th><?php echo _e('Total Subscribers', 'egoi-for-wp');?></th>
						<th><?php echo _e('Language', 'egoi-for-wp');?></th>
						<th><?php echo _e('Edit', 'egoi-for-wp');?></th>
					</tr>
				</thead>
				<?php 

				$index = 1;
				foreach($result as $key_list => $value_list) {
					if($value_list->listnum){
						if($index <= $total_lists){?>
							<tr>
								<td>
									<?php echo $value_list->listnum; ?>
								</td>
								<td>
									<?php echo $value_list->title; ?>
								</td>
								<td>
									<?php echo $value_list->title_ref; ?>
								</td>
								<td>
									<?php echo $value_list->subs_activos; ?>
								</td>
								<td>
									<?php echo $value_list->subs_total; ?>
								</td>
								<td>
									<?php
									
										if(strcmp($value_list->idioma,'pt')==0) { 
											echo "Português (Portugal)";
										} else if(strcmp($value_list->idioma,'br')==0) {
											echo "Português (Brasil)";
										} else if(strcmp($value_list->idioma,'es')==0) {
											echo "Español";
										} else {
											echo "English";
										} ?>
								</td>
								<td>

								<a href="https://bo.e-goi.com/?from=<?php echo urlencode('/?action=lista_definicoes_principal&list='.$value_list->listnum);?>" class='button-primary' target="_blank" />
									<?php _e('Change', 'egoi-for-wp');?>
								</a>
								</td>
							</tr><?php
							
						}
					}

					$index++;
				} ?>
				</table>

				<div class= "tablenav">
					<div class='tablenav-pages' style="margin: 1em 0">
						<?php echo $page_links; ?>
					</div>
				</div>


			<h3><?php echo _e('Create another list', 'egoi-for-wp');?></h3>
			<form name='egoi_wp_createlist_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
				<table class="form-table">
				<tr>
					<th>
						<label for="egoi_wp_title"><?php echo _e('Name', 'egoi-for-wp');?></label>
					</th>
					<td>
						<input type='text' size='60' name='egoi_wp_title' required="required" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="egoi_wp_lang"><?php echo _e('Language', 'egoi-for-wp');?></label>
					</th>
					<td>
						<select name='egoi_wp_lang'>
							<option value='en'><?php echo _e('English', 'egoi-for-wp');?></option>
							<option value='pt'><?php echo _e('Portuguese', 'egoi-for-wp');?></option>
							<option value='br'><?php echo _e('Portuguese (Brasil)', 'egoi-for-wp');?></option>
							<option value='es'><?php echo _e('Spanish', 'egoi-for-wp');?></option>
						</select>
						<p class="help"><?php echo _e('All messages sent to subscribers will be in the language selected for the list E-goi', 'egoi-for-wp');?></p>
					</td>
				</tr>
				<tr>
					<th>
						<input type='submit' class='button-primary' name='egoi_wp_createlist' id='egoi_wp_createlist' value='<?php echo _e('Add', 'egoi-for-wp');?>' />
					</th>
					<td>
					</td>
				</tr>
				</table>
			</form>
	</div>