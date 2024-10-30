<?php
global $brief_options;

function brief_dashboard_widgets()
{
  global $wp_meta_boxes;

  wp_add_dashboard_widget('custom_help_widget', 'Brief', 'brief_dashboard_help');
}

function brief_dashboard_help()
{
  global $brief_options;

  $brand_url = $brief_options['brand_url'];
  $brand_img = wp_get_attachment_url($brief_options['brand']);

  $showTabs = false;

  $showChangelog = true;
  $showDoc = true;
  $showPromo = true;
  $showEmergency = true;

  if (isset($brief_options['disableChangelog']) && $brief_options['disableChangelog'] === '1') {
    $showChangelog = false;
  }
  if (isset($brief_options['disableDoc']) && $brief_options['disableDoc'] === '1') {
    $showDoc = false;
  }
  if (isset($brief_options['disablePromo']) && $brief_options['disablePromo'] === '1') {
    $showPromo = false;
  }
  if (isset($brief_options['disableEmergency']) && $brief_options['disableEmergency'] === '1') {
    $showEmergency = false;
  }

  if ($showChangelog || $showDoc  || $showPromo || $showEmergency) {
    $showTabs = true;
  }


?>
  <div id="brief-widget" class="brief-widget">

    <?php if (!empty($brand_url) && !empty($brand_img)) : ?>
      <a class="brief-brand-link" href="<?php echo $brand_url; ?>" <?php if ($showTabs === false) {
                                                                      echo ' style="position: static;" ';
                                                                    } ?>target="_blank">
        <img id='brief-brand' src='<?php echo $brand_img; ?>' width='100'>
      </a>
    <?php endif; ?>

    <?php if ($showTabs) : ?>

      <div class="brief-tabs">
        <ul class="brief-tabs-list">
          <?php if ($showChangelog) : ?>
            <li class="brief-tabs-items">
              <a class="brief-tabs-links active" href="#briefChangelog">Changelog</a>
            </li>
          <?php endif; ?>
          <?php if ($showDoc) : ?>
            <li class="brief-tabs-items">
              <a class="brief-tabs-links" href="#briefDocs">Readme</a>
            </li>
          <?php endif; ?>
          <?php if ($showPromo) : ?>
            <li class="brief-tabs-items">
              <a class="brief-tabs-links" href="#briefPromotions">Promotions</a>
            </li>
          <?php endif; ?>
          <?php if ($showEmergency) : ?>
            <li class="brief-tabs-items">
              <a class="brief-tabs-links" href="#briefEmergency">Emergency</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="brief-tabs-content">

        <?php if ($showChangelog) : ?>
          <!-- Changelog Card -->
          <div id="briefChangelog" class="brief-tabs-card active">
            <h3>Recently Changed</h3>

            <div class="brief-tabs-card__content">
              <?php
              echo PHP_EOL . $brief_options['changelog'];
              ?>
            </div><!-- /.brief-tabs-card__content -->
          </div>
        <?php endif; ?>

        <?php if ($showDoc) : ?>
          <!-- Docs Card -->
          <div id="briefDocs" class="brief-tabs-card">
            <div class="brief-tabs-card__content">
              <?php
              echo PHP_EOL . $brief_options['doc'];
              ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($showPromo) : ?>
          <!-- Promotions Card -->
          <div id="briefPromotions" class="brief-tabs-card">
            <div class="brief-tabs-card__content">
              <?php
              echo PHP_EOL . $brief_options['promo'];
              ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($showEmergency) : ?>
          <!-- Emergency Card -->
          <div id="briefEmergency" class="brief-tabs-card">
            <div class="brief-tabs-card__content">
              <?php
              echo PHP_EOL . $brief_options['emergency'];
              ?>
            </div>
          </div>
        <?php endif; ?>

      </div>

      <div class="brief-tabs-card__footer">
        <a class="brief-expand" href="#">Expand</a>
      </div><!-- /.brief-tabs-card__footer -->

    <?php endif; ?>
  </div>
<?php
}

if ($brief_options['enable']) {
  add_action('wp_dashboard_setup', 'brief_dashboard_widgets');
}
