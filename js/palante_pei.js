Backdrop.behaviors.base = {
  attach: function(context, settings) {
    $(function () {
      // search bar
      $('#search-bar-box input').on('change', function() {
        var value = $.trim($(this).val());
        $(this).toggleClass('filled-background', value.length !== 0);
      }).change();
      // Add button modal
      $('.modal .toggle, .modal a').bind("click", function(e){
          $('.modal .toggle').parent().toggleClass('open');
          $('.add-activity ul, .add-activity span.caret').removeClass('open');
      });
      $('.add-activity h2, .add-activity span.caret').bind("click", function(e){
          $(this).siblings('ul').toggleClass('open');
          $('.add-activity span.caret').toggleClass('open');
      });
      $(document).on("click", function(event){
        if(!$(event.target).closest(".modal").length){
            $('.modal').removeClass('open');
            $('.modal, .add-activity ul, .add-activity span.caret').removeClass('open');
        }
      });
      // Accordion header buttons
      $('.views-accordion-header .actions a').click(function () {
        self.location.href = $(this).attr("href");
        return false;
      });
    });
  }
};

$(window).on('load', function (e) {
  $('.block-system-user-menu .menu-tree').wrap( '<div class="welcome top-padding-10 bottom-padding-10">Welcome <span class="caret"></span></div>' );
  $('.summary .ui-accordion-content').addClass('container');
  $('.summary .views-view-accordion').addClass('col-12');
  $('.block-views-educators-recent-activity-view-added-by-educator-block .dropbutton-wrapper .first a').addClass('crm-popup');
  // Wrapping data in statistics   
  var rex = new RegExp("([0-9]+\.?[0-9]+)", "gm");
  
  $(".aggregate-activity .views-field-expression-1 span").each(function(){
      $(this).wrap('<div>');
      var $this = $(this);
      var content = $this.html();
      $this.html(content.replace(rex, "<span>$1</span>"));
  });
});

(function ($) {
  // CiviCRM modal override auto-sizing
  $(document).on('dialogopen', function(e) {
    var $elem = $(e.target);
    var $elemParent = $elem.parent();

    if ($elemParent.hasClass('crm-container') && $elem.dialog('option', 'resizable')) {
      $('.crm-dialog-titlebar-resize', $elemParent).trigger('click');
    }
    $( document ).ajaxComplete(function() {
      $('.ui-dialog.crm-container form').addClass('container gutters');
      $('.ui-dialog.crm-container form .crm-section').addClass('col-6');
    });
  });
})(CRM.$);

