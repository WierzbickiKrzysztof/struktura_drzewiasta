function fillForm(name, id) {
    $('#parent_id').val(id);
    $('#parent_disp').val(name);
}

function editForm(name, id) {
    $('#editForm').attr('action', '/tree/'+id);
    $('#name_edit').val(name);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = {
        id_node: id,
    };
    var type = "POST";
    var ajaxurl = '../api/get/parents';
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {


            $('#parent_id_edit').empty();

            var option = document.createElement('option');
            option.text = '--bez zmiany węzła rodzica--';
            //option.disabled = true;
            option.selected = true;
            option.value = 0;
            document.querySelector('#parent_id_edit').add(option, 0)


            data.forEach(optionsFunction);
            function optionsFunction(item, index, arr) {
                var option = document.createElement('option');
                option.text = data[index].name;
                option.value = data[index].id;

                document.querySelector('#parent_id_edit').add(option, null)
            }

        },
        error: function (data) {
            console.log(data);
        }
    });

}


function checkChildren(name, id) {

    $('#name_node').val(name);

    $('#delForm').attr('action', '/tree/'+id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = {
        id_node: id,
    };
    var type = "POST";
    var ajaxurl = '../api/get/children';
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            $('#delInfo1').show();
            $('#delInfo2').hide();

            if(data == 0){
                $('#delInfo1').hide();
                $('#delInfo2').show();
            }

            $('#countNodes').text(data);



        },
        error: function (data) {
            console.log(data);
        }
    });
}


$('.show').hide();
$('.show').click(function(){
    $(this).parent().find('ul').slideToggle();
    $(this).next().show();
    $(this).hide();
});

$('.hide').click(function(){
    $(this).parent().find('ul').slideToggle();
    $(this).prev().show();
    $(this).hide();

});
