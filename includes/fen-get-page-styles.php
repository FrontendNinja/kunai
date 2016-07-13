<?php
/**
* Function get_page_styles($section_options_array)
*
* @param $section_options_array. Options from APF_Fen_OnePager
* @return  string. You need to echo this function.
**/

function get_page_styles($section_options_array, $global_options_array){

  $custom_css = !empty($global_options_array['extra']['ace_css_custom']) ? $global_options_array['extra']['ace_css_custom'] : '';
  $product_cat_bg = !empty($global_options_array['product_cat']['featured_img']) ? 'background-image:url("'.$global_options_array['product_cat']['featured_img'].'");' : '';

  $product_cat_style = !empty($product_cat_bg) ? '.category-header{'.
                          $product_cat_bg.
                        '}' : '';


  $bHasSectionOptions = is_array($section_options_array) || is_object($section_options_array) && !empty($section_options_array);
  if($bHasSectionOptions){
    foreach ( $section_options_array as $key => $section ) :

      $font_size                        = $section['style_font_size'];
      $font_size_xs                     = $section['style_font_size_xs'];

      // General Section Classes
      $style_bg_color                   = !empty($section['style_bg_color']) && $section['style_bg_color'] != 'transparent'                           ? 'background-color:' . $section['style_bg_color'] . ';' : '';
      $style_bg_image                   = !empty($section['style_bg_image']) && $section['info_section_type'] == 1 || is_home() && !empty($section['style_bg_image']) ? 'background-image:url("' . $section['style_bg_image'] . '");' : '';

      // Section Selector Classes
      $style_padding_top                = !empty($section['style_padding'][0])  ? 'padding-top:' . $section['style_padding'][0] . 'px;' : '';
      $style_padding_bottom             = !empty($section['style_padding'][1])  ? 'padding-bottom:' . $section['style_padding'][1] . 'px;' : '';      
      $style_font_size                  = !empty($font_size['size'])            ? 'font-size:'.$font_size['size'].$font_size['unit'].';' : '';
      $style_font_size_xs               = !empty($font_size_xs['size'])         ? 'font-size:'.$font_size_xs['size'].$font_size_xs['unit'].';' : '';
      $style_border_t_color_section_1   = !empty($section['style_border_top_section_1']) && $section['style_border_top_section_1'] != 'transparent'   ? 'border-top-color:' . $section['style_border_top_section_1'] . ';' : '';
      $style_border_t_color_section_2   = !empty($section['style_border_top_section_2']) && $section['style_border_top_section_2'] != 'transparent'   ? 'border-top-color:' . $section['style_border_top_section_2'] . ';' : '';
      $style_bg_image_section_1         = !empty($section['style_bg_image']) && $section['info_section_type'] == 2                                    ? 'background-image:url("' . $section['style_bg_image'] . '");' : '';
      $style_bg_image_section_2         = !empty($section['style_bg_image_2']) && $section['info_section_type'] == 2                                  ? 'background-image:url("' . $section['style_bg_image_2'] . '");' : '';


      $has_styles = !empty($section['info_section_type']) || is_home() && !empty($section['section_title']);

      if($has_styles):

        $section_id                 = '#'.slugify($section['section_title']).'-'.$key;

        if(is_page()){

          // General section: Background image, color, font-size
          $has_any_style_general      = !empty($style_bg_color) || 
                                        !empty($style_font_size) ||
                                        !empty($style_bg_image);

          $style_section_id           = $has_any_style_general ? $section_id.'{'.
                                          $style_bg_color .
                                          $style_bg_image .
                                          $style_font_size .
                                        '}' : '';

          // Only Extra Small Devices: font-size
          $has_any_style_general_xs   = !empty($style_font_size_xs);                              
          $style_section_id_xs = '';
          
          if($has_any_style_general_xs){
            $style_section_id_xs        = '@media (max-width: 768px){';
            $style_section_id_xs          .= $section_id.'{'.
                                              $style_font_size_xs .
                                            '}';
            $style_section_id_xs        .= '}';
          }

          // Section selector: Padding
          $has_any_style_section_selector       = !empty($style_padding_top) ||
                                                  !empty($style_padding_bottom) ||
                                                  !empty($style_border_t_color_section_1) ||
                                                  !empty($style_border_t_color_section_2);

          $style_section_selector               = $has_any_style_section_selector ? $section_id.' section{'.
                                                    $style_padding_top .
                                                    $style_padding_bottom .
                                                    $style_border_t_color_section_1 .
                                                    $style_border_t_color_section_2 .
                                                  '}' : 'false';

          // Section:nth-child 1 : border-top-1, background-image
          $has_any_style_section_1              = !empty($style_border_t_color_section_1) || 
                                                  !empty($style_bg_image_section_1);

          $style_section_selector_1             = $has_any_style_section_1 ? $section_id.' section:nth-child(1){'.
                                                    $style_border_t_color_section_1 .
                                                    $style_bg_image_section_1 .
                                                  '}' : '';

          // Section:nth-child 2 : border-top-2, background-image
          $has_any_style_section_2              = !empty($style_border_t_color_section_2) ||
                                                  !empty($style_bg_image_section_2);

          $style_section_selector_2             = $has_any_style_section_2 ? $section_id.' section:nth-child(2){'.
                                                    $style_border_t_color_section_2 .
                                                    $style_bg_image_section_2 .
                                                  '}' : '';

          $styles .= $style_section_id . $style_section_selector . $style_section_selector_1 . $style_section_selector_2 . $style_section_id_xs;

        }else{
          // is_page() ? Hay que darle sus estilos propios, else: lo actual.


          $homepage_has_any_style_general   =   !empty($style_bg_color) || 
                                                !empty($style_bg_image) || 
                                                !empty($style_padding_top) || 
                                                !empty($style_padding_bottom);

          $homepage_style_section_id    = $homepage_has_any_style_general ? $section_id.'{'.
                                            $style_bg_color .
                                            $style_bg_image .
                                            $style_padding_top .
                                            $style_padding_bottom .
                                          '}' : '';
          
          $styles .= $homepage_style_section_id;
        }
      endif;


    endforeach; 
  }

  $styles .= $custom_css.$product_cat_style;

  return !empty($styles) ? '<style type="text/css">' . $styles . '</style>' : '';

}
