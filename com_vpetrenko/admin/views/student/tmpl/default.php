<?php
/**
 * Student form template
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'Vpetrenko.cancel' || document.formvalidator.isValid(document.id('banner-form')))
		{
			Joomla.submitform(task, document.getElementById('banner-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_vpetrenko&task=read&view=student&id='.(int) (isset($this->item->id) ? $this->item->id : 0)); ?>" method="post" name="adminForm" id="banner-form" class="form-validate form-horizontal">

	<div class="span10 form-horizontal">

		<fieldset>
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('firstname'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('firstname'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('lastname'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('lastname'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('group'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('group'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('address'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('address'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('hobby'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('hobby'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('published'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('published'); ?>
				</div>
			</div>
			<?php echo $this->form->getInput('id'); ?>

		</fieldset>

		<input type="hidden" name="task" id="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>

</form>