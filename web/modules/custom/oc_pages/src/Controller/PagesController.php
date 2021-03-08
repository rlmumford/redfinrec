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

  /**
   * Get the testimonials.
   *
   * @return array
   */
  protected function getTestimonials() {
    $ts = [];

    $ts[] = [
      'message' => 'blah',
      'source' => 'Luis Spinardi',
      'position' => 'Site Director, Kraft Heinz',
    ];
    $ts[] = [
      'message' => 'blah',
      'source' => 'Lance Olmsted',
      'position' => 'Vice President, Redzone Production Systems',
    ];

    return $ts;
  }

  /**
   * The testimonials page.
   *
   * @return array
   */
  public function testimonials() {
    $build = [];

    foreach ($this->getTestimonials() as $key => $testimonial) {
      $build['t_'.$key] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['card', 'testimonial'],
        ],
        'message' => [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => "\"".$testimonial['message']."\"",
        ],
        'source' => [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => [
            'class' => 'source',
          ],
          '#value' => $testimonial['source'],
        ],
        'position' => [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => [
            'class' => 'position',
          ],
          '#value' => $testimonial['position'],
        ],
      ];
    }

    return $build;
  }
}
