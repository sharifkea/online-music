$(document).ready(function() {
    // Get all from albums for dropdown
    $.ajax({
        type:"GET",
        url: "https://sharifs-music-api.herokuapp.com/api/artist?name=",
        success: function(data){
            $.each(data.artist, function (key, value) {
                $("#artistDrop").append($("<option>", {value: value.ArtistId, text: value.Name}));
            })

        }
    });


    $(document).delegate('#addAlbum', 'click', function(event) {
        event.preventDefault();
        
        let title = $('#title').val();
        
        if(title == null || title == "") {
            alert("Track Title is required");
            return;      
        }

        const formData = $("#add_album").serialize();
        
        $.ajax({
            type: "POST",
            url: 'https://sharifs-music-api.herokuapp.com/api/album/new',
            data: formData,
            success: function(result) {
                console.log(formData);
                console.log(result)
                alert('New Album is Added.');
                window.location.href ='home.php';
            },
            error: function(err) {
                alert(err);
                console.log("Error")
            }
        });
    });
}); 
