<?php

namespace Drupal\redfin_connect\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block that displays connect information.
 *
 * @Block(
 *   id = "redfin_connect_block",
 *   admin_label = @Translation("Redfin Connect Block"),
 * )
 */
class RedfinConnectBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Stores the configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Creates a RedfinConnectBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *  The factory for configuration objects.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'telephone' => NULL,
      'email' => NULL,
      'address_line1' => NULL,
      'address_line2' => NULL,
      'linkedin' => NULL,
      'facebook' => NULL,
      'twitter' => NULL,
      'instagram' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['connect_information'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Connect Information'),
    ];

    $form['connect_information']['telephone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Telephone'),
      '#default_value' => $this->configuration['telephone'],
    ];
    $form['connect_information']['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#default_value' => $this->configuration['email'],
    ];
    $form['connect_information']['address_line1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address Line 1'),
      '#default_value' => $this->configuration['address_line1'],
    ];
    $form['connect_information']['address_line2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address Line 2'),
      '#default_value' => $this->configuration['address_line2'],
    ];
    $form['connect_information']['linkedin'] = [
      '#type' => 'textfield',
      '#title' => $this->t('LinkedIn'),
      '#default_value' => $this->configuration['linkedin'],
    ];
    $form['connect_information']['facebook'] = [
      '#type' => 'textfield',
      '#title' => $this->t('FaceBook'),
      '#default_value' => $this->configuration['facebook'],
    ];
    $form['connect_information']['twitter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitter'),
      '#default_value' => $this->configuration['twitter'],
    ];
    $form['connect_information']['instagram'] = [
      '#type' => 'textfield',
      '#title' => $this->t('instagram'),
      '#default_value' => $this->configuration['instagram'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $values = $form_state->getValue('connect_information');
    $this->configuration['telephone'] = $values['telephone'];
    $this->configuration['email'] = $values['email'];
    $this->configuration['address_line1'] = $values['address_line1'];
    $this->configuration['address_line2'] = $values['address_line2'];
    $this->configuration['linkedin'] = $values['linkedin'];
    $this->configuration['facebook'] = $values['facebook'];
    $this->configuration['twitter'] = $values['twitter'];
    $this->configuration['instagram'] = $values['instagram'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [
      '#type' => 'container',
      '#attached' => [
        'library' => [
          'redfin_connect/connect_button',
        ],
      ],
    ];
    $build['connect_button'] = [
      '#type' => 'button',
      '#value' => $this->t('Connect'),
      '#attributes' => [
        'class' => ['connect-button'],
      ],
    ];
    $build['connect_information'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => [ 'connect-info', 'connect-info-collapsed' ],
      ],
    ];
    if ($this->configuration['telephone']) {
      $build['connect_information']['telephone'] = [
        '#type' => 'item',
        '#title' => $this->t('Tel.'),
        '#markup' => '<a class="telephone" href="callto:'.$this->configuration['telephone'].'"><i class="fas fa-phone"></i><span>'.$this->configuration['telephone'].'</span></a>',
      ];
    }
    if ($this->configuration['email']) {
      $build['connect_information']['email'] = [
        '#type' => 'item',
        '#title' => $this->t('Email'),
        '#markup' => '<a class="email" href="mailto:'.$this->configuration['email'].'"><i class="fas fa-envelope"></i><span>'.$this->configuration['email'].'</span></a>',
      ];
    }
    if ($this->configuration['address_line1']) {
      $build['connect_information']['address_line1'] = [
        '#type' => 'item',
        '#markup' => '<span class="address">'.$this->configuration['address_line1'].'</span>',
      ];
    }
    if ($this->configuration['address_line2']) {
      $build['connect_information']['address_line2'] = [
        '#type' => 'item',
        '#markup' => '<span class="address">'.$this->configuration['address_line2'].'</span>',
      ];
    }

    $social_links = [];
    if ($this->configuration['linkedin']) {
      $social_links[] = '<a href="https://www.linkedin.com/'.$this->configuration['linkedin'].'" target="_blank"><i class="spaceright fab fa-linkedin-in"></i></a>';
    }
    if ($this->configuration['facebook']) {
      $social_links[] = '<a href="https://www.facebook.com/'.$this->configuration['facebook'].'" target="_blank"><i class="spaceright fab fa-facebook-f"></i></a>';
    }
    if ($this->configuration['twitter']) {
      $social_links[] = '<a href="https://twitter.com/'.$this->configuration['twitter'].'" target="_blank"><i class="spaceright fab fa-twitter"></i></a>';
    }
    if ($this->configuration['instagram']) {
      $social_links[] = '<a href="https://www.instagram.com/'.$this->configuration['instagram'].'" target="_blank"><i class="fab fa-instagram"></i></a>';
    }
    if (!empty($social_links)) {
      $build['connect_information']['social'] = [
        '#type' => 'item',
        '#markup' => '<span class="social">'.implode('', $social_links).'</span>',
      ];
    }

    $build['connect_information']['client_contact'] = [
      '#type' => 'link',
      '#title' => $this->t('Clients'),
      '#url' => Url::fromRoute('entity.contact_form.canonical', ['contact_form' => 'client_interest']),
      '#attributes' => [
        'class' => ['use-ajax', 'client-contact'],
        'data-dialog-type' => 'modal',
      ],
      '#attached' => [
        'library' => ['core/drupal.dialog.ajax'],
      ],
    ];
    $build['connect_information']['candidate_contact'] = [
      '#type' => 'link',
      '#title' => $this->t('Candidates'),
      '#url' => Url::fromRoute('entity.contact_form.canonical', ['contact_form' => 'candidate_interest']),
      '#attributes' => [
        'class' => ['use-ajax', 'candidate-contact'],
        'data-dialog-type' => 'modal',
      ],
      '#attached' => [
        'library' => ['core/drupal.dialog.ajax'],
      ],
    ];
    $build['connect_information']['colleague_contact'] = [
      '#type' => 'link',
      '#title' => $this->t('Colleagues'),
      '#url' => Url::fromRoute('entity.contact_form.canonical', ['contact_form' => 'colleague_interest']),
      '#attributes' => [
        'class' => ['use-ajax', 'colleague-contact'],
        'data-dialog-type' => 'modal',
      ],
      '#attached' => [
        'library' => ['core/drupal.dialog.ajax'],
      ],
    ];

    return $build;
  }
}
