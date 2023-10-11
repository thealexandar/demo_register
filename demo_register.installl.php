<?php

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Implements hook_entity_base_field_info().
 */
function demo_register_entity_base_field_info(EntityTypeInterface $entity_type) {
  if ($entity_type->id() === 'user') {
    $fields = [];
    $fields['code'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Code'))
      ->setDescription(t('The unique code for the user.'))
      ->setSettings([
        'min' => 10000000,
        'max' => 99999999,
      ]);

  }
  return $fields;
}
