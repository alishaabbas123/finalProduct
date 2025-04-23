<?php include "template/header.php"; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="timetable.css">

<!-- Modal 1 for adding to the database-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <label for="Day">Day</label>
          <select name="days" id="days" required>
            <option value="">Select a Day</option>
            <option value="mon">Monday</option>
            <option value="tue">Tuesday</option>
            <option value="wed">Wednesday</option>
            <option value="thu">Thursday</option>
            <option value="fri">Friday</option>
            <option value="sat">Saturday</option>
            <option value="sun">Sunday</option>
          </select>

          <label for="Activity">Activity</label>
          <input type="text" name="activity" id="activity" required>

          <label for="desc">Description</label>
          <input type="text" name="description" id="desc">

          <label for="time">Time</label>
          <input type="time" id="time" name="time" required>

          <label for="date">Date</label>
          <input type="date" id="date" name="date" required>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="save" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>






<div class="layout">
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Tasks</th>
          <th>Day</th>
          <th>Activity</th>
          <th>Description</th>
          <th>DateTime</th>
          
        </tr>
        <tr>
          
        </tr>
      </thead>
      <tbody>
        <?php
        include_once "activity_config.php";

        $sql = "SELECT * FROM activity";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) < 1) {
          echo '<tr><td colspan="6" class="text-center">No records found</td></tr>';
        } else {
          foreach ($rows as $row) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['days']}</td>
                    <td>{$row['activity']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['time']}</td>
                    
                    

                    
            
                  </tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="control">
    <button><a href='update_timetable.php' class="update" >update</a></button>
    <button ><a href='deleteTimetable.php' class="update" >delete</a></button>
    <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
      Add
    </button>
  </div>
</div>

<?php include "template/footer.php"; ?>
