/**
 * 
 * Overflow Menu Plugin
 *
 * @version 1.0.0
 * 
 */
(function($) {    
    $.fn.swMenu=function(){return this.each(function(){var t,d,e,n=$(this);function i(i){t,$.when(i.find(".sw-menu > li").appendTo(i)).done(function(){var n;$.when((n=i,void n.each(function(){$(this).html($(this).find(" > li").sort(function(n,i){return $(i).data("index")<$(n).data("index")?1:-1}))}))).done(function(){o(i)})})}function o(i){d=i.outerWidth(!0),e=i.find("li.sw-dropdown").outerWidth(!0),i.find(".sw-dropdown > a").removeAttr("href"),i.find('> li:not(".sw-dropdown")').each(function(n){if(e+=$(this).outerWidth(!0),d<e)return function(n,i,d){for(x=i;x<=t;x++)n.find(' > li:not(".sw-dropdown")[data-index="'+x+'"]').appendTo(n.find(".sw-menu"))}(i,n),i.find(".sw-dropdown").show(),!1;i.find(".sw-dropdown").hide()}),i.css("visibility","visible")}!function(n){n.wrap("<div class='sw-container'></div>").css("visibility","hidden"),n.find("li.sw-dropdown").length||n.append('<li style="display:none" class="dropdown sw-dropdown"></li>').find("li.sw-dropdown").append('<a href="#" class="item-link"><span class="have-title"><span class="menu-title">'+menu_text.more_text+"</span></span></a>").append('<ul class="dropdown-menu dropdown-menu-center sw-menu"></ul>');n.find(" > li").each(function(n){$(this).attr("data-index",n)}),t=n.find("> li").length,index=t-1,o(n)}(n),$(window).resize(function(){i(n)})})};
	if( menu_text.more_menu && !($('#header').hasClass('header-style4') ) ){
		$( '.primary-menu ul.nav' ).swMenu();
	}
	$( '.footer-mstyle2 ul.menu-footer' ).swMenu();
})(jQuery);
