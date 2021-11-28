<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold">Detail <?= $title ?></h4>
                <p class="text-muted">Berikut adalah detail data pengguna</p>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Username</td>
                                    <td><?= $user->username ?></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>*******</td>
                                </tr>
                                <tr>
                                    <td>Dibuat Pada</td>
                                    <td><?= $user->created_at ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    </td>
                                </tr>
                            </table>
                            <img class="img-thumbnail" src="<?= $user->gambar != '' && $user->gambar != 'default.png' ? base_url('upload/user/' . $user->gambar) : base_url('default.png') ?>" class="rounded" style="width:100%;height:200px;object-fit:cover;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="<?= base_url('node_modules/axios/dist/axios.min.js') ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo9HRRCCPaSc56lFFDzT2V0xOYPI8OA9U&callback=initMap&libraries=places&v=weekly" defer></script>
<script type=" text/javascript">
    let map;
    let markers = [];

    function initMap() {

        // The location of node
        const node = {
            lat: <?= getLatLng($node->coordinate, 'lat') ?>,
            lng: <?= getLatLng($node->coordinate, 'lng') ?>,
        };
        // The map, centered at node
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: node,
        });
        // The marker, positioned at node
        const marker = new google.maps.Marker({
            position: node,
            map: map,
        });

        const svgMarker = {
            path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
            fillColor: "blue",
            fillOpacity: 0.6,
            strokeWeight: 0,
            rotation: 0,
            scale: 1.3,
            anchor: new google.maps.Point(15, 30),
        };

        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.get('<?= site_url('admin/node') ?>')
            .then(res => resJSON = res.data)
            .then((resJson) => {
                resJson.map(e => {
                    addMarker(e, e.coordinate, svgMarker);
                })
                showMarkers();
            })
            .catch(err => console.log(err))

    }
    // adds a marker to the map and push to the array
    function addMarker(attr, position, svgMarker) {
        const positionSplit = position.split(',');
        const infowindow = new google.maps.InfoWindow({
            content: `${attr.name} <a href="<?= site_url('admin/node/') ?>${attr.id}">Selengkapnya...</a>`,
        });
        const marker = new google.maps.Marker({
            position: {
                lat: parseFloat(positionSplit[0]),
                lng: parseFloat(positionSplit[1])
            },
            icon: svgMarker,
            map: map,
        });

        marker.addListener("click", () => {
            infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
            });
        });
        markers.push(marker);
    }

    //sets the map on all markers in the array
    function setMapOnAll(map) {
        console.log(markers)
        for (i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    //Show any markers currently in the array
    function showMarkers() {
        setMapOnAll(map)
    }
</script>
<?= $this->endSection() ?>