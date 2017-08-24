<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_dJ65r0h4TBIF8IVjsuHzd0_pSOP9qyY"
        type="text/javascript"></script>
<?php
$countImage = count($model->sliders);
?>

<div class="image_map">

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#image" aria-controls="image" role="tab" data-toggle="tab">
                    <i class="fa fa-picture-o" aria-hidden="true"></i> Hình ảnh <?= $countImage > 0 ? "($countImage)" : '' ?>
                </a>
            </li>
            <li role="presentation">
                <a href="#map" aria-controls="map" role="tab" data-toggle="tab">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Bản đồ
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content details_map">

            <div role="tabpanel" class="tab-pane active" id="image">

                <?php if ($countImage > 0): ?>
                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                        <?php foreach($model->sliders as $value):?>
                            <li data-thumb="<?= $value->getUrl() ?>">
                                <img src="<?= $value->getUrl() ?>" alt="">
                            </li>
                        <?php endforeach;?>
                    </ul>
                <?php else: ?>
                    <p>Chưa có hình ảnh</p>
                <?php endif; ?>
            </div>
            <input type="hidden" id="txtPositionX" value="<?= $model->dia_diem ? $model->dia_diem->positionX : '';  ?>">
            <input type="hidden" id="txtPositionY" value="<?= $model->dia_diem ? $model->dia_diem->positionY : '';  ?>">
            <input type="hidden" id="address" value="<?= $model->dia_diem ? $model->dia_diem->ten : '';  ?>">
            <div role="tabpanel" class="tab-pane" id="map">
                <div id="map-canvas" style="position: relative; overflow: hidden;">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function initMap()
    {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 16,
            center: new google.maps.LatLng(document.getElementById('txtPositionX').value, document.getElementById('txtPositionY').value),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        infowindow = new google.maps.InfoWindow();
        var position = new google.maps.LatLng(document.getElementById('txtPositionX').value, document.getElementById('txtPositionY').value);
        marker = new google.maps.Marker({
            position: position,
            map: map,
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(document.getElementById('address').value);
                infowindow.open(map, marker);
            }
        })(marker, 0));
        infowindow.setContent(document.getElementById('address').value);
        infowindow.open(map, marker);

    }
    window.onload = function () {
        initMap();
        $(document).ready(function () {
//            $('.tab-pane').removeClass('active');
//            $('#image').addClass('active');
            $('#image-gallery').lightSlider({
                gallery: true,
                item: 1,
                thumbItem: 5,
                slideMargin: 0,
                speed: 1000,
                auto: true,
                loop: true,
                onSliderLoad: function () {
                    jQuery('#image-gallery').removeClass('cS-hidden');
                }
            });
        });
    }
</script>
<!-- /Map va Hinh anh -->