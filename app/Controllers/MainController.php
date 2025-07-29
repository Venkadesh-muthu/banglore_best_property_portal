<?php

namespace App\Controllers;

use App\Models\PropertyImageModel;
use App\Models\PropertyModel;
use App\Models\MasterPlanModel;
use App\Models\FloorPlanModel;
use App\Models\FloorPlanImageModel;
use App\Models\PropertyAmenitiesModel;
use App\Models\PropertySpecificationsModel;
use App\Models\LegalApprovalModel;
use App\Models\MicroMarketDocumentModel;
use App\Models\MicroMarketSectionModel;
use App\Models\DeveloperModel;

class MainController extends BaseController
{
    protected $propertyModel;
    protected $propertyImageModel;
    protected $masterPlanModel;
    protected $floorPlanModel;
    protected $floorPlanImageModel;
    protected $propertyAmenitiesModel;
    protected $propertySpecificationsModel;
    protected $legalApprovalModel;
    protected $microMarketDocumentModel;
    protected $microMarketSectionModel;
    protected $developerModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
        $this->propertyImageModel = new PropertyImageModel();
        $this->masterPlanModel = new MasterPlanModel();
        $this->floorPlanModel = new FloorPlanModel();
        $this->floorPlanImageModel = new FloorPlanImageModel();
        $this->propertyAmenitiesModel = new PropertyAmenitiesModel();
        $this->propertySpecificationsModel = new PropertySpecificationsModel();
        $this->legalApprovalModel = new LegalApprovalModel();
        $this->microMarketDocumentModel = new MicroMarketDocumentModel();
        $this->microMarketSectionModel = new MicroMarketSectionModel();
        $this->developerModel = new DeveloperModel();
    }
    public function index(): string
    {
        $properties = $this->propertyModel->findAll();


        foreach ($properties as &$property) {
            $image = $this->propertyImageModel
                ->where('property_id', $property['id'])
                ->first();
            $property['image'] = $image['image'] ?? 'default.jpg';

        }

        $data = [
            'title' => 'Home',
            'content' => 'home',
            'properties' => $properties,
        ];

        return view('layout/templates', $data);
    }

    public function properties()
    {
        $perPage = 3; // Number of properties per page
        $currentPage = $this->request->getVar('page') ?? 1;

        // Get total number of properties
        $totalProperties = $this->propertyModel->countAll();

        // Get paginated properties
        $properties = $this->propertyModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        // Attach one image per property
        foreach ($properties as &$property) {
            $image = $this->propertyImageModel
                ->where('property_id', $property['id'])
                ->first();
            $property['image'] = $image['image'] ?? 'default.jpg';
        }

        $data = [
            'title' => 'Properties',
            'properties' => $properties,
            'pager' => $this->propertyModel->pager,
            'content' => 'properties',
            'currentPage' => $currentPage,
        ];

        return view('layout/templates', $data);
    }


    public function ors_proxy()
    {
        $apiKey = '5b3ce3597851110001cf6248e66a59c0c4444227a3c256ea1a0046f2'; // Replace with your real API key

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $url = "https://api.openrouteservice.org/v2/directions/driving-car";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: $apiKey",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // Convert API response string to array so it's not double-encoded
        $decodedResponse = json_decode($response, true);

        return $this->response->setJSON($decodedResponse);
    }



    public function propertyDetails($id)
    {
        $property = $this->propertyModel->find($id);

        if (!$property) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Property not found");
        }

        // Get property images
        $images = $this->propertyImageModel
            ->where('property_id', $id)
            ->findAll();

        // Get master plan images
        $master_plan_images = $this->masterPlanModel
            ->where('property_id', $id)
            ->findAll();

        // Get floor plans
        $floor_plans = $this->floorPlanModel
            ->where('property_id', $id)
            ->findAll();

        // Get floor plan images and attach them to the corresponding floor plan
        foreach ($floor_plans as &$plan) {
            $plan['images'] = $this->floorPlanImageModel
                ->where('floor_plan_id', $plan['id'])
                ->findAll();
        }
        // Define master lists
        $all_amenities_master = [
            'lifestyle' => [
                'Pet Park',
                'Supermarket',
                'Pharmacy/Clinic',
                'Library',
                'Sauna',
                'Amphitheatre',
                'Swimming Pool',
                'Gym - Indoor',
                'Gym - Outdoor',
                'Cafe/Restaurant',
                'Jacuzzi',
                'Kids Play Area',
                'Salon',
                'Play School',
                'Heated Pool',
            ],
            'sports' => [
                'Running Track',
                'Basketball',
                'Badminton',
                'Cricket Pitch',
                'Cricket Ground',
                'Football Ground',
                'Squash',
                'Skating',
                'Lawn Tennis',
                'Volleyball Net',
            ],
            'natural' => [
                'Lake',
                'Forest',
                'Army Land',
                'Mountain/Hill',
                'Golf Course',
                'Park Area',
            ],
        ];


        // Get amenities from DB (JSON column)
        $property_amenities = $this->propertyAmenitiesModel
            ->where('property_id', $id)
            ->first();

        $decoded_json = [];

        if ($property_amenities && !empty($property_amenities['amenities_json'])) {
            $decoded_json = json_decode($property_amenities['amenities_json'], true);
        }

        // Convert to selected_amenities format
        $selected_amenities = [];

        if (!empty($decoded_json)) {
            foreach ($decoded_json as $type => $items) {
                foreach ($items as $item) {
                    $selected_amenities[$type][$item['name']] = $item['tag']; // tag is 'NORMAL' or 'RARE'
                }
            }
        }


        // ✅ Grouped amenities
        $grouped_amenities = [];
        foreach ($all_amenities_master as $type => $items) {
            foreach ($items as $name) {
                $grouped_amenities[$type][] = [
                    'name' => $name,
                    'selected' => isset($selected_amenities[$type][$name]),
                    'rare' => $selected_amenities[$type][$name] ?? null,
                ];
            }
        }

        // ✅ Specification definitions (with icons & default values)
        $spec_details = [
            'flooring' => [
                'title_image' => 'architecture-and-city.png',
                'fields' => [
                    'Living Room' => ['icon' => 'interior-design.png', 'value' => 'Vitrified'],
                    'Bedroom' => ['icon' => 'bedroom.png', 'value' => 'Vitrified'],
                    'Master Bedroom' => ['icon' => 'master.png', 'value' => 'Vitrified'],
                    'Kitchen' => ['icon' => 'kitchen.png', 'value' => 'Ceramic Flooring + Wall Tile'],
                    'Toilets' => ['icon' => 'master.png', 'value' => 'Ceramic Flooring + Wall Tile'],
                ],
            ],
            'doors_windows' => [
                'title_image' => 'balcony.png',
                'fields' => [
                    'Main Door' => ['icon' => 'door(1).png', 'value' => 'Polished Teak Wood'],
                    'Window' => ['icon' => 'window.png', 'value' => 'UPVC Sliding Door'],
                    'Balcony Door' => ['icon' => 'balcony.png', 'value' => 'UPVC Sliding Door'],
                    'Toilets' => ['icon' => 'sanitary.png', 'value' => 'Engineered Wood'],
                    'Internal Door' => ['icon' => 'door.png', 'value' => 'Timber With Both Side Laminated'],
                ],
            ],
            'paint' => [
                'title_image' => 'painting.png',
                'fields' => [
                    'Internal Paint' => ['icon' => 'painting.png', 'value' => 'Plastic Emulsion'],
                    'External Paint' => ['icon' => 'paintwork.png', 'value' => 'Acrylic Emulsion'],
                ],
            ],
            'others' => [
                'title_image' => 'tap.png',
                'fields' => [
                    'Construction Technology' => ['icon' => 'tap.png', 'value' => 'RCC Framed Structure'],
                    'Sanitary Fittings' => ['icon' => 'bathroom.png', 'value' => 'Chromium Plated'],
                ],
            ],
        ];


        // ✅ Get saved spec values (JSON from DB)
        $specificationsData = $this->propertySpecificationsModel
            ->where('property_id', $id)
            ->first();

        $selected_specs = [];
        if (!empty($specificationsData['specifications_json'])) {
            $decoded = json_decode($specificationsData['specifications_json'], true);
            if (is_array($decoded)) {
                $selected_specs = $decoded;
            }
        }

        // ✅ Merge DB values into default spec_details
        foreach ($spec_details as $section => &$section_data) {
            foreach ($section_data['fields'] as $label => &$field) {
                if (!empty($selected_specs[$section][$label])) {
                    $field['value'] = $selected_specs[$section][$label]; // override
                }
            }
        }
        unset($section_data, $field); // important to clear references

        $legalApprovals = $this->legalApprovalModel
            ->where('property_id', $id) // use the correct $propertyId
            ->findAll();
        // Fetch Micro Market Documents
        // $documentModel = new MicroMarketDocumentModel();
        // $microMarketDocuments = $documentModel->where('property_id', $id)->findAll();

        // // Fetch Micro Market Section (Assuming 1 per property)
        // $sectionModel = new MicroMarketSectionModel();
        // $microMarketSection = $sectionModel->where('property_id', $id)->first();

        $property = $this->propertyModel->find($id);
        if (!$property) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Property not found");
        }

        // Fetch related developer for this property
        $developer = $this->developerModel->where('property_id', $id)->first();
        $data = [
            'title' => $property['name'],
            'content' => 'property_details',
            'property' => $property,
            'images' => $images,
            'master_plan_image' => $master_plan_images,
            'floor_plans' => $floor_plans,
            'grouped_amenities' => $grouped_amenities,
            'grouped_specifications' => $spec_details,
            'legalApprovals' => $legalApprovals,
            // 'microMarketDocuments' => $microMarketDocuments,
            // 'microMarketSection' => $microMarketSection,
            'developer' => $developer,
        ];


        return view('layout/templates', $data);
    }



    public function services()
    {
        $data = [
            'title' => 'Services',
            'content' => 'services',
        ];
        return view('layout/templates', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About Us',
            'content' => 'about',
        ];
        return view('layout/templates', $data);
    }

    public function contact_us()
    {
        $data = [
            'title' => 'Contact Us',
            'content' => 'contact_us',
        ];
        return view('layout/templates', $data);
    }
}
