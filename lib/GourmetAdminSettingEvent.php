<?php

class GourmetAdminSettingEvent extends Gourmet {

    public function initEvent() {
        add_action('admin_menu', array($this, 'addMenu'));
        add_action('whitelist_options', array($this, 'addWhitelistOptions'));
    }

    public function addMenu() {
        $page = add_options_page(self::NAME.' Options', self::NAME, 'manage_options', __FILE__, array($this, 'generateOptionForm'));
    }

    public function addWhitelistOptions() {
        $whitelist_options['wpgroumet'] = array(
            self::getKey('api_key'),
        );
        return $whitelist_options;
    }

    public function generateOptionForm() {

?>

<div class="wrap">
    <h2><?php echo self::NAME ?></h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('wpgroumet-options'); ?>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="option_page" value="wpgroumet" />
        <h3><?php echo __('Settings', self::TEXT_DOMAIN) ?></h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <p>
                        <?php echo __('API KEY', self::TEXT_DOMAIN) ?><br/>
                        <a href="http://api.gnavi.co.jp/api/use.htm" target="_blank"><?php echo __('Registration here', self::TEXT_DOMAIN) ?></a>
                    </p>
                </th>
                <td>
                    <p>
                        <input type="text" name="<?php echo self::getKey('api_key') ?>" value="<?php echo self::getApiKey() ?>" size="70" />
                    </p>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php echo __('Save Changes', self::TEXT_DOMAIN) ?>" />
        </p>
    </form>
</div>

<?php
    }

}
