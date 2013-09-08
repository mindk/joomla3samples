<?php
/**
 * Template for render animal edit form
 *
 * @package   com_maxim
 * @author    Maxim
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
		if (task == 'cancel' || document.formvalidator.isValid(document.id('animals-form')))
		{
			Joomla.submitform(task, document.getElementById('animals-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_maxim&task=save&view=animal&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="animals-form" class="form-validate form-horizontal">

	<div class="span10 form-horizontal">

		<fieldset>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('id'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('id'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('name'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('name'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('weight'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('weight'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('height'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('height'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('speed'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('speed'); ?>
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

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('description'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('description'); ?>
				</div>
			</div>
		</fieldset>

		<input type="hidden" name="task" id="task" value="save" />
		<?php echo JHtml::_('form.token'); ?>
	</div>

</form>
