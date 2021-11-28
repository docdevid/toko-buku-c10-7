<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php $node = isset($node) ? $node : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $node ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
                <p class="text-muted">Berikut adalah formulir data <?= $title ?>. Silahkan daftarkan pengguna baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-4 order-1 order-md-0">
                        <form action="<?= $node ? base_url('admin/master/node/' . $node->id) : base_url('admin/master/node') ?>" method="post">
                            <?= csrf_field() ?>
                            <?php if ($node) : ?>
                                <input type="hidden" name="_method" value="PUT" />
                                <input type="hidden" name="id" value="<?= $node->id ?>" />
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama *</label>
                                <textarea class="form-control<?= $validation->hasError('name') ? ' is-invalid' : '' ?>" name="name" id="name"><?= old('name') ? old('name') : ($node ? $node->name : '') ?></textarea>
                                <?php if ($validation->hasError('name')) : ?>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        <?= $validation->getError('name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Titik Kordinat *</label>
                                <input type="text" readonly class="form-control <?= $validation->hasError('coordinate') ? 'is-invalid' : '' ?>" name="coordinate" id="coordinate" aria-describedby="emailHelp" value="<?= old('coordinate') ? old('coordinate') : ($node ? $node->coordinate : '') ?>" placeholder="Masukan titik kordinat">
                                <?php if ($validation->hasError('coordinate')) : ?>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        <?= $validation->getError('coordinate') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <p class="text-muted"><small>Harap lengkapi semua data yang ditandai (*)</small></p>
                            <a href="<?= base_url('admin/master/node') ?>" class="btn btn-white"><i class="bi bi-arrow-90deg-left"></i></a>
                            <button type="submit" class="btn btn-primary"><?= $node ? 'Perbarui' : 'Simpan' ?></button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8">
                        <div id="map" style="height:600px;width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="<?= base_url('node_modules/axios/dist/axios.min.js') ?>"></script>
<script>
    let currentCoordinate = document.getElementById('coordinate').value ? document.getElementById('coordinate').value : '<?= getDefaultLatLng() ?>';
    let currentLat = parseFloat(currentCoordinate.split(',')[0]);
    let currentLng = parseFloat(currentCoordinate.split(',')[1]);
    var mymap = L.map('map').setView([currentLat, currentLng], 13);
    var currentMarker;
    let inputCoordinate = document.getElementById("coordinate");
    let inputName = document.getElementById("name");
    let features;
    let allMarkers = [];

    var greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog'
    }).addTo(mymap);

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.get('<?= site_url('admin/master/node') ?>')
        .then(res => resJSON = res.data)
        .then((resJson) => {
            resJson.map(e => {
                addMarker(e);
            })
            // showMarkers();
        })
        .catch(err => console.log(err))

    axios.get('<?= base_url('admin/master/graph') ?>')
        .then(res => resJSON = res.data)
        .then((resJson) => {
            resJson.map(e => {
                startCoord = e.startCoordinate.split(',');
                endCoord = e.endCoordinate.split(',');

                latlngs = [
                    [parseFloat(startCoord[0]), parseFloat(startCoord[1])],
                    [parseFloat(endCoord[0]), parseFloat(endCoord[1])],
                ];

                var polyline = L.polyline(latlngs, {
                    color: 'blue'
                }).bindTooltip(`${e.distance} Km`, {
                    sticky: true,
                    permanent: true,
                }).arrowheads({
                    frequency: '100px',
                    size: '12px',
                    fill: true

                }).addTo(mymap);

                // zoom the map to the polyline
                // mymap.fitBounds(polyline.getBounds());
            })
        })
        .catch(err => console.log(err))

    <?php if ($node) : ?>
        currentMarker = L.marker([currentLat, currentLng], {
            icon: greenIcon,
            draggable: true
        }).addTo(mymap);

        currentMarker.on('dragend', function(e) {
            setCoordinate(e.target._latlng.lat, e.target._latlng.lng);
            features = fetchFeatures(e.target._latlng.lat, e.target._latlng.lng)
        });
    <?php endif; ?>

    mymap.on('click', function(e) {
        if (currentMarker) {
            mymap.removeLayer(currentMarker);
        }
        currentMarker = L.marker([e.latlng.lat, e.latlng.lng], {
            icon: greenIcon,
            draggable: true
        }).addTo(mymap);
        currentMarker.on('dragend', function(e) {
            setCoordinate(e.target._latlng.lat, e.target._latlng.lng);
            features = fetchFeatures(e.target._latlng.lat, e.target._latlng.lng)
        });
        setCoordinate(e.latlng.lat, e.latlng.lng);
        feateures = fetchFeatures(e.latlng.lat, e.latlng.lng)
    });

    function fetchFeatures(lat, lng) {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.get(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?limit=1&access_token=pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog`)
            .then(e => e.data)
            .then(data => {
                setInputName((data.features[0].properties.address ?? data.features[0].place_name ?? data.features[0].text ?? data.features[0].id));
            })
            .catch(err => console.log(err))
    }

    function setInputName(placeName) {
        inputName.value = placeName;
    }

    function setCoordinate(lat, lng) {
        inputCoordinate.value = `${lat},${lng}`
    }

    function addMarker(e) {
        console.log(e);
        if (e.amal_usaha_node_id) {
            marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])], {
                icon: new L.Icon({
                    iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${e.jenis_usaha_color}.png`,
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                }),
            }).bindPopup(`${e.name}`).openPopup().addTo(mymap);
        } else {
            marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])]).bindPopup(`${e.name}`).openPopup().addTo(mymap);
        }
        allMarkers.push(marker);
    }
</script>
<?= $this->endsection() ?>