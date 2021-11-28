<?= $this->extend('layout/template_full') ?>
<?= $this->section('head') ?>
<link href="<?= base_url('node_modules/tom-select') ?>/dist/css/tom-select.css" rel="stylesheet">
<script src="<?= base_url('node_modules/tom-select') ?>/dist/js/tom-select.complete.min.js"></script>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row g-0">
    <div class="col-12 col-md-2">
        <div class="my-4 mt-md-2 mx-2">
            <form>
                <?= csrf_field() ?>
                <div class="mb-3">
                    <select id="startCoordinate" class="" name="start">
                        <option value="CURRENT_LOCATION">Lokasi Saat Ini</option>
                        <?php foreach ($nodes as $node) : ?>
                            <option value="<?= $node->id ?>"><?= $node->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <select id="endCoordinate" name="end">
                        <option value="">Pilih Lokasi Tujuan</option>
                        <?php foreach ($nodes as $node) : ?>
                            <option value="<?= $node->id ?>"><?= $node->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" onclick="getShortestPath(this)">
                        <span class="" role="status" id="loadingState" aria-hidden="true"></span>
                        Rute Terdekat
                    </button>
                </div>
            </form>
            <div id="result" class="small mt-2"></div>
        </div>
    </div>
    <div class="col-12 col-md-10">
        <div id="map" class="" style="min-height:700px;"></div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="<?= base_url('node_modules/axios/dist/axios.min.js') ?>"></script>
<script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>
<script>
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
    let map;
    let markers = [];
    let nodes = [];
    let currentCoordinate = '<?= getDefaultLatLng() ?>';
    let currentLat = parseFloat(currentCoordinate.split(',')[0]);
    let currentLng = parseFloat(currentCoordinate.split(',')[1]);
    let lines;
    var mymap = L.map('map').setView([currentLat, currentLng], 14);
    let currentLocation;

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }

        function showPosition(position) {
            currentLocation = [position.coords.latitude, position.coords.longitude];

            L.marker([position.coords.latitude, position.coords.longitude], {
                icon: greenIcon
            }).addTo(mymap).bindPopup('Lokasi Saat Ini');
            mymap.setView([position.coords.latitude, position.coords.longitude], 17)
        }
    }

    getCurrentLocation();



    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog'
    }).addTo(mymap);

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.get('<?= site_url('rute') ?>')
        .then(res => resJSON = res.data.nodes)
        .then((resJson) => {
            resJson.map(e => {
                addMarker(e);
                nodes.push(e);
            })
            // showMarkers();
        })
        .catch(err => console.log(err))

    function addMarker(e) {
        if (e.amal_usaha_node_id) {
            console.log(e);
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
        } else {
            marker = L.marker([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])]).bindPopup(`${e.name}`).openPopup().addTo(mymap);
        }
        markers.push([parseFloat(e.coordinate.split(',')[0]), parseFloat(e.coordinate.split(',')[1])])
        // allMarkers.push(marker);
    }

    axios.get('<?= site_url('rute') ?>')
        .then(res => resJSON = res.data.graphs)
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
    let line;
    new TomSelect("#startCoordinate", {
        plugins: ['change_listener'],
        maxItems: 1,
        sortField: {
            field: "text"
        },
        onChange: function(e) {
            if (e == 'CURRENT_LOCATION') {
                getCurrentLocation()
            }
            console.log(this.getValue());
        }
    });

    new TomSelect("#endCoordinate", {
        plugins: ['change_listener'],
        maxItems: 1,
        sortField: {
            field: "text"
        },
    });

    let loadingState = document.getElementById('loadingState');
    let result = document.getElementById('result');

    function hasMin(obj, attr) {
        return (obj.length && obj.reduce(function(prev, curr) {
            return prev[attr] < curr[attr] ? prev : curr;
        })) || null;
    }

    function getShortestLocation() {
        let distance_temp = [];
        markers.map(e => {

            var from = turf.point(currentLocation);
            var to = turf.point(e);
            var options = {
                units: 'kilometers'
            };
            distance_temp.push({
                coordinate: e,
                distance: parseFloat(turf.distance(from, to, options).toFixed(2))
            });

        })
        min = hasMin(distance_temp, 'distance').coordinate;
        return `${min[0]},${min[1]}`;
    }

    function getShortestPath(e) {
        start = document.getElementById('startCoordinate');
        if (document.getElementById('startCoordinate').value == 'CURRENT_LOCATION') {
            start = getShortestLocation();
            console.log(start);
            shortestId = nodes.find(e => {
                if (e.coordinate == start) {
                    return e
                }
            })
            start = shortestId.id;
        } else {
            start = document.getElementById('startCoordinate').value;
        }
        result.innerHTML = '';
        e.disabled = true;
        loadingState.classList.add('spinner-border', 'spinner-border-sm');
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.post("<?= base_url('rute/path') ?>", {
                'start': start,
                'end': document.getElementById('endCoordinate').value,
            })
            .then(function(res) {
                return res.data;
            })
            .then(function(res) {
                console.log(res);
                e.disabled = false;
                loadingState.classList.remove('spinner-border', 'spinner-border-sm');
                result.innerHTML = `<div style="height:300px;overflow-x:auto;">
                <table class="table table-sm small">
                    <tr>
                        <td>Jarak</td>
                        <td><b>${res.distance}</b></td>
                    </tr>
                    <tr>
                        <td>Dari</td>
                        <td>${res.from_}</td>
                    </tr>
                    <tr>
                        <td>Tujuan</td>
                        <td>${res.to_}</td>
                    </tr>
                    <tr>
                        <td>Path</td>
                        <td>${res.path_}</td>
                    </tr>
                </table>
                </div>
                `;
                if (lines) {
                    lines.remove('mymap')
                }

                lines = L.polyline(res.path_cor, {
                    color: 'red'
                }).bindTooltip(`<b>Jarak terdekat adalah ${res.distance}</b>`, {
                    sticky: true,
                    permanent: true,
                }).arrowheads({
                    frequency: '100px',
                    size: '12px',
                    fill: true

                }).addTo(mymap);
                mymap.fitBounds(lines.getBounds());
            })
            .catch(err => {
                result.innerHTML = '';
                e.disabled = false;
                result.innerHTML = '<div class="alert bg-danger text-white">Jalur tidak ditemukan</div>';
                loadingState.classList.remove('spinner-border', 'spinner-border-sm');
            })
    }
</script>
<?= $this->endsection() ?>