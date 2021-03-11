<?php

namespace Drupal\oc_pages\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;

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
  public function about() {
    return [
      'p1' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('Every proven leader agrees that listening is critical to successfully
        building and maintaining winning teams. Our role is to listen and learn what you need, challenge where
        necessary, and then deliver. Simple as that.'),
      ],
      'p2' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('We believe in providing a service that demonstrates our values of
        <strong>excellence</strong>, <strong>genuineness</strong>, <strong>honesty</strong> and being <strong>solution providers</strong>.'),
      ],
      'p3' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('If you are a business looking to add talent to your team and want a
        knowledgeable, dedicated, and ethical recruitment partner <a href=":url"><strong>contact us</strong></a> and let’s explore how we can serve you.',
    [
      ':url' => Url::fromRoute('contact.site_page')->toString(),
    ]
  ),
      ],
      'p4' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => new TranslatableMarkup('We serve all industries within the manufacturing sector and have
        experience of successfully deploying talent acquisition campaigns across multiple functions including
        Operation & Production, Technical & Quality, Engineering, Product Development & Innovation, Sales, Marketing,
        HR, Supply Chain, Logistics & Purchasing, Main & Lower Board Appointments.'),
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
      'message' => 'James provided an excellent service to our ambitious plan. With agility and flexibility he proved
      to be a committed member of our extended team in the search for high level profiles to our organization.',
      'source' => 'Luis Spinardi',
      'position' => 'Site Director, Kraft Heinz',
    ];
    $ts[] = [
      'message' => 'James and I have worked together for a number of years. His insights and understanding of the FMCG
      sector are unparalleled. Couple this understanding with his ability to quickly dissect and absorb a company
      culture and it becomes readily apparent why James and Oliver Carol Recruitment have become a trusted partner
      within the FMCG & CPG space. I would recommend any business leader looking to scale their Operations,
      Maintenance or QA management talent to contact Oliver Carol Recruitment as an obvious first step.',
      'source' => 'Lance Olmsted',
      'position' => 'Vice President, Redzone Production Systems',
    ];
    $ts[] = [
      'message' => 'Oliver Carol Recruitment have recently found me my perfect job. After working at the same place
      for the last seven years, making the decision to start looking for something new was daunting to say the least.
      The team made the whole process so easy and stress free despite my constantly changing diary. They are really
      approachable, up front and is easy to work with and really know what they are talking about. I am so excited to
      start my new role and will be forever thankful for all the help they have given me over the last few months.',
      'source' => 'Leanne Parkin',
      'position' => 'Head of Operations, Ramsden International',
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
