<?php
include_once 'config/Database.php';

?>
<title>SimpleCRM</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css"/>
<script src="js/customer.js"></script>
<?php include('inc/container.php'); ?>
<div class="container" style="background-color:#f4f3ef;">
    <h2>SimpleCRM</h2>
    <div>
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="col-md-2" align="right">
                    <button type="button" id="addCustomer" class="btn btn-info" title="Add Customer"><span
                                class="glyphicon glyphicon-plus"></span></button>
                </div>
            </div>
        </div>
        <div>
            <table>
                <tr id="filter_global">
                    <td>Search: </td>
                    <td><input type="text" class="global_filter" id="global_filter"></td>
                </tr>
            </table>
        </div>
        <table id="customerListing" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Customer Nr.</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Company</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>ZIP</th>
                <th>Phone</th>
                <th>E-Mail</th>
                <th>Create Date</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>

    <div id="customerModal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="customerForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Customer</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"
                        <label for="first_name" class="control-label">Firstname</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="Firstname" required>
                    </div>

                    <div class="form-group"
                    <label for="last_name" class="control-label">Lastname</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Lastname"
                           required>
                </div>

                <div class="form-group">
                    <label for="company" class="control-label">Company</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Company" required>
                </div>

                <div class="form-group">
                    <label for="address" class="control-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                </div>

                <div class="form-group">
                    <label for="city" class="control-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                </div>

                <div class="form-group">
                    <label for="country" class="control-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>
                </div>

                <div class="form-group">
                    <label for="zip" class="control-label">ZIP</label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP" required>
                </div>

                <div class="form-group">
                    <label for="phone" class="control-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">E-Mail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" required>
                </div>

        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="id"/>
            <input type="hidden" name="action" id="action" value=""/>
            <input type="submit" name="save" id="save" class="btn btn-info" value="Save"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    </form>
</div>
</div>

</div>
