$(document).ready(function () {

    var customerRecords = $('#customerListing').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "searching": true,
        // "bFilter": false,
        "ordering": false,
        "responsive": true,
        'serverMethod': 'post',
        "ajax": {
            url: "customer_action.php",
            type: "POST",
            // data: {action: 'listCustomer'},
            data:function(d) {
                if (d.search.value != null && d.search.value !== "" ) {
                    d.action = 'findCustomer';
                } else {
                    d.action = 'listCustomer';
                }
            },
            dataType: "json"
        },
        "columnDefs": [
            {
                "targets": [0, 10, 11, 12],
            },
        ],
        "pageLength": 10
    });

    $('#addCustomer').click(function () {
        $('#customerModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#customerModal").on("shown.bs.modal", function () {
            $('#customerForm')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Customer");
            $('#action').val('addCustomer');
            $('#save').val('Save');
        });
    });

    $("#customerListing").on('click', '.update', function () {
        var id = $(this).attr("id");
        var action = 'getCustomer';
        $.ajax({
            url: 'customer_action.php',
            method: "POST",
            data: {id: id, action: action},
            dataType: "json",
            success: function (data) {
                $("#customerModal").on("shown.bs.modal", function () {
                    $('#id').val(data.customer_nr);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#company').val(data.company);
                    $('#address').val(data.address);
                    $('#city').val(data.city);
                    $('#country').val(data.country);
                    $('#zip').val(data.zip);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('.modal-title').html("<i class='fa fa-plus'></i> Edit Customer");
                    $('#action').val('updateCustomer');
                    $('#save').val('Save');
                }).modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });
    });

    $("#customerModal").on('submit', '#customerForm', function (event) {
        event.preventDefault();
        $('#save').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url: "customer_action.php",
            method: "POST",
            data: formData,
            success: function (data) {
                $('#customerForm')[0].reset();
                $('#customerModal').modal('hide');
                $('#save').attr('disabled', false);
                customerRecords.ajax.reload();
            }
        })
    });

    $("#customerListing").on('click', '.delete', function () {
        var id = $(this).attr("id");
        var action = "deleteCustomer";
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "customer_action.php",
                method: "POST",
                data: {id: id, action: action},
                success: function (data) {
                    customerRecords.ajax.reload();
                }
            })
        } else {
            return false;
        }
    });

});