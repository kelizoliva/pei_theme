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

      // Reports button modal
      if($(".saved-reports-toggle").length==0) {
        $('<div class="saved-reports-toggle">').insertBefore('.saved-reports');
      }
      $('.saved-reports, .saved-reports-toggle').wrapAll('<div class="saved-reports-container"></div>');

      $('#toggle_saved_reports, .saved-reports-toggle').unbind().bind("click", function(e) {
        e.preventDefault();
        $('.saved-reports').animate({
          width: "toggle"
        }, 1000 );
        var ajaxView = getAjaxViewSelector('saved_reports');
        // $(ajaxView).triggerHandler('RefreshView');
      });

      // Reports
      $('#open-save').bind('click', function() {
        $('#open-save').toggleClass('hide');
        $('#report_title').toggleClass('hide');
        $('#report_title .form-text').animate({
          width: 'toggle'
        }, 1000 );
        $('.save_report').toggleClass('hide');
      });

      // Accordion header buttons
      $('.views-accordion-header .actions a').click(function () {
        self.location.href = $(this).attr("href");
        return false;
      });

      // Retrieves the AJAX selector for a view by its view name
      var getAjaxViewSelector = function(needle) {
        for(var viewName in Backdrop.settings.views.ajaxViews) {
          if(Backdrop.settings.views.ajaxViews[viewName].view_name == needle) {
            return '.view-dom-id-' + Backdrop.settings.views.ajaxViews[viewName].view_dom_id;
          }
        }
      };
    });
  }
};

$(window).on('load', function (e) {
  $('.block-system-user-menu .menu-tree').wrap( '<div class="welcome top-padding-10 bottom-padding-10">Welcome <span class="caret"></span></div>' );
  $('.summary .ui-accordion-content').addClass('container');
  $('.summary .views-view-accordion').addClass('col-12');
  $('.block-views-educators-recent-activity-view-added-by-educator-block .dropbutton-wrapper .first a').addClass('crm-popup');3
  $('#crm-main-content-wrapper').addClass('container');
  $('.crm-summary-contactname-block').addClass('col-12 col-sm-7 col-md-12 col-lg-7');
  $('.crm-actions-ribbon').addClass('col-12 col-sm-5 col-md-12 col-lg-5');
  $('.crm-content-block').addClass('col-12 col-lg-10');

  // CiviCRM screen view overrides
  $('.civicrm .view-member-statistics .views-row').addClass('container gutters');
  $('.civicrm .view-member-stats .views-row').addClass('container gutters');
  $('.civicrm .view-member-statistics .views-row .views-field-activity-type').addClass('col-12');
  $('.civicrm .view-member-stats .views-row .views-field-activity-type').addClass('col-12');

  // Backdrop User Page overrides
  $('article.profile').addClass('container gutters col-12');
  $('article.profile .form-item').first().addClass('col-12');
  $('article.profile .form-item').slice(1).addClass('col-12 col-xs-6 col-md-4');

  // Navigation Captions
  $(function(){
    var current = location.pathname;
    $('.navigation a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href') === current ){
            $this.parents('.navigation').addClass('active');
            $this.parents('.navigation').find('.nav-caption').addClass('active').prependTo('.l-main');
        }
    })
  })

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
  // CiviCRM modal overrides
  $(document).on('dialogopen', function(e) {
    var $elem = $(e.target);
    var $elemParent = $elem.parent();

    if ($elemParent.hasClass('crm-container') && $elem.dialog('option', 'resizable')) {
      $('.crm-dialog-titlebar-resize', $elemParent).trigger('click');
    }
    $( document ).ajaxComplete(function() {
      $('.ui-dialog.crm-container form').addClass('container gutters');
      $('.ui-dialog.crm-container form .crm-section').slice(1).addClass('col-12 col-xs-6');
      $('.ui-dialog.crm-container form .crm-section').first().addClass('col-12');
      // Help Text
      $('.ui-dialog.crm-container .help').wrapInner( '<p></p>' );
      $('.ui-dialog.crm-container .help').prepend('<div class="hicon">&#63;</div>');
      $('.ui-dialog.crm-container .content').append(function() {
        return $(this).siblings('.help');
      });
      $('.ui-dialog.crm-container .help .hicon').on('click',function(){
        if($('.ui-dialog.crm-container .help p:visible').length)
          $('.ui-dialog.crm-container .help p').hide("slide", { direction: "up" }, 1000);
        else
          $('.ui-dialog.crm-container .help p').show("slide", { direction: "up" }, 1000);
      });
      $(document).on("click", function(event){
        if(!$(event.target).closest(".ui-dialog.crm-container .help .hicon").length){
            $('.ui-dialog.crm-container .help p').hide("slide", { direction: "up" }, 1000);
        }
      });
    });
  });
  // CiviCRM Reload parent after dialog form submits
    $(document).on('dialogclose', function(e) {
      if(!$('body').is('.view-name-expanded_views')){
        setTimeout(function(){// wait for 5 secs(2)
          location.reload(); // then reload the page.(3)
        }, 500);
      }
    });

})(CRM.$);

