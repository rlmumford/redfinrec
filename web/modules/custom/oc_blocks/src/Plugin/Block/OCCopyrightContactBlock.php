<?php

namespace Drupal\oc_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block for the Oliver Carol copyright and contact.
 *
 * @Block(
 *   id = "oc_copyright_contact",
 *   admin_label = @Translation("OC Copyright & Contact"),
 * )
 */
class OCCopyrightContactBlock extends BlockBase {

  /**
   * @inheritDoc
   */
  public function build() {
    return [
      '#markup' => '<span class="copyright">Oliver Carol Recruitment &copy; '.(new \DateTime())->format('Y').'</span>&nbsp;|&nbsp;'.
                   '<span class="contact"><a href="mailto:info@olivercarol.com">info@olivercarol.com</a></span>',
      ];
  }
}
