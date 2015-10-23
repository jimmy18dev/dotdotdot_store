$(document).ready(function(){
    $('#photo_thumbnail').click(function(){
        console.log('Click addEventListener;');
        $('#photo_files').trigger("click");
    });

    var fileDiv     = document.getElementById("photo_files_div");
    var fileInput   = document.getElementById("photo_files");
    console.log(fileInput);

    fileInput.addEventListener("change",function(e){
        var files = this.files;
        ShowPostThumbnail(files);
    },false);


    fileDiv.addEventListener("click",function(e){
        $(fileInput).show().focus().click().hide();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("dragenter",function(e){
        e.stopPropagation();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("dragover",function(e){
        e.stopPropagation();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("drop",function(e){
        e.stopPropagation();
        e.preventDefault();

        var dt = e.dataTransfer;
        var files = dt.files;

        ShowPostThumbnail(files);
    },false);
});

function ShowPostThumbnail(files){
    $('#photo_thumbnail').html('');
    // $('#post_thumbnail').removeClass('thumbnail-border');

    for(var i=0;i<files.length;i++){
        var file = files[i];
        var imageType = /image.*/

        if(!file.type.match(imageType)){
            console.log("Not an Image");
            continue;
        }

        var image = document.createElement("img");
        // image.classList.add("")
        var thumbnail = document.getElementById("photo_thumbnail");
        image.file = file;
        thumbnail.appendChild(image);

        var reader = new FileReader()
        reader.onload = (function(aImg){
            return function(e){
                aImg.src = e.target.result;
            };
        }(image));

        var ret = reader.readAsDataURL(file);
        var canvas = document.createElement("canvas");
        ctx = canvas.getContext("2d");
        
        image.onload= function(){
            ctx.drawImage(image,100,100);
        }
    }
}