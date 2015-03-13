<?php
/**
 * RssReaders view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="row">
	<div class="col-xs-6">
		
	</div>

	<div class="col-xs-6 text-right">
		<span class="nc-tooltip" tooltip="<?php echo __d('rss_readers', 'Site Info'); ?>">
			<a href="" class="btn btn-default">
				<span class="glyphicon glyphicon-info-sign"> </span>
			</a>
		</span>

		<span class="nc-tooltip" tooltip="<?php echo __d('net_commons', 'Edit'); ?>">
			<a href="<?php echo $this->Html->url('/rss_readers/rss_readers/edit/' . $frameId) ?>" class="btn btn-primary">
				<span class="glyphicon glyphicon-edit"> </span>
			</a>
		</span>
	</div>
</div>



		<?php //echo $this->element('RssReaders/view_site_info'); ?>
