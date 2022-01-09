<br>
<br>
<hr>
<div class="container-form-newpost">
  <form action="./?page=newpost" method="post" class="was-validated" enctype="multipart/form-data">
    <div class="form-group">
      <label class="text-white" for="label">Titre:</label>
      <input type="text" class="form-control" id="label" placeholder="Enter username" name="label" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label class="text-white" for="description">Description:</label>
      <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" value="">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label class="text-white" for="content">Liens vers image:</label>
      <input type="text" class="form-control" id="content" placeholder="Lien vers le contenu" name="content">
    </div>
    <div class="form-group">

      <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <div class="file-upload">
        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image/Video</button>

        <div class="image-upload-wrap">
          <input class="file-upload-input" type="file" onchange="readURL(this);" accept="audio/mp3,audio/wav,video/mp4,video/x-m4v,video/MOV,video/x-matroska,video/webm,image/jpeg,image/jpg,image/gif,image/png" class="form-control" id="imagesend" name="imagesend"></input>
          <div class="drag-text">
            <h3>Drag and drop a file or select add Image</h3>
          </div>
        </div>
       
      </div>
      <div class="file-upload-content" id="fileuploadcontent">
          <img class="file-upload-image" src="#" alt="your image" />
          <div class="image-title-wrap">
            <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
          </div>
        </div>

    </div>
    <div class="form-group">
      <label for="selectedTags">Select tags</label>
      <input type="text" class="form-control" id="selectedTags" placeholder="Tags ici séparés par une ," name="selectedTags">
    </div>
    <button type="submit" class="btn btn-primary center btn-pandabooru">Submit</button>
  </form>
</div>
<br>
<hr>
<br>