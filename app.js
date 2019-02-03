
var currentTODO;
$("#addButton").click(function(e){
    var text = $('#text').val();
   
$.ajax({
    method:"POST",
    url:'ajax.php',
    data:{text:text},
    
    success:function(data,textStatus,xhr)
    {   //console.log(xhr);
        $(data).hide().appendTo('.todoList').fadeIn();
    }
});
//e.preventDefault();
});

    // If any link in the todo is clicked, assign
    // the todo item to the currentTODO variable for later use.
$('.todo a').click(function(e)
{
currentTODO = $(this).closest('.todo');
currentTODO.data('id',currentTODO.attr('id').replace('todo-',''));
//alert(currentTODO.data('id'));
e.preventDefault();
});

$('.todo a.edit').click(function(e)
{

    var container = currentTODO.find('.text');
    //console.log(currentTODO.data());
    if(currentTODO.data('origText') == null)
    {
                    // Saving the current value of the ToDo so we can
            // restore it later if the user discards the changes:
          currentTODO.data('origText',container.text());
    }
    else
    {
        // This will block the edit button if the edit box is already open:
        return false;
    }
    $("<input type='text'>").val(container.text()).appendTo(container.empty());
    
            // Appending the save and cancel links:
            container.append(
                '<div class="editTodo">'+
                '<button onclick="save()" href="">Save</button> Or <button  onclick="cancel()" class="discardChanges" href="">Cancel</button>'
                +'</div>'
            );

});
// cancel edit
function cancel(){
   console.log('test');
    currentTODO.find('.text')
                .text(currentTODO.data('origText'))
                .end()
                .removeData('origText');
                
};

//save link
function save(){
    var text = currentTODO.find('input[type=text]').val();
    var id = currentTODO.data('id');
    //console.log('test');
    $.ajax({
        method:"POST",
        url:'ajax.php',
        data:{text:text,id:id},
        success:function(data,textStatus,xhr){
            alert(data);
        }
    });
};

$("#dialog-confirm").dialog({
    resizable: false,
    height:200,
    modal: true,
    autoOpen:false,
    buttons: {
        'Delete item': function() {
            var id = currentTODO.data('id');
            $.ajax({
                method:'GET',
                url:"ajax.php",
                data:{id:id},
                success:function(data,textStatus,xhr){
                    console.log(data);
                currentTODO.fadeOut('fast');
            }
        });

            $(this).dialog('close');
        },
        Cancel: function() {
            $(this).dialog('close');
        }
    }
});

$('.todo a.delete').click(function(){
    $("#dialog-confirm").dialog('open');
});


//rearrange todo list
$('.todoList').sortable({
    axis:"y",           // Only vertical movements allowed
    containment:'window',
    update:function()   // The function is called after the todos are rearranged
    {
                    // The toArray method returns an array with the ids of the todos
        var arr = $('.todoList').sortable('toArray');
           // Striping the todo- prefix of the ids:
           arr = $.map(arr,function(val,key)
           {
               return val.replace('todo-','');
           });
           //console.log(arr);
           $.ajax({
            method:"POST",
            url:'ajax.php',
            data:{positions:arr},
            success:function(data,textStatus,xhr)
            {
                console.log(data);
            }
           });
    }

});