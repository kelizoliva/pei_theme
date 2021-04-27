Backdrop.behaviors.base = {
  attach: function(context, settings) {
    $(function () {
      // search bar
      $('#search-bar-box input').on('change', function() {
        var value = $.trim($(this).val());
        $(this).toggleClass('filled-background', value.length !== 0);
      }).change();
      // Add modal
      $('.modal .toggle').bind("click", function(e){
          $(this).parent().toggleClass('open');
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
});