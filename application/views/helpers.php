<script>
//Only when the document has fully loaded
$(document).ready(function() {

    //Any edit to be done uses this code for modal popu-up
  $('table tbody').on('click', 'tr .edit_me', function(e){
    e.preventDefault();
    var row = $(this).closest('tr');
    var tbl = row.parent().parent();
    tbl_id = $(tbl).attr("id");
    var dt = dTable[tbl_id];
    var data = dt.row(row).data();
    if(typeof (data) === 'undefined'){
      data = dt.row($(row).prev()).data();
      if(typeof (data) === 'undefined'){
        data = dt.row($(row).prev().prev()).data();
      }
    }
    var formId = tbl_id.replace("tbl","form");
    edit_data(data, formId);
  });

//Any delete to be done uses this code for modal popu-up
  $('table tbody').on('click', 'tr .delete_me', function(e){
    e.preventDefault();
    var row = $(this).closest('tr');
    var tbl = row.parent().parent();
    tbl_id = $(tbl).attr("id");
    var dt = dTable[tbl_id];
    var data = dt.row(row).data();
    if(typeof (data) === 'undefined'){
      data = dt.row($(row).prev()).data();
      if(typeof (data) === 'undefined'){
        data = dt.row($(row).prev().prev()).data();
      }
    }
    var controller = tbl_id.replace("tbl","");
    var url = "<?php echo site_url()?>/"+controller.toLowerCase()+"/delete";

    delete_item("Are you sure, you want to Delete",data.ID, url, tbl_id);
  });

// clear the fields in forms whose modal dialogs have been closed
$("div.modal").on("hide.bs.modal", function () {
    var forms = $('form', this);
    var datepicker = $('.datepicker');
    if(forms.length){
        forms[0].reset();
    }
    $('input[type="hidden"]', this).val('');
    if(datepicker.length){
        datepicker.datepicker('clearDates');
    }
    
});

});//End of the document is ready operations

//This function helps to add and update info
function saveData(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
            alert('Please fill all the fields correctly');
        } else {
            // everything looks good!
            e.preventDefault();
            var $form = $(e.target);//fv = $form.data('formValidation'),
            enableDisableButton(e.target, true);
            var formData = new FormData($form[0]);
            var id = $form.attr('id');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (feedback) {

                    //var feedback = JSON.parse(result);
                    if (!feedback.error) {
                        if (isNaN(parseInt(formData.get('id')))) {
                            $form[0].reset();
                            $modal = $form.parents('div.modal');
                            if ($modal.length) {
                                $($modal[0]).modal('hide');
                            }
                        }
                            setTimeout(function () {
                                var formId = $form.attr('id');
                                var tblId = formId.replace("form","tbl");
                                if(typeof dTable !== 'undefined' && typeof dTable[tblId] !== 'undefined'){
                                    dTable[tblId].ajax.reload(null, false);
                                }
                                if (typeof reload_data === "function") {
                                reload_data(formId, feedback);
                                }
                            }, 1000);
                    }else{
                        alert("Error was brought back");
                    }
                    enableDisableButton(e.target, false);
                    alert(feedback.message);
                    //console.log(data);
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    
                    //alert("The request was not completed. Contact IT support immediately");
                    network_error(jqXHR, textStatus, errorThrown, e.target);
                }
            });
        }
}//End of the saveData function

//This function helps to pass data for edit to the modal form
function edit_data(data_array, form) {
    $.each(data_array, function (key, val) {
        $.map($('#' + form + ' [name="' + key + '"]'), function (named_item) {
            if (named_item.type === 'radio' || named_item.type === 'checkbox') {
                $(named_item).prop("checked", (named_item.value === val ? true : false)).trigger('change');
            } else {
                $(named_item).val(val).trigger('change');
                date_picker = $("#" + key).parent(".datepicker");
                if (date_picker.length) {
                    date_picker.datepicker('setDate', val)
                }
            }
        });
    });
}

//function for deleting message
function confirm_delete(msg) {
    var really = confirm(msg + "?");
    return really;
}

//Delete function
function delete_item(msg, id, url, tblId) {
    
    if (confirm_delete(msg)) {
        $.post(
                url,
                {id: id},

                function (response) {
                    if (response.success) {
                        setTimeout(function () {
                            alert("Success: \n" + response.message);
                            //any other tasks(function) to be run here
                            if(typeof dTable !== 'undefined' && typeof dTable[tblId] !== 'undefined'){
                                dTable[tblId].ajax.reload(null, false);
                            }
                            //$(".modal").modal('hide');
                        }, 1000);
                    } else {
                        alert("Operation failed. Reason(s):<ol>" + response.message + "</ol>");
                    }
                },

                'json').fail(function (jqXHR, textStatus, errorThrown) {
            network_error(jqXHR, textStatus, errorThrown, $("#myform"));
        });
    }

    return false;
}//End of the deleting function

//function to format currencies
function curr_format(n) {
    var formatted = "";
    formatted = (n < 0) ? ("(" + numberWithCommas(n * -1) + ")") : numberWithCommas(n);
    return formatted;
}

//function for rounding off currecies
function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

//The function for making currency have commas
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

//register the summing function for dataTables
jQuery.fn.dataTable.Api.register('sum()', function ( ) {
    return this.flatten().reduce(function (a, b) {
        if (typeof a === 'string') {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if (typeof b === 'string') {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }

        return a + b;
    }, 0);
});

//send form data
$.fn.serializeObject = function ()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

//set options value afterwards
setOptionValue = function (propId) {
    return function (option, item) {
        if (item === undefined) {
            option.value = "";
        } else {
            option.value = item[propId];
        }
    };
};


function network_error(jqXHR, textStatus, errorThrown, formElement) {
    msg = "Network error. Please check your network/internet connection or get in touch with the admin.";
    status = jqXHR.status;
    switch (status) {
        case 500:
            msg = "There was a server problem.\nPlease report the following message to admin\n" + textStatus;
            break;
        case 404:
            msg = "The operation was unsuccessful.\n Please report the following message to admin\n" + textStatus + "\n" + errorThrown;
            break;
        default:
            break;
    }
    alert(msg);
    console.log("Status : " + textStatus + "\nStatus code: " + status + "\nResponse: " + errorThrown);
    enableDisableButton(formElement, false);
}
function enableDisableButton(frm, status) {
    $(frm).find(":input[type=submit], :button[type=submit]").prop("disabled", status);
}

function formatDate(date) {
      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          var d = new Date(date),
              month = '' + monthNames[(d.getMonth())],
              day = '' + d.getDate(),
              year = d.getFullYear();

          if (month.length < 2) month = '0' + month;
          if (day.length < 2) day = '0' + day;
              return [day, month, year].join(' ');
          }
</script>   