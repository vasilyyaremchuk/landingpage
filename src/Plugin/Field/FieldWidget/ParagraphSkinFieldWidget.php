<?php

namespace Drupal\landingpage\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\Core\Asset\LibraryDiscoveryInterface;

/**
 * Plugin implementation of the 'paragraph_skin_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "paragraph_skin_field_widget",
 *   label = @Translation("Paragraph skin field widget"),
 *   field_types = {
 *     "paragraph_skin_field_type"
 *   }
 * )
 */
class ParagraphSkinFieldWidget extends WidgetBase {

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
    $module_id = explode(".", $items->getFieldDefinition()->id());
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';
    /*$query = \Drupal::entityQuery('skin_entity');
    $skins = $query->execute();*/
    $options = array();
    /*foreach ($skins as $skin) {
      $entity = entity_load('skin_entity', $skin);
      $options[$skin] = $entity->label();
    }*/

    $modules = \Drupal::moduleHandler()->getModuleList();
    $module_list = array_keys($modules);
    sort($module_list);
    $paragraphs = array();
    $libraries = array();
    foreach ($module_list as $module) {
      if (strpos($module, $module_id[1]) !== false) {
        $paragraphs[] = $module;
        $library = \Drupal::service('library.discovery')->getLibrariesByExtension($module);
        $option = array_keys($library);
        foreach ($option as $op) {
          $options[$op] = $op;
        }
      }
    }
    //dpm($libraries);

    $element = array(
      '#type' => 'select',
      '#title' => t('Paragraph Skin'),
      '#options' => $options,
      '#default_value' => $value,
      '#multiple' => FALSE,
    );

    return array('value' => $element);
  }

}
