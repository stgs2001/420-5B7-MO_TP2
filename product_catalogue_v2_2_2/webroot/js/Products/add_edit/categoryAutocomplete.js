(function ($) {
    // Get the path to action from CakePHP
    var autoCompleteSource = urlToAutocompleteAction;
    $('#autocomplete').autocomplete({
        source: autoCompleteSource,        
        minLength: 1
        ,
        select: function (event, ui) {
            $("#category-id" ).val(ui.item.value );
            $("#autocomplete").val(ui.item.label);
            return false;
        }
    });
})(jQuery);
