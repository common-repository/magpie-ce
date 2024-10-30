<?php

global $wecpi_config;
global $local_wecpi_config;

$NEWLINE   = array("\r\n", "\n", "\r");

$magpie_standard = array("type"=>"text","legal"=>true);
$magpie_noinput  = array("type"=>"text","legal"=>false);
$magpie_textarea = array("type"=>"textarea","legal"=>true);
$magpie_select = array("type"=>"select","legal"=>true);
$magpie_pulldown = array("type"=>"pulldown","legal"=>true);
$magpie_image = array("type"=>"_thumbnail_id","legal"=>true);
$magpie_categories = array("type"=>"categories","legal"=>true);

$sort_order= array(
"_thumbnail_id"=>array("input"=>$magpie_image,"balloon"=>"Click the thumbnail and select a new image in the drop down menu."),
//"product_file"=>array("input"=>$magpie_image,"balloon"=>"Click the thumbnail and select a new image in the drop down menu."),
"ID"=>array("input"=>$magpie_noinput,"balloon"=>"id numbers are internal post id's and can not be edited"),
"post_title"=>array("input"=>$magpie_standard,"balloon"=>"Name of your product"),
"post_content"=>array("input"=>$magpie_textarea,"balloon"=>"The description and main text of your product. HTML tags allowed - use any formatting."),
"post_excerpt"=>array("input"=>$magpie_textarea,"balloon"=>"Used as excerpt in some themes. HTML tags also allowed."),
"post_status"=>array("input"=>$magpie_pulldown,"value"=>get_post_statuses(),"balloon"=>"Set to publish or draft. Draft will not be available online."),
"_wpsc_price"=>array("input"=>$magpie_standard,"balloon"=>"The price of your product."),
"_wpsc_sku"=>array("input"=>$magpie_standard,"balloon"=>"Stock Keeping Unit name/number. Keep it unique."),
"_wpsc_stock"=>array("input"=>$magpie_standard,"balloon"=>"The ammount you have on stock."),
"_wpsc_is_donation"=>array("input"=>$magpie_select,"value"=>array("Yes","No"),"balloon"=>"Set to yes if donation."),
"_wpsc_special_price"=>array("input"=>$magpie_standard,"balloon"=>"Special lowered rebate price (if any)."),
"product_tag"=>array("input"=>$magpie_standard,"balloon"=>"List your tags with a comma."),
"wpsc_product_category"=>array("input"=>$magpie_categories,"balloon"=>"Select as many categories as you like."),
"wpsc-variation"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
//"quantity_limited"=>array("input"=>$magpie_select,"value"=>array("Yes","No"),"balloon"=>"Click thumbnail to select new image"), /*_wpsc_limited_stock*/
"_wpsc_limited_stock"=>array("input"=>$magpie_select,"value"=>array("Yes","No"),"balloon"=>"Click thumbnail to select new image"), /*_wpsc_limited_stock*/
"image"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"image_url"=>array($magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"unpublish_when_none_left"=>array("input"=>$magpie_select,"value"=>array("Yes","No"),"balloon"=>"Click thumbnail to select new image"),
"custom_meta"=>array("input"=>$magpie_textarea,"balloon"=>"Click thumbnail to select new image"),
"external_link"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"external_link_text"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"external_link_target"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"weight"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"weight_unit"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"dimensions"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"shipping"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"table_rate_price"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
/*"height"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"height_unit"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"width"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"width_unit"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"length"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"length_unit"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"local"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"international"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
*/"no_shipping"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"merchant_notes"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"engraved"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"can_have_uploaded_image"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"enable_comments"=>array("input"=>$magpie_select,"value"=>array("Yes","No"),"balloon"=>"Click thumbnail to select new image"),
"special"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"display_weight_as"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"table_price"=>array("input"=>$magpie_textarea,"balloon"=>"Click thumbnail to select new image"),
"google_prohibited"=>array("input"=>$magpie_select,"value"=>array("Yes","No"),"balloon"=>"Click thumbnail to select new image"),
"_edit_lock"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"_edit_last"=>array($magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"_wpsc_currency"=>array("input"=>$magpie_textarea,"balloon"=>"Click thumbnail to select new image"),
"wpec_taxes_taxable_amount"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"post_author"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_date"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_date_gmt"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"comment_status"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"ping_status"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_password"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"), 
"to_ping"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),
"pinged"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_modified"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_modified_gmt"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_content_filtered"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_parent"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"guid"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"menu_order"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_type"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"post_mime_type"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"comment_count"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image"),	
"filter"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image")
//"custom_meta"=>array("input"=>$magpie_standard,"balloon"=>"Click thumbnail to select new image")
);

$inmeta = array(
"_wpsc_price"=>"",
"_wpsc_special_price"=>"",
"_wpsc_sku"=>"",
"_wpsc_stock"=>"",
"_wpsc_limited_stock"=>"",
//"_wpsc_product_metadata"=>"",
"_wpsc_is_donation"=>"",
"_wpsc_currency"=>"",
"_thumbnail_id"=>"",
"product_file"=>"",
"_edit_lock"=>"",
"_edit_last"=>""
//"custom_meta"=>""
);

/*
$inmeta=array(
"_wpsc_price"=>"",
"_wpsc_special_price"=>"",
"_wpsc_sku"=>"",
"_wpsc_is_donation"=>"",
"_wpsc_stock"=>"",
//"_wpsc_limited_stock"=>"",
//*"_wpsc_product_metadata"=>"",
"_wpsc_currency"=>"",
//"_thumbnail_id"=>"",
"_edit_lock"=>"",
"_edit_last"=>"");
*/

global $magpie_date_time;
$magpie_date_time=array(
"post_date"=>"",
"post_date_gmt"=>"",
"post_modified"=>"",
"post_modified_gmt"=>"");

$wpsc_meta=array(
"_wpsc_product_metadata"=>"");

$not_this_meta=array(
"_wpsc_product_metadata"=>"",
"_thumbnail_id"=>"");

//$in_all_meta = $inmeta+$inmeta2;
global $taxonomies;
$taxonomies = get_object_taxonomies('wpsc-product');//,'names','objects');

global $import_bulk;
global $export_bulk;

//$taxonomies = get_taxonomies('','names');
