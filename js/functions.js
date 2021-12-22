"use strict";

// Creates a table where to display the movie data it receives as a parameter
function tableHeader() {
    $("section#searchResults").empty();
                                                        
    const table = $("<table />");
    const header = $("<thead />");
    const headerRow = $("<tr />");
    headerRow.
    append($("<th />", { "text": "Name"})).
    append($("<th />", { "text": "Album Title"})).
    append($("<th />", { "text": "Artist Name"})).
    append($("<th />", { "text": "Media Type Name"})).
    append($("<th />", { "text": "Genre Name"})).
    append($("<th />", { "text": "Unit Price", "class": "number"})).
    append($("<th />", { "class": "action"}))
    header.append(headerRow);
    table.append(header);
    return table;
}

function tableBodyTrack(data, tableBody) {
    $.each(data.track, function (key, value) {
        const thisTrack= value;
        const row = $("<tr />");
        const trackID = value.TrackId;
        row.
            append($("<td />", { "text": value.Name})).
            append($("<td />", { "text":value.AlbumTitle})).
            append($("<td />", { "text": value.ArtistName})).
            append($("<td />", { "text":value.MediaTypeName})).
            append($("<td />", { "text": value.GenreName})).
            append($("<td />", { "text":value.UnitPrice, "class": "number"})).
            append($("<td />", { "html": "<img data-id='" + trackID + "' data-name='" + value.Name + "' data-unitP='" + value.UnitPrice + "' class='smallButton addCart' src='img/cart.png'>", "class": "action"}))
            
        tableBody.append(row);
    });
    return tableBody;
}
// Creates a table where to display the movie data it receives as a parameter
function tableHeaderAdmin(searchBy) {
    $("section#searchResults").empty();
                                                        
    const table = $("<table />");
    const header = $("<thead />");
    const headerRow = $("<tr />");
    switch (searchBy) {
        case 'artist':            
        headerRow.
            append($("<th />", { "text": "Artist Name"})).
            append($("<th />", { "class": "action"})).
            append($("<th />", { "class": "action"})).
            append($("<th />", { "class": "action"}))
            header.append(headerRow);
            break;
        case 'album':
            headerRow.
            append($("<th />", { "text": "Album Title"})).
            append($("<th />", { "class": "action"})).
            append($("<th />", { "class": "action"})).
            append($("<th />", { "class": "action"}))
            header.append(headerRow);
            break;
        case 'track':
            headerRow.
            append($("<th />", { "text": "Track Name"})).
            append($("<th />", { "class": "action"})).
            append($("<th />", { "class": "action"})).
            append($("<th />", { "class": "action"}))
            header.append(headerRow);
        default:
            headerRow;
            return;
    }
    table.append(header);
    return table;
}

function tableAdmin(data,searchBy) {
    //let tableBody = $("<tbody />");
    console.log(searchBy);
    console.log(data);
    
    switch (searchBy) {
        
        case 'artist':
            if (data.artist.length == 0 ) {
                alert("Sorry No Artist match found.");               
            }else{
                const table = $("<table />");
                const header = $("<thead />");
                const headerRow = $("<tr />");
                headerRow.
                    append($("<th />", { "text": "Artist Name"})).
                    append($("<th />", { "class": "action"})).
                    append($("<th />", { "class": "action"})).
                    append($("<th />", { "class": "action"}))
                header.append(headerRow);
                table.append(header);
                const tableBody = $("<tbody />");
                $.each(data.artist, function (key, value) {
                    const artistID = value.ArtistId;
                    const row = $("<tr />");           
                    row.
                        append($("<td />", { "text": value.Name})).
                        append($("<td />", { "html": "<img data-id='" + artistID + "' class='smallButton showArtist' src='img/show.png'>", "class": "action"})).
                        append($("<td />", { "html": "<img data-id='" + artistID + "' class='smallButton editArtist' src='img/edit.png'>", "class": "action"})).
                        append($("<td />", { "html": "<img data-id='" + artistID + "' class='smallButton deleteArtist' src='img/delete.png'>", "class": "action"}))
                    tableBody.append(row); 
                    
                });
                table.append(tableBody);
                table.appendTo($("section#searchResults"));
            }
            break;
              
        case 'album':
            if (data.album.length == 0 ) {
                alert("Sorry No Album match found.");               
            }else{
                const table = $("<table />");
                const header = $("<thead />");
                const headerRow = $("<tr />");
                headerRow.
                    append($("<th />", { "text": "Album Title"})).
                    append($("<th />", { "class": "action"})).
                    append($("<th />", { "class": "action"})).
                    append($("<th />", { "class": "action"}))
                header.append(headerRow);
                table.append(header);
                const tableBody = $("<tbody />");
                $.each(data.album, function (key, value) {
                    const albumID = value.AlbumId;
                    const row = $("<tr />");           
                    row.
                        append($("<td />", { "text": value.Title})).
                        append($("<td />", { "html": "<img data-id='" + albumID + "' class='smallButton showAlbum' src='img/show.png'>", "class": "action"})).
                        append($("<td />", { "html": "<img data-id='" + albumID + "' class='smallButton editAlbum' src='img/edit.png'>", "class": "action"})).
                        append($("<td />", { "html": "<img data-id='" + albumID + "' class='smallButton deleteAlbum' src='img/delete.png'>", "class": "action"}))
                    tableBody.append(row); 
                    
                });
                table.append(tableBody);
                table.appendTo($("section#searchResults"));
            }
            break;
        case 'track':
            if (data.track.length == 0 ) {
                alert("Sorry No Track match found.");               
            }else{
                const table = $("<table />");
                const header = $("<thead />");
                const headerRow = $("<tr />");
                headerRow.
                    append($("<th />", { "text": "Track Name"})).
                    append($("<th />", { "class": "action"})).
                    append($("<th />", { "class": "action"})).
                    append($("<th />", { "class": "action"}))
                header.append(headerRow);
                table.append(header);
                const tableBody = $("<tbody />"); 
                $.each(data.track, function (key, value) {
                    const trackID = value.TrackId;
                    const row = $("<tr />");           
                    row.
                        append($("<td />", { "text": value.Name})).
                        append($("<td />", { "html": "<img data-id='" + trackID + "' class='smallButton showTrack' src='img/show.png'>", "class": "action"})).
                        append($("<td />", { "html": "<img data-id='" + trackID + "' class='smallButton editTrack' src='img/edit.png'>", "class": "action"})).
                        append($("<td />", { "html": "<img data-id='" + trackID + "' class='smallButton deleteTrack' src='img/delete.png'>", "class": "action"}))
                    tableBody.append(row); 
                    
                });
                table.append(tableBody);
                table.appendTo($("section#searchResults"));
            }
            break;            
        default:
            alert('Something Went Wrong');
            return;
    }   
    
}
function tableBodyTrackAdmin(name,id,tableBody,searchBy) {


}
function loadingStart() { 
    $("#loading").show(); 
    $("#searchResults").empty(); 
}

// Hide the "loading" animated gif
function loadingEnd() { 
    $("#loading").hide(); 
}

   function getAjaxApi(myUrl){
        
        $.ajax({
            url:myUrl,
            type : 'GET',                
            success: function (result) {
                return(result);
            },
            error: function(err) {
                alert('error');
                return(err);
            }
        });
    }
    function postAjaxApi(myUrl){
        
        $.ajax({
            url:myUrl,
            type : 'POST',                
            success: function (result) {
                return(result);
            },
            error: function(err) {
                alert('error');
                return(err);
            }
        });
    }





