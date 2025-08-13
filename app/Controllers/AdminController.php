<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ConnectivityPointModel;
use App\Models\LegalApprovalModel;
use App\Models\MasterPlanModel;
use App\Models\PropertyImageModel;
use App\Models\PropertyModel;
use App\Models\FloorPlanModel;
use App\Models\FloorPlanImageModel;
use App\Models\PropertyAmenitiesModel;
use App\Models\PropertySpecificationsModel;
use App\Models\MicroMarketDocumentModel;
use App\Models\MicroMarketSectionModel;
use App\Models\DeveloperModel;
use App\Models\ServiceModel;
use App\Models\AboutModel;
use App\Models\FeatureModel;
use App\Models\TeamMemberModel;
use App\Models\StatisticModel;
use App\Models\ResourceModel;
use App\Models\ContactUsModel;
use App\Models\PropertyVideoModel;
use CodeIgniter\Controller;

class AdminController extends BaseController
{
    protected $propertyModel;
    protected $propertyImageModel;
    protected $propertyVideoModel;
    protected $adminModel;
    protected $connectivityPointModel;
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
    protected $aboutModel;
    protected $featureModel;
    protected $teamModel;
    protected $statModel;
    protected $resourceModel;
    protected $contactModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
        $this->propertyImageModel = new PropertyImageModel();
        $this->propertyVideoModel = new PropertyVideoModel();
        $this->adminModel = new AdminModel();
        $this->connectivityPointModel = new ConnectivityPointModel();
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
        $this->aboutModel = new AboutModel();
        $this->featureModel = new FeatureModel();
        $this->teamModel = new TeamMemberModel();
        $this->statModel = new StatisticModel();
        $this->resourceModel = new ResourceModel();
        $this->contactModel = new ContactUsModel();


    }

    public function index(): string
    {
        return view('admin/index');
    }

    public function login()
    {
        $session = session();

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->adminModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set('isAdminLoggedIn', true);
            $session->set('adminUser', $user);
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin')->with('success', 'You have been logged out successfully.');
    }

    public function dashboard()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id'); // assuming session stores admin_id
        $user = $this->adminModel->find($adminId);

        $data = [
            'title' => 'Dashboard',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/dashboard',
        ];

        return view('admin/layout/templates', $data);
    }
    public function profile()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        // Use 'adminUser' instead of 'admin_id'
        $adminUser = session()->get('adminUser');
        $adminId = $adminUser['id'] ?? null;

        if (!$adminId) {
            return redirect()->to('/admin')->with('error', 'Session expired. Please login again.');
        }

        // Safe: returns flat array
        $user = $this->adminModel->find($adminId);

        $data = [
            'title'   => 'Profile',
            'admin'   => $user,
            'name'    => $user['username'] ?? 'Admin',
            'content' => 'admin/profile_view',
        ];

        return view('admin/layout/templates', $data);
    }



    public function properties()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $adminId = session()->get('admin_id'); // assuming session stores admin_id
        $user = $this->adminModel->find($adminId);

        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;

        $properties = $this->propertyModel->orderBy('id', 'DESC')->paginate($perPage, 'group1');
        $pager = $this->propertyModel->pager;

        $data = [
            'title' => 'Properties',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/properties',
            'properties' => $properties,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
        ];

        return view('admin/layout/templates', $data);
    }

    public function add_property()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id'); // assuming session stores admin_id
        $user = $this->adminModel->find($adminId);

        $data = [
            'title' => 'Properties',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_property',
        ];

        return view('admin/layout/templates', $data);
    }
    public function save_property()
    {
        helper(['form', 'url']);

        // Determine property type detail value
        $propertyType = $this->request->getPost('property_type');
        $propertyTypeDetail = '';

        if ($propertyType === 'apartment') {
            $propertyTypeDetail = implode(',', $this->request->getPost('apartment_type') ?? []);
        } elseif ($propertyType === 'villa') {
            $propertyTypeDetail = implode(',', $this->request->getPost('villa_type') ?? []);
        } elseif ($propertyType === 'plot') {
            $propertyTypeDetail = implode(',', $this->request->getPost('plot_type') ?? []);
        }

        // Prepare property data
        $propertyData = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'start_price' => $this->request->getPost('start_price'),
            'end_price' => $this->request->getPost('end_price'),
            'property_type' => $propertyType,
            'property_type_detail' => $propertyTypeDetail,
            'possession_date' => $this->request->getPost('possession_date'),
            'land_area' => $this->request->getPost('land_area'),
            'avg_land_area' => $this->request->getPost('avg_land_area'),
            'clubhouse_area' => $this->request->getPost('clubhouse_area'),
            'avg_clubhouse_area' => $this->request->getPost('avg_clubhouse_sqft'),
            'park_area' => $this->request->getPost('park_area'),
            'avg_park_area' => $this->request->getPost('avg_park_area'),
            'open_area' => $this->request->getPost('open_area'),
            'avg_open_area' => $this->request->getPost('avg_open_area'),
            'units' => $this->request->getPost('units'),
            'avg_units' => $this->request->getPost('avg_units'),
            'price_per_sqft' => $this->request->getPost('price_per_sqft'),
            'avg_price_per_sqft' => $this->request->getPost('avg_price_per_sqft'),
            'clubhouse_factor' => $this->request->getPost('clubhouse_factor'),
            'avg_clubhouse_factor' => $this->request->getPost('avg_clubhouse_factor'),
            'metro_distance' => $this->request->getPost('metro_distance'),
            'avg_metro_distance' => $this->request->getPost('avg_metro_distance'),
            'road_width' => $this->request->getPost('road_width'),
            'avg_road_width' => $this->request->getPost('avg_road_width'),
            'unit_density' => $this->request->getPost('unit_density'),
            'avg_unit_density' => $this->request->getPost('avg_unit_density'),
        ];
        // print_r($propertyData);
        // die();
        // Insert property and get inserted ID
        $this->propertyModel->insert($propertyData);
        $propertyId = $this->propertyModel->getInsertID();

        // Handle property images upload
        $imageFiles = $this->request->getFiles()['property_images'] ?? [];
        $uploadPath = FCPATH . 'uploads/properties/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if (is_array($imageFiles)) {
            foreach ($imageFiles as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $imageName = $file->getRandomName();
                    $file->move($uploadPath, $imageName);

                    $this->propertyImageModel->insert([
                        'property_id' => $propertyId,
                        'image' => $imageName,
                    ]);
                }
            }
        }

        $videos = $this->request->getFiles();
        if (isset($videos['property_videos'])) {
            foreach ($videos['property_videos'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/properties/videos/', $newName);
                    $this->propertyVideoModel->insert([
                        'property_id' => $propertyId,
                        'video'       => $newName,
                    ]);
                }
            }
        }

        // Handle multiple master plan image uploads
        $masterPlanImages = $this->request->getFileMultiple('master_plan_image');
        $masterPlanUploadPath = FCPATH . 'uploads/master_plans/';

        if (!is_dir($masterPlanUploadPath)) {
            mkdir($masterPlanUploadPath, 0755, true);
        }

        foreach ($masterPlanImages as $image) {
            if ($image->isValid() && !$image->hasMoved()) {
                $masterPlanImageName = $image->getRandomName(); // Example: 'random123.jpg'
                $image->move($masterPlanUploadPath, $masterPlanImageName);

                $this->masterPlanModel->insert([
                    'property_id' => $propertyId,
                    'master_plan_image' => $masterPlanImageName, // Ensure this is a string like 'xyz.jpg'
                ]);
            }
        }
        // Floor Plans
        $floorPlans = $this->request->getPost('floor_plans');
        if (!is_array($floorPlans)) {
            log_message('error', 'Invalid floorPlans data');
            $floorPlans = [];
        }

        $floorPlanFiles = $this->request->getFiles()['floor_plans'] ?? [];

        $floorPlanPath = FCPATH . 'uploads/floor_plans/';
        if (!is_dir($floorPlanPath)) {
            mkdir($floorPlanPath, 0755, true);
        }

        foreach ($floorPlans as $index => $floorPlan) {
            // Save floor plan details first
            $floorPlanData = [
                'property_id' => $propertyId,
                'bhk_type' => $floorPlan['bhk'] ?? '',
                'price' => $floorPlan['price'] ?? '',
                'saleable_area' => $floorPlan['saleable_area'] ?? '',
                'entrance_direction' => $floorPlan['entrance_direction'] ?? '',
                'carpet_area' => $floorPlan['carpet_area'] ?? '',
                'efficiency' => $floorPlan['efficiency'] ?? '',
                'floor_height' => $floorPlan['floor_height'] ?? '',
                'bathroom_count' => $floorPlan['bathroom_count'] ?? 0,
                'balcony_count' => $floorPlan['balcony_count'] ?? 0,
            ];

            $this->floorPlanModel->insert($floorPlanData);
            $floorPlanId = $this->floorPlanModel->getInsertID();

            // Upload images for this floor plan
            $images = $floorPlanFiles[$index]['images'] ?? [];

            if (!empty($images) && is_array($images)) {
                foreach ($images as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $imgName = $img->getRandomName();
                        $img->move($floorPlanPath, $imgName);

                        // Save to floor_plan_images table (optional model)
                        $this->floorPlanImageModel->insert([
                            'floor_plan_id' => $floorPlanId,
                            'image' => $imgName
                        ]);
                    }
                }
            }
        }
        // Amenities
        $amenities = ['lifestyle' => [], 'sports' => [], 'natural' => []];
        foreach ($amenities as $type => &$items) {
            $selected = $this->request->getPost("{$type}_amenities") ?? [];
            foreach ($selected as $item) {
                $isRare = $this->request->getPost("{$type}_rare")[$item] ?? null;
                $items[] = [
                    'name' => $item,
                    'tag' => $isRare === 'RARE' ? 'RARE' : 'NORMAL',
                ];
            }
        }

        $this->propertyAmenitiesModel->insert([
            'property_id' => $propertyId,
            'amenities_json' => json_encode($amenities),
        ]);


        // Specifications
        $specifications = [
            'flooring' => $this->request->getPost('specifications')['flooring'] ?? [],
            'doors' => $this->request->getPost('specifications')['doors'] ?? [],
            'paint' => $this->request->getPost('specifications')['paint'] ?? [],
            'others' => $this->request->getPost('specifications')['others'] ?? [],
        ];

        $this->propertySpecificationsModel->insert([
            'property_id' => $propertyId,
            'specifications_json' => json_encode($specifications),
        ]);
        // Handle Legal Approvals
        $legalApprovals = $this->request->getPost('legal_approvals') ?? [];
        $legalFiles = $this->request->getFiles()['legal_approvals'] ?? [];
        $uploadDir = FCPATH . 'documents/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!empty($legalApprovals) && is_array($legalApprovals)) {
            foreach ($legalApprovals as $index => $approval) {
                $title = $approval['title'] ?? '';
                $approvedBy = $approval['approved_by'] ?? '';
                $status = $approval['status'] ?? '';

                // Handle file
                $fileName = null;
                if (!empty($legalFiles[$index]['document_file']) && $legalFiles[$index]['document_file']->isValid()) {
                    $file = $legalFiles[$index]['document_file'];
                    $fileName = $file->getRandomName();
                    $file->move($uploadDir, $fileName);
                }

                // Save to DB
                $this->legalApprovalModel->insert([
                    'property_id' => $propertyId,
                    'title' => $title,
                    'approved_by' => $approvedBy,
                    'status' => $status,
                    'document_file' => $fileName,
                ]);
            }
        }
        // //Handle micro market
        // $documents = $this->request->getPost('documents') ?? [];
        // $files = $this->request->getFiles()['documents'] ?? [];

        // $documentModel = new MicroMarketDocumentModel();
        // $sectionModel = new MicroMarketSectionModel();

        // $uploadDir = FCPATH . 'documents/';
        // if (!is_dir($uploadDir)) {
        //     mkdir($uploadDir, 0755, true);
        // }

        // // Save document cards
        // if (!empty($documents)) {
        //     foreach ($documents as $index => $doc) {
        //         $title = $doc['title'] ?? '';
        //         $description = $doc['description'] ?? '';
        //         $linkText = $doc['link_text'] ?? '';
        //         $linkUrl = $doc['link_url'] ?? '';
        //         $iconFile = $files[$index]['image'] ?? null;

        //         $iconFileName = null;
        //         if ($iconFile && $iconFile->isValid()) {
        //             $iconFileName = $iconFile->getRandomName();
        //             $iconFile->move($uploadDir, $iconFileName);
        //         }

        //         // Insert into table
        //         $documentModel->insert([
        //             'property_id' => $propertyId,
        //             'title' => $title,
        //             'description' => $description,
        //             'link_text' => $linkText,
        //             'link_url' => $linkUrl,
        //             'image' => $iconFileName,
        //         ]);
        //     }
        // }

        // // Save section data
        // $sectionImage = $this->request->getFile('section_image');
        // $sectionTitle = $this->request->getPost('section_title');
        // $sectionDescription = $this->request->getPost('section_description');
        // $sectionDirr = FCPATH . 'images/';
        // $sectionImageName = null;
        // if ($sectionImage && $sectionImage->isValid()) {
        //     $sectionImageName = $sectionImage->getRandomName();
        //     $sectionImage->move($sectionDirr, $sectionImageName);
        // }

        // $sectionModel->insert([
        //     'property_id' => $propertyId,
        //     'section_title' => $sectionTitle,
        //     'section_description' => $sectionDescription,
        //     'section_image' => $sectionImageName,
        // ]);
        return redirect()->to('/admin/properties')->with('success', 'Property saved successfully.');
    }
    public function delete_master_plan($id)
    {
        // Your logic to delete image
        $deleted = $this->masterPlanModel->delete($id);

        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Master plan image deleted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete master plan image.'
            ])->setStatusCode(500);
        }
    }






    public function edit_property($id)
    {
        $property = $this->propertyModel->find($id);
        if (!$property) {
            return redirect()->to('/admin/properties')->with('error', 'Property not found.');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        // Fetch related images
        $images = $this->propertyImageModel->where('property_id', $id)->findAll();
        $videos = $this->propertyVideoModel->where('property_id', $id)->findAll();
        $masterPlans = $this->masterPlanModel->where('property_id', $id)->findAll();

        // Fetch all floor plans
        $floorPlans = $this->floorPlanModel->where('property_id', $id)->findAll();

        // Fetch images for each floor plan
        foreach ($floorPlans as &$floorPlan) {
            $floorPlan['images'] = $this->floorPlanImageModel
                ->where('floor_plan_id', $floorPlan['id'])
                ->findAll();
        }
        // Fetch Amenities (decode JSON and prepare grouped format)
        $grouped_amenities = ['lifestyle' => [], 'sports' => [], 'natural' => []];
        $amenityRow = $this->propertyAmenitiesModel->where('property_id', $id)->first();

        if ($amenityRow && $amenityRow['amenities_json']) {
            $decoded = json_decode($amenityRow['amenities_json'], true);
            foreach ($decoded as $category => $items) {
                foreach ($items as $item) {
                    $grouped_amenities[$category][] = [
                        'name' => $item['name'],
                        'selected' => true,
                        'rare' => $item['tag'] ?? 'NORMAL',
                    ];
                }
            }
        }

        // Fetch Specifications
        $specifications = ['flooring' => [], 'doors' => [], 'paint' => [], 'others' => []];
        $specRow = $this->propertySpecificationsModel->where('property_id', $id)->first();

        if ($specRow && $specRow['specifications_json']) {
            $specifications = json_decode($specRow['specifications_json'], true);
        }

        // Fetch Legal Approvals
        $legalApprovals = $this->legalApprovalModel->where('property_id', $id)->findAll();
        // Fetch Legal Approvals
        $legalApprovals = $this->legalApprovalModel
            ->where('property_id', $id)
            ->findAll();

        $microMarketDocuments = $this->microMarketDocumentModel
            ->where('property_id', $id)
            ->orderBy('id', 'asc')
            ->findAll();

        $microMarketSection = $this->microMarketSectionModel
            ->where('property_id', $id)
            ->first();

        $data = [
            'title' => 'Properties',
            'name' => $user['username'] ?? 'Admin',
            'property' => $property,
            'propertyImages' => $images,
            'propertyVideos' => $videos,
            'masterPlans' => $masterPlans,
            'floorPlans' => $floorPlans,
            'grouped_amenities' => $grouped_amenities,
            'specifications' => $specifications,
            'legalApprovals' => $legalApprovals,
            'microMarketDocuments' => $microMarketDocuments,
            'microMarketSection' => $microMarketSection,
            'content' => 'admin/edit_property',
        ];

        return view('admin/layout/templates', $data);
    }
    public function update_property($id)
    {
        helper(['form', 'url']);

        $property = $this->propertyModel->find($id);
        if (!$property) {
            return redirect()->to('/admin/properties')->with('error', 'Property not found.');
        }

        // Handle property_type_detail
        $propertyType = $this->request->getPost('property_type');
        $propertyTypeDetail = null;

        if ($propertyType === 'apartment') {
            $propertyTypeDetail = implode(',', $this->request->getPost('apartment_type') ?? []);
        } elseif ($propertyType === 'villa') {
            $propertyTypeDetail = implode(',', $this->request->getPost('villa_type') ?? []);
        } elseif ($propertyType === 'plot') {
            $propertyTypeDetail = implode(',', $this->request->getPost('plot_type') ?? []);
        }

        // Property main data
        $propertyData = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'start_price' => $this->request->getPost('start_price'),
            'end_price' => $this->request->getPost('end_price'),
            'property_type' => $propertyType,
            'property_type_detail' => $propertyTypeDetail,
            'possession_date' => $this->request->getPost('possession_date'),

            // Review fields
            'land_area' => $this->request->getPost('land_area'),
            'avg_land_area' => $this->request->getPost('avg_land_area'),
            'clubhouse_area' => $this->request->getPost('clubhouse_area'),
            'avg_clubhouse_area' => $this->request->getPost('avg_clubhouse_sqft'),
            'park_area' => $this->request->getPost('park_area'),
            'avg_park_area' => $this->request->getPost('avg_park_area'),
            'open_area' => $this->request->getPost('open_area'),
            'avg_open_area' => $this->request->getPost('avg_open_area'),
            'units' => $this->request->getPost('units'),
            'avg_units' => $this->request->getPost('avg_units'),
            'price_per_sqft' => $this->request->getPost('price_per_sqft'),
            'avg_price_per_sqft' => $this->request->getPost('avg_price_per_sqft'),
            'clubhouse_factor' => $this->request->getPost('clubhouse_factor'),
            'avg_clubhouse_factor' => $this->request->getPost('avg_clubhouse_factor'),
            'metro_distance' => $this->request->getPost('metro_distance'),
            'avg_metro_distance' => $this->request->getPost('avg_metro_distance'),
            'road_width' => $this->request->getPost('road_width'),
            'avg_road_width' => $this->request->getPost('avg_road_width'),
            'unit_density' => $this->request->getPost('unit_density'),
            'avg_unit_density' => $this->request->getPost('avg_unit_density'),
        ];

        // Update property
        $this->propertyModel->update($id, $propertyData);

        /**
         * Property Images Upload
         */
        $imageFiles = $this->request->getFiles()['images'] ?? [];
        $uploadPath = FCPATH . 'uploads/properties/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        foreach ($imageFiles as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move($uploadPath, $imageName);
                $this->propertyImageModel->insert([
                    'property_id' => $id,
                    'image' => $imageName,
                ]);
            }
        }
        /**
         * Property Videos Upload
         */
        $videoFiles = $this->request->getFiles()['property_videos'] ?? null;
        $videoPath  = FCPATH . 'uploads/properties/videos/';

        // Create directory if not exists
        if (!is_dir($videoPath)) {
            mkdir($videoPath, 0755, true);
        }

        // If videos are uploaded
        if ($videoFiles) {
            // Normalize single file to array
            if (!is_array($videoFiles)) {
                $videoFiles = [$videoFiles];
            }

            foreach ($videoFiles as $file) {
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $videoName = $file->getRandomName();
                    $file->move($videoPath, $videoName);

                    $this->propertyVideoModel->insert([
                        'property_id' => $id,
                        'video'       => $videoName,
                    ]);
                }
            }
        }

        /**
         * Master Plan Upload
         */
        $masterPlanImages = $this->request->getFiles()['master_plan_image'] ?? [];
        $masterPlanPath = FCPATH . 'uploads/master_plans/';
        if (!is_dir($masterPlanPath)) {
            mkdir($masterPlanPath, 0755, true);
        }

        foreach ($masterPlanImages as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move($masterPlanPath, $fileName);
                $this->masterPlanModel->insert([
                    'property_id' => $id,
                    'master_plan_image' => $fileName,
                ]);
            }
        }

        /**
         * Floor Plans Handling
         */
        $floorPlans = $this->request->getPost('floor_plans') ?? [];
        $floorPlanFiles = $this->request->getFiles()['floor_plans'] ?? [];
        $floorPlanPath = FCPATH . 'uploads/floor_plans/';
        if (!is_dir($floorPlanPath)) {
            mkdir($floorPlanPath, 0755, true);
        }

        foreach ($floorPlans as $index => $floorPlan) {
            $floorPlanId = $floorPlan['id'] ?? null;

            $floorPlanData = [
                'property_id' => $id,
                'bhk_type' => $floorPlan['bhk'] ?? '',
                'price' => $floorPlan['price'] ?? '',
                'saleable_area' => $floorPlan['saleable_area'] ?? '',
                'entrance_direction' => $floorPlan['entrance_direction'] ?? '',
                'carpet_area' => $floorPlan['carpet_area'] ?? '',
                'efficiency' => $floorPlan['efficiency'] ?? '',
                'floor_height' => $floorPlan['floor_height'] ?? '',
                'bathroom_count' => $floorPlan['bathroom_count'] ?? 0,
                'balcony_count' => $floorPlan['balcony_count'] ?? 0,
            ];

            if ($floorPlanId) {
                // Update existing floor plan
                $this->floorPlanModel->update($floorPlanId, $floorPlanData);
            } else {
                // Insert new floor plan
                $this->floorPlanModel->insert($floorPlanData);
                $floorPlanId = $this->floorPlanModel->getInsertID();
            }

            // Handle Floor Plan Images
            $images = $floorPlanFiles[$index]['images'] ?? [];
            if (!empty($images) && is_array($images)) {
                foreach ($images as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $imgName = $img->getRandomName();
                        $img->move($floorPlanPath, $imgName);
                        $this->floorPlanImageModel->insert([
                            'floor_plan_id' => $floorPlanId,
                            'image' => $imgName
                        ]);
                    }
                }
            }
        }
        // === Amenities Update ===
        $amenities = ['lifestyle' => [], 'sports' => [], 'natural' => []];
        foreach ($amenities as $type => &$items) {
            $selected = $this->request->getPost("{$type}_amenities") ?? [];
            foreach ($selected as $item) {
                $isRare = $this->request->getPost("{$type}_rare")[$item] ?? null;
                $items[] = [
                    'name' => $item,
                    'tag' => $isRare === 'RARE' ? 'RARE' : 'NORMAL',
                ];
            }
        }


        // Check if amenity exists for property_id
        $existingAmenity = $this->propertyAmenitiesModel
            ->where('property_id', $id)
            ->first();

        if ($existingAmenity) {
            $this->propertyAmenitiesModel->update($existingAmenity['id'], [
                'amenities_json' => json_encode($amenities),
            ]);
        } else {
            $this->propertyAmenitiesModel->insert([
                'property_id' => $id,
                'amenities_json' => json_encode($amenities),
            ]);
        }


        // === Specifications Update ===
        $specifications = [
            'flooring' => $this->request->getPost('specifications')['flooring'] ?? [],
            'doors' => $this->request->getPost('specifications')['doors'] ?? [],
            'paint' => $this->request->getPost('specifications')['paint'] ?? [],
            'others' => $this->request->getPost('specifications')['others'] ?? [],
        ];

        $existingSpec = $this->propertySpecificationsModel
            ->where('property_id', $id)
            ->first();

        if ($existingSpec) {
            $this->propertySpecificationsModel->update($existingSpec['id'], [
                'specifications_json' => json_encode($specifications),
            ]);
        } else {
            $this->propertySpecificationsModel->insert([
                'property_id' => $id,
                'specifications_json' => json_encode($specifications),
            ]);
        }
        $legalApprovals = $this->request->getPost('legal_approvals') ?? [];
        $legalFiles = $this->request->getFiles()['legal_approvals'] ?? [];
        $uploadDir = FCPATH . 'documents/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        foreach ($legalApprovals as $index => $approval) {
            $legalId = $approval['id'] ?? null;  // This is the primary key (legal_approvals.id)
            $title = $approval['title'] ?? '';
            $approvedBy = $approval['approved_by'] ?? '';
            $status = $approval['status'] ?? '';

            $fileName = null;
            if (!empty($legalFiles[$index]['document_file']) && $legalFiles[$index]['document_file']->isValid()) {
                $file = $legalFiles[$index]['document_file'];
                $fileName = $file->getRandomName();
                $file->move($uploadDir, $fileName);
            }

            $dataToSave = [
                'title' => $title,
                'approved_by' => $approvedBy,
                'status' => $status,
            ];

            if ($fileName) {
                $dataToSave['document_file'] = $fileName;
            }

            if ($legalId) {
                // UPDATE using legal ID (primary key)
                $this->legalApprovalModel->update($legalId, $dataToSave);
            } else {
                // INSERT new entry and add property_id
                $dataToSave['property_id'] = $id; // Make sure $propertyId is set in this method
                $this->legalApprovalModel->insert($dataToSave);
            }
        }
        // $documents = $this->request->getPost('documents');
        // $files = $this->request->getFiles()['documents'] ?? [];

        // $existingDocs = $this->microMarketDocumentModel
        //     ->where('property_id', $id)
        //     ->orderBy('id', 'asc')
        //     ->findAll();

        // foreach ($documents as $index => $doc) {
        //     if (!isset($existingDocs[$index]))
        //         continue;

        //     $docId = $existingDocs[$index]['id'];

        //     $imageFile = $files[$index]['image'] ?? null;
        //     $imageName = $existingDocs[$index]['image']; // default to existing image

        //     if ($imageFile && $imageFile->isValid()) {
        //         $imageName = $imageFile->getRandomName();
        //         $imageFile->move(FCPATH . 'documents/', $imageName);
        //     }

        //     $this->microMarketDocumentModel->update($docId, [
        //         'title' => $doc['title'] ?? '',
        //         'description' => $doc['description'] ?? '',
        //         'link_text' => $doc['link_text'] ?? '',
        //         'link_url' => $doc['link_url'] ?? '',
        //         'image' => $imageName,
        //     ]);
        // }
        // $sectionImage = $this->request->getFile('section_image');
        // $sectionTitle = $this->request->getPost('section_title');
        // $sectionDescription = $this->request->getPost('section_description');

        // $existingSection = $this->microMarketSectionModel
        //     ->where('property_id', $id)
        //     ->first();

        // $imageName = $existingSection['section_image'] ?? null;

        // if ($sectionImage && $sectionImage->isValid()) {
        //     $imageName = $sectionImage->getRandomName();
        //     $sectionImage->move(FCPATH . 'images/', $imageName);
        // }

        // $sectionData = [
        //     'section_title' => $sectionTitle,
        //     'section_description' => $sectionDescription,
        //     'section_image' => $imageName,
        // ];

        // $this->microMarketSectionModel->update($existingSection['id'], $sectionData);


        return redirect()->to('/admin/properties')->with('success', 'Property updated successfully.');
    }
    public function deleteVideo($id)
    {
        $video = $this->propertyVideoModel->find($id);

        if (!$video) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Video not found.'
            ]);
        }

        $filePath = FCPATH . 'uploads/properties/videos/' . $video['video'];
        if (is_file($filePath)) {
            unlink($filePath);
        }

        $this->propertyVideoModel->delete($id);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Video deleted successfully.'
        ]);
    }


    public function delete_property_image($imageId)
    {
        $image = $this->propertyImageModel->find($imageId);

        if ($image) {
            $imagePath = FCPATH . 'admin-template/uploads/properties/' . $image['image'];
            if (is_file($imagePath)) {
                unlink($imagePath);
            }

            $this->propertyImageModel->delete($imageId);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Image deleted successfully.',
            'csrfHash' => csrf_hash()
        ]);
    }

    public function delete_property($id)
    {
        // === Delete property images ===
        $propertyImages = $this->propertyImageModel->where('property_id', $id)->findAll();
        foreach ($propertyImages as $img) {
            $filePath = FCPATH . 'uploads/properties/' . $img['image'];
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
        $this->propertyImageModel->where('property_id', $id)->delete();

        // === Delete master plan images ===
        $masterPlans = $this->masterPlanModel->where('property_id', $id)->findAll();
        foreach ($masterPlans as $plan) {
            $planPath = FCPATH . 'uploads/master_plans/' . $plan['master_plan_image'];
            if (is_file($planPath)) {
                unlink($planPath);
            }
        }
        $this->masterPlanModel->where('property_id', $id)->delete();

        // === Delete floor plans and their images ===
        $floorPlans = $this->floorPlanModel->where('property_id', $id)->findAll();
        foreach ($floorPlans as $plan) {
            $images = $this->floorPlanImageModel->where('floor_plan_id', $plan['id'])->findAll();
            foreach ($images as $img) {
                $imgPath = FCPATH . 'uploads/floor_plans/' . $img['image'];
                if (is_file($imgPath)) {
                    unlink($imgPath);
                }
            }
            $this->floorPlanImageModel->where('floor_plan_id', $plan['id'])->delete();
        }
        $this->floorPlanModel->where('property_id', $id)->delete();
        // Delete Legal Approvals & Files
        $legalApprovals = $this->legalApprovalModel->where('property_id', $id)->findAll();
        foreach ($legalApprovals as $approval) {
            if (!empty($approval['document_file'])) {
                $docPath = FCPATH . 'documents/' . $approval['document_file'];
                if (is_file($docPath)) {
                    unlink($docPath);
                }
            }
        }
        $this->legalApprovalModel->where('property_id', $id)->delete();
        // === Delete Micro Market Documents ===
        $marketDocs = $this->microMarketDocumentModel->where('property_id', $id)->findAll();
        foreach ($marketDocs as $doc) {
            if (!empty($doc['image'])) {
                $docPath = FCPATH . 'uploads/micro_market/' . $doc['image'];
                if (is_file($docPath)) {
                    unlink($docPath);
                }
            }
        }
        $this->microMarketDocumentModel->where('property_id', $id)->delete();

        // === Delete Micro Market Section ===
        $section = $this->microMarketSectionModel->where('property_id', $id)->first();
        if ($section && !empty($section['section_image'])) {
            $imgPath = FCPATH . 'images/' . $section['section_image'];
            if (is_file($imgPath)) {
                unlink($imgPath);
            }
            $this->microMarketSectionModel->delete($section['id']);
        }

        // === Delete Property Amenities ===
        $this->propertyAmenitiesModel->where('property_id', $id)->delete();

        // === Delete Specifications ===
        $this->propertySpecificationsModel->where('property_id', $id)->delete();

        // === Finally delete property ===
        $this->propertyModel->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Property and all related data deleted successfully.']);
    }
    public function delete_floor_plan($id)
    {
        if ($this->request->isAJAX()) {
            try {
                $floorPlan = $this->floorPlanModel->find($id);

                if (!$floorPlan) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Floor plan not found.'
                    ]);
                }

                // Delete associated images
                $images = $this->floorPlanImageModel->where('floor_plan_id', $id)->findAll();

                foreach ($images as $img) {
                    if (!empty($img['image'])) {
                        $filePath = FCPATH . 'uploads/floor_plans/' . $img['image'];
                        if (file_exists($filePath)) {
                            try {
                                unlink($filePath);
                            } catch (\Throwable $e) {
                                log_message('error', 'Error deleting image file: ' . $filePath . ' - ' . $e->getMessage());
                            }
                        }
                    }
                }

                // Delete image records from DB
                $this->floorPlanImageModel->where('floor_plan_id', $id)->delete();

                // Delete the floor plan
                if ($this->floorPlanModel->delete($id)) {
                    return $this->response->setJSON(['success' => true]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to delete floor plan.'
                    ])->setStatusCode(400);
                }
            } catch (\Throwable $e) {
                log_message('error', 'Error deleting floor plan: ' . $e->getMessage());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Internal Server Error'
                ])->setStatusCode(500);
            }
        }

        return $this->response->setStatusCode(400)->setJSON([
            'success' => false,
            'message' => 'Invalid request.'
        ]);
    }
    public function view_property_images($id)
    {
        if ($this->request->isAJAX()) {
            $images = $this->propertyImageModel->where('property_id', $id)->findAll();
            return view('admin/property_images_modal', ['images' => $images]);
        }
    }
    public function developers()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;

        $developers = $this->developerModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage, 'group1');

        $pager = $this->developerModel->pager;

        $data = [
            'title' => 'Developers',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/developers',
            'developers' => $developers,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
        ];

        return view('admin/layout/templates', $data);
    }

    public function add_developer()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        // Load models
        $propertyModel = new PropertyModel();
        $assignedPropertyIds = $this->developerModel->select('property_id')->findAll();

        // Extract assigned property IDs
        $assignedIds = array_column($assignedPropertyIds, 'property_id');

        // Fetch properties not already assigned to any developer
        $availableProperties = $propertyModel->whereNotIn('id', $assignedIds)->findAll();

        $data = [
            'title' => 'Developers',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_developer',
            'properties' => $availableProperties,
        ];

        return view('admin/layout/templates', $data);
    }


    public function save_developer()
    {
        helper(['form', 'url']);

        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required',
            'established_year' => 'required|numeric|min_length[4]',
            'completed_projects' => 'required',
            'description' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpeg,image/png,image/jpg]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $validation->getErrors()));
        }

        $image = $this->request->getFile('image');
        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/developers/', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'property_id' => $this->request->getPost('property_id'),
            'established_year' => $this->request->getPost('established_year'),
            'completed_projects' => $this->request->getPost('completed_projects'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->developerModel->insert($data)) {
            return redirect()->to('admin/developers')->with('success', 'Developer added successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to save developer.');
        }
    }

    public function edit_developer($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        // Get developer by ID
        $developer = $this->developerModel->find($id);
        if (!$developer) {
            return redirect()->back()->with('error', 'Developer not found.');
        }

        // Get logged-in admin name
        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        // Get all property IDs assigned to developers excluding the current one
        $assignedPropertyIds = $this->developerModel
            ->where('id !=', $id)
            ->select('property_id')
            ->findAll();

        $assignedIds = array_column($assignedPropertyIds, 'property_id');

        // Build property query
        $builder = $this->propertyModel;

        if (!empty($assignedIds)) {
            $builder = $builder->whereNotIn('id', $assignedIds);
        }

        $builder = $builder->orWhere('id', $developer['property_id']);

        $properties = $builder->findAll();

        $data = [
            'title' => 'Edit Developer',
            'name' => $user['username'] ?? 'Admin',
            'developer' => $developer,
            'properties' => $properties,
            'content' => 'admin/edit_developer'
        ];

        return view('admin/layout/templates', $data);
    }
    public function update_developer($id)
    {
        $developer = $this->developerModel->find($id);
        if (!$developer) {
            return redirect()->back()->with('error', 'Developer not found.');
        }

        $rules = [
            'name' => 'required',
            'established_year' => 'required|numeric',
            'completed_projects' => 'required',
            'description' => 'required',
            'property_id' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $image = $this->request->getFile('image');
        $imageName = $developer['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if (!empty($developer['image']) && file_exists(FCPATH . 'uploads/developers/' . $developer['image'])) {
                unlink(FCPATH . 'uploads/developers/' . $developer['image']);
            }

            $imageName = $image->getRandomName();
            $image->move('uploads/developers/', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'property_id' => $this->request->getPost('property_id'),
            'established_year' => $this->request->getPost('established_year'),
            'completed_projects' => $this->request->getPost('completed_projects'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->developerModel->update($id, $data);

        return redirect()->to(base_url('admin/developers'))->with('success', 'Developer updated successfully.');
    }
    public function delete_developer($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $developer = $this->developerModel->find($id);
        if (!$developer) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Developer not found']);
        }

        // Delete image from server
        if (!empty($developer['image']) && file_exists(FCPATH . 'uploads/developers/' . $developer['image'])) {
            unlink(FCPATH . 'uploads/developers/' . $developer['image']);
        }

        // Delete record from DB
        if ($this->developerModel->delete($id)) {
            return $this->response->setJSON(['success' => 'Developer deleted successfully']);
        }
    }
    // 1. Show All Services
    public function services()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $user = session()->get(); // Assuming you store username in session
        $services = $this->serviceModel->findAll();

        $data = [
            'title' => 'Services',
            'name' => $user['username'] ?? 'Admin',
            'services' => $services,
            'content' => 'admin/services',
        ];
        return view('admin/layout/templates', $data);
    }

    // 2. Add Service Form
    public function addService()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $user = session()->get();

        $data = [
            'title' => 'Add Service',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_service',
        ];
        return view('admin/layout/templates', $data);
    }

    // 3. Insert New Service
    public function saveService()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'icon' => 'uploaded[icon]|is_image[icon]|max_size[icon,1024]',
            'title' => 'required',
            'slug' => 'required|is_unique[services.slug]',
            'short_description' => 'required',
            'long_description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        // Handle icon
        $iconFile = $this->request->getFile('icon');
        $iconName = '';
        if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
            $iconName = $iconFile->getRandomName();
            $iconFile->move('uploads/icons/', $iconName);
        }

        // Handle main image
        $img = $this->request->getFile('image');
        $imageName = '';
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imageName = $img->getRandomName();
            $img->move('uploads/services/', $imageName);
        }

        $this->serviceModel->save([
            'icon' => $iconName,
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'short_description' => $this->request->getPost('short_description'), // or 'description'
            'long_description' => $this->request->getPost('long_description'),
            'image' => $imageName,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('admin/services')->with('success', 'Service added successfully');
    }


    // 4. Edit Service Form
    public function editService($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $user = session()->get();
        $service = $this->serviceModel->find($id);

        if (!$service) {
            return redirect()->to('admin/services')->with('error', 'Service not found');
        }

        $data = [
            'title' => 'Edit Service',
            'name' => $user['username'] ?? 'Admin',
            'service' => $service,
            'content' => 'admin/edit_service',
        ];
        return view('admin/layout/templates', $data);
    }

    // 5. Update Service
    public function updateService($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'title' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $service = $this->serviceModel->find($id);

        // Handle icon upload
        $iconFile = $this->request->getFile('icon');
        $iconName = $service['icon'] ?? '';

        if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
            if (!empty($iconName) && file_exists('uploads/icons/' . $iconName)) {
                unlink('uploads/icons/' . $iconName);
            }
            $iconName = $iconFile->getRandomName();
            $iconFile->move('uploads/icons/', $iconName);
        }

        // Handle main image upload
        $img = $this->request->getFile('image');
        $imageName = $service['image'] ?? '';

        if ($img && $img->isValid() && !$img->hasMoved()) {
            if (!empty($imageName) && file_exists('uploads/services/' . $imageName)) {
                unlink('uploads/services/' . $imageName);
            }
            $imageName = $img->getRandomName();
            $img->move('uploads/services/', $imageName);
        }

        $this->serviceModel->update($id, [
            'icon' => $iconName,
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'short_description' => $this->request->getPost('short_description'),
            'long_description' => $this->request->getPost('long_description'),
            'image' => $imageName,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('admin/services')->with('success', 'Service updated successfully');
    }


    // 6. Delete Service
    public function deleteService($id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {
            return $this->response->setJSON(['error' => 'Service not found']);
        }

        if (!empty($service['image']) && file_exists('uploads/services/' . $service['image'])) {
            unlink('uploads/services/' . $service['image']);
        }

        $this->serviceModel->delete($id);

        return $this->response->setJSON(['success' => true]);
    }
    public function about()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $data = [
            'title' => 'About Us',
            'about' => $this->aboutModel->first(),
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/about',
        ];
        return view('admin/layout/templates', $data);
    }

    public function add_about()
    {
        $data = [
            'title' => 'Add About Section',
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/add_about',
        ];
        return view('admin/layout/templates', $data);
    }

    public function save_about()
    {
        $rules = [
            'heading' => 'required',
            'paragraphs_left' => 'required',
            'paragraphs_right' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $data = [
            'heading' => $this->request->getPost('heading'),
            'paragraphs_left' => $this->request->getPost('paragraphs_left'),
            'paragraphs_right' => $this->request->getPost('paragraphs_right'),
        ];

        $this->aboutModel->insert($data);

        return redirect()->to('/admin/about')->with('success', 'About section added successfully.');
    }


    public function edit_about($id)
    {
        $about = $this->aboutModel->find($id);
        if (!$about) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $data = [
            'title' => 'Edit About Section',
            'about' => $about,
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/edit_about',
        ];
        return view('admin/layout/templates', $data);
    }

    public function update_about($id)
    {
        $about = $this->aboutModel->find($id);
        if (!$about) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $this->aboutModel->update($id, [
            'heading' => $this->request->getPost('heading'),
            'paragraphs_left' => $this->request->getPost('paragraphs_left'),
            'paragraphs_right' => $this->request->getPost('paragraphs_right'),
        ]);

        return redirect()->to('admin/about')->with('success', 'About section updated successfully.');
    }


    public function delete_about($id)
    {
        $this->aboutModel->delete($id);
        return $this->response->setJSON(['success' => 'Deleted successfully']);
    }


    public function features()
    {
        helper('text');
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $data = [
            'title' => 'Features',
            'features' => $this->featureModel->findAll(),
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/features',
        ];
        $data['can_add_feature'] = count($data['features']) < 3;
        return view('admin/layout/templates', $data);
    }

    public function add_feature()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $data = [
            'title' => 'Add Feature',
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/add_feature',
        ];
        return view('admin/layout/templates', $data);
    }

    public function save_feature()
    {
        helper(['form', 'url']);

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'icon' => 'uploaded[icon]|max_size[icon,1024]|is_image[icon]',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed. Please check inputs and file size (max 1MB).');
        }

        // Upload icon
        $iconFile = $this->request->getFile('icon');
        $iconName = $iconFile->getRandomName();
        $iconFile->move('uploads/about', $iconName);

        // Upload image
        $imageFile = $this->request->getFile('image');
        $imageName = $imageFile->getRandomName();
        $imageFile->move('uploads/about', $imageName);

        $data = [
            'icon' => $iconName,
            'image' => $imageName,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        $this->featureModel->insert($data);

        return redirect()->to('/admin/features')->with('success', 'Feature added successfully.');
    }


    public function edit_feature($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $feature = $this->featureModel->find($id);
        if (!$feature) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $data = [
            'title' => 'Edit Feature',
            'feature' => $feature,
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/edit_feature',
        ];
        return view('admin/layout/templates', $data);
    }

    public function update_feature($id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $feature = $this->featureModel->find($id);
        if (!$feature) {
            return redirect()->to('/admin/features')->with('error', 'Feature not found.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Handle icon upload
        $iconFile = $this->request->getFile('icon');
        if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
            $iconName = $iconFile->getRandomName();
            $iconFile->move('uploads/about', $iconName);
            $data['icon'] = $iconName;

            // Optionally delete old icon
            if (!empty($feature['icon']) && file_exists('uploads/about/' . $feature['icon'])) {
                unlink('uploads/about/' . $feature['icon']);
            }
        } else {
            $data['icon'] = $feature['icon']; // keep existing
        }

        // Handle image upload
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('uploads/about', $imageName);
            $data['image'] = $imageName;

            // Optionally delete old image
            if (!empty($feature['image']) && file_exists('uploads/about/' . $feature['image'])) {
                unlink('uploads/about/' . $feature['image']);
            }
        } else {
            $data['image'] = $feature['image']; // keep existing
        }

        $this->featureModel->update($id, $data);

        return redirect()->to('/admin/features')->with('success', 'Feature updated successfully.');
    }


    public function delete_feature($id)
    {
        $this->featureModel->delete($id);
        return $this->response->setJSON(['success' => 'Deleted successfully']);
    }


    // TEAM MEMBERS SECTION
    public function team()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $data = [
            'title' => 'Team',
            'team_members' => $this->teamModel->findAll(),
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/team',
        ];

        return view('admin/layout/templates', $data);
    }
    public function add_team()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $data = [
            'title' => 'Add Team Member',
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/add_team',
        ];

        return view('admin/layout/templates', $data);
    }
    public function save_team()
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]|max_size[image,1024]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move('uploads/team/', $imageName);

        $data = [
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->teamModel->insert($data);

        return redirect()->to('/admin/team')->with('success', 'Team member added successfully.');
    }
    public function edit_team($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $member = $this->teamModel->find($id);
        if (!$member) {
            return redirect()->back()->with('error', 'Team member not found.');
        }

        $data = [
            'title' => 'Edit Team Member',
            'team_member' => $member,
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/edit_team_member',
        ];

        return view('admin/layout/templates', $data);
    }
    public function update_team($id)
    {
        $member = $this->teamModel->find($id);
        if (!$member) {
            return redirect()->back()->with('error', 'Team member not found.');
        }

        $rules = [
            'name' => 'required',
            'designation' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $image = $this->request->getFile('image');
        $imageName = $member['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if (file_exists(FCPATH . 'uploads/team/' . $imageName)) {
                unlink(FCPATH . 'uploads/team/' . $imageName);
            }

            $imageName = $image->getRandomName();
            $image->move('uploads/team/', $imageName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'image' => $imageName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->teamModel->update($id, $data);

        return redirect()->to('/admin/team')->with('success', 'Team member updated successfully.');
    }
    public function delete_team($id)
    {
        $member = $this->teamModel->find($id);
        if (!$member) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Team member not found']);
        }

        if (!empty($member['image']) && file_exists(FCPATH . 'uploads/team/' . $member['image'])) {
            unlink(FCPATH . 'uploads/team/' . $member['image']);
        }

        $this->teamModel->delete($id);

        return $this->response->setJSON(['success' => 'Team member deleted successfully']);
    }


    public function statistics()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $data = [
            'title' => 'Statistics',
            'statistics' => $this->statModel->findAll(),
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/statistics',
        ];
        return view('admin/layout/templates', $data);
    }

    public function add_statistic()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $data = [
            'title' => 'Add Statistic',
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/add_statistic',
        ];
        return view('admin/layout/templates', $data);
    }

    public function save_statistic()
    {
        $rules = [
            'images' => 'uploaded[images]|max_size[images,1024]|is_image[images]',
            'number' => 'required|numeric',
            'caption' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $image = $this->request->getFile('images');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/statistics', $imageName);
        }

        $data = [
            'caption' => $this->request->getPost('caption'),
            'number' => $this->request->getPost('number'),
            'images' => $imageName,
        ];

        $this->statModel->insert($data);
        return redirect()->to('/admin/statistics')->with('success', 'Statistic added successfully.');
    }


    public function edit_statistic($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }
        $stat = $this->statModel->find($id);
        if (!$stat) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $data = [
            'title' => 'Edit Statistic',
            'statistic' => $stat,
            'name' => session()->get('user')['username'] ?? 'Admin',
            'content' => 'admin/edit_statistic',
        ];
        return view('admin/layout/templates', $data);
    }

    public function update_statistic($id)
    {
        $rules = [
            'caption' => 'required',
            'number' => 'required|numeric',
            'images' => 'if_exist|max_size[images,1024]|is_image[images]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $image = $this->request->getFile('images');
        $imageName = null;

        // Get existing record
        $existing = $this->statModel->find($id);
        if (!$existing) {
            return redirect()->back()->with('error', 'Statistic not found.');
        }

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Optionally delete old image
            if (!empty($existing['images']) && file_exists('uploads/statistics/' . $existing['images'])) {
                unlink('uploads/statistics/' . $existing['images']);
            }

            $imageName = $image->getRandomName();
            $image->move('uploads/statistics', $imageName);
        } else {
            $imageName = $existing['images']; // keep old image
        }

        $data = [
            'caption' => $this->request->getPost('caption'),
            'number' => $this->request->getPost('number'),
            'images' => $imageName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->statModel->update($id, $data);
        return redirect()->to('/admin/statistics')->with('success', 'Statistic updated successfully.');
    }


    public function delete_statistic($id)
    {
        $this->statModel->delete($id);
        return $this->response->setJSON(['success' => 'Deleted successfully']);
    }
    // 1. Show All Resources
    public function resources()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $resources = $this->resourceModel->findAll();
        $user = session()->get();

        $data = [
            'title' => 'Resources',
            'name' => $user['username'] ?? 'Admin',
            'resources' => $resources,
            'content' => 'admin/resources',
        ];
        return view('admin/layout/templates', $data);
    }

    // 2. Show Add Resource Form
    public function addResource()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        if (count($this->resourceModel->findAll()) >= 5) {
            return redirect()->back()->with('error', 'You can add only 5 resources.');
        }

        $user = session()->get();
        $data = [
            'title' => 'Add Resource',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_resource',
        ];
        return view('admin/layout/templates', $data);
    }

    // 3. Save New Resource
    public function saveResource()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'title'             => 'required',
            'slug'              => 'required|is_unique[resources.slug]',
            'category'          => 'required',
            'description'       => 'required',
            'publish_date'      => 'required',
            'image'             => 'uploaded[image]|is_image[image]|max_size[image,1024]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $img = $this->request->getFile('image');
        $imageName = '';
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imageName = $img->getRandomName();
            $img->move('uploads/resources/', $imageName);
        }

        $this->resourceModel->save([
            'title'             => $this->request->getPost('title'),
            'slug'              => $this->request->getPost('slug'),
            'category'          => $this->request->getPost('category'),
            'short_description' => $this->request->getPost('short_description'),
            'description'       => $this->request->getPost('description'),
            'image'             => $imageName,
            'publish_date'      => $this->request->getPost('publish_date'),
            'read_time'         => $this->request->getPost('read_time'),
            'author_name'       => $this->request->getPost('author_name'),
            'meta_title'        => $this->request->getPost('meta_title'),
            'meta_description'  => $this->request->getPost('meta_description'),
            'meta_keywords'     => $this->request->getPost('meta_keywords'),
            'tags'              => $this->request->getPost('tags'),
            'is_new'            => $this->request->getPost('is_new') ?? 0,
            'is_featured'       => $this->request->getPost('is_featured') ?? 0,
            'status'            => $this->request->getPost('status'),
        ]);

        return redirect()->to('admin/resources')->with('success', 'Resource added successfully');
    }


    // 4. Show Edit Form
    public function editResource($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $resource = $this->resourceModel->find($id);
        $user = session()->get();

        if (!$resource) {
            return redirect()->to('admin/resources')->with('error', 'Resource not found');
        }

        $data = [
            'title' => 'Edit Resource',
            'name' => $user['username'] ?? 'Admin',
            'resource' => $resource,
            'content' => 'admin/edit_resource',
        ];
        return view('admin/layout/templates', $data);
    }

    // 5. Update Resource
    public function updateResource($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'title'       => 'required',
            'slug'        => "required|is_unique[resources.slug,id,{$id}]",
            'category'    => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $resource   = $this->resourceModel->find($id);
        $imageName  = $resource['image'];

        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // delete old
            if ($imageName && file_exists('uploads/resources/' . $imageName)) {
                unlink('uploads/resources/' . $imageName);
            }
            $imageName = $img->getRandomName();
            $img->move('uploads/resources/', $imageName);
        }

        $this->resourceModel->update($id, [
            'title'             => $this->request->getPost('title'),
            'slug'              => $this->request->getPost('slug'),
            'category'          => $this->request->getPost('category'),
            'description'       => $this->request->getPost('description'),
            'short_description' => $this->request->getPost('short_description'),
            'image'             => $imageName,
            'publish_date'      => $this->request->getPost('publish_date'),
            'read_time'         => $this->request->getPost('read_time'),
            'author_name'       => $this->request->getPost('author_name'),
            'meta_title'        => $this->request->getPost('meta_title'),
            'meta_description'  => $this->request->getPost('meta_description'),
            'meta_keywords'     => $this->request->getPost('meta_keywords'),
            'tags'              => $this->request->getPost('tags'),
            'is_new'            => $this->request->getPost('is_new') ?? 0,
            'is_featured'       => $this->request->getPost('is_featured') ?? 0,
            'status'            => $this->request->getPost('status'),
        ]);

        return redirect()->to('admin/resources')->with('success', 'Resource updated successfully');
    }


    // 6. Delete Resource
    public function deleteResource($id)
    {
        $resource = $this->resourceModel->find($id);

        if (!$resource) {
            return $this->response->setJSON(['error' => 'Resource not found']);
        }

        if (!empty($resource['image']) && file_exists('uploads/resources/' . $resource['image'])) {
            unlink('uploads/resources/' . $resource['image']);
        }

        $this->resourceModel->delete($id);
        return $this->response->setJSON(['success' => true]);
    }
    public function contact_us()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        $contact = $this->contactModel->first(); // assuming one record

        $data = [
            'title' => 'Contact Us',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/contact_us',
            'contact' => $contact,
        ];

        return view('admin/layout/templates', $data);
    }
    public function add_contact()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        $data = [
            'title' => 'Add Contact Us Info',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/add_contact_us',
        ];

        return view('admin/layout/templates', $data);
    }
    public function save_contact()
    {
        helper(['form']);

        $rules = [
            'location' => 'required',
            'open_days' => 'required',
            'open_hours' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        $data = [
            'location' => $this->request->getPost('location'),
            'open_days' => $this->request->getPost('open_days'),
            'open_hours' => $this->request->getPost('open_hours'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->contactModel->insert($data)) {
            return redirect()->to('admin/contact-us')->with('success', 'Contact details added.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to save contact info.');
    }
    public function edit_contact($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        $contact = $this->contactModel->find($id);
        if (!$contact) {
            return redirect()->back()->with('error', 'Contact info not found.');
        }

        $adminId = session()->get('admin_id');
        $user = $this->adminModel->find($adminId);

        $data = [
            'title' => 'Edit Contact Info',
            'name' => $user['username'] ?? 'Admin',
            'content' => 'admin/edit_contact_us',
            'contact' => $contact,
        ];

        return view('admin/layout/templates', $data);
    }
    public function update_contact($id)
    {
        $contact = $this->contactModel->find($id);
        if (!$contact) {
            return redirect()->back()->with('error', 'Contact not found.');
        }

        $rules = [
            'location' => 'required',
            'open_days' => 'required',
            'open_hours' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed.');
        }

        $data = [
            'location' => $this->request->getPost('location'),
            'open_days' => $this->request->getPost('open_days'),
            'open_hours' => $this->request->getPost('open_hours'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->contactModel->update($id, $data);

        return redirect()->to('admin/contact-us')->with('success', 'Contact updated successfully.');
    }
    public function delete_contact($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $contact = $this->contactModel->find($id);
        if (!$contact) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Contact not found']);
        }

        if ($this->contactModel->delete($id)) {
            return $this->response->setJSON(['success' => 'Contact deleted successfully']);
        }

        return $this->response->setStatusCode(500)->setJSON(['error' => 'Deletion failed']);
    }



}
