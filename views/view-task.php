<div class="mb-3">
    <label for="name" class="form-label">Description: <span><?= $task->Description;?></span></label>
</div>
<div class="mb-3">
    <label for="name" class="form-label">Priority: <span><?= $task->Priority;?></span></label>
</div>
<div class="mb-3">
    <label for="name" class="form-label">Status: <span><?= $task->Status ? "Completed" : "Pending";?></span></label>
</div>