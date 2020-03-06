(function($) {
	$(document).ready(function(){
		/*
		 *
		 * Bestshop_Options_upload function
		 * Adds media upload functionality to the page
		 *
		 */
		 
		var header_clicked = false;
		 
		$("img[src='']").attr("src", bestshop_upload.url);
		
		$('.bestshop-menu-upload').on('click', function() {
			header_clicked = true;
			formfield = $(this).attr('rel-id');
			preview = $(this).prev('img');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});
		
		$('.bestshop-opts-upload').on('click',function() {
			header_clicked = true;
			formfield = $(this).attr('rel-id');
			preview = $(this).prev('img');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});
		
		
		// Store original function
		window.original_send_to_editor = window.send_to_editor;
		
		
		window.send_to_editor = function(html) {
			if (header_clicked) {
				if ($('img', html).attr('src')) {
					imgurl = $('img', html).attr('src');
				} else imgurl = $(html).attr('src');
				
				$('#' + formfield).val(imgurl);
				$('#' + formfield).next().fadeIn('slow');
				$('#' + formfield).next().next().fadeOut('slow');
				$('#' + formfield).next().next().next().fadeIn('slow');
				$(preview).attr('src' , imgurl);
				tb_remove();
				header_clicked = false;
			} else {
				window.original_send_to_editor(html);
			}
		}
		$('.bestshop-opts-upload-remove').on('click',function(){
			$relid = $(this).attr('rel-id');
			$('#'+$relid).val('');
			$(this).prev().fadeIn('fast');
			$(this).prev().prev().fadeOut('fast', function(){jQuery(this).attr("src", bestshop_upload.url);});
			$(this).fadeOut('slow');
		});
		
		$('.bestshop-menu-upload-remove').on('click', function(){
			$relid = $(this).attr('rel-id');
			$('#'+$relid).val('');
			$(this).prev().fadeIn('fast');
			$(this).prev().prev().fadeOut('fast', function(){$(this).attr("src", bestshop_upload.url);});
			$(this).fadeOut('slow');
		});
	});
	function MenuClick(){
		$('.menu-advance-href').on('click', function(){
			$(this).parent().find('.menu-config-content').slideToggle();
		});
	}
	$(document).ready(function(){
		MenuClick();
	});
}(jQuery));