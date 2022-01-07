<?php
$addon = rex_addon::get('ycom_impersonate');
$form = rex_config_form::factory($addon->name);
$field = $form->addInputField('text', 'default_id', null, ["class" => "form-control"]);
$field->setLabel($addon->i18n('ycom_impersonate_default_id'));

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $addon->i18n('ycom_impersonate_settings'), false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');
