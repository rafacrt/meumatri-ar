<?php
/* Template Name: Classic*/
if (!is_main_site()) {
  get_template_part('header-subsite');
} else {
  get_template_part('header');
}
?>
<input type="hidden" class="current_template" name="current_template" value="<?php echo basename(get_page_template()); ?>">
<?php
get_template_part('template-parts/classic/hero');
get_template_part('template-parts/all-templates/description', null, 'classic');
get_template_part('template-parts/all-templates/countdown', null, 'classic');
get_template_part('template-parts/all-templates/the-couple', null, 'classic');
get_template_part('template-parts/all-templates/ceremony', null, 'classic');
get_template_part('template-parts/all-templates/gift-list', null, 'classic');
get_template_part('template-parts/all-templates/tips', null, 'classic');
get_template_part('template-parts/all-templates/presence-forms', null, 'classic');



if (!wp_is_mobile()):
  ?>
  <style>
    section:not(:first-child) {

      border: 3px solid #666;
      border-radius: .5em;
      padding: 10px;
      cursor: move;
    }

    section.over {
      border: 3px dotted #666;
    }
  </style>

  <?php
endif;
get_footer();
?>
