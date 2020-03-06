(function($) {
	"use strict";

	/**
	* Quickview
	**/
	if( $('body').html().match( /sw-quickview-bottom/ ) ){
		var qv_target =  $('.sw-quickview-bottom');
		$(document).on( 'click', 'button[data-type="popup"]', function(){
			var video_url = $(this).data( 'video' );
			qv_target.addClass( 'show loading' );					
			setTimeout(function(){
				qv_target.find( '.quickview-inner' ).append( '<div class="video-wrapper"><iframe width="560" height="390" src="'+ video_url +'" frameborder="0" allowfullscreen></iframe></div>' );	
				qv_target.find( '.quickview-content' ).css( 'margin-top', ( $(window).height() - qv_target.find( '.quickview-content' ).outerHeight() ) /2 );
				qv_target.removeClass( 'loading' );
			}, 1000);
		});
		$(document).on( 'click', 'a[data-type="quickview"]', function(){
			var product_id = $(this).data( 'product_id' ), ajaxurl = quickview_param.ajax_url.replace( '%%endpoint%%', 'bestshop_quickviewproduct' );
			ajaxurl = ajaxurl.replace( '%endpoint%', 'bestshop_quickviewproduct' );
			qv_target.addClass( 'show loading' );
			var data 		= {
				action: 'bestshop_quickviewproduct',
				product_id: product_id,
				
			};
			jQuery.post(ajaxurl, data, function(response) {
				qv_target.find( '.quickview-inner' ).append( response );				
				qv_target.removeClass( 'loading' );
				$( '.quickview-container .product-images' ).each(function(){
					var $id 					= this.id;
					var $rtl 					= $('body').hasClass( 'rtl' );
					var $img_slider 	= $(this).find('.product-responsive');
					var $thumb_slider = $(this).find('.product-responsive-thumbnail' )
					$img_slider.slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						fade: true,
						arrows: false,
						rtl: $rtl,
						asNavFor: $thumb_slider
					});
					$thumb_slider.slick({
						slidesToShow: 5,
						slidesToScroll: 1,
						asNavFor: $img_slider,
						arrows: true,
						focusOnSelect: true,
						rtl: $rtl,
						responsive: [				
						{
							breakpoint: 360,
							settings: {
								slidesToShow: 2    
							}
						}
						]
					});

					var el = $(this);
					setTimeout(function(){
						el.removeClass("loading");
						var height = el.find('.product-responsive').outerHeight();
						var target = el.find( ' .item-video' );
						target.css({'height': height,'padding-top': (height - target.outerHeight())/2 });

						var thumb_height = el.find('.product-responsive-thumbnail' ).outerHeight();
						var thumb_target = el.find( '.item-video-thumb' );
						thumb_target.css({ height: thumb_height,'padding-top':( thumb_height - thumb_target.outerHeight() )/2 });
						qv_target.find( '.quickview-content' ).css( 'margin-top', ( $(window).height() - qv_target.find( '.quickview-content' ).outerHeight() ) /2 );
						var _wpUtilSettings  = quickview_param.wpUtilSettings;
						var woocommerce_params = quickview_param.woocommerce_params;
						var wc_add_to_cart_variation_params = quickview_param.wc_add_to_cart_variation_params;
						$.getScript(quickview_param.add_to_cart);
						$.getScript(quickview_param.woocommerce);
						$.getScript(quickview_param.add_to_cart_variable);
						$.getScript(quickview_param.wp_embed);
						$.getScript(quickview_param.underscore);
						$.getScript(quickview_param.wp_util);
						$.getScript(quickview_param.wc_quantity_increment);
					}, 1000);
				});
				if( $(window).height() > qv_target.find( '.quickview-content' ).outerHeight() ){
					qv_target.find( '.quickview-content' ).css( 'margin-top', ( $(window).height() - qv_target.find( '.quickview-content' ).outerHeight() ) /2 );
				}else{
				qv_target.find( '.quickview-content' ).css({ 'margin-top': '60px' });
				qv_target.find( '.quickview-inner' ).css({'max-height' : $(window).height() - 120, 'overflow-y' : 'auto' });
				}			
			});
		});
		
		$( '.quickview-close' ).on('click', function(){
			qv_target.removeClass( 'show' );
			qv_target.find( '.quickview-inner' ).html('');			
		});
		$(document).on('click', function(e) {			
			var container = qv_target.find( '.quickview-inner' );
			if ( !container.is(e.target) && container.has(e.target).length === 0 && qv_target.find( '.quickview-inner' ).html().length > 0 ){
				qv_target.removeClass( 'show' );
				qv_target.find( '.quickview-inner' ).html('');
			}
		});
	}
})(jQuery);	