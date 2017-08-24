function sendFileToServer(formData) {
    $.ajax({
        url:  "/home/data/up-image",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data)
        {
            $('#preview').hide();
            $('#showimage').html(data);
            document.getElementById('uploadForm').reset();
        },
    });
}
function handleFileUpload(files)
{
    countFiles = files.length;
    fileUploaded = 0;
    count = 0;
    var _files = [];
    for (var i = 0; i < countFiles; i++) {
        if (checkImage(files[i])) {
            _files.push(files[i]);
        }
    }
    countFiles = _files.length;
    for (var i = 0; i < countFiles; i++)
    {
        var fd = new FormData();
        var type = files[i].type;
        fd.append('userImage', _files[i]);
        sendFileToServer(fd);
    }
}
function checkImage(file) {
    var match = ["image/jpeg", "image/png", "image/jpg"];
    return match.indexOf(file.type) > -1;
}
jQuery(document).ready(function() {
    $('#working-upload-item').click(function () {
        $('#secleimg').click();
    });
    $('input[type="file"]').bind('change', function () {
        handleFileUpload(this.files);
    });
    $(document).delegate("a.upload-item-delete", "click", function (e) {
        if (confirm("Bạn có muốn xóa ảnh này")){
            $(this).parent().remove();
            $(this).parent().parent().hide();
            $('#preview').show();
        }
    });
});