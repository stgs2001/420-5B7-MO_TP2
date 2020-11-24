$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter 
    $('#category-id').change(function () {
        var categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'category_id=' + categoryId,
                success: function (Products) {
                    $select = $('#product-id');
                    $select.find('option').remove();
                    $.each(Products, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.title + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#product-id').html('<option value="">Select category first</option>');
        }
    }).change();
});
