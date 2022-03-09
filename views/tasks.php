
<div>
  <div class="float-end m-4">
    <button class="btn btn-primary">
        All <span class="badge bg-secondary"><?= count($tasks) ?></span>
    </button>
    <button class="btn btn-warning">
        Pending <span class="badge bg-secondary"><?= $pendingTaskCount ?></span>
    </button>
    <button class="btn btn-success">
        Completed <span class="badge bg-secondary"><?= $completedTaskCount ?></span>
    </button>
  </div>

  <table id="tasksTbl" class="table table-striped display">
      <thead class="table-light">
          <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Status</th>
              <th scope="col">Priority</th>
              <th scope="col">Date Created</th>
              <th scope="col">Date Completed</th>
              <th scope="col">Actions</th>
          </tr>
      </thead>
      <tbody id="task-list">
          
          <?php foreach($tasks as $task): ?>
          <tr>
              <td><a href="/task/<?= $task['Id']; ?>/view" ><?= $task['Id']; ?></a></td>
              <td><?= $task['Name']; ?></td>
              <td><?= $task['Status'] ? "Completed" : "Pending"; ?></td>
              <td><?= $task['Priority']; ?></td>
              <td><?= $task['DateCreated']; ?></td>
              <td><?= $task['CompletedDate']; ?></td>
              <td class="m-2">

                  <button type="button" class="btn btn-success complete-task <?= $task['Status'] ? "visually-hidden" :"";?>" data-taskid="<?= $task['Id']; ?>">Complete</button>
                  <button type="button" class="btn btn-danger delete-task" data-taskid="<?= $task['Id']; ?>">Remove</button>
                  <button type="button " data-bs-toggle="modal" data-bs-target="#updateTaskModal" class="btn btn-primary" data-priority="<?= $task['Priority']; ?>" data-title="<?= $task['Name']; ?>" data-taskid="<?= $task['Id']; ?>">Update</button>
              </td>
          </tr>
          <?php endforeach; ?>
      </tbody>
  </table>
  <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="updateTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateTaskModalLabel">Update Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="priority" class="col-form-label">Priority:</label>
              <select class="form-select" id="priority" name="priority" aria-label="Select Priority">
                <option selected>Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="updateTaskModalBtn" data-id="" data-priority="" class="btn btn-primary update-task">Update</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  let updateTaskModal = document.getElementById('updateTaskModal')
  let updateTask = document.getElementById('updateTaskModalBtn')
  let priorityElem = document.getElementById('priority')
  updateTaskModal.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget

    var id = button.getAttribute('data-taskid')
    var title = button.getAttribute('data-title')
    var priority = button.getAttribute('data-priority')
    var modalTitle = updateTaskModal.querySelector('.modal-title')

    modalTitle.textContent = 'Update  ' + title
    $('#priority').val(priority);
    updateTask.setAttribute('data-id',id)
    updateTask.setAttribute('data-priority',$('#priority').val())
  })

  priorityElem.addEventListener("change", e => {
      e.preventDefault();
      updateTask.setAttribute('data-priority',e.target.value)
  })
  
  updateTask.addEventListener("click", e => {
      
      e.preventDefault();
      let $clicked = $(e.target)
      console.log(updateTask.getAttribute('data-id'))
      console.log(updateTask.getAttribute('data-priority'))
      $.post("task/"+$clicked.data("id")+"/update-priority/"+$clicked.data("priority"), r => {
          console.log(r)
            window.location.reload()
      })
  })

    

</script>





