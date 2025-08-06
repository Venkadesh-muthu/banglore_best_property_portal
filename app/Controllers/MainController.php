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
use App\Models\ServiceModel;
use App\Models\AboutModel;
use App\Models\FeatureModel;
use App\Models\StatisticModel;
use App\Models\TeamMemberModel;
use App\Models\ResourceModel;
use App\Models\ContactUsModel;

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
    protected $serviceModel;
    protected $aboutContentModel;
    protected $featureModel;
    protected $statisticModel;
    protected $teamModel;
    protected $resourceModel;
    protected $contactModel;

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
        $this->serviceModel = new ServiceModel();
        $this->aboutContentModel = new AboutModel();
        $this->featureModel = new FeatureModel();
        $this->statisticModel = new StatisticModel();
        $this->teamModel = new TeamMemberModel();
        $this->resourceModel = new ResourceModel();
        $this->contactModel = new ContactUsModel();
    }
    public function index(): string
    {
        helper('custom');
        $properties = $this->propertyModel
                   ->orderBy('id', 'DESC') // Replace 'id' with 'created_at' if needed
                   ->findAll(6);
        $services = $this->serviceModel->where('status', 1)->findAll();
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
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
            'services' => $services,
            'resources'  => $resources,
        ];

        return view('layout/templates', $data);
    }

    public function properties()
    {
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ?? 1;

        // Get all filters from GET parameters
        $keyword     = $this->request->getGet('keyword');
        $type        = $this->request->getGet('type');
        $bhk         = $this->request->getGet('bhk');
        $plot_area   = $this->request->getGet('plot_area');
        $min_budget  = $this->request->getGet('min_budget');
        $max_budget  = $this->request->getGet('max_budget');

        // Start building the query
        $builder = $this->propertyModel;

        // Apply keyword search (name or location)
        if (!empty($keyword)) {
            $builder = $builder->groupStart()
                ->like('name', $keyword)
                ->orLike('location', $keyword)
                ->groupEnd();
        }

        // Apply property type filter
        if (!empty($type)) {
            $builder = $builder->where('property_type', $type);

            // If Apartment or Villa and BHK is selected
            if (($type === 'Apartment' || $type === 'Villa') && !empty($bhk)) {
                $bhk = str_replace(' ', '', $bhk); // Normalize input
                $builder = $builder->like('property_type_detail', $bhk);
            }

            // If Plot and plot area is provided
            if ($type === 'Plot' && !empty($plot_area)) {
                $builder = $builder->where('property_type_detail', $plot_area);
            }
        }

        // Budget filter
        if (!empty($min_budget)) {
            $builder->where("(start_price * 100000) >=", (int)$min_budget);
        }

        if (!empty($max_budget)) {
            $builder->where("(end_price * 100000) <=", (int)$max_budget);
        }

        $sort_by = $this->request->getGet('sort_by');

        // Sort conditions
        switch ($sort_by) {
            // case 'popularity':
            //     $builder->orderBy('views', 'DESC'); // or your actual popularity column
            //     break;

            case 'possession_new':
                $builder->orderBy('possession_date', 'DESC');
                break;

            case 'possession_old':
                $builder->orderBy('possession_date', 'ASC');
                break;

            case 'price_high':
                $builder->orderBy('(start_price * 100000)', 'DESC');
                break;

            case 'price_low':
                $builder->orderBy('(start_price * 100000)', 'ASC');
                break;
        }



        // Paginate the results
        $properties = $builder
            ->orderBy('id', 'DESC')
            ->paginate($perPage, 'default', $currentPage);

        // Attach first image to each property
        foreach ($properties as &$property) {
            $image = $this->propertyImageModel
                ->where('property_id', $property['id'])
                ->first();
            $property['image'] = $image['image'] ?? 'default.jpg';
        }

        // Fetch unique min and max budgets
        $minBudgetsRaw = $this->propertyModel
        ->select('start_price * 100000 AS price', false)
        ->groupBy('start_price')
        ->orderBy('start_price', 'ASC')
        ->findAll();

        $maxBudgetsRaw = $this->propertyModel
            ->select('end_price * 100000 AS price', false)
            ->groupBy('end_price')
            ->orderBy('end_price', 'ASC')
            ->findAll();


        // Extract values into arrays and filter out zeros
        $minBudgets = array_filter(array_map(fn ($row) => (int) $row['price'], $minBudgetsRaw));
        $maxBudgets = array_filter(array_map(fn ($row) => (int) $row['price'], $maxBudgetsRaw));

        $services = $this->serviceModel->where('status', 1)->findAll();
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
        // Pass data to view
        $data = [
            'title' => 'Properties',
            'properties' => $properties,
            'pager' => $this->propertyModel->pager,
            'currentPage' => $currentPage,
            'content' => 'properties',
            'filters' => [
                'keyword' => $keyword,
                'type' => $type,
                'bhk' => $bhk,
                'plot_area' => $plot_area,
                'min_budget' => $min_budget,
                'max_budget' => $max_budget,
                'sort_by' => $sort_by,
            ],
            'minBudgets' => $minBudgets,
            'maxBudgets' => $maxBudgets,
            'services' => $services,
            'resources'  => $resources,
        ];


        return view('layout/templates', $data);
    }


    public function search()
    {
        $q = $this->request->getGet('q');
        if (strlen($q) < 3) {
            return $this->response->setJSON([]);
        }

        $propertyModel = new \App\Models\PropertyModel();

        $results = $propertyModel
            ->like('name', $q)
            ->orLike('location', $q)
            ->select('id, name, location')
            ->limit(10)
            ->find();

        return $this->response->setJSON($results);
    }
    public function compareProperties()
    {
        $allProperties = $this->propertyModel->findAll();

        $property1 = null;
        $property2 = null;

        $id1 = $this->request->getGet('property1');
        $id2 = $this->request->getGet('property2');

        if ($id1 && $id2 && $id1 != $id2) {
            $property1 = $this->propertyModel->find($id1);
            $property2 = $this->propertyModel->find($id2);
        }
        $services = $this->serviceModel->where('status', 1)->findAll();
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
        $data = [
            'title' => 'Compare Properties',
            'content' => 'compare_properties',
            'allProperties' => $allProperties,
            'property1' => $property1,
            'property2' => $property2,
            'services' => $services,
            'resources'  => $resources,
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
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
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
            'resources'  => $resources,
        ];


        return view('layout/templates', $data);
    }



    public function services()
    {
        $services = $this->serviceModel->where('status', 1)->findAll();
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
        $data = [
            'title' => 'Services',
            'content' => 'services',
            'services' => $services,
            'resources'  => $resources,
        ];
        return view('layout/templates', $data);
    }
    public function serviceDetail($slug)
    {
        $serviceModel = new \App\Models\ServiceModel();

        $service = $serviceModel->where('slug', $slug)->where('status', 1)->first();
        $services = $this->serviceModel->where('status', 1)->findAll();
        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
        $data = [
            'title' => $service['title'],
            'service' => $service,
            'services' => $services,
            'content' => 'service_detail',
            'resources'  => $resources,
        ];

        return view('layout/templates', $data);
    }
    public function resources()
    {
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll();
        $services = $this->serviceModel->where('status', 1)->findAll(); // For top nav or sidebar, like services

        $data = [
            'title'     => 'Resources',
            'content'   => 'resources', // This should be a view file like `resources.php` under `Views/`
            'resources' => $resources,
            'services'  => $services,
        ];

        return view('layout/templates', $data);
    }
    public function resourceDetail($slug)
    {
        // Normalize slug to lowercase
        $slug = strtolower($slug);

        // Fetch the matching active resource
        $resource = $this->resourceModel
            ->where('category', $slug)
            ->where('status', 'active')
            ->first();

        // If not found, show 404
        if (!$resource) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Resource Not Found');
        }

        // Get latest 5 resources for sidebar
        $resources = $this->resourceModel
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->findAll(5);

        // Get all active services
        $services = $this->serviceModel
            ->where('status', 1)
            ->findAll();

        // Prepare data for view
        $data = [
            'title'     => $resource['title'],
            'content'   => 'resource_detail', // The view inside Views/
            'resource'  => $resource,
            'resources' => $resources,
            'services'  => $services,
        ];

        return view('layout/templates', $data);
    }



    public function about()
    {
        $services = $this->serviceModel->where('status', 1)->findAll();
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
        $data = [
            'title' => 'About Us',
            'about' => $this->aboutContentModel->first(),
            'features' => $this->featureModel->findAll(3),
            'statistics' => $this->statisticModel->findAll(4),
            'team' => $this->teamModel->findAll(),
            'content' => 'about',
            'resources'  => $resources,
            'services'  => $services,
        ];

        return view('layout/templates', $data);
    }

    public function contact_us()
    {
        $services = $this->serviceModel->where('status', 1)->findAll();
        $resources = $this->resourceModel->where('status', 'active')->orderBy('id', 'DESC')->findAll(5);
        $contact = $this->contactModel->first(); // Get active contact

        $data = [
            'title' => 'Contact Us',
            'content' => 'contact_us',
            'resources'  => $resources,
            'services'  => $services,
            'contact' => $contact, // Pass to view
        ];
        return view('layout/templates', $data);
    }

}
