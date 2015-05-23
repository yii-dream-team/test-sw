$('body').on('click', '.j-order-item-delete-row', function () {
    var $items = $('#order-item-rows'),
        $itemsCount = $items.find('.order-item-row').length;
        $this = $(this);

    $this.closest('.order-item-row').hide();
    $this.next().val(1);
});

$('body').on('click', '.j-order-item-add-row', function () {
    var $items = $('#order-item-rows'),
        $itemsCount = $items.find('.order-item-row').length,
        template = $('#order-item-row-template').html();
    template = template.replace(new RegExp(':counter:', 'g'), $itemsCount);
    $items.append(template);
})
