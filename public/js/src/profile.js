document.getElementById('fileInput').addEventListener('change', function () {
    const fileInput = document.getElementById('fileInput');
    const profileImage = document.getElementById('profileImage');
    
    if (fileInput.files.length > 0) {
      const selectedImage = fileInput.files[0];
      const objectURL = URL.createObjectURL(selectedImage);
      
      profileImage.src = objectURL;
    }
  });