<?php

namespace Drupal\demo_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RegisterForm extends FormBase {

  public function getFormId() {
    return 'demo_register_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Register'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // You can add validation here if you need to.
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Generate a unique code.
    $code = rand(10000000, 99999999);

    // Save the code to the user entity.
    $user = \Drupal\user\Entity\User::create([
      'name' => $form_state->getValue('username'),
      'mail' => $form_state->getValue('email'),
      'status' => 1,
      'code' => $code,
    ]);

    $user->save();

    // // Send an email to the user.
    // $mail_manager = \Drupal::service('plugin.manager.mail');
    // $module = 'custom_register';
    // $key = 'user_register';
    // $to = $user->getEmail();
    // $params['message'] = 'Your registration was successful. Your code is: ' . $code;
    // $langcode = \Drupal::currentUser()->getPreferredLangcode();
    // $send = true;

    // $mail_manager->mail($module, $key, $to, $langcode, $params, NULL, $send);
  }

}
