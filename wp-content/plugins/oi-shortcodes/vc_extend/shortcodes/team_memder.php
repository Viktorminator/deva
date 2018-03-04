<?php
/*TEAM  MEMBER*/
add_shortcode('vc_team_member', 'vc_team_member_f');
function vc_team_member_f($atts, $content = null) {
	extract(shortcode_atts( array(
	'image'=> get_template_directory_uri().'/assets/img/no_image.png',
	'name'=> 'Jhon Doe',
	'position'=>'My Position In Company',
	'welcome'=>'',
	'fb_url'=>'',
	'tw_url'=>'',
	'gplus_url'=>'',
	'in_url'=>'',
	'mail_url'=>'',
	), $atts));
	
	 if ($fb_url == ''){$fb ='';} else { $fb = '<a class="oi_fb" target="_blank" href="'.$fb_url.'"><i class="fa fa-facebook fa-fw"></i></a>';};
	 if ($tw_url == ''){$tw ='';} else { $tw = '<a class="oi_tw" target="_blank" href="'.$tw_url.'"><i class="fa fa-twitter fa-fw"></i></a>';};
	 if ($gplus_url == ''){$gplus ='';} else { $gplus = '<a target="_blank" class="oi_gplus" href="'.$gplus_url.'"><i class="fa fa-google-plus fa-fw"></i></a>';};
	 if ($in_url == ''){$in ='';} else { $in = '<a class="oi_in" target="_blank" href="'.$in_url.'"><i class="fa fa-linkedin fa-fw"></i></a>';};
	 if ($mail_url == ''){$mail ='';} else { $mail = '<a class="oi_mail" href="mailto:'.$mail_url.'"><i class="fa fa-envelope-o fa-fw"></i></a>';};
	 
 	 if ($welcome == ''){$welcome1 ='';} else { $welcome1 = '<h5><span>'.$welcome.'</span></h5>';};

	 $ulrs = ''.$fb.''.$tw.''.$gplus.''.$in.''.$mail.'';
  	 if (($welcome == '')&& ($ulrs == '')){$main_cont ='';} else { $main_cont = '
	 <div class="oi_mask_holder">
		<div class="oi_mask">
			<div class="oi_team_cont_holder">
					<h6><strong>'.$name.'</strong></h6>
					'.$position.'
					<div class="oi_icons">'.$ulrs.'</div>
			 	</div>
			
		</div>
	</div>';};

	
	 $image_done = wp_get_attachment_image($image,'full img-responsive vc_team_member_image');
	 
	 
	 $code = '<div class="vc_team_member_holder">
	 			<div class="vc_team_member_image_holder">
					<div class="inner_img_holder">
						'.$image_done.'
					</div>
					'.$main_cont.'
				</div>
				
			 </div>';

	return $code;
};

vc_map( array(
   "name" => __("Team Member",'maxcode-pure-portfolio-and-business-theme'),
   "base" => "vc_team_member",
   "class" => "",
   "icon" => "icon-wpb-team_member",
   "admin_enqueue_css" => array(get_template_directory_uri().'/vc_extend/style.css'),
   "category" => __('OI','maxcode-pure-portfolio-and-business-theme'),
   "params" => array(
	  array(
         "type" => "attach_image",
         "class" => "",
         "heading" => __("Member Photo",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "image",
         "value" => __("",'maxcode-pure-portfolio-and-business-theme'),
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Name",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "name",
         "value" => __("Jhon Doe",'maxcode-pure-portfolio-and-business-theme'),
      ),
	  
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Position In Company",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "position",
         "value" => __("My Position In Company",'maxcode-pure-portfolio-and-business-theme'),
         "description" => __("",'maxcode-pure-portfolio-and-business-theme')
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Contact text",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "welcome",
         "value" => __("Text above the icons",'maxcode-pure-portfolio-and-business-theme'),
      ),
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("URL to Facebook page",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "fb_url",
         "value" => __("",'maxcode-pure-portfolio-and-business-theme'),
      ),
	   array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("URL to Twitter page",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "tw_url",
         "value" => __("",'maxcode-pure-portfolio-and-business-theme'),
      ),
	   array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("URL to Google plus page",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "gplus_url",
         "value" => __("",'maxcode-pure-portfolio-and-business-theme'),
      ),
	   array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("URL to LinkedIn page",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "in_url",
         "value" => __("",'maxcode-pure-portfolio-and-business-theme'),
      ),
	  
	   array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("e-mail",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "mail_url",
         "value" => __("",'maxcode-pure-portfolio-and-business-theme'),
      ),

      array(
         "type" => "textarea_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content",'maxcode-pure-portfolio-and-business-theme'),
         "param_name" => "content",
         "value" => __("<p>I am test text block. Click edit button to change this text.</p>",'maxcode-pure-portfolio-and-business-theme'),
         "description" => __('Enter your content.', 'maxcode-pure-portfolio-and-business-theme')
      )
   )
) );

