<?php include ("header.php");
    if($_SESSION["Name"]=='Admin'){ $formId='fmSearchMusicAdmin';}
    else{$formId='fmSearchMusic';}
?>

    <form action="home.php" id=<?php echo $formId; ?> method="POST">
        <fieldset> 
            <label for="txtFilm">Search Music By:</label>
            <select name="searchBy" id="searchBy">
                <option value="artist">Artist</option>
                <option value="album">Album</option>
                <option value="track">Track</option>
            </select>
            <input type="text" id="txtMusic" name="name" required>
            <button id="btnSubmit" type="submit">Search</button>
        </fieldset>
    </form>
    
<section id="searchResults">  
    
</section>
<div id="loading">
        <img src="img/loading.gif">
</div>
<div id='show'>
<div id='edit'>
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close" id ="span">&times;</span>
    <div class="modal-content" id="modalCont">
        
        <form action='home.php' id="fmBuy" method="POST">
            <input id="cusId" name="CustomerId" type="hidden" value=<?php echo $_SESSION["CustomerId"]; ?> required tabindex="1"><br>
            <label for="ba">Billing Address:</label>
            <input id="billAdd" name="BillingAddress" type="text" value=<?php echo $_SESSION["Address"]; ?> required tabindex="2"><br>
            <label for="bct">City:</label>
            <input id="billCty" name="BillingCity" type="text" value=<?php echo $_SESSION["City"]; ?> required tabindex="3" ><br>
            <label for="bs">State:</label>
            <input id="billSt" name="BillingState" type="text" value=<?php echo $_SESSION["State"]; ?> required tabindex="4"><br>
            <label for="bc">Country:</label>
            <input id="billCon" name="BillingCountry" type="text" value=<?php echo $_SESSION["Country"]; ?> required tabindex="5"><br>
            <label for="pc">PostalCode:</label>
            <input id="billPcd" name="BillingPostalCode" type="text" value=<?php echo $_SESSION["PostalCode"]; ?> required tabindex="6">
            <input id="trackCount" type="hidden" value="0" >
            <input id="totalCost" type="hidden" value="0" ><br>
        
        </from>
        <div id="invSub">
    </div>
    

  
    
  <!-- Modal content -->
  
    
    



    
 <?php include_once('footer.php');?> 