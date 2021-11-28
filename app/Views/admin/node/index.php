<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <h4 class="fw-bold"><?= $title ?></h4>
            <p class="text-muted">Berikut adalah data <?= $title ?> sistem yang sudah terdaftar</p>
            <?= session()->has('create_success') ? session()->getFlashdata('create_success') : '' ?>
            <?= session()->has('delete_success') ? session()->getFlashdata('delete_success') : '' ?>
            <?= session()->has('get_failed') ? session()->getFlashdata('get_failed') : '' ?>
            <div class="col-12 col-md-4 order-1 order-md-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="<?= route_to('admin/master/node/new') ?>" class="btn btn-primary text-nowrap me-1"><i class="bi bi-plus-lg"></i> <span class="d-none d-xl-inline">Tambah</span></a>
                    <form class="d-flex" method="GET" action="">
                        <input type="search" class="form-control me-1" name="search" value="<?= $_GET['search'] ?? null ?>" placeholder="Cari...">
                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <hr class="border-bottom" />


                <div class="table-responsive mb-3">
                    <table class="table table-sm text-nowrap">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Node</th>
                            <th scope="col"></th>
                        </tr>
                        <?php
                        $no = 1 + ($pager->getPerPage() * ($pager->getCurrentPage() - 1));
                        ?>
                        <?php foreach ($nodes as $node) : ?>
                            <?php if (is_null($node->amal_usaha_node_id)) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><a href="<?= site_url('admin/master/node/' . $node->id) ?>" class="btn"><?= $node->name ?></a></td>
                                    <td>
                                        <a href="<?= site_url('admin/master/node/' . $node->id . '/edit') ?>" class="btn btn-sm text-success"><i class="bi bi-pencil"></i></a>
                                        <form onSubmit="event.preventDefault();deleteHandler(this);" action="<?= base_url('admin/master/node/' . $node->id) ?>" method="POST" class="form d-inline">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-item-center">
                    <?= $pager->makeLinks($pager->getCurrentPage(), $pager->getPerPage(), $pager->getTotal(), 'bootstrap_full') ?>
                    <span class="text-muted small">
                        Total data <?= $pager->getTotal() ?>
                    </span>
                </div>
            </div>
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <div class="" id="map" style="height: 600px;width: 100%;"></div>
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

<script>
    let dialogShowDelete = true;

    function deleteHandler(e) {
        if (dialogShowDelete) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light me-2'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    dialogShowDelete = false;
                    e.dispatchEvent(new Event('submit'));
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    dialogShowDelete = true;
                }
            })
        }
    }
</script>
<?= $this->endSection() ?>