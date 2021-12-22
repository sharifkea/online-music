<?php require 'header.php'; ?>
<script src="js/addAlbum.js"></script>
<div class="">
    <div class="">
        <div class="">
            <h2>Add Album</h2>
        </div>
        <div class="">
            <form action="AddAlbum.php" method="post" id="add_album">
                <div class="form-group">
                    <label for="title">Album Title</label>
                    <input type="text" name="Title" id="title" class="form-control" require>
                </div>
                
                <div class="form-group">
                    <label for="artistName">Artist Name</label>
                    <select name="ArtistId" id="artistDrop" reqire>				
                    </select>
                </div>
                <div class="form-group">
                    <button id='addAlbum' type="submit" class="btn btn-info">Create Album</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>