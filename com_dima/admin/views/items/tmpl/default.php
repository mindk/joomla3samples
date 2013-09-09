<?php
/**
 * @package     com_dima
 *
 * @author      Davidov D.
 * @copyright   Copyright (C) 2013 Mindk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

$sortFields = array('id' => JText::_('COM_DIM_ID'), 'name' => JText::_('COM_DIM_NAME'));
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$i = 0;

$document = JFactory::getDocument();
$document->addScriptDeclaration("
	Joomla.orderTable = function()
	{
		table = document.getElementById('sortTable');
		direction = document.getElementById('directionTable');
		order = table.options[table.selectedIndex].value;
		if (order != '" . $listOrder . "')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
");

?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div class="fluid-container">
		<div id="j-main-container">
			<div id="filter-bar" class="btn-toolbar">
				<div class="btn-group pull-right hidden-phone">
					<label for="limit"
					       class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="directionTable"
					       class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC');?></label>
					<select name="directionTable" id="directionTable" class="input-medium"
					        onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?></option>
						<option
							value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?></option>
						<option
							value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?></option>
					</select>
				</div>
				<div class="btn-group pull-right">
					<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY');?></label>
					<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>
						<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
					</select>
				</div>
			</div>

			<table class="table table-striped" id="categoryList">
				<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('grid.sort', 'COM_DIM_ID', 'id', $listDirn, $listOrder, null, 'asc', 'COM_DIM_ID'); ?>
					</th>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value=""
						       title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
					</th>
					<th width="20%" class="left">
						<?php echo JHtml::_('grid.sort', 'COM_DIM_NAME', 'name', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JText::_('COM_DIM_DESCRIPTION'); ?>
					</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td colspan="5" align="center">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
				<tbody>
				<?php if (!empty($this->list)): ?>
					<?php foreach ($this->list as $item): ?>
						<tr>
							<td class="center hidden-phone">
								<?php echo $item->id; ?>
							</td>
							<td class="center hidden-phone">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<td>
								<?php if ($item->checked_out) : ?>
									<?php echo JHtml::_('jgrid.checkedout', $i, JFactory::getUser()->id, $item->checked_out_time, '', true); ?>
								<?php endif; ?>
								<a href="index.php?option=com_dima&task=read&cid[]=<?php echo $item->id; ?>"
								   title="<?php echo JText::_('COM_DIM_EDIT_ITEM'); ?>"><?php echo $item->name; ?></a>
							</td>
							<td>
								<?php echo $item->description; ?>
							</td>
						</tr>
						<?php $i++; endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="5"><?php echo JText::_('COM_DIM_NO_ITEMS_TO_DISPLAY');?></td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<input type="hidden" name="option" value="com_dima"/>
	<input type="hidden" name="task" value="display"/>
	<input type="hidden" name="boxchecked" id="boxchecked" value=""/>
	<?php echo JHtml::_('form.token'); ?>

</form>