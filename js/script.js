"use strict";

const isExist=true;
const inCartId=[];
var count=0;

$(document).ready(function() {
    
    //Email available or not
    $(document).delegate('#verify', 'click', function(e) {
        e.preventDefault();
        const email = $('#em').val();
        if(email == null || email == ""){
            alert("Email is required");
            return
        }
        else{
            const myUrl="https://sharifs-music-api.herokuapp.com/api/customer/"+ email;
            $.ajax({
                url:myUrl,
                type : 'GET',                
                success: function (result) {
                    if(result['customer']['return']==true){
                        alert('A customer already using this Email. You can not use it for Registration.');
                    } else {
                        alert('You can use this email.');
                    }
                },
                error: function(err) {
                    alert('error');                    
                }
            });
            console.log(data);
            
        }
    });
        
   

    // Customer Registration
    $('#cr').on("submit", function(e) {
        e.preventDefault();
        const email = $('#em').val();
        const myUrl="https://sharifs-music-api.herokuapp.com/api/customer/"+ email;
        const regUrl="https://sharifs-music-api.herokuapp.com/api/customer/new";
        
        const fromData= $("#cr").serialize();
        console.log(fromData);
        console.log(myUrl)
        console.log(regUrl)
        $("#searchResults").show();
        $("#add").hide();
        $("#show").hide();
        $("#edit").hide();
        //console.log(toDb)
        $.ajax({
            url:myUrl,
            type : 'GET',                
            success: function (result) {
                console.log(result['customer']['return'])
                if(result['customer']['return']==false){
                    
                    $.ajax({
                        url: regUrl ,
                        type: "POST",
                        data: fromData,
                        success: function(result) {
                            console.log(result);
                            
                                alert('Customer added successfully');
                                window.location.href ='index.php';
                        
                        },
                        error: function(err) {
                            alert('error');
                            console.log(err)
                        }
                    });
                } else {
                    alert('Please try with another Email Address.');
                }
            },
            error: function(err) {
                alert('error');
                console.log("Error")
            }
        });
    });

    $('#fmSearchMusic').on("submit", function(e) {
        e.preventDefault();
        const searchBy = $('#searchBy').val();
        console.log(searchBy);
        const name = $('#txtMusic').val();
        console.log(name);
        if(searchBy=="album"){
            let myUrl="https://sharifs-music-api.herokuapp.com/api/"+ searchBy+"?title="+name;
            console.log(myUrl);
            
            $.ajax({
                url:myUrl,
                type : 'GET',                
                success: function (data) {
                    const table= tableHeader();            
                    let tableBody = $("<tbody />");
                    if (data.album.length == 0 ) {
                        alert("No Album match found.");               
                    }else{
                        $.each(data.album, function (key, value) {
                            let title = value.Title;
                            let albumId = value.AlbumId;
                            console.log(albumId); 
                            const myUrl="https://sharifs-music-api.herokuapp.com/api/track?albumId="+albumId;
                            console.log(myUrl);
                            $.ajax({
                                url:myUrl,
                                type : 'GET',                
                                success: function (data) {
                                    tableBody=tableBodyTrack(data, tableBody); 
                                    table.append(tableBody);
                                    table.appendTo($("section#searchResults"));         
                                },
                                error: function(err) {
                                    alert('error');
                                    console.log("Error")
                                }
                            });
                        });
                    }       
                },
                error: function(err) {
                    alert('error');
                    console.log("Error")
                }
            });
        }else  if(searchBy=="artist"){
            const myUrl="https://sharifs-music-api.herokuapp.com/api/"+ searchBy+"?name="+name;
            console.log(myUrl)
            $.ajax({
                url:myUrl,
                type : 'GET',                
                success: function (data) {
                    
                    const table= tableHeader();            
                    let tableBody = $("<tbody />");
                    if (data.artist.length == 0 ) {
                        alert("No Artist match found.");               
                    }else{
                        $.each(data.artist, function (key, value) {
                            let artistId = value.ArtistId;
                            console.log(artistId); 
                            const myUrl="https://sharifs-music-api.herokuapp.com/api/album?artistId="+artistId;
                            console.log(myUrl);
                            $.ajax({
                                url:myUrl,
                                type : 'GET',                
                                success: function (data) {
                        
                                    $.each(data.album, function (key, value) {
                                        let albumId = value.AlbumId;
                                        console.log(albumId); 
                                        const myUrl="https://sharifs-music-api.herokuapp.com/api/track?albumId="+albumId;
                                        console.log(myUrl);
                                        $.ajax({
                                            url:myUrl,
                                            type : 'GET',                
                                            success: function (data) {
                                                tableBody=tableBodyTrack(data, tableBody); 
                                                table.append(tableBody);
                                                table.appendTo($("section#searchResults"));         
                                            },
                                            error: function(err) {
                                                alert('error');
                                                console.log("Error")
                                            }
                                        });
                                    });
                                },
                                error: function(err) {
                                    alert('error');
                                    console.log("Error")
                                }
                            });                 
                        });              
                    }
                },
                error: function(err) {
                    alert('error');
                    console.log("Error")
                }
            });
        }else  if(searchBy=="track"){
            const myUrl="https://sharifs-music-api.herokuapp.com/api/"+ searchBy+"?name="+name;
            console.log(myUrl)
            $.ajax({
                url:myUrl,
                type : 'GET',                
                success: function (data) {
                    const table= tableHeader();            
                    let tableBody = $("<tbody />");
                    if (data.track.length == 0 ) {
                        alert("No Artist match found.");               
                    }else{
                        tableBody=tableBodyTrack(data, tableBody); 
                        table.append(tableBody);
                        table.appendTo($("section#searchResults"));         
                                            
                    }
                },
                error: function(err) {
                    alert('error');
                    console.log("Error")
                }
            });
        }
    });

    $('#fmSearchMusicAdmin').on("submit", function(e) {
        e.preventDefault();
        const searchBy = $('#searchBy').val();
        console.log(searchBy);
        const name = $('#txtMusic').val();
        console.log(name);
        let myUrl='';
        if(searchBy=='album')  myUrl="https://sharifs-music-api.herokuapp.com/api/"+ searchBy+"?title="+name;
        else myUrl="https://sharifs-music-api.herokuapp.com/api/"+ searchBy+"?name="+name;
        console.log(myUrl)
        loadingStart();
        $.ajax({
            url:myUrl,
            type : 'GET',                
            success: function (data) {
                console.log(data);                
                tableAdmin(data,searchBy);
                loadingEnd(); 
            },
            error: function(err) {
                alert('error');
                console.log("Error")
            }
        });
    });


    
        
    $(document).on("click", "img.deleteTrack", function() {
        const id = $(this).attr("data-id");

        if (confirm("Are you sure that you want to delete this Track?")) {
            const myUrl='https://sharifs-music-api.herokuapp.com/api/track/'+id;
            $.ajax({
                url:myUrl,
                type : 'DELETE',                
                success: function (data) {
                    if(data.track==true){
                        $("img[data-id=" + id + "]").parent().parent().remove(); 
                    }
                    else{
                        alert('This Track cannot be Deleted.');
                    }
                },
                error: function(err) {
                    alert('error');
                    console.log("Error")
                }
            

            });
        }
    });
    $(document).on("click", "img.deleteAlbum", function() {
        const id = $(this).attr("data-id");

        if (confirm("Are you sure that you want to delete this Track?")) {
            const myUrl='https://sharifs-music-api.herokuapp.com/api/album/'+id;
            $.ajax({
                url:myUrl,
                type : 'DELETE',                
                success: function (data) {
                    if(data.album==true){
                        $("img[data-id=" + id + "]").parent().parent().remove(); 
                    }
                    else{
                        alert('This Album cannot be Deleted.');
                    }
                },
                error: function(err) {
                    alert('error');
                    console.log("Error")
                }
            

            });
        }
    });

    $(document).on("click", "img.deleteArtist", function() {
        const id = $(this).attr("data-id");

        if (confirm("Are you sure that you want to delete this Track?")) {
            const myUrl='https://sharifs-music-api.herokuapp.com/api/artist/'+id;
            $.ajax({
                url:myUrl,
                type : 'DELETE',                
                success: function (data) {
                    if(data.artist==true){
                        $("img[data-id=" + id + "]").parent().parent().remove(); 
                    }
                    else{
                        alert('This Artist cannot be Deleted.');
                    }
                },
                error: function(err) {
                    alert('error');
                    console.log("Error")
                }
            

            });
        }
    });
    

    $(document).on("click", "img.showTrack, img.editTrack", function() {
        $("#fmSearchMusicAdmin").hide();
        const action = ($(this)[0].className === "smallButton showTrack" ? "show" : "edit");
        const id = $(this).attr("data-id");
        const myUrl='https://sharifs-music-api.herokuapp.com/api/track/?trackId='+id;
        $("#searchResults").hide();
        $("div#show").empty();          
        $.ajax({
            url:myUrl,
            type : 'GET',                
            success: function (data) {
                var output = '';
                const value=data.track[0];
                switch (action) {
                case 'show':
                    output +=
                        `<form id="fmInfo" method="POST">
                        <p> <strong>Name:</strong> ${value.Name}</p>
                        <p> <strong>Album Title:</strong> ${value.AlbumTitle}</p>
                        <p> <strong>Artist Name:</strong> ${value.ArtistName}</p>
                        <p> <strong>Media Type Name:</strong> ${value.MediaTypeName}</p>
                        <p> <strong>Genre Name:</strong> ${value.GenreName}</p>
                        <p> <strong>Composer:</strong> ${value.Composer}</p>
                        <p> <strong>Milliseconds:</strong> ${value.Milliseconds}</p>
                        <p> <strong>Bytes:</strong> ${value.Bytes}</p>
                        <p> <strong>Unit Price:</strong> ${value.UnitPrice}</p>
                        <br>
                        <button type="submit" id="btnExit">Exit</button>
                        </form>`;
                    break;
                case 'edit':
                    output +=
                        `<form action='home.php' id="fmUpd" method="POST">
                        <label for="tn">Name:</label>
                        <input id="tnUDT" name="Name" type="text" value="${value.Name}" required tabindex="1"><br>
                        <label for="an">Artist Name:</label>
                        <input id="cmUDT" name="Composer" type="text" value="${value.Composer}" required tabindex="2" ><br>
                        <label for="ms">Milliseconds:</label>
                        <input id="msUDT" name="Milliseconds" type="text" value="${value.Milliseconds}" required tabindex="3"><br>
                        <label for="bt">Bytes:</label>
                        <input id="btUDT" name="Bytes" type="text" value="${value.Bytes}" required tabindex="4"><br>
                        <label for="up">Unit Price:</label>
                        <input id="upUDT" name="UnitPrice" type="text" value="${value.UnitPrice}" required tabindex="5"><br>
                        <input id="tidUDT" name="TrackId" type="hidden" value="${value.TrackId}" required ><br>
                        <br>
                        <button type="submit" id="btnUpd">Update</button>
                        </form>
                        <button type="submit" id="btnExit">Exit</button>`;
                    break;
                }
                const trackOut = $("<div />", {});
                trackOut.append(output);
                trackOut.appendTo($("div#show"));
            },
            error: function(err) {
                alert('error');
                console.log("Error")
            }
        });
        
    });

    $(document).on("click", "img.showAlbum, img.editAlbum", function() {
        $("#fmSearchMusicAdmin").hide();
        const action = ($(this)[0].className === "smallButton showAlbum" ? "show" : "edit");
        const id = $(this).attr("data-id");
        const myUrl='https://sharifs-music-api.herokuapp.com/api/album/?albumId='+id;
        $("#searchResults").hide();         
        $.ajax({
            url:myUrl,
            type : 'GET',                
            success: function (data) {
                const value=data.album[0];
                var output = '';
                $("div#show").empty();
                switch (action) {
                    case 'show':
                        
                        output +=
                            `<p> <strong>Album Title:</strong> ${value.Title}</p>
                            <p> <strong>Artist Name:</strong> ${value.ArtistName}</p>
                            <br>
                            <button type="submit" id="btnExit">Exit</button>`;
                        
                        break;
                    case 'edit':
                        output +=
                            `<form action='home.php' id="fmUpdAlb" method="POST">
                                <label for="al">Album Title:</label>
                                <input id="alt" name="Title" type="text" value="${value.Title}" required tabindex="1"><br>
                                <input id="alid" name="AlbumId" type="hidden" value="${value.AlbumId}" required tabindex="3"><br>
                                <br>
                                <button type="submit" id="btnUpdAlb">Update</button>
                            </form>
                            <button type="submit" id="btnExit">Exit</button>`;
                        break;
                }
                const trackOut = $("<div />", {});
                trackOut.append(output);
                trackOut.appendTo($("div#show"));
            },
            error: function(err) {
                alert('error');
                console.log("Error")
            }
        });
    });
    $(document).on("click", "img.showArtist, img.editArtist", function() {
        $("#fmSearchMusicAdmin").hide();
        const action = ($(this)[0].className === "smallButton showArtist" ? "show" : "edit");
        const id = $(this).attr("data-id");
        const myUrl='https://sharifs-music-api.herokuapp.com/api/artist/?artistId='+id;
        $("#searchResults").hide();         
        $.ajax({
            url:myUrl,
            type : 'GET',                
            success: function (data) {
                console.log(data.artist[0].Title);
                const value=data.artist[0];
                var output = '';
                $("div#show").empty();
                switch (action) {
                    case 'show':
                        
                        output +=
                            `<p> <strong>Artist Name:</strong> ${value.Name}</p>
                            <br>
                            <button type="submit" id="btnExit">Exit</button>`;
                        break;
                    case 'edit':
                        output +=
                            `<form action='home.php' id="fmUpdArt" method="POST">
                                <label for="at">Artist Name:</label>
                                <input id="at" name="Name" type="text" value="${value.Name}" required tabindex="1"><br>
                                <input id="atid" name="ArtistId" type="hidden" value="${value.ArtistId}" required tabindex="2"><br>
                                <br>
                                <button type="submit" id="btnUpdArt">Update</button>
                            </form>
                            <button type="submit" id="btnExit">Exit</button>`;
                        break;
                }
                const trackOut = $("<div />", {});
                trackOut.append(output);
                trackOut.appendTo($("div#show"));
            },
            error: function(err) {
                alert('error');
                console.log("Error")
            }
        });
    });
               
                
    // Track Edit
    $(document).delegate("#btnUpd", "click", function(e) {
    //$(document).on("click", "btnUpd", function(e) {
        e.preventDefault();
        const formData= $("#fmUpd").serialize();
        
        if (confirm("Are you sure about this Track update?")) {
           
            console.log(formData);
           
            $.ajax({
                type: "POST",
                url: 'https://sharifs-music-api.herokuapp.com/api/track',
                data: formData,
                success: function(result) {
                    console.log(formData);
                    console.log(result);
                    if(result.track==true){
                        alert('Track Edit Successfully.');
                        window.location.href ='home.php';
                    }else  alert('Track Edit Not Successfull.');
                   
                },
                error: function(err) {
                    alert(err);
                    console.log("Error")
                }
            });
        }
    });
    $(document).delegate("#btnUpdAlb", "click", function(e) {
        //$(document).on("click", "btnUpd", function(e) {
            e.preventDefault();
            const formData= $("#fmUpdAlb").serialize();
            
            if (confirm("Are you sure about this Album update?")) {
               
                console.log(formData);
               
                $.ajax({
                    type: "POST",
                    url: 'https://sharifs-music-api.herokuapp.com/api/album',
                    data: formData,
                    success: function(result) {
                        console.log(formData);
                        console.log(result);
                        if(result.album==true){
                            alert('Album Edited Successfully.');
                            window.location.href ='home.php';
                        }else  alert('Album Edit Not Successfull.');
                       
                    },
                    error: function(err) {
                        alert(err);
                        console.log("Error")
                    }
                });
            }
        });
        $(document).delegate("#btnUpdArt", "click", function(e) {
            //$(document).on("click", "btnUpd", function(e) {
                e.preventDefault();
                const formData= $("#fmUpdArt").serialize();
                
                if (confirm("Are you sure about this Artist update?")) {
                   
                    console.log(formData);
                   
                    $.ajax({
                        type: "POST",
                        url: 'https://sharifs-music-api.herokuapp.com/api/artist',
                        data: formData,
                        success: function(result) {
                            console.log(formData);
                            console.log(result);
                            if(result.artist==true){
                                alert('Artist Edited Successfully.');
                                window.location.href ='home.php';
                            }else  alert('Artist Edit Not Successfull.');
                           
                        },
                        error: function(err) {
                            alert(err);
                            console.log("Error")
                        }
                    });
                }
            });
    $(document).delegate("#btnExit", "click", function(e) {
        window.location.href ='home.php';
    });
    
    function isset (accessor) {
        try {
        // Note we're seeing if the returned value of our function is not
        // undefined or null
        return (accessor !== undefined && accessor !== null)
        } catch (e) {
        // And we're able to catch the Error it would normally throw for
        // referencing a property of undefined
        return false
        }
    }
    var trackIdCount=0;
    $(document).on("click", "img.addCart", function() {
        const trackCount = parseInt($('#oneCart').val());
        const id = $(this).attr("data-id");
        const trackName = $(this).attr("data-name");
        const unitPrice = parseFloat($(this).attr("data-unitP"));
        console.log(trackName);
        console.log(unitPrice);

        
        const trackCountAdd=trackCount+1;
        $('#oneCart').val(trackCountAdd);

        if($("#tid" + id).length == 0){
            
            var output =`<label">Track-${trackIdCount+1}:${trackName}  </label>
            <label for="UnitPrice[${trackIdCount}]"> Unit Price:</label>
            <input id="up${id}" name="UnitPrice[${trackIdCount}]" type="text" value="${unitPrice}" required  readonly />
            <label for="Quantity[${trackIdCount}]">Quantity:</label>
            <input id="qt${id}" name="Quantity[${trackIdCount}]" type="number" value="1" required readonly />
            <input id="tid${id}" name="TrackId[${trackIdCount}]" type="hidden" value="${id}" required /><br>`;
            $("#fmBuy").append(output);
            trackIdCount=trackIdCount+1;
        }
        
        else{
            let quantity=parseInt($("#qt" + id).val());
            quantity=quantity+1;
            $("#qt" + id).val(quantity);
        }
        if(trackCount==0){
            const total=unitPrice
            const addTotal =`<input id="total" name="Total" type="hidden" value="${total}" required >`;
            $("#fmBuy").append(addTotal);
        }else {const total=parseFloat($("#total").val())+unitPrice;
        $("#total").val(total);
        }    
    });

    var modal = document.getElementById("myModal");
    $(document).delegate("#customerBuy", "click", function(e) {
        $("div#invSub").empty(); 
        const trackCount = parseInt($('#oneCart').val());
        if(trackCount>0){
            const total=parseFloat($("#total").val()).toFixed(2);

            const output =`<label for="allTo">Total Price : ${total}</label>  
                            <button type="submit" id="btnSubBuy">Buy</button>
                        </div>`;
            $("div#invSub").append(output);
            modal.style.display = "block";
        }else {alert("No Track Selected.");
            window.location.href ='home.php';
        }
    });

    $(document).delegate("#btnSubBuy", "click", function(e) {
        e.preventDefault();
       
        let form = $("#fmBuy");
        var value = $.map(form.serializeArray(), function(v, k) {
            return [v.value]});
        var name = $.map(form.serializeArray(), function(v, k) {
            return [v.name]});
        var  arrayData=[];
        for (var i = 0; i < value.length; i++) {
            arrayData[name[i]]=value[i];
            }
        console.log(name);
        console.log(value);
        console.log(arrayData);
        const myUrl="https://sharifs-music-api.herokuapp.com/api/invoice";
        
        const fromData= $("#fmBuy").serialize();
        console.log(fromData);
        
        $.ajax({
            url: myUrl ,
            type: "POST",
            data: fromData,
            success: function(result) {
                //console.log(formData);
                console.log(result.invoice)

                if(isset(result.invoice)){
                    alert('Thank You For purchasing.');
                    window.location.href ='home.php';
                }else{
                    alert('Somthing went wrong.');
                }
            },
            error: function(err) {
                alert(err);
                console.log("Error")
            }                
            
                    
        });
        
    });
      
      // When the user clicks on <span> (x), close the modal
      $(document).delegate("#span", "click", function(e) {
          //window.location.href ='home.php';
            modal.style.display = "none";
      });
      
});



       


