<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="dropify/css/dropify.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <form action="upload.php" method="POST" class="uploader" enctype="multipart/form-data">
        <h2 class="uploader-title">Upload Zip File</h2>

        <div class="dropify-wrapper">
            <div class="dropify-message">
                <span class="file-icon"></span> 
                <p>Choose Your Zip File</p>
                <p class="dropify-error">Ooops, something wrong appended.</p>
            </div>
            <div class="dropify-loader"></div>
            <input type="file" id="file" name="file" class="dropify" data-max-file-size="2M">
            <div class="dropify-preview" style="display: none;">
                <span class="dropify-render">
                    <i class="dropify-font-file"></i>
                    <span class="dropify-extension"></span>
                    <span class="dropify-filename">
                        No file name
                    </span>
                </span>
            </div>
        </div>

        <button type="submit" class="save-btn" disabled>Upload</button>
    </form>

    <script>
        function init() {
            document.querySelector("#file").addEventListener('change', function(e){
                e.preventDefault();

                let files = e.target.files;

                if (files.length < 1) return;

                let file = files[0];


                if(file.name.match('.zip')){
                    document.querySelector(".dropify-preview").style.display = 'block';
                    document.querySelector(".dropify-extension").innerText = 'zip';
                    document.querySelector(".dropify-filename").innerHTML = `
                        ${file.name} (${(file.size / 1024 / 1024).toFixed(2)}MB)
                    `;
                    document.querySelector('.save-btn').removeAttribute('disabled');
                }else{
                    document.querySelector(".dropify-preview").style.display = 'block';
                    document.querySelector(".dropify-extension").innerText = ': (';
                    document.querySelector(".dropify-filename").innerText = 'Upload a ZIP archive';
                }
            });
        }

        window.onload = function() {
            init();
        }; 
    </script>

</body>
</html>