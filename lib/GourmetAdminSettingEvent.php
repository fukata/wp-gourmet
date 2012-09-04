<?php

class GourmetAdminSettingEvent extends Gourmet {

    public function __construct() {
    }

    public function initEvent() {
        add_action('admin_menu', array($this, 'addMenu'));
        add_action('whitelist_options', array($this, 'addWhitelistOptions'));
    }

	public function addMenu() {
		$page = add_options_page(self::NAME.' Options', self::NAME, 'manage_options', __FILE__, array($this, 'generateOptionForm'));
	}

    public function addWhitelistOptions() {
		$whitelist_options['wpgroumet'] = array(
        );
		return $whitelist_options;
    }

	public static function generateOptionForm() {

?>

<div class="wrap">
	<h2><?php echo self::NAME ?></h2>
	<form method="post" action="options.php">
    </form>
</div>

<?php
    }

}
