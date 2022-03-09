
<form method="POST" name="createTask">
	<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Task Name">
  </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <select class="form-select" name="priority" aria-label="Select Priority">
            <option selected>Select Priority</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
          </select>
        </div>
		 <div class="mb-3">
     <button type="submit" class="btn btn-primary">Save</button>
    </div>
	</form>