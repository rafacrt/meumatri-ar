<?php
/* Template Name: Nature*/
if (!is_main_site()) {
  get_template_part('header-subsite');
} else {
  get_template_part('header');
}
?>
<input type="hidden" class="current_template" name="current_template" value="<?php echo basename(get_page_template()); ?>">

<?php
get_template_part('template-parts/nature/hero');
get_template_part('template-parts/all-templates/description',null ,'nature');
get_template_part('template-parts/all-templates/countdown',null ,'nature');
get_template_part('template-parts/all-templates/the-couple',null ,'nature');
get_template_part('template-parts/all-templates/ceremony',null ,'nature');
get_template_part('template-parts/all-templates/gift-list',null ,'nature');
get_template_part('template-parts/all-templates/tips',null ,'nature');
get_template_part('template-parts/all-templates/presence-forms',null ,'nature');

if(!wp_is_mobile(  )):
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {

function handleDragStart(e) {
  this.style.opacity = '0.4';

  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragEnd(e) {
  this.style.opacity = '1';

  items.forEach(function (item) {
    item.classList.remove('over');
  });
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault();
  }

  return false;
}

function handleDragEnter(e) {
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over');
}

function handleDrop(e) {
  e.stopPropagation();

  if (dragSrcEl !== this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }

  return false;
}

let items = document.querySelectorAll('main section');
items.forEach(function(item) {
  item.addEventListener('dragstart', handleDragStart);
  item.addEventListener('dragover', handleDragOver);
  item.addEventListener('dragenter', handleDragEnter);
  item.addEventListener('dragleave', handleDragLeave);
  item.addEventListener('dragend', handleDragEnd);
  item.addEventListener('drop', handleDrop);
});
});
</script>
<?php
endif;
get_footer();