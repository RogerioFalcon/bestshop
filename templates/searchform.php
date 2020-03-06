<form role="search" method="get" class="form-search searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="hide"></label>
  <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-query" placeholder="<?php esc_attr_e( 'Search', 'bestshop' ) ?>">
  <button type="submit" class="fa fa-search button-search-pro form-button"></button>
</form>