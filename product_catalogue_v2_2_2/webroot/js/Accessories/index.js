
// Update the accessories data list
function getAccessories() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
                function (data) {
                    var accessoryTable = $('#accessoryData');
                    accessoryTable.empty();
                    $.each(data.accessories, function (key, value)
                    {
                        var editDeleteButtons = '</td><td>' +
                                '<a href="javascript:void(0);" class="btn btn-warning" rowID="' +
                                    value.id + 
                                    '" data-type="edit" data-toggle="modal" data-target="#modalAccessoryAddEdit">' + 
                                    'edit</a>' +
                                '<a href="javascript:void(0);" class="btn btn-danger"' +
                                    'onclick="return confirm(\'Are you sure to delete data?\') ?' + 
                                    'accessoryAction(\'delete\', \'' + 
                                    value.id + 
                                    '\') : false;">delete</a>' +
                                '</td></tr>';
                        accessoryTable.append('<tr><td>' + value.id + '</td><td>' + value.title + '</td><td>' + value.description + editDeleteButtons);
 
                    });

                }

    });
}

 /* Function takes a jquery form
 and converts it to a JSON dictionary */
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}


function accessoryAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var accessoryData = '';
    var ajaxUrl = urlToRestApi;
    frmElement = $("#modalAccessoryAddEdit");
    if (type == 'add') {
        requestType = 'POST';
        accessoryData = convertFormToJSON(frmElement.find('form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        ajaxUrl = ajaxUrl + "/" + id;
        accessoryData = convertFormToJSON(frmElement.find('form'));
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    frmElement.find('.statusMsg').html('');
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(accessoryData),
        success: function (msg) {
            if (msg) {
                frmElement.find('.statusMsg').html('<p class="alert alert-success">Accessory data has been ' + statusArr[type] + ' successfully.</p>');
                getAccessories();
                if (type == 'add') {
                    frmElement.find('form')[0].reset();
                }
            } else {
                frmElement.find('.statusMsg').html('<p class="alert alert-danger">Some problem occurred, please try again.</p>');
            }
        }
    });
}

// Fill the accessory's data in the edit form
function editAccessory(id) {
    $.ajax({
        type: 'GET',
        url: urlToRestApi + "/" + id,//'accessoryAction.php',
        dataType: 'JSON',
        //data: 'action_type=data&id=' + id,
        success: function (data) {
            $('#id').val(data.accessory.id);
            $('#title').val(data.accessory.title);
            $('#description').val(data.accessory.description);
        }
    });
}

// Actions on modal show and hidden events
$(function () {
    $('#modalAccessoryAddEdit').on('show.bs.modal', function (e) {
        var type = $(e.relatedTarget).attr('data-type');
        var accessoryFunc = "accessoryAction('add');";
        $('.modal-title').html('Add new accessory');
        if (type == 'edit') {
            var rowId = $(e.relatedTarget).attr('rowID');
            accessoryFunc = "accessoryAction('edit'," + rowId + ");";
            $('.modal-title').html('Edit accessory');
            editAccessory(rowId);
        }
        $('#accessorySubmit').attr("onclick", accessoryFunc);
    }); 

    $('#modalAccessoryAddEdit').on('hidden.bs.modal', function () {
        $('#accessorySubmit').attr("onclick", "");
        $(this).find('form')[0].reset();
        $(this).find('.statusMsg').html('');
    });
});



