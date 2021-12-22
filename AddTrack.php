<?php require_once 'header.php'; ?>
<script src="js/addTrack.js"></script>
<div class="">
    <div class="">
        <div class="">
            <h2>Add Track</h2>
        </div>
        <div class="">
            <form action="AddTrack.php" method="post" id="add_track">
                <div class="form-group">
                    <label for="name">Track Name</label>
                    <input type="text" name="Name" id="name" class="form-control" require>
                </div>
                
                <div class="form-group">
                    <label for="albumTitle">Album Title</label>
                    <select name="AlbumId" id="albumDrop" reqire>				
                    </select>
                </div>
                <div class="form-group">
                    <label for="mediaTypeName">Media Type</label>  
                    <select name="MediaTypeId" id="mediaDrop" reqire>				
                    </select>
                </div>
                <div class="form-group">
                    <label for="genreId">Genre</label>
                    <select name="GenreId" id="genreDrop" reqire>				
                    </select>
                </div>
                <div class="form-group">
                    <label for="composer">Composer Name</label>
                    <input type="text" name="Composer" id="composer" class="form-control" require>
                </div>
                <div class="form-group">
                    <label for="milliseconds">Milliseconds</label>
                    <input type="text" name="Milliseconds" id="milliseconds" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bytes">Bytes</label>
                    <input type="text" name="Bytes" id="bytes" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unitPrice">Unit Price</label>
                    <input type="text" name="UnitPrice" id="unitPrice" class="form-control" require>
                </div>                
                <div class="form-group">
                    <button id='addTrack' type="submit" class="btn btn-info">Create A Track</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
