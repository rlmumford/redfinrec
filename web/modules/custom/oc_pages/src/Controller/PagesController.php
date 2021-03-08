<?php

namespace Drupal\oc_pages\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Controller for static Oliver Carol Pages
 *
 * @package Drupal\oc_pages\Controller
 */
class PagesController extends ControllerBase {

  /**
   * The home page is empty.
   *
   * @return array
   */
  public function home() {
    return [
      '#markup' => '',
    ];
  }

  /**
   * The divisions page has some text.
   *
   * @return array
   */
  public function divisions() {
    return [
      'p1' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('Every proven leader...'),
      ],
      'p2' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('We believe in...'),
      ],
      'p3' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('If you are...'),
      ],
      'p4' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('We serve all...'),
      ],
    ];
  }
}
