$(function(){
    let $addTaskBtn = $("#add-task"),
        $taskList = $("#task-list"),
        $spinnerIcon = $('<i class="fas fa-spinner fa-spin"></i>');
        
    $taskList.on("click", ".delete-task", e => {
        e.preventDefault();
        let $clicked = $(e.target)
        $.post("task/"+$clicked.data("taskid")+"/remove", r => {
            console.log(r)
            $clicked.parents("tr").remove()
            window.location.reload()
        })
    })    

    $taskList.on("click", ".create-task", e => {
        e.preventDefault();
        let priority = $("#priority").val(),
            name = $("#name").val(),
            description = $("#description").val();
        let data = {
            priority,
            name,
            description
        }
        $.post("/create", data,  r => {
            $clicked.parents("tr").remove()
            window.location.reload()
        })
    })

    $taskList.on("click", ".complete-task", e => {
        e.preventDefault();
        var $clicked = $(e.target)
        $.post("task/"+$clicked.data("taskid")+"/complete", r => {
            console.log(r)
            $spinnerIcon.detach()
            window.location.reload()
        })
    })

    $('#tasksTbl').DataTable( {
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }]
    } );
})