
<form role="search" method="get" id="searchform" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <div class="form-floating ms-3 me-3 ms-lg-0 me-lg-3">
        <input type="search" class="form-control" placeholder="Search" value="<?php echo get_search_query() ?>" name="s" title="Search" />
        <label for="s" class="secondary-text"> <i class="fas fa-search"></i> <?php echo pll_e('Buscar'); ?></label>
        <input type="hidden" name="post_type" value="post" />
    </div>
    <!-- <input type="submit" id="searchsubmit" value="Search" /> -->
</form>