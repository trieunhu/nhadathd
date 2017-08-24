jQuery(document).ready(function() {
var aboveHeight = jQuery('#stickymenu').offset();
var adsHeight = jQuery('#noidung').offset();
    jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop() > aboveHeight.top){
            jQuery('#stickymenu').addClass('fixed').fadeIn();
        } 
        else {
            jQuery('#stickymenu').removeClass('fixed');
        }
    });
    jQuery('.advsearch').click(function(e){
    	e.preventDefault();
    	jQuery('.advanced-search-form').slideToggle();
    	var content = jQuery(this).text();
    	if (content == 'Tìm kiếm nâng cao')
    		content = 'Bỏ tìm kiếm nâng cao';
    	else
    		content = 'Tìm kiếm nâng cao';
    	jQuery('.advsearch').text(content);
    });
    
    $(".thanhpho_id").change(function () {
        var idt = $(this).val();
        $.ajax({
            url: "/home/data/huyen",
            type: "POST",
            data: {id: idt, type: "huyen"},
            success: function (data) {
                $('select.huyen_id').html(data);
                $('select.huyen_id').niceSelect('update');;
            },
        });
    });
    $("select.huyen_id").change(function () {
        var idt = $(this).val();
        $.ajax({
            url: "/home/data/huyen",
            type: "POST",
            data: {id: idt, type: "xa"},
            success: function (data) {
                $('select.xa_id').html(data);
                $('select.xa_id').niceSelect('update');
            },
        });
    });
    $('#form_fogot').on('beforeSubmit', function(e) {
        var form = $(this);
        var formData = form.serialize()+"&submit=1";
        $('.loading').removeClass('hidden');
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (data) {
                console.log(data.error);
                if (data.error == 0){
                    $('.success').removeClass('hidden');
                }
                $('.loading').addClass('hidden');
            },
        });
    }).on('submit', function(e){
        e.preventDefault();
    });
    var availableTags = [
        "ActionScript",
        "AppleScript",
        "Asp",
        "BASIC",
        "C",
        "C++",
        "Clojure",
        "COBOL",
        "ColdFusion",
        "Erlang",
        "Fortran",
        "Groovy",
        "Haskell",
        "Java",
        "JavaScript",
        "Lisp",
        "Perl",
        "PHP",
        "Python",
        "Ruby",
        "Scala",
        "Scheme"
    ];
    console.log('co vao day ');
    // $( "#tags" ).autocomplete({
    //     source: availableTags
    // });

});

jQuery(window).load(function(){
	function setHeight($item) {
        var $max = 0;
        jQuery($item).each(function() {
            $tmp = jQuery(this).height();
            if ($max < $tmp) $max = $tmp;
        });
        jQuery($item).each(function() {
            jQuery(this).height($max);
        });
    }
    function setHeightMin($item) {
        var $min = jQuery(this).height();
        jQuery($item).each(function() {
            $tmp = jQuery(this).height();
            if ($min > $tmp) $min = $tmp;
        });
        jQuery($item).each(function() {
            jQuery(this).height($min);
        });
    }
    setHeight('.equalheight1');
    setHeight('.equalheight2');
    setHeight('.equalheight3');
})