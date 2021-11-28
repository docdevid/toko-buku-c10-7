<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Libraries\Astar;
use App\Models\GraphModel;
use App\Models\NodeModel;

class RouteController extends BaseController
{
    public function __construct()
    {

        $this->nodeModel = new NodeModel();
        $this->graphModel = new GraphModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $nodes = $this->nodeModel->get($this->request->getGet('search'));
        $graphs = $this->graphModel->get($this->request->getGet('search'));
        if (!$this->request->isAJAX()) {
            return view('front/rute/index', [
                'title' => 'Rute',
                'nodes' => $nodes->find(),
            ]);
        } else {
            echo json_encode(array('graphs' => $graphs->findAll(), 'nodes' => $nodes->findAll()));
        }
    }

    public function getShortestPath()
    {
        if ($this->request->isAJAX()) {
            $lok_asal = $this->request->getVar('start');
            $lok_akhir = $this->request->getVar('end');
            $graphs = $this->graphModel->get()->find();

            foreach ($graphs as $k => $v) {
                $weights[$v->n1_id][$v->n2_id] = $v->distance;
                $coordinate[$v->n1_id] = array('lat' => floatval(getLatLng($v->startCoordinate, 'lat')), 'lng' => floatval(getLatLng($v->startCoordinate, 'lng')));
                $coordinate[$v->n2_id] = array('lat' => floatval(getLatLng($v->endCoordinate, 'lat')), 'lng' => floatval(getLatLng($v->endCoordinate, 'lng')));
                $nodeName[$v->n1_id] = $v->startName;
                $nodeName[$v->n2_id] = $v->endName;
            }

            $kordinat_goal = $coordinate[$lok_akhir];

            $heuristiks = array();

            foreach ($coordinate as $key => $val) {
                $heuristik = sqrt(pow($val['lat'] - $kordinat_goal['lat'], 2) + pow($val['lng'] - $kordinat_goal['lng'], 2)) * 111.319;
                $heuristiks[$key][$lok_akhir] = round($heuristik, 2);
            }

            $astar = new Astar($weights, $nodeName, $heuristiks, $lok_asal, $lok_akhir);

            $result['from_'] = $nodeName[$lok_asal];
            $result['to_'] = $nodeName[$lok_akhir];
            $result['from'] = $lok_asal;
            $result['to'] = $lok_akhir;
            $result['distance'] = round($astar->getDistance(), 2) . " Km";
            $result['path'] = $astar->getPath();
            $result['path_'] = $astar->printPath();

            foreach (array_reverse($astar->getPath()) as $p) {
                $result['path_cor'][] = $coordinate[$p];
            }

            $result['calculate'] = $astar->getDetailPerhitungan();
            echo json_encode($result);
        }
        // $this->load->model('GraphModel');


        // $graphResult = $this->GraphModel->get();
        // foreach ($graphResult as $k => $v) {
        //     $graf[$v->n1_id][$v->n2_id] = $v->distance;
        //     $time[$v->n1_id][$v->n2_id] = $v->time;
        //     $kordinat[$v->n1_id] = array('lat' => $v->n1_lat, 'lng' => $v->n1_lng);
        //     $kordinat[$v->n2_id] = array('lat' => $v->n2_lat, 'lng' => $v->n2_lng);
        //     $grafName[$v->n1_id] = $v->n1_name;
        //     $grafName[$v->n2_id] = $v->n2_name;
        // }
        // $kordinat_goal = $kordinat[$lok_akhir];
        // /*
        // * Mencari Nilai heuristik
        // * Menggunakan Metode teorema euclid
        // */
        // $heuristik = array();

        // foreach ($kordinat as $key => $val) {
        //     $heuristiks = sqrt(pow($val['lat'] - $kordinat_goal['lat'], 2) + pow($val['lng'] - $kordinat_goal['lng'], 2)) * 111.319;
        //     $heuristik[$key][$lok_akhir] = round($heuristiks, 2);
        // }

        // $astar = new Astar($graf, $grafName, $heuristik, $lok_asal, $lok_akhir, $time);
        // $res['from_'] = $grafName[$lok_asal];
        // $res['from'] = $lok_asal;
        // $res['to_'] = $grafName[$lok_akhir];
        // $res['to'] = $lok_akhir;
        // $res['distance'] = round($astar->getDistance(), 2) . " Km";

        // $res['path'] = $astar->getPath();
        // $res['path_'] = $astar->printPath();

        // foreach ($astar->getPath() as $p) {
        //     $res['path_cor'][] = $kordinat[$p];
        // }

        // $res['time'] = $astar->getTime() . ' Menit';
        // $res['detail_perhitungan'] = $astar->getDetailPerhitungan();

        // echo json_encode($res);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
