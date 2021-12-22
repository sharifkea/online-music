$(document).ready(function() {
    $(document).delegate('#editCustomer', 'click', function(event) {
      event.preventDefault();
      
      let fname = $('#fname').val();
      let lname = $('#lname').val();
      
      if(fname == null || fname == "") {
          alert("First Name is required");
          return;      
      }else if(lname == null || lname == "") {
        alert("Last Name is required");
        return;      
    }const formData = $("#editCust").serialize();
    console.log(formData);
    $.ajax({
        type: "POST",
        url: 'https://sharifs-music-api.herokuapp.com/api/customer',
        data: formData,
        success: function(result) {
            console.log(formData);
            console.log(result)
            alert('Your Profile Edited Successfully. Pleas Login again.');
            window.location.href ='logout.php';
        },
        error: function(err) {
            alert(err);
            console.log("Error")
        }
    });
  });
});