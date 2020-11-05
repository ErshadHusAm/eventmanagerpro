<div class="row">
    <div class="col-md-12">
        <h4>Add your To do List against event</h4><hr>
        <?php
            if (empty($event_list) || $event_list == null) {
        ?>
            <center><span class="text-danger"><i>Sorry user! </i> You must add a event </span></center>
        <?php
            }else{
        ?>
        <form id="frm_to_do" method="post" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="event_category">Choose event <i class="fa fa-asterisk required"></i></label>
                </div>
                <div class="form-group col-md-4">
                    <select id="event_category" class="form-control"  name="event_category">
                      <option value="">Please Select</option>
                      <?php
                      foreach($event_list as $event){
                         echo "<option value='".$event->event_id."'>".$event->event_category." - ".$event->event_type." - ".$event->event_name."</option>";
                      }
                      ?>
                    </select>
                    <p class="error_input" id="label_error_event_category"></p>
                </div>
                <div class="form-group col-md-2">
                    <label for="event_budget" class="float-right">Note <i class="fa fa-asterisk required"></i></label>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="todo_desc" name="todo_desc" placeholder="Take a Note" >
                    <p class="error_input" id="label_error_todo_desc"></p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <button type="button" id="btn_add_todo" class="btn btn-warning btn_add_todo float-right">
                        <i class="fa fa-spin fa-spinner" style="display: none"></i>
                        Add Note
                    </button>
                </div>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
    <div class="col-md-12">
        <hr><h4>View all To Do (Note) list</h4><hr>
        <div class="table-responsive">
          <?php
          foreach ($event_list as $key => $event) {
            echo "<h2>$event->event_name</h2>";
            ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="60%">To Do List</th>
                        <th width="20%">Status</th>
                        <th class="text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($event->emails)){
                    foreach ($event->emails as $key => $email) {
                        ?>
                        <tr>
                            <td><?php echo $email->todo_desc ? $email->todo_desc : " "?></td>
                            <td>
                                <?php if($email->status == 1){ ?>
                                    <b class="text-success">Done</b>
                                <?php }elseif ($email->status == 0) {?>
                                    <b class="text-danger">Not Done</b>
                                <?php }?>
                            </td>
                            <td>
                                <span class="btn_delete_todo btn-danger btn-sm" style="cursor: pointer" title="Delete to do" data-todo-id="<?php echo $email->todo_list_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    Delete
                                </span>
                                <?php if($email->status == 1){ ?>
                                    <span class="btn_change_status btn-danger btn-sm" style="cursor: pointer" title="Make it Not Done"
                                    data-status-id="0" data-todo-id="<?php echo $email->todo_list_id;?>">
                                        <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                        <i class="fa fa-ban"></i>
                                    </span>
                                <?php }elseif ($email->status == 0) {?>
                                    <span class="btn_change_status btn-success btn-sm" style="cursor: pointer" title="Make it Done"
                                    data-status-id="1" data-todo-id="<?php echo $email->todo_list_id;?>">
                                        <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                        <i class="fa fa-check"></i>
                                    </span>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
                        }
                    } else{
                    ?>
                        <tr><td colspan="5">No Result Found</td></tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>

            <?php
          }
          ?>

        </div>
    </div>
</div>
