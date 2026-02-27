<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Profile</title>
  <link href="createprofile.css" rel="stylesheet" type="text/css">
</head>
<body>
<main>
<section class="grid-container-flex">



<form id="frmSimple" action="upload-success.php" method="POST" enctype="multipart/form-data">

<label for="profilephoto"><h1>Upload your favourite photo of you below</h1></label>

<p>All you need to do is press the plus to do this</p>

  <div class="photo-upload">
    <input type="file" id="profilephoto1" name="profilephoto1" accept="image/*" hidden onchange="previewPhoto(event)">
    <div class="photo-box" onclick="triggerFileInput()">
      <span class="plus-icon" id="plusIcon" style="<?php echo empty($uploadedImagePath) ? '' : 'display:none;'; ?>">+</span>
      <img id="photoDisplay" class="photo-display" src="<?php echo htmlspecialchars($uploadedImagePath); ?>" alt="Preview of profile photo" style="<?php echo empty($uploadedImagePath) ? 'display:none;' : 'display:block;'; ?>">
      <span class="remove-photo" id="removePhoto" onclick="removeSelectedPhoto(event)" style="<?php echo empty($uploadedImagePath) ? 'display:none;' : 'display:block;'; ?>">&#10006;</span>
    </div>
  </div>




  <div class="profile-content">
    <div class="bio-section">
    <label for="bio"><h1>Tell us more about yourself</h1></label>

<p>This is so other users can know more about you but don't worry 
  if you don't know what to put, this is optional
</p>
      <textarea id="bio" name="bio" rows="7" cols="100" required></textarea>
    </div>
  </div>

  <input type="submit" class="nextbtn" value="Save" />

</form>


<?php echo $imagemessage; ?>

</section>
</main>

<script>

function triggerFileInput() {
  document.getElementById('profilephoto1').click();
}

function previewPhoto(event) {
  const file = event.target.files[0];
  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('photoDisplay').src = e.target.result;
      document.getElementById('photoDisplay').style.display = 'block';
      document.getElementById('plusIcon').style.display = 'none';
      document.getElementById('removePhoto').style.display = 'block';
    }
    reader.readAsDataURL(file);
  }
}

function removeSelectedPhoto(event) {
  event.stopPropagation();
  document.getElementById('profilephoto1').value = '';
  document.getElementById('photoDisplay').src = '';
  document.getElementById('photoDisplay').style.display = 'none';
  document.getElementById('plusIcon').style.display = 'block';
  document.getElementById('removePhoto').style.display = 'none';
}
</script>

</body>
</html>