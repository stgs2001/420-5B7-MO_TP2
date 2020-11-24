<?php
$urlToRestApi = $this->Url->build('/api/accessories', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Accessories/index', ['block' => 'scriptBottom']);
?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 head">
                    <h5>Accessories</h5>
                    <!-- Add link -->
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" data-type="add" data-toggle="modal" data-target="#modalAccessoryAddEdit"><i class="plus"></i> New Accessory</a>
                    </div>
                </div>
                <div class="statusMsg"></div>
                <!-- List the accessories -->
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="accessoryData">
                        <?php if (!empty($accessories)) {
                            foreach ($accessories as $row) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-warning" rowID="<?php echo $row['id']; ?>" data-type="edit" data-toggle="modal" data-target="#modalAccessoryAddEdit">edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="return confirm('Are you sure to delete data?') ? accessoryAction('delete', '<?php echo $row['id']; ?>') : false;">delete</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr><td colspan="5">No accessories(s) found...</td></tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Modal Add and Edit Form -->
        <div class="modal fade" id="modalAccessoryAddEdit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Accessory</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="statusMsg"></div>
                        <form role="form">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter description">
                            </div>
                            <input type="hidden" class="form-control" name="id" id="id"/>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="accessorySubmit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

