<?php require 'header.php'; ?>
<script src="js/addArtist.js"></script>
<div class="">
    <div class="">
        <div class="">
            <h2>Add Artist</h2>
        </div>
        <div class="">
            <form action="AddArtist.php" method="post" id="add_artist">
                <div class="form-group">
                    <label for="name">Artist Name</label>
                    <input type="text" name="Name" id="name" class="form-control" require>
                </div>
                <div class="form-group">
                    <button id='addArtist' type="submit" class="btn btn-info">Create Artist</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
