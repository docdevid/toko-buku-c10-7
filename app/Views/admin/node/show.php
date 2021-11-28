<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12 col-md-4">
                <h4 class="fw-bold">Detail <?= $title ?></h4>
                <p class="text-muted">Berikut adalah detail data <?= $title ?></p>
                <table class="table small">
                    <tr>
                        <td class="fw-bold">Node</td>
                        <td style="text-align:right;"><?= $node->name ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Koordinat</td>
                        <td style="text-align:right;"><?= $node->coordinate ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Terdaftar</td>
                        <td style="text-align:right;"><?= $node->created_at ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-8">
                <div class="" id="map" style="height: 600px;width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('node_modules/axios/dist/axios.min.js') ?>"></script>
<script>
    let currentCoordinate = '<?= $node->coordinate ?>';
    let currentLat = parseFloat(currentCoordinate.split(',')[0]);
    let currentLng = parseFloat(currentCoordinate.split(',')[1]);
    let allMarkers = [];
    var mymap = L.map('map').setView([currentLat, currentLng], 16);

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
            resJson.map(e => {
                addMarker(e);
            })
            // showMarkers();
        })
        .catch(err => console.log(err))

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
</script>
<?= $this->endSection() ?>