function subDate(a,b) {

    var a1 = a.split('/');
    var date1 = new Date(a1[2],a1[1] -1,a1[0])
    var b1 = b.split('/');
    var date2 = new Date(b1[2],b1[1] -1,b1[0]);
    var diffDays = parseInt((date2 - date1) / (1000 * 60 * 60 * 24));
    return diffDays;
};
function checkImage(file) {
    var match = ["image/jpeg", "image/png", "image/jpg"];
    return match.indexOf(file.type) > -1;
}
function setDataTable(t) {
    var checked = $('.feeradio:checked');
    if (checked.length > 0){
        if (t == 0) t = 1;
        var _id = checked.val();
        var obj = fees[_id];
        var price = obj.price_day;
        var vat = obj.fee_vat;
        var fee_day = obj.fee_day;
        var km = obj.khuyen_mai;
        var total_money = (price - km) * t + fee_day;
        vat = total_money * vat / 100;
        total_money += vat;
        $('#price-day').html(price);
        $('#fee-vat').html(vat);
        $('#fee-day').html(fee_day);
        $('#khuyen-mai').html(km);
        $('#total-money').html(total_money);
    }
}
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
            $('#listImage').prepend(data);
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
var fees;
jQuery(document).ready(function() {
    fees = JSON.parse($('#datafee').val());
    jQuery('select').niceSelect();
    jQuery('.radioinput').customInput();
    jQuery('.radioinput2').customInput();
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('.datetimepicker1').datetimepicker(
        {
            locale: 'vi',
            useCurrent: true,
            minDate: 'now',
            format: 'DD/MM/YYYY',
        }
    );
    jQuery('#txtDenngay').datetimepicker(
        {
            locale: 'vi',
            useCurrent: true,
            format: 'DD/MM/YYYY',
        }
    );
    var a = $('#txtTungay').val();
    var b = $('#txtDenngay').val();
    var date = subDate(a,b);
    $('#subdate').html(date + " ngày");
    $(".thanhpho_id").change(function () {
        var txt = $(this).find(":selected").text();
        $('#preview_address').html(txt);
        var str = "Tỉnh "+txt;
        showLocation(str);
        $('#diadiem_id').val(str);
    });
    $("select.huyen_id").change(function () {
        var str = $(this).find(":selected").text()+", "+$(".thanhpho_id").find(":selected").text();
        var txt = $(this).find(":selected").text()+" - "+$(".thanhpho_id").find(":selected").text();
        $('#preview_address').html(txt);
        showLocation(str);
        $('#diadiem_id').val(str);
    });
    $("select.xa_id").change(function (){
        var str = $(this).find(":selected").text()+", "+$(".huyen_id").find(":selected").text()+", "+$(".thanhpho_id").find(":selected").text();
        showLocation(str);
        $('#diadiem_id').val(str);
    });
    $('#txtTungay').on('dp.change', function(e){
        var a = $('#txtTungay').val();
        var b = $('#txtDenngay').val();
        var date = subDate(a,b);
        $('#subdate').html(date + " ngày");
        setDataTable(date);
    });
    $("#input_title").bind('keyup keypress keydown load',function () {
        var string = $("#input_title").val();
        $('#priview-title').html(string);
        var leng = string.length;
        $("#leng_input_title").html(leng);
    });
    $("#input_area").bind('keyup keypress keydown load',function () {
        var string = $(this).val();
        $('#preview_area').html(string);
    });
    $("#input_price").bind('keyup keypress keydown load',function () {
        var string = $(this).val();
        $('#preview_price').html(string);
    });
    $('#txtDenngay').on('dp.change', function(e){
        var a = $('#txtTungay').val();
        var b = $('#txtDenngay').val();
        var date = subDate(a,b);
        $('#subdate').html(date + " ngày");
        setDataTable(date);
    });
    $(".feeradio").change(function () {
        var a = $('#txtTungay').val();
        var b = $('#txtDenngay').val();
        var date = subDate(a,b);
        setDataTable(date);
        $('#feeid').val($(this).val());
        var _id = $(this).val();
        var _class = $(this).data('class');
        $('#priview-title').removeClass();
        $('#priview-title').addClass(_class);
        $('.vip-desc').hide();
        $('#vip-desc'+_id).show();
        var label = $(this).parent().find('label');
        $('#viptype-title b').html(label.html() + ' :');
    });
    $(".categoryradio").change(function () {
        var idt = $(this).val();
        $.ajax({
            url: "/home/data/category",
            type: "POST",
            data: {id: idt},
            success: function (data) {
                $('select.category_id').html(data);
                $('select.category_id').niceSelect('update');
            },
        });
    });
    $('#working-upload-item').click(function () {
        $('#secleimg').click();
    });
    $("#uploadForm").on('submit', (function (e) {

        e.preventDefault();
        $.ajax({
            url:  _linkHost+"/posts/images/postimages",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                jQuery('#myTab a:last').tab('show');
                $('.listImage').prepend(data);
                document.getElementById('uploadForm').reset();
            },
        });
    }));
    $('input[type="file"]').bind('change', function () {
        handleFileUpload(this.files);
    });
    $(document).delegate("a.upload-item-delete", "click", function (e) {
        if (confirm("Bạn có muốn xóa ảnh này")){
            $(this).parent().remove();
        }
    });
});