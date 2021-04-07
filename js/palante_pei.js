Backdrop.behaviors.base = {
  attach: function(context, settings) {
    $(function () {
      $('#search-bar-box input').on('change', function() {
        var value = $.trim($(this).val());
        $(this).toggleClass('filled-background', value.length !== 0);
      }).change();
      $('.block-system-user-menu .menu-tree').wrap( '<div class="welcome">Welcome <span class="caret"></span></div>' );
      $('.modal .toggle').bind("click", function(e){
          $(this).parent().toggleClass('open');
      });
      $('.add-activity h2').bind("click", function(e){
          $(this).siblings('ul').toggleClass('open');
      });
      $(document).on("click", function(event){
        if(!$(event.target).closest(".modal").length){
            $('.modal').removeClass('open');
            $('.modal, .add-activity ul').removeClass('open');
        }
      });
      // Accordion header buttons
      $('.views-accordion-header .actions a').click(function () {
        self.location.href = $(this).attr("href");
        return false;
      });
      $('.ui-accordion-content').addClass('container gutters').css("display", "flex");

    });
  }
};