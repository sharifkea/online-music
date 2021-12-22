<?php require 'header.php'; ?>
<script src="js/editCustomer.js"></script>
<div class="">
    <div class="">
        <div class="">
            <h2>Edit Profile</h2>
        </div>
        <div class="formEdit">  
            <form action="EditCustomer.php" id="editCust" method="POST" class="edit">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input  type="text" name="FirstName" id="fname" value=<?php echo $_SESSION['FirstName']; ?> require>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input  type="text" name="LastName" id="lname" value=<?php echo $_SESSION['LastName']; ?> require>
                </div>             
                <div class="form-group">
                    <label for="company">Company</label>
                    <input  type="text" name="Company" id="company" value=<?php echo $_SESSION['Company']; ?> >
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input  type="text" name="Address" id="address" class="form-control" value=<?php echo $_SESSION['Address']; ?>>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input  type="text" name="City" id="city" class="form-control" value=<?php echo $_SESSION['City']; ?>>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input  type="text" name="State" id="state" class="form-control" value=<?php echo $_SESSION['State']; ?>>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="Country" id="country" class="form-control" value=<?php echo $_SESSION['Country']; ?>>
                </div>
                <div class="form-group">
                    <label for="postalcode">Postal Code</label>
                    <input  type="text" name="PostalCode" id="postalcode" class="form-control" value=<?php echo $_SESSION['PostalCode']; ?>>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input  type="phone" name="Phone" id="phone" class="form-control" value=<?php echo $_SESSION['Phone']; ?> >
                </div>
                <div class="form-group">
                    <label for="fax">Fax</label>
                    <input  type="text" name="Fax" id="fax" class="form-control" value=<?php echo $_SESSION['Fax']; ?> >
                </div>
                <div class="form-group">
                    <input  type="hidden"  name="CustomerId" id="customerId" value=<?php echo $_SESSION['CustomerId']; ?>>
                </div>       
                <div class="form-group">
                    <button type="submit" class="btn btn-info" id="editCustomer">Edit Customer</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
