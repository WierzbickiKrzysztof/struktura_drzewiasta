function fillForm(name, id) {
    $('#parent_id').val(id);
    $('#parent_disp').val(name);
}

function editForm(name, id, position) {
    $('#editForm').attr('action', '/tree/'+id);
    $('#name_edit').val(name);
    $('#position_edit').val(position);

    // position = JSON.parse(position);
    //
    //
    // $('#position_edit').empty();
    //
    // var option = document.createElement('option');
    // option.text = '--bez zmiany węzła rodzica--';
    // //option.disabled = true;
    // option.selected = true;
    // option.value = 0;
    // document.querySelector('#position_edit').add(option, 0)
    //
    //
    // position.forEach(optionsFunction);
    // function optionsFunction(item, index, arr) {
    //     var option = document.createElement('option');
    //     option.text = position[index];
    //     option.value = position[index];
    //
    //     document.querySelector('#position_edit').add(option, null)
    // }




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


// function move(arr, old_index, new_index) {
//     while (old_index < 0) {
//         old_index += arr.length;
//     }
//     while (new_index < 0) {
//         new_index += arr.length;
//     }
//     if (new_index >= arr.length) {
//         var k = new_index - arr.length;
//         while ((k--) + 1) {
//             arr.push(undefined);
//         }
//     }
//     arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
//     return arr;
// }
//
// var position = JSON.parse($('#position').val())
//
//
// console.log(move(position, 0, 1));
