<?php 
/*DROPCAP*/
add_shortcode('oi_console_text', 'oi_console_text_f');
function oi_console_text_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'oi_text' => "'Brand new agency.', 'Creative Company.', 'Innovations & Inspirations.'",
		), $atts)
	);
	$output ="
	<h1 class='oi_legend console-container'><span id='text'></span><span id='console' class='console-underscore'>_</span></h1>
	<script>
	jQuery.noConflict()(function($){
	'use strict';
		function consoleText(words, id, colors) {
		  if (colors === undefined) colors = ['#000'];
		  var visible = true;
		  var con = document.getElementById('console');
		  var letterCount = 1;
		  var x = 1;
		  var waiting = false;
		  var target = document.getElementById(id)
		  window.setInterval(function() {
			if (letterCount === 0 && waiting === false) {
			  waiting = true;
			  target.innerHTML = words[0].substring(0, letterCount)
			  window.setTimeout(function() {
				var usedColor = colors.shift();
				colors.push(usedColor);
				var usedWord = words.shift();
				//words.push(usedWord);
				x = 1;
				target.setAttribute('style', 'color:' + colors[0])
				letterCount += x;
				waiting = false;
			  }, 0)
			} else if (letterCount === words[0].length + 1 && waiting === false && words.length>1) {
			  waiting = true;
			  window.setTimeout(function() {
				x = -1;
				letterCount += x;
				waiting = false;
			  }, 2000)
			 
			} else if (waiting === false) {
			  target.innerHTML = words[0].substring(0, letterCount)
			  letterCount += x;
			}
			if(words.length=='1' && words[0].length ==letterCount){
				$('#console').addClass('oi_conosle_done')
				$('#text').addClass('oi_conosle_done_text')
			}
		  }, 60)
		  
		  	 window.setInterval(function() {
				  if(!$('#console').hasClass('oi_conosle_done')){
				if (visible === true) {
				  con.className = 'console-underscore oi_hidden'
				  visible = false;
				} else {
				  con.className = 'console-underscore'
				  visible = true;
				}
			  }
			  }, 400)
			
			 
		}
		$(window).load(function() {consoleText([".$oi_text."], 'text', ['#000']);});
	});
	</script>
	";
	return $output;
};

/*DROPCAP*/
vc_map( array(
	"name" => __("Console Text",'maxcode-pure-portfolio-and-business-theme'),
	"base" => "oi_console_text",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_dropcap",
	"category" => __('OI','maxcode-pure-portfolio-and-business-theme'), 
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_text",
			"heading" => __("Letter", "orangeidea"),
			"value" => "'Brand new agency.', 'Creative Company.', 'Innovations & Inspirations.'",
		),
	)
) );


