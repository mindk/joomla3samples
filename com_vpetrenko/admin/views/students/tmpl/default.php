<?php
/**
 * Student list template
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$trashed = $this->state->get('filter.published') == -2 ? true : false;
$sortFields = $this->getSortFields();

?>
<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		}
		else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, 'display');
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_vpetrenko&view=students'); ?>" method="post" name="adminForm"
      id="adminForm">
	<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif; ?>
			<div id="filter-bar" class="btn-toolbar">

				<div class="btn-group pull-right hidden-phone">
					<label for="directionTable"
					       class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></label>
					<select name="directionTable" id="directionTable" class="input-medium"
					        onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
						<option
							value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
						<option
							value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?></option>
					</select>
				</div>
				<div class="btn-group pull-right">
					<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
					<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
						<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
					</select>
				</div>
			</div>
			<div class="clearfix"></div>
			<table class="table table-striped">
				<thead>
				<tr>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th class="left">

						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_FIRSTNAME'), 'firstname', $listDirn, $listOrder); ?>
					</th>
					<th width="7%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_LASTNAME'), 'lastname', $listDirn, $listOrder); ?>
					</th>
					<th width="5%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_GROUP'), 'group', $listDirn, $listOrder); ?>
					</th>
					<th width="5%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_ADDRESS'), 'address', $listDirn, $listOrder); ?>
					</th>
					<th width="10%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_HOBBY'), 'hobby', $listDirn, $listOrder); ?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_PUBLISHED'), 'published', $listDirn, $listOrder); ?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('grid.sort', JText::_('com_vpetrenko_ID'), 'id', $listDirn, $listOrder); ?>
					</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td colspan="15">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
				<tbody>
				<?php foreach ($this->items as $i => $item) : ?>
					<tr class="row<?php echo $i % 2; ?>">
						<td class="center">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i, JFactory::getUser($item->checked_out)->name, $item->checked_out_time, 'banners.'); ?>
							<?php endif; ?>
							<a href="<?php echo JRoute::_('index.php?option=com_vpetrenko&view=student&task=read&id=' . (int) $item->id); ?>"
							   title="<?php echo $this->escape(JFactory::getUser($item->checked_out)->username); ?>">
								<?php echo $this->escape($item->firstname); ?></a>
						</td>
						<td class="center">

							<?php echo $this->escape($item->lastname); ?>
						</td>
						<td class="center">
							<?php echo $this->escape($item->group); ?></a>
						</td>
						<td class="center">
							<?php echo $this->escape($item->address); ?></a>
						</td>
						<td class="center">
							<?php echo $this->escape($item->hobby); ?></a>
						</td>

						<td class="center">
							<?php echo $this->escape($item->published); ?></a>
						</td>
						<td class="center">
							<?php echo $this->escape($item->id); ?></a>
						</td>

					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>


			<input type="hidden" name="task" value="display"/>
			<input type="hidden" name="boxchecked" value="0"/>
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
			<?php echo JHtml::_('form.token'); ?>
		</div>
</form>
