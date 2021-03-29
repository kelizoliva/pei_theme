Backdrop.behaviors.base = {
  attach: function(context, settings) {
    $(function () {
      $('.block-system-user-menu .menu-tree').wrap( "<div class='welcome'>Welcome, NAME</div>" );
    });
  }
};