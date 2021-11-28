<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php $kategori = isset($kategori) ? $kategori : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $kategori ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
                <p class="text-muted">Berikut adalah formulir data <?= $title ?>. Silahkan daftarkan <?= $title ?> baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?= $kategori ? base_url('admin/kategori/' . $kategori->id) : base_url('admin/kategori') ?>" method="post" enctype="multipart/form-data">
                            <?php if ($kategori) : ?>
                                <input type="hidden" name="_method" value="put" />
                                <input type="hidden" name="id" value="<?= $kategori->id ?>" />
                            <?php endif; ?>
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control<?= $validation->hasError('kategori') ? ' is-invalid' : '' ?>" name="kategori" id="kategori" value="<?= old('kategori') ? old('kategori') : ($kategori ? $kategori->kategori : '') ?>" placeholder="">
                                <div id="validationServerkategoriFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('kategori') ? $validation->getError('kategori') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary"><?= $kategori ? 'Perbarui' : 'Simpan' ?></button>
                            </div>
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
    function previewImage() {
        const gambar = document.querySelector("#gambar");
        const gambarPreview = document.querySelector("#imgPreview");
        const fr = new FileReader();

        console.log(gambar);
        fr.readAsDataURL(gambar.files[0]);
        fr.onload = function(e) {
            gambarPreview.src = e.target.result;
        }

    }
</script>
<script src="<?= base_url('node_modules/axios/dist/axios.min.js') ?>"></script>
<script>
    let currentCoordinate = document.getElementById('coordinate').value ? document.getElementById('coordinate').value : '<?= getDefaultLatLng() ?>';
    let currentLat = parseFloat(currentCoordinate.split(',')[0]);
    let currentLng = parseFloat(currentCoordinate.split(',')[1]);
    var mymap = L.map('map').setView([currentLat, currentLng], 13);
    var currentMarker;
    let inputCoordinate = document.getElementById("coordinate");
    let inputName = document.getElementById("alamat");
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
        if (e.amal_usaha_node_id) {
            if (currentCoordinate == e.coordinate) {
                marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])], {
                    icon: greenIcon,
                    draggable: true
                }).addTo(mymap);
                marker.on('dragend', function(e) {
                    setCoordinate(e.target._latlng.lat, e.target._latlng.lng);
                    fetchFeatures(e.target._latlng.lat, e.target._latlng.lng);
                });
            } else {
                content = `<img class="img-thumbnail" style="width:!200px;height:!200px;object-fit:cover;" src="<?= base_url('upload/object') ?>/${e.amal_usaha_gambar}"/><b>${e.name}</b><br/>${e.amal_usaha_keterangan.substring(0,150)}<a href="<?= base_url('amal-usaha') ?>/${e.amal_usaha_id}">Selengkapnya</a>`;
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
            }
        } else {
            marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])]).bindPopup(`${e.name}`).openPopup().addTo(mymap);
        }
        allMarkers.push(marker);
    }
</script>

<?= $this->endSection() ?>