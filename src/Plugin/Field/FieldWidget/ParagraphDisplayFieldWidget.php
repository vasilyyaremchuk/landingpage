<?php

namespace Drupal\landingpage\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'paragraph_display_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "paragraph_display_field_widget",
 *   label = @Translation("Paragraph display field widget"),
 *   field_types = {
 *     "paragraph_display_field_type"
 *   }
 * )
 */
class ParagraphDisplayFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  /*public static function defaultSettings() {
    return array(
      'size' => 60,
      'placeholder' => '',
    ) + parent::defaultSettings();
  }*/

  /**
   * {@inheritdoc}
   */
  /*public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = array(
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    );
    $elements['placeholder'] = array(
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    );

    return $elements;
  }*/

  /**
   * {@inheritdoc}
   */
  /*public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: !size', array('!size' => $this->getSetting('size')));
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', array('@placeholder' => $this->getSetting('placeholder')));
    }

    return $summary;
  }*/

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    $view_modes = \Drupal::entityManager()->getViewModeOptionsByBundle($items->getFieldDefinition()->getTargetEntityTypeId(), $items->getFieldDefinition()->getTargetBundle());

    $element = array(
      '#type' => 'select',
      '#title' => t('Paragraph Display'),
      '#options' => $view_modes,
      '#default_value' => $value,
      '#multiple' => FALSE,
    );

    return array('value' => $element);
  }

}
