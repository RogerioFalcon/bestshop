(function($) {
	"use strict";
	$(document).ready(function(){
		var MobileSlider = function( $target ) {
			this.$target = $target;
			var _target = $target.find( '.slider' );
			$target.append( '<span class="res-button slick-prev slick-arrow" data-scroll="left"></span><span data-role="none" class="res-button slick-next slick-arrow" data-scroll="right"></span>' );
			$target.find( '.res-button' ).on( 'click', function (){
				var scroll = $(this).data( 'scroll' );
				var wli = $target.find( '.slider > div' ).outerWidth() + 4;
				wli = ( 'left' === scroll ) ? - wli : wli;
				var pos = _target.scrollLeft() + wli;
				_target.animate({scrollLeft: pos}, 200);
			});
		}
		
		$.fn.sw_mobile_scroll = function() {
			new MobileSlider( this );
			return this;
		};
		$( '.responsive-slider' ).each(function(){
			$(this).sw_mobile_scroll();
		});
	});
})(jQuery);