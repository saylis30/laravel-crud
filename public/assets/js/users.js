$(function(){
    $('#add_user_form')[0].reset();
    $("#add_user_form").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType:false,
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(response){
                if(response.status == 0){
                    if (response.hasOwnProperty('action') && response.action == 'update') {
                        $('#addusermodal').modal('hide');
                        toastr.info(response.msg);
                    }else{
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                }else{
                    $('#add_user_form')[0].reset();
                    $('#addusermodal').modal('hide');
                    $("#tablecontainer").load(user_table_reload_route);
                    toastr.success(response.msg);
                }
            }
        });
    })
});

$("#addusers").click(function(){
    $('#add_user_form')[0].reset();
    $('#addusermodalLable').text('Add User');
    $('span.error-text').text('');
    $('#add_user_form').attr('action', add_user_route);
});

function deleteRecord(rowid){
    $.ajax({
        url: 'delete',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        data: {'id' : rowid},
        dataType: 'json',
        beforeSend: function(){
        },
        success: function(response){
            if(response.status == 0){
                toastr.error(response.msg);
            }else{
                toastr.success(response.msg);
                $("#tablecontainer").load(user_table_reload_route);
            }
        }
    });
}

function getRecord(rowid){
    $.ajax({
        url: 'edit',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        data: {'id' : rowid},
        dataType: 'json',
        beforeSend: function(){
        },
        success: function(response){
            if(response.status == 0){
                toastr.error(response.msg);
            }else{
                $('#addusermodal').modal('show');
                $('#add_user_form').attr('action', update_user_route);
                $('#addusermodalLable').text('Edit User');
                $('#recordid').val(response.data.id);
                $('#name').val(response.data.name);
                $('#email').val(response.data.email);
                $('#mobileno').val(response.data.mobileno);
                $('#status').val(response.data.status);
            }
        }
    });
}