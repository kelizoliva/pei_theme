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
  $('.block-views-educators-recent-activity-view-added-by-educator-block .dropbutton-wrapper .first a').addClass('crm-popup');3
  $('#crm-main-content-wrapper').addClass('container gutters');
  $('.crm-summary-contactname-block').addClass('col-12 col-xs-10');
  $('.crm-actions-ribbon').addClass('col-12 col-xs-2');
  $('.crm-content-block').addClass('col-12');
  
  // Expanded Activities Add Classes
  // $('.view-expanded-views-activities .fieldset-wrapper').not('.view-expanded-views-activities #edit-filters-date .fieldset-wrapper').not('.view-expanded-views-activities #edit-more-filters-retreat-end-date .fieldset-wrapper').addClass('container gutters content-end items-end');
  // $('.view-expanded-views-activities #edit-filters-date .fieldset-wrapper, .view-expanded-views-activities #edit-more-filters-retreat-end-date .fieldset-wrapper, .view-expanded-views-activities #edit-more-filters-retreat-end-date .fieldset-wrapper').addClass('container content-end items-end');
  // $('.view-expanded-views-activities .fieldset-wrapper #edit-manage-columns-columns').addClass('container gutters content-end items-end');
  // $('.view-expanded-views-activities .sliderfield').addClass('container gutters content-end items-end');
  // $('.view-expanded-views-activities .sliderfield-container').addClass('col-12');
  // $('.view-expanded-views-activities .sliderfield-event-field-container').addClass('col-12 col-xs-6 col-md-4');
  // $('.view-expanded-views-activities .form-item').not('.view-expanded-views-activities fieldset#edit-filters-date .form-item').not('.view-expanded-views-activities fieldset#edit-more-filters-retreat-end-date .form-item').addClass('col-12 col-xs-6 col-md-4');
  // $('.view-expanded-views-activities fieldset#edit-filters-date').addClass('col-12 col-sm-8');
  // $('.view-expanded-views-activities fieldset#edit-more-filters-retreat-end-date').addClass('col-12 col-sm-8');
  // $('.view-expanded-views-activities fieldset#edit-filters-date .form-item').addClass('col-12 col-xs-6');
  // $('.view-expanded-views-activities fieldset#edit-more-filters-retreat-end-date .form-item').addClass('col-12 col-xs-6');
  // Expanded activities element changes
  // $('#pei-activities-form #edit-apply, #pei-activities-form #edit-reset, #pei-activities-form #edit-export').wrapAll('<div class="form-action-buttons"></div>');

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
    //if(current.indexOf('/teencouncil/') = -1){
    //    $('.navigation.dashboard').addClass('active');
    //    $('.navigation.dashboard .nav-caption').addClass('active').prependTo('.l-main');
    //}
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
  // CiviCRM modal override auto-sizing
  $(document).on('dialogopen', function(e) {
    var $elem = $(e.target);
    var $elemParent = $elem.parent();

    if ($elemParent.hasClass('crm-container') && $elem.dialog('option', 'resizable')) {
      $('.crm-dialog-titlebar-resize', $elemParent).trigger('click');
    }
    $( document ).ajaxComplete(function() {
      $('.ui-dialog.crm-container form').addClass('container gutters');
      $('.ui-dialog.crm-container form .crm-section').slice(1).addClass('col-6');
      $('.ui-dialog.crm-container form .crm-section').first().addClass('col-12');
    });
  });

})(CRM.$);

