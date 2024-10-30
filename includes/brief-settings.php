<?php

// Create menu Link
function brief_options_menu_link()
{
  add_options_page(
    'Brief Options',
    'Brief',
    'manage_options',
    'brief-options',
    'brief_options_content'
  );
}

// Create Options Page Content
function brief_options_content()
{

  // Init Options Global
  global $brief_options;

  ob_start(); ?>
  <div class="wrap">
    <h2><?php _e('Brief Settings', 'brief_domain'); ?></h2>
    <p><?php _e('Settings for Brief plugin', 'brief_domain'); ?></p>
    <form method="post" action="options.php">

      <?php settings_fields('brief_settings_group'); ?>

      <table class="form-table">
        <tbody>

          <!-- Enable / Disable Script -->
          <tr>
            <th scope="row"><label for="brief_settings[enable]"><?php _e('Enable', 'brief_domain'); ?></label></th>
            <td><input name="brief_settings[enable]" type="checkbox" id="brief_settings[enable]" value="1" <?php checked('1', $brief_options['enable']); ?>></td>
          </tr>

          <tr>
            <th scope="row"><label for="brief_settings[brand]"><?php _e('Brand', 'brief_domain'); ?></label></th>
            <td>

              <!-- Load Brand -->
              <?php
              wp_enqueue_media();

              $active = '';
              if ($brief_options['brand']) {
                $active = ' active';
              }
              ?>

              <form method='post'>
                <div class='brief-img-wrapper<?php echo $active; ?>'>
                  <img id='briefImgPreview' src='<?php echo wp_get_attachment_url($brief_options['brand']); ?>' width='180'>
                </div>
                <input id="briefBtnUpload" type="button" class="button" value="<?php _e('Upload image', 'brief_domain'); ?>" />
                <button id="briefBtnRemove" class="brief-btn__remove<?php echo $active; ?>" type="button"><?php _e('Remove', 'brief_domain'); ?></button>
                <input type='hidden' name='brief_settings[brand]' id='brief_settings[brand]' value='<?php echo $brief_options['brand']; ?>'>
              </form>

            </td>
          </tr>

          <!-- Brand URL -->
          <tr>
            <th scope="row"><label for="brief_settings[brand_url]"><?php _e('Developer Profile URL', 'brief_domain'); ?></label></th>
            <td><input name="brief_settings[brand_url]" type="text" id="brief_settings[brand_url]" value="<?php echo $brief_options['brand_url']; ?>" class="regular-text">
              <p class="description"><?php _e('Enter your Developer profile URL', 'brief_domain'); ?></p>
            </td>
          </tr>

          <!-- Changelog Textarea -->
          <tr>
            <th scope="row">
              <label for="brief_settings[changelog]"><?php _e('Changelog', 'brief_domain'); ?></label>
            </th>
            <td>
              <textarea name="brief_settings[changelog]" id="brief_settings[changelog]" class="large-text" rows="10" cols="50"><?php echo $brief_options['changelog']; ?></textarea>
              <p class="description"><?php _e('Last changes (in markdown format)', 'brief_domain'); ?></p>

              <input name="brief_settings[disableChangelog]" type="checkbox" id="brief_settings[disableChangelog]" value="1" <?php checked('1', $brief_options['disableChangelog']); ?>>
              <label for="brief_settings[disableChangelog]"><?php _e('Disable Changelog Tab', 'brief_domain'); ?></label></th>
            </td>
          </tr>

          <!-- Documentation Textarea -->
          <tr>
            <th scope="row"><label for="brief_settings[doc]"><?php _e('Readme', 'brief_domain'); ?></label></th>
            <td>
              <textarea name="brief_settings[doc]" id="brief_settings[doc]" class="large-text" rows="10" cols="50"><?php echo $brief_options['doc']; ?></textarea>
              <p class="description"><?php _e('Documentation, Links etc. (in markdown format)', 'brief_domain'); ?></p>

              <input name="brief_settings[disableDoc]" type="checkbox" id="brief_settings[disableDoc]" value="1" <?php checked('1', $brief_options['disableDoc']); ?>>
              <label for="brief_settings[disableDoc]"><?php _e('Disable Readme Tab', 'brief_domain'); ?></label></th>
            </td>
          </tr>

          <!-- Promotions Textarea -->
          <tr>
            <th scope="row"><label for="brief_settings[promo]"><?php _e('Promotions', 'brief_domain'); ?></label></th>
            <td>
              <textarea name="brief_settings[promo]" id="brief_settings[promo]" class="large-text" rows="10" cols="50"><?php echo $brief_options['promo']; ?></textarea>
              <p class="description"><?php _e('Promotions, News etc. (in markdown format)', 'brief_domain'); ?></p>

              <input name="brief_settings[disablePromo]" type="checkbox" id="brief_settings[disablePromo]" value="1" <?php checked('1', $brief_options['disablePromo']); ?>>
              <label for="brief_settings[disablePromo]"><?php _e('Disable Promotions Tab', 'brief_domain'); ?></label></th>
            </td>
          </tr>

          <!-- Emergency Textarea -->
          <tr>
            <th scope="row"><label for="brief_settings[emergency]"><?php _e('Emergency', 'brief_domain'); ?></label></th>
            <td>
              <textarea name="brief_settings[emergency]" id="brief_settings[emergency]" class="large-text" rows="10" cols="50"><?php echo $brief_options['emergency']; ?></textarea>
              <p class="description"><?php _e('Operative contact information etc. (in markdown format)', 'brief_domain'); ?></p>

              <input name="brief_settings[disableEmergency]" type="checkbox" id="brief_settings[disableEmergency]" value="1" <?php checked('1', $brief_options['disableEmergency']); ?>>
              <label for="brief_settings[disableEmergency]"><?php _e('Disable Emergency Tab', 'brief_domain'); ?></label></th>
            </td>
          </tr>

        </tbody>
      </table>
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'brief_domain'); ?>" </p>
    </form>
  </div>
<?php
  echo ob_get_clean();
}

add_action('admin_menu', 'brief_options_menu_link');

// Register Settings
function brief_register_settings()
{
  register_setting('brief_settings_group', 'brief_settings');
}

add_action('admin_init', 'brief_register_settings');
