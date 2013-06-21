<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <?php echo $this->formText('query', $filters['query']); ?>
    <?php if ($options['show_advanced']): ?>
    <fieldset id="advanced-form">
        <input type="hidden" name="query_type" value="exact_match">
        <?php if ($record_types): ?>
        <?php elseif (is_admin_theme()): ?>
            <p><a href="<?php echo url('settings/edit-search'); ?>"><?php echo __('Go to search settings to select record types to use.'); ?></a></p>
        <?php endif; ?>
        <p><?php echo link_to_item_search(__('Advanced Search (Items only)')); ?></p>
    </fieldset>
    <?php endif; ?>
    <?php echo $this->formSubmit(null, $options['submit_value']); ?>
</form>
