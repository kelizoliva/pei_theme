<?php

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Adds grid classes, theme overrides, and processors to form elements.
 * Some classes can be added directly to form elements, but the rest need theme overrides and custom processors.
 */
function pei_theme_form_pei_activities_form_alter(&$form, &$form_state) {

  $filter_wrapper_class = 'col-12 col-xs-6 col-md-4';
  $slider_class = 'col-11';
  $date_class = 'col-11 col-xs-6';

  $form['#attributes']['class'][] = 'container';

  $form['filters']['#theme_wrappers'] = array('pei_activities_form_fieldset');

  $form['filters']['activity_type']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['filters']['teen_councils']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['filters']['teen_council_states']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['filters']['member_name']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['filters']['date']['#name'] = 'date';
  $form['filters']['date']['#theme_wrappers'] = array('pei_activities_form_fieldset');
  $form['filters']['date']['from']['#wrapper_attributes']['class'][] = $date_class;
  $form['filters']['date']['to']['#wrapper_attributes']['class'][] = $date_class;

  $form['more_filters']['#theme_wrappers'] = array('pei_activities_form_fieldset');

  $form['more_filters']['hours']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['hours']['#attributes']['class'][] = $slider_class;
  $form['more_filters']['hours']['#process'] = array('pei_activities_form_sliderfield_element_sliderfield_structure');

  $form['more_filters']['school_name']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  if(isset($form['more_filters']['people_reached'])) {
    $form['more_filters']['people_reached']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
    $form['more_filters']['people_reached']['#attributes']['class'][] = $slider_class;
    $form['more_filters']['people_reached']['#process'] = array('pei_activities_form_sliderfield_element_sliderfield_structure');
  }
  $form['more_filters']['audience_age']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  if(isset($form['more_filters']['conversations'])) {
    $form['more_filters']['conversations']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
    $form['more_filters']['conversations']['#attributes']['class'][] = $slider_class;
    $form['more_filters']['conversations']['#process'] = array('pei_activities_form_sliderfield_element_sliderfield_structure');
  }
  if(isset($form['more_filters']['training_topic'])) {
    $form['more_filters']['training_topic']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  if(isset($form['more_filters']['other_training_topic'])) {
    $form['more_filters']['other_training_topic']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  if(isset($form['more_filters']['retreat_hours_type'])) {
    $form['more_filters']['retreat_hours_type']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  if(isset($form['more_filters']['retreat_content_topic'])) {
    $form['more_filters']['retreat_content_topic']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  if(isset($form['more_filters']['other_retreat_content_topic'])) {
    $form['more_filters']['other_retreat_content_topic']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  if(isset($form['more_filters']['retreat_end_date'])) {
    $form['more_filters']['retreat_end_date']['#name'] = 'retreat_end_date';
    $form['more_filters']['retreat_end_date']['#theme_wrappers'] = array('pei_activities_form_fieldset');
    $form['more_filters']['retreat_end_date']['from']['#wrapper_attributes']['class'][] = $date_class;
    $form['more_filters']['retreat_end_date']['to']['#wrapper_attributes']['class'][] = $date_class;
  }
  $form['more_filters']['pei_lesson_use']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  if(isset($form['more_filters']['presentation_informal_education_topic'])) {
    $form['more_filters']['presentation_informal_education_topic']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  if(isset($form['more_filters']['other_presentation_informal_education_topic'])) {
    $form['more_filters']['other_presentation_informal_education_topic']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  }
  $form['more_filters']['attendance']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['manage_columns']['#theme_wrappers'] = array('pei_activities_form_fieldset');

  $form['manage_columns']['columns']['#attributes']['class'][] = 'container gutters content-end items-end';
  $form['manage_columns']['columns']['#process'] = array('pei_activities_form_process_checkboxes');
  $form['manage_columns']['display_results_as']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['manage_columns']['show']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['action_buttons']['#attributes']['class'][] = 'form-action-buttons';
}

/**
 * Impelements hook_pei_activities_form_fieldset().
 *
 * Overrides theme_fieldset() to add grid classes where needed.
 */
function pei_theme_pei_activities_form_fieldset($variables) {
  $element = $variables['element'];
//  dpm($element);
//  dpm($element['#name']);
  element_set_attributes($element, array('id'));

  $classes = array('form-wrapper col-12 col-xs-6 col-md-4');



  _form_set_class($element, $classes);

  $output = '<fieldset' . backdrop_attributes($element['#attributes']) . '>';
  if (!empty($element['#title'])) {
    // Always wrap fieldset legends in a SPAN for CSS positioning.
    $output .= '<legend><span class="fieldset-legend">' . $element['#title'] . '</span></legend>';
  }

  // Add custom grid classes to fieldset-wrapper div.
  if(strpos($element['#name'], 'date') !== false) {
    $output .= '<div class="fieldset-wrapper container content-end items-end">';
  } else {
    $output .= '<div class="fieldset-wrapper container gutters content-end items-end">';
  }

  if (!empty($element['#description'])) {
    $output .= '<div class="fieldset-description">' . $element['#description'] . '</div>';
  }
  $output .= $element['#children'];
  if (isset($element['#value'])) {
    $output .= $element['#value'];
  }
  $output .= '</div>';
  $output .= "</fieldset>\n";
  return $output;
}

/**
 * Overrides _sliderfield_element_sliderfield_structure().
 *
 * Adds grid classes to slider elements.
 */
function pei_activities_form_sliderfield_element_sliderfield_structure($element, &$form_state) {
  $element['#tree'] = TRUE;
  /*
  $values = NULL;
  $input = NULL;
  if (isset($form_state['values'])) {
    $values = backdrop_array_get_nested_value($form_state['values'], $element['#parents']);
    $input = backdrop_array_get_nested_value($form_state['input'], $element['#parents']);
  }
  */

  if (is_array($element['#value'])) {
    $value = isset($element['#value']['value']) ? $element['#value']['value'] : NULL;
    $value2 = isset($element['#value']['value2']) ? $element['#value']['value2'] : NULL;
  } else {
    $value = $element['#value'];
    $value2 = NULL;
  }

  if ($element['#display_inside_fieldset']) {
    $element['slider'] = array(
      '#type'             => 'fieldset',
      '#title'    => $element['#title']
    );
  } elseif ($element['#title']) {
    $element['slider'] = array(
      '#type' => 'container'
    );
    /*
    $element['slider']['title'] = array(
      '#type'             => 'item',
      '#markup'    => '<label>' . $element['#title'] . '</label>'
    );
    */
  }

  if (!is_null($value) && $value !== '') {
    if ($value < $element['#min']) {
      $value = $element['#min'];
    }
    if ($value > $element['#max']) {
      $value = $element['#max'];
    }
  }
  $values = array();
  $values[] = $value;

  $group_css = '';
  if ($element['#group']) {
    $group_css = 'sliderfield-group-' . $element['#group'];

    if ($element['#group_master']) {
      $group_css .= ' sliderfield-group-master';
    }
  }

  if ($element['#display_ignore_button'] && !$element['#display_inputs']) {
    $element['ignore'] = array(
      '#type' => 'checkbox',
      '#title' => t('Not Selected (Uncheck to select a value)'),
      '#value' => (is_null($value) || $value === ''),
      '#disabled' => $element['#disabled'],
      '#attributes' => array('class' => array('sliderfield-ignore'))
    );
  }

  // Generate input for slider
  $element['value'] = array(
    '#tree'             => TRUE,
    '#prefix'           => '<div id="' . $element['#id'] . '" class="sliderfield ' . $group_css . 'container gutters content-end items-end">' . '<div class="sliderfield-event-field-container col-12 col-xs-6 col-md-4">',
    '#suffix' => '</div>',
    '#type'             => 'textfield',
    '#required'    => $element['#required'],
    '#element_validate' => array('sliderfield_validate_number'),
    '#title'             => $element['#input_title'],
    '#default_value'    => $value,
    '#disabled'    => $element['#disabled'],
    '#size'             => $element['#size'],
    '#attributes'       => array('class' => array('sliderfield-value-field')),
  );

  //Only show title for input fields when there is more than one value
  if (is_null($value2)) {
    $element['value']['#title'] = NULL;
  }

  #--(Begin)--> For Ajax compatibility
  if (isset($element['#ajax'])) {
    $ajax = @$element['#ajax'];
    if (!isset($ajax['trigger_as']) && isset($element['#name'])) {
      $value = NULL;
      $ajax['trigger_as'] = array(
        'name' => $element['#name'],
        'value' => $value
      );
    }
    if (!isset($ajax['event'])) {
      $ajax['event'] = 'change';
    }
    // Generate input for slider
    $element['value']['#ajax'] = $ajax;
  }
  #--(End)--> For Ajax compatibility

  if (!is_null($value2)) {
    if (!is_null($value2) && $value2 !== '') {
      if ($value2 < $element['#min']) {
        $value2 = $element['#min'];
      }
      if ($value2 > $element['#max']) {
        $value2 = $element['#max'];
      }
    }
    if ($value2 < $value) {
      $value2 = $value;
    }
    $values[] = $value2;
    $element['value2'] = array(
      '#type'             => 'textfield',
      '#default_value'    => $value2,
      '#required'    => $element['#required'],
      '#title'             => $element['#input2_title'],
      '#element_validate' => array('sliderfield_validate_number'),
      '#disabled'    => $element['#disabled'],
      '#size'             => $element['#size'],
      '#attributes'       => array('class' => array('sliderfield-value2-field')),
      '#wrapper_attributes' => array('class' => array('hide')),
    );
  }

  if ($element['#range'] === TRUE && (!isset($value2) || is_null($value2))) {
    $element['#range'] = FALSE;
  }

  if ($element['#display_values']) {
    foreach ($values as $key => $value) {
      $values[$key] = str_replace('%{value}%', $value ,$element['#display_values_format']);
    }
    $element['values_text'] = array(
      '#markup'     => '<div class="sliderfield-display-values-field">' . htmlentities(implode(' - ',  $values)) . '</div>'
    );
  }

  $style = NULL;
  if (!is_null($element['#slider_length'])) {
    if ($element['#orientation'] == 'horizontal') {
      $style = "width : {$element['#slider_length']}";
    } else {
      $style = "height : {$element['#slider_length']}";
    }
  }
  if ($element['#hide_slider_handle_when_no_value'] && !empty($element['#no_value_text'])) {
    $element['note'] = array(
      '#type' => 'markup',
      '#markup' => '<div class="sliderfield-selectvalue-description">' . t($element['#no_value_text']) . '</div>'
    );
  }

  $_attributes_new = array('class' => array('sliderfield-container', $element['#slider_style']), 'style' => $style);
  if (isset($element['#attributes']) && is_array($element['#attributes'])) {
    $_attributes_new = backdrop_array_merge_deep($_attributes_new, $element['#attributes']);
  }
  // Create markup for slider container
  $element['container'] = array(
    '#type' => 'container',
    '#attributes' => $_attributes_new,
    '#attached' => array(
      'library' => array(
        array('system', 'ui.slider')
      ),
      'js' => array(
        backdrop_get_path('module', 'sliderfield') . '/js/sliderfield_element_sliderfield.js',
        array(
          'data' => array(
            'sliderfield_' . $element['#id'] => array(
              'animate' => $element['#animate'],
              'adjust_field_min_css_selector' => $element['#adjust_field_min'],
              'adjust_field_max_css_selector' => $element['#adjust_field_max'],
              'disabled' => $element['#disabled'],
              'max' => $element['#max'] * 1,
              'min' => $element['#min'] * 1,
              'orientation' => $element['#orientation'],
              'range' => $element['#range'],
              'step' => $element['#step'] * 1,
              'display_inputs' => $element['#display_inputs'],
              'display_values_format' => $element['#display_values_format'],
              'display_bubble' => $element['#display_bubble'],'display_bubble' => $element['#display_bubble'],
              'display_bubble_format' => $element['#display_bubble_format'],
              'display_values' => $element['#display_values'],
              'group' => $element['#group'],
              'group_type' => $element['#group_type'],
              'group_master' => $element['#group_master'],
              'fields_to_sync_css_selector' => $element['#fields_to_sync_css_selector'],
              'display_ignore_button' => $element['#display_ignore_button'],
              'hide_slider_handle_when_no_value' => $element['#hide_slider_handle_when_no_value'],
              'no_value_text_auto_hide' => $element['#no_value_text_auto_hide'],
              'no_value_first_select_slider_effect' => $element['#no_value_first_select_slider_effect'],
              'no_value_text' => $element['#no_value_text']
            )
          ),
          'type' => 'setting',
        )
      ),
      'css' => array(
        array(
          'data' => backdrop_get_path('module', 'sliderfield') . '/css/sliderfield_element_sliderfield.css',
          'type' => 'file',
          //'group' => CSS_SYSTEM,
          'weight' => 2000,
        )
      ),
    ),

    '#markup' => '',
    '#suffix' => '</div>'
  );

  if ($element['#title2']) {
    $element['title2'] = array(
      '#type'   => 'item',
      '#markup' => '<label>' . $element['#title2'] . '</label>'
    );
  }

  // Generate input for sliders with adjustable min/max
  if (!empty($element['#adjust_field_min'])) {
    $element['container']['min_value'] = array(
      '#tree'       => TRUE,
      '#type'       => 'hidden',
      '#default_value' => $element['#min'],
      '#attributes' => array('class' => array('sliderfield-min-value-field')),
    );
  }
  if (!empty($element['#adjust_field_max'])) {
    $element['container']['max_value'] = array(
      '#tree'       => TRUE,
      '#type'       => 'hidden',
      '#default_value' => $element['#max'],
      '#attributes' => array('class' => array('sliderfield-max-value-field')),
    );
  }

  //$element = ajax_pre_render_element($element);
  //dpm($element);

  return $element;
}

/**
 * Overrides form_process_checkboxes().
 *
 * Adds grid classes to individual checkbox elements.
 */
function pei_activities_form_process_checkboxes($element) {
  $value = is_array($element['#value']) ? $element['#value'] : array();
  $element['#tree'] = TRUE;
  if (count($element['#options']) > 0) {
    if (!isset($element['#default_value']) || $element['#default_value'] == 0) {
      $element['#default_value'] = array();
    }
    $weight = 0;
    foreach ($element['#options'] as $key => $choice) {
      // Integer 0 is not a valid #return_value, so use '0' instead.
      // @see form_type_checkbox_value().
      // @todo Cast all integer keys to strings for consistency
      //   with form_process_radios().
      if ($key === 0) {
        $key = '0';
      }
      // Maintain order of options as defined in #options, in case the element
      // defines custom option sub-elements, but does not define all option
      // sub-elements.
      $weight += 0.001;

      $element += array($key => array());
      $element[$key] += array(
        '#type' => 'checkbox',
        '#title' => $choice,
        '#return_value' => $key,
        '#default_value' => isset($value[$key]) ? $key : NULL,
//        '#attributes' => $element['#attributes'],
        '#ajax' => isset($element['#ajax']) ? $element['#ajax'] : NULL,
        '#weight' => $weight,
        '#wrapper_attributes' => array(
          'class' => array('col-12 col-xs-6 col-md-4'),
        ),
      );
    }
  }
  return $element;
}

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Adds grid classes, theme overrides, and processors to form elements.
 * Some classes can be added directly to form elements, but the rest need theme overrides and custom processors.
 */
function pei_theme_form_pei_contacts_form_alter(&$form, &$form_state) {

  $filter_wrapper_class = 'col-12 col-xs-6 col-md-4';
  $slider_class = 'col-11';
  $date_class = 'col-11 col-xs-6';

  $form['#attributes']['class'][] = 'container';

  $form['filters']['#theme_wrappers'] = array('pei_activities_form_fieldset');

  $form['filters']['teen_councils']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['filters']['teen_council_states']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['filters']['first_name']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['filters']['last_name']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['more_filters']['#theme_wrappers'] = array('pei_activities_form_fieldset');

  $form['more_filters']['attendance_rate']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['attendance_rate']['#attributes']['class'][] = $slider_class;
  $form['more_filters']['attendance_rate']['#process'] = array('pei_activities_form_sliderfield_element_sliderfield_structure');

  $form['more_filters']['preferred_name']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['pronouns']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['race']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['additional_race']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['gender']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['additional_gender']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['sexual_orientation']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['additional_sexual_orientation']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['sex_assigned_at_birth']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['more_filters']['dob']['#name'] = 'dob';
  $form['more_filters']['dob']['#theme_wrappers'] = array('pei_activities_form_fieldset');
  $form['more_filters']['dob']['from']['#wrapper_attributes']['class'][] = $date_class;
  $form['more_filters']['dob']['to']['#wrapper_attributes']['class'][] = $date_class;

  $form['more_filters']['age']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['age']['#attributes']['class'][] = $slider_class;
  $form['more_filters']['age']['#process'] = array('pei_activities_form_sliderfield_element_sliderfield_structure');

  $form['more_filters']['grade_level']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['grade_level']['#attributes']['class'][] = $slider_class;
  $form['more_filters']['grade_level']['#process'] = array('pei_activities_form_sliderfield_element_sliderfield_structure');

  $form['more_filters']['income_proxy']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['more_filters']['enrollment_date']['#name'] = 'dob';
  $form['more_filters']['enrollment_date']['#theme_wrappers'] = array('pei_activities_form_fieldset');
  $form['more_filters']['enrollment_date']['from']['#wrapper_attributes']['class'][] = $date_class;
  $form['more_filters']['enrollment_date']['to']['#wrapper_attributes']['class'][] = $date_class;

  $form['more_filters']['withdrawal_date']['#name'] = 'dob';
  $form['more_filters']['withdrawal_date']['#theme_wrappers'] = array('pei_activities_form_fieldset');
  $form['more_filters']['withdrawal_date']['from']['#wrapper_attributes']['class'][] = $date_class;
  $form['more_filters']['withdrawal_date']['to']['#wrapper_attributes']['class'][] = $date_class;

  $form['more_filters']['reason_for_withdrawal']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['other_reason_for_withdrawal']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['member_email_address']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['member_phone_number']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['member_text_ok']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['member_ok_for_pei_to_contact']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['more_filters']['release_forms_received']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['manage_columns']['#theme_wrappers'] = array('pei_activities_form_fieldset');

  $form['manage_columns']['columns']['#attributes']['class'][] = 'container gutters content-end items-end';
  $form['manage_columns']['columns']['#process'] = array('pei_activities_form_process_checkboxes');
  $form['manage_columns']['display_results_as']['#wrapper_attributes']['class'][] = $filter_wrapper_class;
  $form['manage_columns']['show']['#wrapper_attributes']['class'][] = $filter_wrapper_class;

  $form['action_buttons']['#attributes']['class'][] = 'form-action-buttons';
}

