<?php

namespace Drupal\oc_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block for the Oliver Carol copyright and contact.
 *
 * @Block(
 *   id = "oc_socials",
 *   admin_label = @Translation("OC Socials"),
 * )
 */
class OCSocialsBlock extends BlockBase {

  /**
   * @inheritDoc
   */
  public function build() {
    return [
      '#markup' => '<a href="https://www.linkedin.com/company/redfinrecruitmentltd/"><i class="fa fa-linkedin"></i></a>',
    ];
  }
}
