<div class="search-box">
  <form method="get" action="<?php bloginfo('url'); ?>/">
   <fieldset> <input type="text" size="15" class="search-field" name="s" id="s" value="<?php _e('Search..','highthemes'); ?>" onfocus="if(this.value == '<?php _e('Search..','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search..','highthemes'); ?>';}"/>
    <input type="submit"  value="search" class="search-go" />
    </fieldset>
  </form>
</div>