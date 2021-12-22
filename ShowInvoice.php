<?php require_once 'header.php'; ?>
<script src="js/showInvoice.js">
   
</script>

<div class="">
    <h2>Show Invoice</h2>
</div>
<div class="form-group">
    <input  type="hidden"  name="CustomerId" id="customerId" value=<?php echo $_SESSION['CustomerId']; ?>>
</div>
<div class="">
    <form action="ShowInvoice.php" method="post" id="show_invoice">
        <div class="form-group">
            <label for="ShowInvoice">Invoice Id</label>
            <select name="InvoiceId" id="invoiceDrop" reqire>				
            </select>
        </div>             
        <div class="form-group">
            <button id='showInvoice' type="submit" class="btn btn-info">Show</button>
        </div>
    </form>
</div>
<div id="showResults">  
        

    

<?php require 'footer.php'; ?>
