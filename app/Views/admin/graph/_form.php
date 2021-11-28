<?= $this->extend('layout/template') ?>


<?= $this->section('head') ?>
<link href="<?= base_url('node_modules/tom-select') ?>/dist/css/tom-select.css" rel="stylesheet">
<script src="<?= base_url('node_modules/tom-select') ?>/dist/js/tom-select.complete.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $graph = isset($graph) ? $graph : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $graph ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
                <p class="text-muted">Berikut adalah formulir data <?= $title ?>. Silahkan daftarkan pengguna baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <?= session()->has('get_failed') ? session()->getFlashdata('get_failed') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-4 order-1 order-md-0">
                        <form action="<?= $graph ? base_url('admin/master/graph/' . $graph->id) : base_url('admin/master/graph/')  ?>" method="post">
                            <?= csrf_field() ?>
                            <?php if ($graph) : ?>
                                <input type="hidden" name="_method" value="PUT" />
                                <input type="hidden" name="id" value="<?= $graph->id ?>" />
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="startCoordinate" id="selectStart" class="form-label">Lokasi Awal *</label>
                                <select id="startCoordinate" class="<?= $validation->hasError('start') ? 'is-invalid' : '' ?>" name="start">
                                    <option value="">Pilih Lokasi Awal</option>
                                    <?php foreach ($nodes as $node) : ?>
                                        <option <?= $graph ? ($graph->start == $node->id ? 'selected' : '') : '' ?> value="<?= $node->id ?>"><?= $node->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('start')) : ?>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        <?= $validation->getError('start') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="endCoordinate" id="selectEnd" class="form-label">Lokasi Tujuan *</label>
                                <select id="endCoordinate" class="<?= $validation->hasError('end') ? 'is-invalid' : '' ?>" name="end">
                                    <option value="">Pilih Lokasi Tujuan</option>
                                    <?php foreach ($nodes as $node) : ?>
                                        <option <?= $graph ? ($graph->end == $node->id ? 'selected' : '') : '' ?> value="<?= $node->id ?>"><?= $node->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('end')) : ?>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        <?= $validation->getError('end') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="distance" class="form-label">Jarak Tempuh (Dalam Kilometer)</label>
                                <input type="text" readonly id="distance" name="distance" value="<?= old('distance') ? old('distance') : ($graph ? $graph->distance : '') ?>" class="form-control" />
                            </div>
                            <p class="text-muted"><small>Harap lengkapi semua data yang ditandai (*)</small></p>
                            <a href="<?= base_url('admin/master/graph') ?>" class="btn btn-white"><i class="bi bi-arrow-90deg-left"></i></a>
                            <button type="submit" class="btn btn-primary"><?= $graph ? 'Perbarui' : 'Simpan' ?></button>
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
    let currentCoordinate = '<?= getDefaultLatLng() ?>';
    let currentLat = parseFloat(currentCoordinate.split(',')[0]);
    let currentLng = parseFloat(currentCoordinate.split(',')[1]);
    let allMarkers = [];
    var mymap = L.map('map').setView([currentLat, currentLng], 13);
    let nodes = [];
    let selectedLine;
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog'
    }).addTo(mymap);

    var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.get('<?= site_url('admin/master/node') ?>')
        .then(res => resJSON = res.data)
        .then((resJson) => {
            resJSON.map(e => {
                nodes.push(e)
            })
            resJSON.map(e => {
                addMarker(e);
            })
            // showMarkers();
        })
        .catch(err => console.log(err))

    function addMarker(e) {
        console.log(e);
        if (e.amal_usaha_node_id) {
            content = `${e.name}`
            marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])], {
                icon: new L.Icon({
                    iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${e.jenis_usaha_color}.png`,
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                }),
            }).bindPopup(content).openPopup().addTo(mymap);
        } else {
            marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])]).bindPopup(`${e.name}`).openPopup().addTo(mymap);
        }
        allMarkers.push(marker);
    }

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
            })
        })
        .catch(err => console.log(err))

    let mk1;
    let mk2;
    let inputDistance = document.getElementById("distance");
    let line;
    new TomSelect("#startCoordinate", {
        plugins: ['change_listener'],
        maxItems: 1,
        sortField: {
            field: "text"
        },
        onChange: function(e) {
            console.log(e);
            let res = nodes.find(n => n.id == e);
            let resSplit = res.coordinate.split(',');
            mk1 = {
                lat: parseFloat(resSplit[0]),
                lng: parseFloat(resSplit[1])
            }
            inputDistance.value = 0;
            showDistance(mk1, mk2)
        }
    });
    new TomSelect("#endCoordinate", {
        plugins: ['change_listener'],
        maxItems: 1,
        sortField: {
            field: "text"
        },
        onChange: function(e) {
            let res = nodes.find(n => n.id == e);
            let resSplit = res.coordinate.split(',');
            mk2 = {
                lat: parseFloat(resSplit[0]),
                lng: parseFloat(resSplit[1])
            }
            inputDistance.value = 0;
            showDistance(mk1, mk2)
        }
    });

    function showDistance(mk1, mk2) {
        if (mk1 && mk2) {
            let distance = getDistance(mk1, mk2);
            inputDistance.value = distance;
            createLine(mk1, mk2);
        }
    }

    function getDistance(mk1, mk2) {
        var R = 3958.8; // Radius of the Earth in miles
        var rlat1 = mk1.lat * (Math.PI / 180); // Convert degrees to radians
        var rlat2 = mk2.lat * (Math.PI / 180); // Convert degrees to radians
        var difflat = rlat2 - rlat1; // Radian difference (latitudes)
        var difflon = (mk2.lng - mk1.lng) * (Math.PI / 180); // Radian difference (longitudes)

        var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
        return (d * 1.6).toPrecision(2);
    }

    // create line
    function createLine(...args) {
        if (selectedLine) {
            selectedLine.remove(mymap);
        }
        selectedLine = L.polyline(args, {
            color: 'blue'
        }).arrowheads({
            frequency: '100px',
            size: '12px',
            fill: true

        }).addTo(mymap);

    }
</script>
<?= $this->endsection() ?>