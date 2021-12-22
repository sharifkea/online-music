$(document).ready(function() {
      $(document).delegate('#addArtist', 'click', function(event) {
        event.preventDefault();
        
        let name = $('#name').val();
        
        if(name == null || name == "") {
            alert("Artist Name is required");
            return;      
        }

        const formData = $("#add_artist").serialize();
        
        $.ajax({
            type: "POST",
            url: 'https://sharifs-music-api.herokuapp.com/api/artist/new',
            data: formData,
            success: function(result) {
                console.log(formData);
                console.log(result)
                alert('New Artist is Added.');
                window.location.href ='home.php';        },
            error: function(err) {
                alert(err);
                console.log("Error")
            }
        });
    });
}); 
