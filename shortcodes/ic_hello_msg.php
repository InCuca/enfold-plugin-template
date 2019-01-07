<?php
error_log(class_exists( 'ic_hello_msg' ));

if ( !class_exists( 'ic_hello_msg' ) ) {
    class ic_hello_msg extends aviaShortcodeTemplate
	{
		function shortcode_insert_button()
		{
			// Configure shortcode
			$this->config['name']		= 'Hello';
			$this->config['icon']		= plugin_dir_url(__FILE__) . '../images/hello_msg.png';
			$this->config['target']		= 'avia-target-insert';
			$this->config['shortcode'] 	= 'ic_hello_msg';
			$this->config['tooltip'] 	= 'Exibe uma mensagem de olá';
			$this->config['preview'] 	= false;
		}

		function popup_elements()
		{
			// Set admin popup elements
			$this->elements = array(
				array(
					"name" => "Mensagem",
					"desc" => "Qual a mensagem?",
					"id" => "message",
					"type" => "input",
				),
			);
		}

		function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
		{
			// Get options from admin popup
			$atts = shortcode_atts(array(
				'class'	=> $meta['el_class'],
				'custom_class' => '',
				'custom_markup' => $meta['custom_markup'],
				'message' => 'Empty Hello',
			), $atts, $this->config['shortcode']);

			/*
			 * Creates $class, $custom_class, $custom_markup, $message
			 */
			extract($atts);
			$custom_class = $custom_class?" $custom_class":"";

			ob_start();
			?>
			<div class="ic-hello-msg-container<?php echo $custom_class; ?>">
				<?php echo $message; ?>
			</div>
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
}